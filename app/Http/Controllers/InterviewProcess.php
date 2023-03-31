<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Models\InterviewEmployeeRounds;
use App\Models\Feedbacks;
use App\Models\EmployeeFeedback;
use Illuminate\Http\Request;
use App\Models\InterviewProcess as InterviewProcessModel;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class InterviewProcess extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $data = InterviewProcessModel::where('company_id',Auth::id())->select('id','title','descriptions')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn updateProcess fa fa-edit" data-title="Edit"></a>';
                     $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn deleteProcess fa fa-trash" data-title="Delete"></a>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         return view('admin.interview_process');
     }

     public function getInterviewProcessForm($id = '')
    {
        $interview = (!empty($id)) ? InterviewProcessModel::find($id) : false;
        return view('admin.interview_process_form', compact('interview'));
    }

    public function createInterviewProcess(request $request)
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
                    $interviewData = InterviewProcessModel::create($insert);
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

    public function updateInterviewProcess(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'descriptions' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                if($request->interview_id){
                    $update = [
                        'company_id' => Auth::id(),
                        'title' => !empty($request->title) ? $request->title : null,
                        'descriptions' => !empty($request->descriptions) ? $request->descriptions : null,
                    ];
                    $interviewData = InterviewProcessModel::where('id',$request->interview_id)->update($update);
                    if (!empty($interviewData)) {
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

    public function deleteInterviewProcess(request $request)
    {
        if (!empty($request->interviewId)) {
            $interview = InterviewProcessModel::find($request->interviewId);
            if ($interview->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function interviewFeedback(request $request)
    {
        if (!empty($request->interviewEmpRoundsId)) {
            $interviewEmpRoundsId = decrypt($request->interviewEmpRoundsId);
            $feedbackResponse = Feedbacks::where('company_id',Auth::id())->get();
            $feedbackRespons = Feedbacks::where('company_id',Auth::id())->first();
            // $interviewEmpRoundsId = $request->interviewEmpRoundsId;
            $employeetime = DB::table('interview_employee_rounds')
            ->join('interview_employees', 'interview_employees.id', '=', 'interview_employee_rounds.interview_employees_id')
            ->join('users', 'interview_employees.company_id', '=', 'users.id')
            ->select('interview_employee_rounds.*','interview_employees.*', 'users.*', 'interview_employees.position')
            ->where('interview_employee_rounds.id', $interviewEmpRoundsId)
            ->first();
            // dd($feedbackResponse);
            if ($employeetime) {
                return view('admin/web-email/interview-feedback', compact('employeetime', 'interviewEmpRoundsId','feedbackResponse','feedbackRespons'));
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function interviewFeedbackForEmployee(request $request)
    {
        // if (!empty($request->interviewEmpRoundsId)) {
        //     //Check if alrady response is submitted
        //     $checkResponse = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)->first();
        //     if (!$checkResponse->interview_feedback) {
        //         $feedback = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)
        //             ->update(['interview_feedback' => $request->input('interview_feedback'),'interviewer_status' => $request->input('interviewer_status')]);
        //         if ($feedback) {
        //             return redirect('/success');
        //         }
        //     } else {
        //         return redirect('/response_submited');
        //     }
        // }

    
          if (!empty($request->interviewEmpRoundsId)) {
                $checkResponse = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)->first();
                $status= EmployeeFeedback::where('interview_round_id',$request->interviewEmpRoundsId)->where('company_id',Auth::id())->first();
                $feedbacksResponse = Feedbacks::where('company_id', Auth::id())->get();
    
          if (!$status) {
            if($feedbacksResponse){
            for ($i=0; $i < count($feedbacksResponse); $i++) {
                 $technicalSkill =array(
                    'company_id' => Auth::id(),
                    'interview_employees_id' => $checkResponse->interview_employees_id,
                    'interview_round_id' => $request->interview_round_id[$i],
                    'feedback_id' => $request->feedback_id[$i],
                    'feedback_rating' => $request->feedback_rating[$i],
                    'status'=> '1',
                  );    
                EmployeeFeedback::create($technicalSkill);
               }
              }
               if (!$checkResponse->interview_feedback) {
                $feedback = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)
                    ->update(['interview_feedback' => $request->input('interview_feedback')]);       
                  }
            
               return redirect('/success');
          }  
          else {
             return redirect('/response_submited');
           }
        }
    }
 }

