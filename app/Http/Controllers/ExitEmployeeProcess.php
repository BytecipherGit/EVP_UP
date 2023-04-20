<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Models\Exitemp;
use App\Models\ExitEmployeeProcess as ExitEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyEmployee;
use App\Models\Employee;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ExitEmployeeProcess extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ExitEmployee::where('company_id', Auth::id())->select('id', 'title', 'descriptions')->get();
            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn updateProcess fa fa-edit" data-title="Edit"></a>';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteProcess fa fa-trash" data-title="Delete"></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.exit_employee_process');
    }

    public function exitEmployeeForm($id = '')
    {
        $exitemployee = (!empty($id)) ? ExitEmployee::find($id) : false;
        return view('admin.exit_employee_process_form', compact('exitemployee'));
    }

    public function createExitEmployeeProcess(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
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
                $interviewData = ExitEmployee::create($insert);
                if (!empty($interviewData)) {
                    return Response::json(['success' => '1']);
                } else {
                    return Response::json(['success' => '0']);
                }

            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function updateExitEmployeeProcess(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
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
                    $employeeData = ExitEmployee::where('id', $request->employee_id)->update($update);
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

    public function deleteExitEmployeeProcess(request $request)
    {

        if (!empty($request->employeeId)) {
            $employee = ExitEmployee::find($request->employeeId);
            if ($employee->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function getExitEmployee($id = '')
    {
        $exitproces = ExitEmployee::where('company_id', Auth::id())->first();
        $exitprocess = ExitEmployee::where('company_id', Auth::id())->get();
        $employee = (!empty($id)) ? Employee::find($id) : false;
        // dd($employee);
        return view('admin.exit_employee_form', compact('employee', 'exitprocess','exitproces'));
    }

    public function createExitEmployee(request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_of_exit' => 'required|string|max:255',
            // 'decipline' => 'required|string|max:255',
            // 'reason' => 'required|string|max:255',
            // 'rating' => 'required|string|max:255',
            // 'document' => 'required|string|max:255',

        ]);

    $checkRecordExist = Exitemp::join('company_employee','company_employee.company_id','=','exit_employee.company_id')->where('exit_employee.company_id',Auth::id())
                        ->where('exit_employee.employee_id', $request->emp_id)->first();
                        // dd($checkRecordExist);
        if (empty($checkRecordExist)) {
            if ($validator->passes()) {
                for ($i = 0; $i < count($request->exit_process_id); $i++) {
                    $uploadAttachementPath = '';
                    if (!empty($request->document[$i])) {
                        if ($request->document[$i]->getClientOriginalName()) {
                            $file = $request->file('document');
                            $fileName = '';
                            $fileName = time() . '_' . $file[$i]->getClientOriginalName();
                            $file[$i]->storeAs('public/interview_documents', $fileName);
                            $uploadAttachementPath = asset('storage/interview_documents/' . $fileName);
                        }
                        $status = '';
                        if (!empty($request->status[$i]) && $request->status[$i] == true) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                        $insert = array(
                            'company_id' => Auth::id(),
                            'employee_id' => $request->emp_id,
                            'exit_process_id' => $request->exit_process_id[$i],
                            'date_of_exit' => $request->date_of_exit,
                            'decipline' => $request->decipline,
                            'reason_of_exit' => $request->reason_of_exit,
                            'rating' => $request->rating,
                            'review' => $request->review,
                            'status' => $status,
                            'document' => !empty($uploadAttachementPath) ? $uploadAttachementPath : '',

                        );

                        $employeeData = Exitemp::create($insert);
                        

                    } else {

                        $status = '';
                        if (!empty($request->status[$i]) && $request->status[$i] == true) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                        $insert = array(
                            'company_id' => Auth::id(),
                            'employee_id' => $request->emp_id,
                            'exit_process_id' => $request->exit_process_id[$i],
                            'date_of_exit' => $request->date_of_exit,
                            'decipline' => $request->decipline,
                            'reason_of_exit' => $request->reason_of_exit,
                            'rating' => $request->rating,
                            'review' => $request->review,
                            'status' => $status,
                            'document' => !empty($uploadAttachementPath) ? $uploadAttachementPath : '',

                        );
                        $employeeData = Exitemp::create($insert);
                        
                    }
                }
                if(!empty($employeeData)){

                 CompanyEmployee::where('employee_id',$employeeData->employee_id)->update([
                    'end_date'  => $employeeData->date_of_exit,
                    'status'  => '0'
                  ]);
             
                //   Employee::where('id',$employeeData->employee_id)->update([
                //     'status'  => '0'
                //   ]);
          
                  return redirect('employee')->with('message','Employee exit successfully');
                }

                if (!empty($employeeData)) {
                    return Response::json(['success' => '1']);
                } else {
                    return Response::json(['success' => '0']);
                }
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
         } else {
            return Response::json(['success' => '0']);
        }

    }

    // public function updateExitEmployee(request $request)
    // {
    //     if (Auth::check()) {
    //         $userDetails = HelpersHelper::getUserDetails(Auth::id());
    //         $validator = Validator::make($request->all(), [
    //             'date_of_exit' => 'required|string|max:255',

    //         ]);
    //         if ($validator->passes()) {
    //             if ($request->interview_id) {
    //                 $update = [
    //                     'company_id' => Auth::id(),
    //                     'employee_id' => !empty($request->id) ? $request->id : null,
    //                     'date_of_exit' => !empty($request->date_of_exit) ? $request->date_of_exit : null,
    //                     'decipline' => !empty($request->decipline) ? $request->decipline : null,
    //                     'reason_of_exit' => !empty($request->reason_of_exit) ? $request->reason_of_exit : null,
    //                     'rating' => !empty($request->rating) ? $request->rating : null,
    //                     'document' => !empty($request->document) ? $request->document : null,
    //                 ];
    //                 $interviewData = Exitemp::where('id', $request->interview_id)->update($update);
    //                 if (!empty($interviewData)) {
    //                     return Response::json(['success' => '1']);
    //                 } else {
    //                     return Response::json(['success' => '0']);
    //                 }
    //             } else {
    //                 return Response::json(['success' => '0']);
    //             }

    //         } else {
    //             return Response::json(['errors' => $validator->errors()]);
    //         }
    //     }

    // }

}
