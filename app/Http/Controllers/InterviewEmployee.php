<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Mail\InterviewReminderMail;
use App\Mail\SendInterviewScheduleMail;
use App\Mail\SendInterviewScheduleMailToInterviewer;
use App\Mail\SendInterviewSchedulePhoneMail;
use App\Mail\SendInterviewScheduleOfficeMail;
use App\Mail\SendInterviewScheduleHomeMail;
use App\Mail\SendInterviewSchedulePhoneMailToInterviewer;
use App\Mail\SendInterviewScheduleOfficeMailToInterviewer;
use App\Mail\SendInterviewScheduleHomeMailToInterviewer;
use App\Models\Employee;
use App\Models\EmployeeInterview;
use App\Models\EmployeeInterviewStatus;
use App\Models\HiringStage;
use App\Models\EmployeeFeedback;
use App\Models\InterviewEmployeeRounds;
use App\Models\InterviewProcess;
use App\Models\Position;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail as FacadesMail;
// use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\user;

class InterviewEmployee extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $interviewEmployees = EmployeeInterview::where('company_id',Auth::id())->get();
    
            // $interviewEmployees = EmployeeInterview::join('interview_employee_rounds', 'interview_employee_rounds.interview_employees_id', '=', 'interview_employees.id')
            //                       ->where('interview_employees.company_id', Auth::id())->select('interview_employees.*','interview_employee_rounds.interview_status')->latest()->get();
            // $interviewEmployees = EmployeeInterview::join('interview_employee_rounds', 'interview_employee_rounds.interview_employees_id', '=', 'interview_employees.id')
            //         ->where('interview_employee_rounds.employee_interview_status', $request->employeeStatusId)
            //         ->where('interview_employees.company_id', Auth::id())->get();
            
            // dd($interviewEmployees);
            // $emloyeeStatusId = $request->employeeStatusId;
            // $interviewEmployees = EmployeeInterview::with('lastInterviewEmployeeRounds')->where('company_id',Auth::id())->get();
            // dd($interviewEmployees[0]->lastInterviewEmployeeRounds->interview_instructions);
            // dd($interviewEmployees);

            //With where clause
            /*$interviewProcessId = 2;
            $interviewEmployees = EmployeeInterview::where('company_id', Auth::id())->whereHas('interviewEmployeeRounds', function ($query) use ($interviewProcessId) {
                $query->where('interview_processes_id', $interviewProcessId);
            }, '>', 0)->with(['lastInterviewEmployeeRounds' => function ($query) use ($interviewProcessId) {
                $query->where('interview_processes_id', $interviewProcessId);
            }])->get();
            dd($interviewEmployees);*/
            // dd($interviewEmployees[0]->lastInterviewEmployeeRounds->interview_instructions);

            /*$interviewProcessId = 1;
            $parentTable = EmployeeInterview::where('company_id', Auth::id())->with(['lastInterviewEmployeeRounds' => function ($query) use ($interviewProcessId) {
                $query->with('employeeInterviewStatus');
                $query->where('interview_processes_id', $interviewProcessId);
                $query->orderBy('id', 'desc')->take(1);
            }])->get();
            dd($parentTable);*/
            
            // dd($interviewEmployees[0]->lastInterviewEmployeeRounds->employeeInterviewStatus->title);

            // }])->where('parent_column', 'parent_value')->get();


            // $companyId = Auth::id();
            // $interviewEmployees = InterviewEmployeeRounds::whereHas('employeeinterview', function ($query) use ($companyId) {
            //     $query->where('company_id', $companyId);
            // })->get();

            // $interviewEmployees = EmployeeInterview::find(1);
            // dd($interviewEmployees);
            // $posts = $user->posts;
            /*if ($request->hiringStatusId && $emloyeeStatusId) {
                $interviewEmployees = EmployeeInterview::join('interview_employee_rounds', 'interview_employee_rounds.interview_employees_id', '=', 'interview_employees.id')
                    ->join('employee_interview_statuses', 'employee_interview_statuses.id', '=', 'interview_employee_rounds.employee_interview_status')
                    ->where('interview_employee_rounds.interview_status', $request->hiringStatusId)
                    ->where('interview_employee_rounds.employee_interview_status', $request->employeeStatusId)
                    ->where('interview_employees.company_id', Auth::id())
                    ->select(
                        'interview_employees.id as id',
                        'interview_employees.company_id',
                        'interview_employees.empCode',
                        'interview_employees.first_name',
                        'interview_employees.last_name',
                        // 'interview_employees.email',
                        'interview_employees.position',
                        // 'interview_employee_rounds.id as interviewEmployeeRoundsId',
                        // 'interview_employee_rounds.interview_employees_id',
                        // 'interview_employee_rounds.interviewer_id',
                        // 'interview_employee_rounds.interview_processes_id',
                        'interview_employee_rounds.offer_status',
                        'interview_employee_rounds.interview_status',
                        // 'interview_employee_rounds.employee_interview_status',
                        // 'interview_employee_rounds.interview_date',
                        // 'interview_employee_rounds.interview_start_time',
                        // 'interview_employee_rounds.duration',
                        // 'interview_employee_rounds.interview_type',
                        // 'interview_employee_rounds.phone',
                        // 'interview_employee_rounds.video_link',
                        // 'interview_employee_rounds.interview_instructions',
                        // 'interview_employee_rounds.interviewee_comment',
                        // 'interview_employee_rounds.interviewee_comment_date',
                        // 'interview_employee_rounds.interview_feedback',
                        // 'interview_employee_rounds.interviewer_status',
                        'employee_interview_statuses.title'
                    )
                    ->get();

            } else if ($request->hiringStatusId) {
                $interviewEmployees = EmployeeInterview::join('interview_employee_rounds', 'interview_employee_rounds.interview_employees_id', '=', 'interview_employees.id')
                    ->join('employee_interview_statuses', 'employee_interview_statuses.id', '=', 'interview_employee_rounds.employee_interview_status')
                    ->where('interview_employee_rounds.interview_status', $request->hiringStatusId)
                    ->where('interview_employees.company_id', Auth::id())
                    ->select(
                        'interview_employees.id as id',
                        'interview_employees.company_id',
                        'interview_employees.empCode',
                        'interview_employees.first_name',
                        'interview_employees.last_name',
                        // 'interview_employees.email',
                        'interview_employees.position',
                        // 'interview_employee_rounds.id as interviewEmployeeRoundsId',
                        // 'interview_employee_rounds.interview_employees_id',
                        // 'interview_employee_rounds.interviewer_id',
                        // 'interview_employee_rounds.interview_processes_id',
                        'interview_employee_rounds.offer_status',
                        'interview_employee_rounds.interview_status',
                        // 'interview_employee_rounds.employee_interview_status',
                        // 'interview_employee_rounds.interview_date',
                        // 'interview_employee_rounds.interview_start_time',
                        // 'interview_employee_rounds.duration',
                        // 'interview_employee_rounds.interview_type',
                        // 'interview_employee_rounds.phone',
                        // 'interview_employee_rounds.video_link',
                        // 'interview_employee_rounds.interview_instructions',
                        // 'interview_employee_rounds.interviewee_comment',
                        // 'interview_employee_rounds.interviewee_comment_date',
                        // 'interview_employee_rounds.interview_feedback',
                        // 'interview_employee_rounds.interviewer_status',
                        'employee_interview_statuses.title'
                    )
                    ->get();

            } else if ($emloyeeStatusId) {
                
                $interviewEmployees = EmployeeInterview::where('company_id', Auth::id())->with(['lastInterviewEmployeeRounds' => function ($query) use ($emloyeeStatusId){
                    $query->where('interview_employee_rounds.employee_interview_status', $emloyeeStatusId);
                    $query->with('employeeInterviewStatus');
                    $query->orderBy('id', 'desc')->take(1);
                }])->get();
            } else {
                $interviewEmployees = EmployeeInterview::where('company_id', Auth::id())->with(['lastInterviewEmployeeRounds' => function ($query){
                    $query->with('employeeInterviewStatus');
                    $query->orderBy('id', 'desc')->take(1);
                }])->get();
            }*/
            
            $hiringStages = HiringStage::all();
            $employeeInterviewStatuses = EmployeeInterviewStatus::all();
            return view('admin.schedule-for-interview', compact('interviewEmployees', 'hiringStages', 'employeeInterviewStatuses'));
        }

    }

    public function interviewRoundDetails(Request $request){
        if (Auth::check()) {
            $hiringStages = HiringStage::all();
            $interviewEmpoloyeeRounds = InterviewEmployeeRounds::join('interview_processes','interview_processes.id','=','interview_processes_id')
            ->select('interview_employee_rounds.*','interview_processes.title')
            ->where('interview_employee_rounds.interview_employees_id',$request->id)
            ->get();
            return view('admin.interview-round-details', compact('interviewEmpoloyeeRounds','hiringStages'));
        }
    }

    public function getScheduleInterviewForm($id = '')
    {
        if (Auth::check()) {
            $interviewProcesses = InterviewProcess::where('company_id', Auth::id())->orderby('id', 'asc')->get();
            $positions = Position::where('company_id', Auth::id())->orderby('id', 'asc')->get();
            $cmpEmployees = Employee::where('company_id', Auth::id())->orderby('id', 'desc')->get();
            $interview = (!empty($id)) ? EmployeeInterview::find($id) : false;
            return view('admin.schedule-interview-form', compact('interview', 'interviewProcesses', 'cmpEmployees','positions'));
        }

    }

    public function scheduleInterview(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            if (!empty($request->interview_type)) {
                if ($request->interview_type == 'Video') {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'email' => 'required|email',
                        'position' => 'required|string|max:255',
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required',
                        'video_link' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                        'attachment' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:10240',

                    ]);
                } elseif($request->interview_type == 'Telephonic') {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'email' => 'required|email',
                        'position' => 'required|string|max:255',
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required|string|max:255',
                        'phone' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                        'attachment' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:10240',

                    ]);
                }
                else {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'email' => 'required|email',
                        'position' => 'required|string|max:255',
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                        'attachment' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:10240',

                    ]);
                }
            }
            $startFormattedTime = '';
            if ($request->interview_start_time) {
                $startTime = DateTime::createFromFormat('H:i', $request->interview_start_time); // parse input time as DateTime object
                $startFormattedTime = $startTime->format('h:i A'); // format DateTime object into 12-hour format
            }

            $uploadAttachementPath = '';
            $uploadInstructionPath = '';
            $company_name=User::where('id',Auth::id())->first();
            if ($validator->passes()) {
                if ($request->hasFile('attachment')) {
                   $name = $company_name->org_name;
                    $file = $request->file('attachment');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $fileTrim = str_replace(" ","-",$name);
                    $file->storeAs('public/'.$fileTrim. '/interview_documents', $fileName);
                    $uploadAttachementPath = asset('storage/'.$fileTrim. '/interview_documents/' . $fileName);
                }

                if ($request->hasFile('instruction')) {
                    $file = $request->file('instruction');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $fileTrim = str_replace(" ","-",$name);
                    $file->storeAs('public/'.$fileTrim.'/interview_instruction_documents', $fileName);
                    $uploadInstructionPath = asset('storage/'.$fileTrim.'/interview_instruction_documents/' . $fileName);
                }

                $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));
                $checkRecordExist = EmployeeInterview::where('empCode', $empCode)->first();
                if (empty($checkRecordExist) && !empty($empCode)) {
                    $insertEmployeeInterview = [
                        'company_id' => Auth::id(),
                        'empCode' => $empCode,
                        'first_name' => !empty($request->first_name) ? $request->first_name : null,
                        'last_name' => !empty($request->last_name) ? $request->last_name : null,
                        'email' => !empty($request->email) ? $request->email : null,
                        'position' => !empty($request->position) ? $request->position : null,
                        'rating' => !empty($request->rating) ? $request->rating : null,
                        'resume' => $uploadAttachementPath,
                        'instruction' => $uploadInstructionPath,

                    ];
                    $employeeInterviewData = EmployeeInterview::create($insertEmployeeInterview);
                    if (!empty($employeeInterviewData)) {

                        //Insert record into Emoloyee Inerview Rounds
                        $insertEmployeeInterviewRounds = [
                            'interview_employees_id' => $employeeInterviewData->id,
                            'company_id' => Auth::id(),
                            'interviewer_id' => !empty($request->interviewer_id) ? $request->interviewer_id : null,
                            'interview_processes_id' => !empty($request->interview_process) ? $request->interview_process : null,
                            'offer_status' => !empty($request->offer_status) ? $request->offer_status : 'Pending',
                            'interview_status' => !empty($request->interview_status) ? $request->interview_status : 1,
                            'employee_interview_status' => !empty($request->employee_interview_status) ? $request->employee_interview_status : 1,
                            'interview_date' => !empty($request->interview_date) ? $request->interview_date : Carbon::now()->format('Y-m-d'),
                            'interview_start_time' => !empty($startFormattedTime) ? $startFormattedTime : null,
                            'duration' => !empty($request->duration) ? $request->duration : null,
                            'interview_type' => !empty($request->interview_type) ? $request->interview_type : null,
                            'phone' => !empty($request->phone) ? $request->phone : null,
                            'video_link' => !empty($request->video_link) ? $request->video_link : null,
                            'interview_instructions' => !empty($request->interview_instruction) ? $request->interview_instruction : null,
                        ];
                        $employeeInterviewRoundData = InterviewEmployeeRounds::create($insertEmployeeInterviewRounds);
                        if ($employeeInterviewRoundData) {
                            $getInterviewTitle = InterviewProcess::where('id', $request->interview_process)->first();
                            //Send email to Interviewee
                            if ($request->interview_type == 'Video') {
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                    'position' => !empty($request->position) ? $request->position : '',
                                    'meeting_url' => !empty($request->video_link) ? $request->video_link : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                    
                                ];
                                FacadesMail::to($request->email)->send(new SendInterviewScheduleMail($mailData));

                            } elseif ($request->interview_type == 'Telephonic') { 
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                    'position' => !empty($request->position) ? $request->position : '',
                                    'phone' => !empty($request->phone) ? $request->phone : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                ];

                                FacadesMail::to($request->email)->send(new SendInterviewSchedulePhoneMail($mailData));
                            } elseif ($request->interview_type == 'At Office') { 
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                    'position' => !empty($request->position) ? $request->position : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                ];

                                FacadesMail::to($request->email)->send(new SendInterviewScheduleOfficeMail($mailData));
                            }
                            else { 
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                    'position' => !empty($request->position) ? $request->position : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                ];

                                FacadesMail::to($request->email)->send(new SendInterviewScheduleHomeMail($mailData));
                            }

                            //Get Interviewer details from employee information table
                            $getInterviewerDetails = Employee::where('id', $request->interviewer_id)->first();
                            // dd($getInterviewerDetails);
                            if (!empty($getInterviewerDetails->email) && !empty($employeeInterviewRoundData)) {
                                //Send email to Interviewer
                                if ($request->interview_type == 'Video') {

                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                        'position' => !empty($request->position) ? $request->position : '',
                                        'meeting_url' => !empty($request->video_link) ? $request->video_link : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleMailToInterviewer($mailData));
                                } elseif ($request->interview_type == 'Telephonic') {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                        'position' => !empty($request->position) ? $request->position : '',
                                        'phone' => !empty($request->phone) ? $request->phone : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewSchedulePhoneMailToInterviewer($mailData));
                                } elseif ($request->interview_type == 'At Office') {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                        'position' => !empty($request->position) ? $request->position : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleOfficeMailToInterviewer($mailData));
                                }
                                else {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($request->first_name) ? $request->first_name . ' ' . $request->last_name : '',
                                        'position' => !empty($request->position) ? $request->position : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction' => !empty($uploadInstructionPath) ? $uploadInstructionPath : '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleHomeMailToInterviewer($mailData));
                                }
                            }
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

    public function getNextRoundOfInterviewForm($id = '')
    {
        if (Auth::check()) {
            $interviewProcesses = InterviewProcess::where('company_id', Auth::id())->orderby('id', 'asc')->get();
            $cmpEmployees = Employee::where('company_id', Auth::id())->orderby('id', 'desc')->get();
            $interview = (!empty($id)) ? EmployeeInterview::find($id) : false;
            return view('admin.next-rouond-of-interview-form', compact('interview', 'interviewProcesses', 'cmpEmployees'));
        }
    }

    public function scheduleNextRoundOfInterview(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            if (!empty($request->interview_type)) {
                if ($request->interview_type == 'Video') {
                    $validator = Validator::make($request->all(), [
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required',
                        'video_link' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                    ]);
                } elseif ($request->interview_type == 'Telephonic') {
                    $validator = Validator::make($request->all(), [
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required|string|max:255',
                        'phone' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                    ]);
                }
                 else {
                    $validator = Validator::make($request->all(), [
                        'interview_process' => 'required',
                        'interviewer_id' => 'required',
                        'interview_date' => 'required|string|max:255',
                        'interview_start_time' => 'required|string|max:255',
                        'duration' => 'required|string|max:255',
                        'interview_instruction' => 'required',
                    ]);
                }
            }
            $startFormattedTime = '';
            if ($request->interview_start_time) {
                $startTime = DateTime::createFromFormat('H:i', $request->interview_start_time); // parse input time as DateTime object
                $startFormattedTime = $startTime->format('h:i A'); // format DateTime object into 12-hour format
            }

            if ($validator->passes()) {

                $checkRecordExist = EmployeeInterview::where('id', $request->interview_id)->first();
                if (!empty($checkRecordExist)) {

                    //Check Interview is already created or not
                    $checkInterviewExist = InterviewEmployeeRounds::where('interview_employees_id', $request->interview_id)->where('interview_processes_id', $request->interview_process)->first();
                    if(empty($checkInterviewExist)){
                        //Insert record into Emoloyee Inerview Rounds
                        $insertEmployeeInterviewRounds = [
                            'interview_employees_id' => !empty($request->interview_id) ? $request->interview_id : null,
                            'interviewer_id' => !empty($request->interviewer_id) ? $request->interviewer_id : null,
                            'company_id' => Auth::id(),
                            'interview_processes_id' => !empty($request->interview_process) ? $request->interview_process : null,
                            'offer_status' => !empty($request->offer_status) ? $request->offer_status : 'Pending',
                            'interview_status' => !empty($request->interview_status) ? $request->interview_status : 1,
                            'employee_interview_status' => !empty($request->employee_interview_status) ? $request->employee_interview_status : 1,
                            'interview_date' => !empty($request->interview_date) ? $request->interview_date : Carbon::now()->format('Y-m-d'),
                            'interview_start_time' => !empty($startFormattedTime) ? $startFormattedTime : null,
                            'duration' => !empty($request->duration) ? $request->duration : null,
                            'interview_type' => !empty($request->interview_type) ? $request->interview_type : null,
                            'phone' => !empty($request->phone) ? $request->phone : null,
                            'video_link' => !empty($request->video_link) ? $request->video_link : null,
                            'interview_instructions' => !empty($request->interview_instruction) ? $request->interview_instruction : null,
                        ];
                        $employeeInterviewRoundData = InterviewEmployeeRounds::create($insertEmployeeInterviewRounds);
                        if ($employeeInterviewRoundData) {
                            $getInterviewTitle = InterviewProcess::where('id', $request->interview_process)->first();
                            //Send email to Interviewee
                            if ($request->interview_type == 'Video') {
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                    'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                    'meeting_url' => !empty($request->video_link) ? $request->video_link : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction'   => '',
                                ];
                                FacadesMail::to($checkRecordExist->email)->send(new SendInterviewScheduleMail($mailData));
                            } elseif ($request->interview_type == 'Telephonic') {
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                    'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                    'phone' => !empty($request->phone) ? $request->phone : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction'   => '',
                                ];
    
                                FacadesMail::to($checkRecordExist->email)->send(new SendInterviewSchedulePhoneMail($mailData));
                            } elseif ($request->interview_type == 'At Office') {
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                    'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction'   => '',
                                ];
    
                                FacadesMail::to($checkRecordExist->email)->send(new SendInterviewScheduleOfficeMail($mailData));
                            } else {
                                $mailData = [
                                    'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                    'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                    'company_id' => Auth::id(),
                                    'name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                    'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                    'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                    'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                    'duration' => !empty($request->duration) ? $request->duration : '',
                                    'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                    'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                    'instruction'   => '',
                                ];
    
                                FacadesMail::to($checkRecordExist->email)->send(new SendInterviewScheduleHomeMail($mailData));
                            }
    
                            //Get Interviewer details from employee information table
                            $getInterviewerDetails = Employee::where('id', $request->interviewer_id)->first();
                            if (!empty($getInterviewerDetails->email) && !empty($employeeInterviewRoundData)) {
                                //Send email to Interviewer
                                if ($request->interview_type == 'Video') {
    
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                        'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                        'meeting_url' => !empty($request->video_link) ? $request->video_link : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction'   => '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleMailToInterviewer($mailData));

                                } elseif ($request->interview_type == 'Telephonic') {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                  
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                        'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                        'phone' => !empty($request->phone) ? $request->phone : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction'   => '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewSchedulePhoneMailToInterviewer($mailData));
                                }

                                elseif ($request->interview_type == 'At Office') {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                        'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                        'phone' => !empty($request->phone) ? $request->phone : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction'   => '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleOfficeMailToInterviewer($mailData));
                                }
                                else {
                                    $mailData = [
                                        'organisationName' => !empty($userDetails->org_name) ? $userDetails->org_name : '',
                                        'interviewEmpRoundsId' => encrypt($employeeInterviewRoundData->id),
                                        'company_id' => Auth::id(),
                                        'interviewer_name' => !empty($getInterviewerDetails->first_name) ? $getInterviewerDetails->first_name . ' ' . $getInterviewerDetails->last_name : '',
                                        'interviewee_name' => !empty($checkRecordExist->first_name) ? $checkRecordExist->first_name . ' ' . $checkRecordExist->last_name : '',
                                        'position' => !empty($checkRecordExist->position) ? $checkRecordExist->position : '',
                                        'phone' => !empty($request->phone) ? $request->phone : '',
                                        'meeting_date' => !empty($request->interview_date) ? $request->interview_date : '',
                                        'meeting_start_time' => !empty($startFormattedTime) ? $startFormattedTime : '',
                                        'duration' => !empty($request->duration) ? $request->duration : '',
                                        'interviewRoundId' => encrypt($employeeInterviewRoundData->id),
                                        'interview_instruction' => !empty($request->interview_instruction) ? $request->interview_instruction : '',
                                        'interview_title' => !empty($getInterviewTitle->title) ? $getInterviewTitle->title : '',
                                        'instruction'   => '',
                                    ];
                                    FacadesMail::to($getInterviewerDetails->email)->send(new SendInterviewScheduleHomeMailToInterviewer($mailData));
                                }
                            }
                            
                        }
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

    public function getInterviewDetailForm($id = '')
    {

        if (Auth::check()) {
            $checkfeedback = EmployeeFeedback::where('interview_round_id',$id)->first();
            $interviewEmpoloyeeFeedback = EmployeeFeedback::join('feedbacks','feedbacks.id','=','interview_employee_feedback.feedback_id')
                                            ->where('interview_employee_feedback.interview_round_id',$id)
                                            ->get();
                            // dd($interviewEmpoloyeeFeedback);
            return view('admin.interview-rounds-details-form', compact('interviewEmpoloyeeFeedback','checkfeedback'));
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

    public function update_interviewer_status(request $request)
    {
//   dd($request->all());
        if (!empty($request->interviewId) && !empty($request->status)) {
            $interview = InterviewEmployeeRounds::find($request->interviewId);
            $interview->interviewer_status = $request->status;

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

    public function sendReminderForInterview(request $request)
    {
        if (!empty($request->interviewId)) {
            $interview = EmployeeInterview::find($request->interviewId);
            if (!empty($interview->email)) {
                $mailData = [
                    'name' => !empty($interview->first_name) ? $interview->first_name . ' ' . $interview->last_name : '',
                ];
                FacadesMail::to($interview->email)->send(new InterviewReminderMail($mailData));

                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function suggestNewTime(request $request)
    {
        $employeetime = DB::table('interview_employee_rounds')->where('id', decrypt($request->interviewEmpRoundsId))
            ->update([
                'interviewee_comment' => $request->input('employee_comment'),
            ]);
        return redirect('/success');
    }

    public function declineInterview(request $request)
    {
        $decline = DB::table('interview_employee_rounds')->where('id', decrypt($request->interviewEmpRoundsId))
            ->update([
                'interviewee_comment' => $request->input('employee_comment'),
            ]);
        return redirect('/success');
    }

    public function interviewRepliedFromMail(request $request)
    {
        if (!empty($request->interviewEmpRoundsId)) {
            //Check if alrady response is submitted
            $checkResponse = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)->first();
            if (!$checkResponse->isEmployeeResponseSubmitted) {
                $employee = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)
                    ->update([
                        'interviewee_comment' => $request->input('employee_comment'),
                        'interviewee_comment_date' => Carbon::now(),
                        'employee_interview_status' => $request->interview_status,
                        'isEmployeeResponseSubmitted' => true,
                    ]);
                if ($employee) {
                    return redirect('/success');
                }
            } else {
                return redirect('/response_submited');
            }
        }
    }

    public function interviewConfirmed(request $request)
    {
        if (!empty($request->interviewEmpRoundsId)) {
            $interviewEmpRoundsId = decrypt($request->interviewEmpRoundsId);
            $employeeStatus = DB::table('interview_employee_rounds')
                ->join('interview_employees', 'interview_employees.id', '=', 'interview_employee_rounds.interview_employees_id')
                ->join('users', 'interview_employees.company_id', '=', 'users.id')
                ->select('interview_employee_rounds.*', 'interview_employees.*', 'users.*', 'interview_employees.position')
                ->where('interview_employee_rounds.id', $interviewEmpRoundsId)
                ->first();
                // dd($employeeStatus);
            if ($employeeStatus) {
                if ($employeeStatus->interview_type == 'Telephonic') {
                    return view('admin/web-email/schedule-phone-interview', compact('employeeStatus', 'interviewEmpRoundsId'));
                } elseif ($employeeStatus->interview_type == 'Video') { 
                    return view('admin/web-email/schedule-video-interview', compact('employeeStatus', 'interviewEmpRoundsId'));
                } elseif ($employeeStatus->interview_type == 'At Office') {
                    return view('admin/web-email/schedule-office-interview', compact('employeeStatus', 'interviewEmpRoundsId'));
                } else {
                    return view('admin/web-email/schedule-home-interview', compact('employeeStatus', 'interviewEmpRoundsId'));
                }
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function getCheckStatus(request $request)
    {
        $user = DB::table('users')->latest()->first();
        return view('company/verify-message',compact('user'));
    }

    public function getResetStatus(request $request)
    {
      
        $user = User::where('id',Auth::id())->first();
        return view('company/reset-verify-message',compact('user'));
    }

    public function verificationEmail(request $request)
    {
        if (!empty($request->id)) {
            $id = decrypt($request->id);
            $companyData = User::where('id',$id)->first();
            if ($companyData) {
                if($companyData->status == '0'){
                $changeStatus=DB::table('users')->where('id',$id)
                ->update([
                      'status'=>'1',         
                ]);
              return view('admin/emails/candidate/verification-success', compact('companyData', 'id'));   
            } 
            else{
                return view('admin/emails/candidate/already-verify', compact('companyData', 'id'));   
            }
         }
            else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function interviewNewTime(request $request)
    {
        if (!empty($request->interviewEmpRoundsId)) {
            $interviewEmpRoundsId = decrypt($request->interviewEmpRoundsId);
            $employeetime = DB::table('interview_employee_rounds')
                ->join('interview_employees', 'interview_employees.id', '=', 'interview_employee_rounds.interview_employees_id')
                ->join('users', 'interview_employees.company_id', '=', 'users.id')
                ->select('interview_employee_rounds.*', 'interview_employees.*', 'users.*', 'interview_employees.position')
                ->where('interview_employee_rounds.id', $interviewEmpRoundsId)
                ->first();

            if ($employeetime) {
                return view('admin/web-email/suggest-new-time', compact('employeetime', 'interviewEmpRoundsId'));
            } else {
                return Response::json(['success' => '0']);
            }
        }
    }

    public function interviewDeclined(request $request)
    {
        if (!empty($request->interviewEmpRoundsId)) {
            $interviewEmpRoundsId = decrypt($request->interviewEmpRoundsId);
            $employedecline = DB::table('interview_employee_rounds')
                ->join('interview_employees', 'interview_employees.id', '=', 'interview_employee_rounds.interview_employees_id')
                ->join('users', 'interview_employees.company_id', '=', 'users.id')
                ->select('interview_employee_rounds.*', 'interview_employees.*', 'users.*', 'interview_employees.position')
                ->where('interview_employee_rounds.id', $interviewEmpRoundsId)
                ->first();
            if ($employedecline) {
                return view('admin/web-email/decline-interview', compact('employedecline', 'interviewEmpRoundsId'));
            } else {
                return Response::json(['success' => '0']);
            }
        }

    }
}
