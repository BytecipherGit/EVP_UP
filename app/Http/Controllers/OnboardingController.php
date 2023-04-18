<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OnboardingProcess;
use App\Models\Onboarding;
use App\Models\Employee;
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
                     $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn updateProcess fa fa-edit" data-title="Edit"></a>';
                     $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteProcess fa fa-trash" data-title="Delete"></a>';
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
            $onboardEmployee = Onboarding::where('employee_id', $id)->where('company_id', Auth::id())->first();
            $employee = Employee::where('id',$id)->first();
            $onboardProcess = OnboardingProcess::where('company_id', Auth::id())->orderby('id', 'asc')->get();
            return view('admin.onboarding-form', compact('onboardProcess','employee','onboardEmployee'));
        }
     }

     public function createOnboardingForm(request $request)
     {
         $checkRecordExist = Onboarding::where('employee_id', $request->employee_id)->first();
         if (empty($checkRecordExist)) {
                 for ($i = 0; $i < count($request->process_id); $i++) {
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
                             'status' => $status,
                            
                         );
 
                         $onboardData = Onboarding::create($insert);
                         
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
        