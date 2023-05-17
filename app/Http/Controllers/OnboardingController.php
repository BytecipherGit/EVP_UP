<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OnboardingProcess;
use App\Models\Onboarding;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class OnboardingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $data = OnboardingProcess::where('company_id', Auth::id())->select('id', 'title', 'descriptions')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                 ->addColumn('action', function ($row) {
                     $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn updateProcess fa fa-edit" title="Edit"></a>';
                     $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteProcess fa fa-trash" title="Delete"></a>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         return view('admin.onboarding_process');
     }
 
     public function onboardingForm($id = '')
     {
         $onboarding = (!empty($id)) ? OnboardingProcess::find($id) : false;
         return view('admin.onboarding_process_form', compact('onboarding'));
     }
 
     public function createOnboardingProcess(request $request)
     {
        // dd($request->all());
         if (Auth::check()) {
             $validator = Validator::make($request->all(), [
                 'title' => 'required|string|max:255',
                 'descriptions' => 'required|string|max:255',
             ]);
             if ($validator->passes()) {
 
                 $insert = [
                     'company_id' => Auth::id(),
                     'title' => !empty($request->title) ? $request->title : null,
                     'descriptions' => !empty($request->descriptions) ? $request->descriptions : null,
                 ];
                 $onboardData = OnboardingProcess::create($insert);
                 if (!empty($onboardData)) {
                     return Response::json(['success' => '1']);
                 } else {
                     return Response::json(['success' => '0']);
                 }
 
             } else {
                 return Response::json(['errors' => $validator->errors()]);
             }
         }
 
     }
 
     public function updateOnboardingProcess(request $request)
     {
         if (Auth::check()) {
             $validator = Validator::make($request->all(), [
                 'title' => 'required|string|max:255',
                 'descriptions' => 'required|string|max:255',
             ]);
             if ($validator->passes()) {
                 if ($request->employee_id) {
                     $update = [
                         'company_id' => Auth::id(),
                         'title' => !empty($request->title) ? $request->title : null,
                         'descriptions' => !empty($request->descriptions) ? $request->descriptions : null,
                     ];
                     $employeeData = OnboardingProcess::where('id', $request->employee_id)->update($update);
                     if (!empty($employeeData)) {
                         return Response::json(['success' => '1']);
                     } else {
                         return Response::json(['success' => '0']);
                     }
                 } else {
                     return Response::json(['success' => '0']);
                 }
 
             } else {
                 return Response::json(['errors' => $validator->errors()]);
             }
         }
 
     }
 
     public function deleteOnboardingProcess(request $request)
     {
 
         if (!empty($request->employeeId)) {
             $employee = OnboardingProcess::find($request->employeeId);
             if ($employee->delete()) {
                 return Response::json(['success' => '1']);
             } else {
                 return Response::json(['success' => '0']);
             }
         } else {
             return Response::json(['success' => '0']);
         }
     }

     public function getOnboardingForm($id = '')
     { 

        if (Auth::check()) {
            // $onboardEmployee = Onboarding::where('employee_id', $id)->where('company_id', Auth::id())->first();

            $employeeonboarding = Onboarding::leftjoin('onboarding_processes', 'onboarding_processes.id', '=', 'onboarding_employee.onboarding_process_id')
                                         ->leftjoin('company_employee','company_employee.company_id','=','onboarding_processes.company_id')
                                         ->leftjoin('employee','employee.id','=','onboarding_employee.employee_id')
                                         ->where('onboarding_employee.employee_id', $id)
                                         ->select('onboarding_employee.*')
                                         ->first();
            $onboardProcessExist = OnboardingProcess::where('company_id', Auth::id())->orderby('id', 'asc')->first();
            $employee = Employee::where('id',$id)->first();
            $onboardProcess = OnboardingProcess::where('company_id', Auth::id())->orderby('id', 'asc')->get();

            return view('admin.onboarding-form', compact('onboardProcess','employee','employeeonboarding','onboardProcessExist'));
        }
     }

     public function createOnboardingForm(request $request)
     {

         $checkRecordExist = Onboarding::where('employee_id', $request->employee_id)->first();
         if (empty($checkRecordExist)) {
   
          for ($i = 0; $i < count($request->process_id); $i++) {
                $uploadDocumentPath = '';
                    if (!empty($request->document[$i])) {
                     if ($request->document[$i]->getClientOriginalName()) {
                        $file = $request->file('document');
                        $fileName = '';
                        $fileName = time() . '_' . $file[$i]->getClientOriginalName();
                        $file[$i]->storeAs('public/onboarding_documents', $fileName);
                        $uploadDocumentPath = asset('storage/onboarding_documents/' . $fileName);
                      }
                      $status = '';
                         if (!empty($request->status[$i]) && $request->status[$i] == true) {
                             $status = 1;
                         } else {
                             $status = 0;
                         }
                         $insert = array(
                             'company_id' => Auth::id(),
                             'employee_id' => $request->employee_id,
                             'onboarding_process_id' => $request->process_id[$i],
                             'description' => $request->description[$i],
                             'document' => !empty($uploadDocumentPath) ? $uploadDocumentPath : '',
                             'status' => $status,
                            
                         );

                         $onboardData = Onboarding::create($insert);

                         if(!empty($onboardData)){
                            $updateOfferEmp = DB::table('employee_offer_statuses')->where('employee_id', $onboardData->employee_id)->where('company_id',Auth::id())
                        ->update([

                            'onboarding_employee_id' => $onboardData->id,
                        ]);
                        
                        }
            
                    }  else { 

                            $status = '';
                            if (!empty($request->status[$i]) && $request->status[$i] == true) {
                                $status = 1;
                            } else {
                                $status = 0;
                            }

                            $insert = array(
                             'company_id' => Auth::id(),
                             'employee_id' => $request->employee_id,
                             'onboarding_process_id' => $request->process_id[$i],
                             'description' => $request->description[$i],
                             'document' => !empty($uploadDocumentPath) ? $uploadDocumentPath : '',
                             'status' => $status,
    
                            );

                            $onboardData = Onboarding::create($insert);
                              
                            if(!empty($onboardData)){
                                $updateOfferEmp = DB::table('employee_offer_statuses')->where('employee_id', $onboardData->employee_id)->where('company_id',Auth::id())
                            ->update([
                                
                                'onboarding_employee_id' => $onboardData->id,
                            ]);
                            
                            }
                      }

                     } 
               
                 if (!empty($onboardData)) {
                     return Response::json(['success' => '1']);
                 } else {
                     return Response::json(['success' => '0']);
                 }
        
           }  else {
             return Response::json(['success' => '0']);
          }
        
        }
    }
        