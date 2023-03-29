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
             $data = Position::where('company_id',Auth::id())->select('id','title')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn updatePosition fa fa-edit" data-title="Edit"></a>';
                     $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn deletePosition fa fa-trash" data-title="Delete"></a>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         return view('admin.positions.index');
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
            ]);
            if ($validator->passes()) {
                    $insert = [
                        'company_id' => Auth::id(),
                        'title' => !empty($request->title) ? $request->title : null,
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
            ]);
            if ($validator->passes()) {
                if($request->position_id){
                    $update = [
                        'company_id' => Auth::id(),
                        'title' => !empty($request->title) ? $request->title : null,
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
