<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
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
             $data = InterviewProcessModel::select('id','title','descriptions')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn updateProcess">Edit</a>';
                     $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn deleteProcess">Delete</a>';
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
}
