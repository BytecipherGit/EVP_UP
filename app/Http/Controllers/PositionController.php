<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as HelpersHelper;
use App\Models\Position;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $data = Position::where('company_id',Auth::id())->select('id','title','descriptions','status')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        $button = "";
                        if ($row->status == 1) {
                            $button = '<span style="cursor:pointer"
                       onclick="update_position_status(' . $row->id . ',' . $row->status . ')" class="btn btn-success position">
                       <i style="font-size: 10px;"></i>&nbsp;Active</span>';
    
                        } else {
                            $button = '<span style="cursor:pointer" class="btn btn-danger position" onclick="update_position_status(' . $row->id . ',' . $row->status . ')">Inactive</span>';
                        }
                        return $button;
                    })
                  ->addColumn('action', function($row){
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn updatePosition fa fa-edit" title="Edit"></a>';
                     $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn deletePosition fa fa-trash" title="Delete"></a>';
                     return $btn;
                 })
                 ->rawColumns(['action','status'])
                 ->make(true);
         }
         return view('admin.positions.index');
     }


     public function update_process_status(request $request)
     {
        // dd('h');
         $validator = Validator::make($request->all(), [
             'id' => 'required',
             'status' => 'required',
         ]);
         $position_id = $request->get('id');
         $status = $request->get('status');
         if ($validator->passes()) {
             if ($status == 0) {
                 DB::table('positions')->where('id', $position_id)->update(['status' => 1]);
                 return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
             } else {
                 DB::table('positions')->where('id', $position_id)->update(['status' => 0]);
                 return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
             }
         } else {
             return Response::json(['status' => 'error', 'msg' => 'Unable to updated']);
         }
     }

    public function getPositionForm($id = '')
    {
        $position = (!empty($id)) ? Position::find($id) : false;
        return view('admin.positions.position_form', compact('position'));
    }

    public function createPosition(request $request)
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
                        'status' => '1',
                    ];
                    $positionData = Position::create($insert);
                    if (!empty($positionData)) {
                        return Response::json(['success' => '1']);
                    } else {
                        return Response::json(['success' => '0']);
                    }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function updatePosition(request $request)
    {
        if (Auth::check()) {
            $userDetails = HelpersHelper::getUserDetails(Auth::id());
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'descriptions' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                if($request->position_id){
                    $update = [
                        'company_id' => Auth::id(),
                        'title' => !empty($request->title) ? $request->title : null,
                        'descriptions' => !empty($request->descriptions) ? $request->descriptions : null,
                    ];
                    $positionData = Position::where('id',$request->position_id)->update($update);
                    if (!empty($positionData)) {
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

    public function deletePosition(request $request)
    {
        if (!empty($request->positionId)) {
            $position = Position::find($request->positionId);
            if ($position->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }
}
