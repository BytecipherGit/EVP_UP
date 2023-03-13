<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Mail\SendInterviewScheduleMail;
use App\Mail\SendInterviewSchedulePhoneMail;
use App\Models\EmployeeInterview;
use App\Models\EmployeeInterviewStatus;
use App\Models\HiringStage;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Auth;
use Helper;

class InterviewEmployee extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()){

            if($request->hiringStatusId && $request->employeeStatusId){
                $interviewEmployees = EmployeeInterview::where('interview_status', $request->hiringStatusId)->where('employee_interview_status', $request->employeeStatusId)->where('company_id', Auth::id())->get();
            } else if ($request->hiringStatusId){
                $interviewEmployees = EmployeeInterview::where('interview_status', $request->hiringStatusId)->where('company_id', Auth::id())->get();
            } else if ($request->employeeStatusId){
                $interviewEmployees = EmployeeInterview::where('employee_interview_status', $request->employeeStatusId)->where('company_id', Auth::id())->get();
            } else {
                $interviewEmployees = EmployeeInterview::where('company_id', Auth::id())->get();
            }
            $hiringStages = HiringStage::all();
            $employeeInterviewStatuses = EmployeeInterviewStatus::all();
            return view('admin.schedule-for-interview', compact('interviewEmployees', 'hiringStages', 'employeeInterviewStatuses'));
        }

        
    }

    public function getScheduleInterviewForm($id = '')
    {
        $interview = (!empty($id)) ? EmployeeInterview::find($id) : false;
        return view('admin.schedule-interview-form', compact('interview'));
    }

    public function schedule_interview(request $request)
    {

        if(Auth::check()){
            $userDetails = HelpersHelper::getUserDetails(Auth::id());  
            if (!empty($request->interview_type)) {
                if ($request->interview_type == 'Video') {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'email' => 'required|email',
                        'designation' => 'required|string|max:255',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'interview_end_time' => 'required|string|max:255',
                        'video_link' => 'required|string|max:255',
                        'message' => 'required|string|max:255',
                        'attachment' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:2048',
    
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'email' => 'required|email',
                        'designation' => 'required|string|max:255',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'interview_end_time' => 'required|string|max:255',
                        'phone' => 'required|string|max:255',
                        'message' => 'required|string|max:255',
                        'attachment' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:2048',
    
                    ]);
                }
            }
            $startFormattedTime = '';
            if($request->interview_start_time){
                $startTime = DateTime::createFromFormat('H:i', $request->interview_start_time); // parse input time as DateTime object
                $startFormattedTime = $startTime->format('h:i A'); // format DateTime object into 12-hour format
            }

            $endFormattedTime = '';
            if($request->interview_end_time){
                $endTime = DateTime::createFromFormat('H:i', $request->interview_end_time); // parse input time as DateTime object
                $endFormattedTime = $endTime->format('h:i A'); // format DateTime object into 12-hour format
            }
            

            $uploadAttachementPath = '';
            if ($validator->passes()) {
                if ($request->hasFile('attachment')) {
                    $file = $request->file('attachment');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/interview_documents', $fileName);
                    $uploadAttachementPath = asset('storage/interview_documents/' . $fileName);
                }
                $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));
                $checkRecordExist = EmployeeInterview::where('empCode', $empCode)->first();
                if (empty($checkRecordExist) && !empty($empCode)) {
                    $insert = [
                        'company_id' => Auth::id(), 
                        'empCode' => $empCode,
                        'first_name' => !empty($request->first_name) ? $request->first_name : null,
                        'last_name' => !empty($request->last_name) ? $request->last_name : null,
                        'email' => !empty($request->email) ? $request->email : null,
                        'designation' => !empty($request->designation) ? $request->designation : null,
                        'rating' => !empty($request->rating) ? $request->rating : null,
                        'offer_status' => !empty($request->offer_status) ? $request->offer_status : 'Pending',
                        'interview_status' => !empty($request->interview_status) ? $request->interview_status : 1,
                        'employee_interview_status' => !empty($request->employee_interview_status) ? $request->employee_interview_status : 1,
                        'interview_date' => !empty($request->interview_date) ? $request->interview_date : Carbon::now()->format('Y-m-d'),
                        'interview_start_time' => !empty($startFormattedTime) ? $startFormattedTime : null,
                        'interview_end_time' => !empty($endFormattedTime) ? $endFormattedTime : null,
                        'interview_type' => !empty($request->interview_type) ? $request->interview_type : null,
                        'phone' => !empty($request->phone) ? $request->phone : null,
                        'video_link' => !empty($request->video_link) ? $request->video_link : null,
                        'message' => !empty($request->message) ? $request->message : null,
                        'attachment' => $uploadAttachementPath,
    
                    ];
                    $interviewData = EmployeeInterview::create($insert);
                    if (!empty($interviewData)) {
    
                        if ($request->interview_type == 'Video') {
                            $mailData = [
                                'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                'empCode' => encrypt($interviewData->empCode),
                                'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                'designation' => !empty($request->designation) ? $request->designation : '',
                                'meeting_url' => !empty($request->video_link) ? $request->video_link : '',
                                'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                'meeting_start_time' => !empty($request->interview_start_time) ? $request->interview_start_time : '',
                                'meeting_end_time' => !empty($request->interview_end_time) ? $request->interview_end_time : '',
                            ];
    
                            FacadesMail::to($request->email)->send(new SendInterviewScheduleMail($mailData));
                        } else {
                            $mailData = [
                                'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                'empCode' => encrypt($interviewData->empCode),
                                'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                'designation' => !empty($request->designation) ? $request->designation : '',
                                'phone' => !empty($request->phone) ? $request->phone : '',
                                'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                'meeting_start_time' => !empty($request->interview_start_time) ? $request->interview_start_time : '',
                                'meeting_end_time' => !empty($request->interview_end_time) ? $request->interview_end_time : '',
                            ];
    
                            FacadesMail::to($request->email)->send(new SendInterviewSchedulePhoneMail($mailData));
                        }
    
                        return Response::json(['success' => '1']);
                    } else {
                        return Response::json(['success' => '0']);
                    }
                }
            } else {
                return Response::json(['errors' => $validator->errors()]);
            } 
        }
        
    }

    public function update_hiring_stage(request $request)
    {
        if (!empty($request->interviewId) && !empty($request->stageId)) {
            $interview = EmployeeInterview::find($request->interviewId);
            $interview->interview_status = $request->stageId;
            if ($interview->save()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function deleteInterview(request $request)
    {
        if (!empty($request->interviewId)) {
            $interview = EmployeeInterview::find($request->interviewId);
            if ($interview->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function interviewConfirmed(request $request)
    {
        if (!empty($request->empCode)) {
            $isUpdate = EmployeeInterview::where('empCode', decrypt($request->empCode))->update(['employee_interview_status' => 2]);
            if ($isUpdate) {
                return redirect('/success');
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function interviewNewTime(request $request)
    {
        if (!empty($request->empCode)) {
            $isUpdate = EmployeeInterview::where('empCode', decrypt($request->empCode))->update(['employee_interview_status' => 3]);
            if ($isUpdate) {
                return redirect('/success');
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function interviewDeclined(request $request)
    {
        if (!empty($request->empCode)) {
            $isUpdate = EmployeeInterview::where('empCode', decrypt($request->empCode))->update(['employee_interview_status' => 4]);
            if ($isUpdate) {
                return redirect('/success');
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }
}
