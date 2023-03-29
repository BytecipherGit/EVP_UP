<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Models\Feedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Feedbacks::where('company_id', Auth::id())->select('id', 'title')->get();
            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn updateFeedback fa fa-edit" data-title="Edit"></a>';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteFeedback fa fa-trash" data-title="Delete"></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.feedbacks.index');
    }

    public function getFeedbackForm($id = '')
    {
        $feedback = (!empty($id)) ? Feedbacks::find($id) : false;
        return view('admin.feedbacks.feedback_form', compact('feedback'));
    }

    public function createFeedback(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                $insert = [
                    'company_id' => Auth::id(),
                    'title' => !empty($request->title) ? $request->title : null,
                ];
                $feedbackData = Feedbacks::create($insert);
                if (!empty($feedbackData)) {
                    return Response::json(['success' => '1']);
                } else {
                    return Response::json(['success' => '0']);
                }

            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function updateFeedback(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                if ($request->feedback_id) {
                    $update = [
                        'company_id' => Auth::id(),
                        'title' => !empty($request->title) ? $request->title : null,
                    ];
                    $feedbackData = Feedbacks::where('id', $request->feedback_id)->update($update);
                    if (!empty($feedbackData)) {
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

    public function deleteFeedback(request $request)
    {
        if (!empty($request->feedbackId)) {
            $feedback = Feedbacks::find($request->feedbackId);
            if ($feedback->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }
}
