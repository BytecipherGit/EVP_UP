<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $data = Subscription::select('id','type','duration','price','name','description','status')->get();
             return FacadesDataTables::of($data)->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        $button = "";
                        if ($row->status == 1) {
                            $button = '<span style="cursor:pointer"
                       onclick="update_status(' . $row->id . ',' . $row->status . ')" class="btn btn-success subscription">
                       <i style="font-size: 10px;"></i>&nbsp;Active</span>';
    
                        } else {
                            $button = '<span style="cursor:pointer" class="btn btn-danger subscription" onclick="update_status(' . $row->id . ',' . $row->status . ')">Inactive</span>';
                        }
                        return $button;
                    })
                  ->addColumn('action', function($row){
                    //  $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn updateSubscription fa fa-edit" title="Edit"></a>';
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit-btn deleteSubscription fa fa-trash" title="Delete"></a>';
                     return $btn;
                 })
                 ->rawColumns(['action','status'])
                 ->make(true);
         }
         return view('superadmin.subscription.index');
     }


     public function update_subscription_status(request $request)
     {
        // dd('h');
         $validator = Validator::make($request->all(), [
             'id' => 'required',
             'status' => 'required',
         ]);
         $subscription_id = $request->get('id');
         $status = $request->get('status');
         if ($validator->passes()) {
             if ($status == 0) {
                 DB::table('subscriptions')->where('id', $subscription_id)->update(['status' => 1]);
                 return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
             } else {
                 DB::table('subscriptions')->where('id', $subscription_id)->update(['status' => 0]);
                 return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
             }
         } else {
             return Response::json(['status' => 'error', 'msg' => 'Unable to updated']);
         }
     }

    public function getSubscriptionForm($id = '')
    {
        $subscription = (!empty($id)) ? Subscription::find($id) : false;
        return view('superadmin.subscription.subscription_form', compact('subscription'));
    }

    public function createSubscription(request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                
            ]);
            if ($validator->passes()) {
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $planId = 'plan_'.substr(str_shuffle($str_result),0, 15);
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
                $plan_id = $api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 
                'description' => 'Description for the weekly 1 plan', 
                'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
            //    dd($plan_id->id);
                    $insert = [
                        // 'user_id' => Auth::id(),
                        'name' => !empty($request->name) ? $request->name : null,
                        'type' => !empty($request->type) ? $request->type : null,
                        'price' => !empty($request->price) ? $request->price : null,
                        'plan_id' => $plan_id->id,
                        'duration' => !empty($request->duration) ? $request->duration : null,
                        'description' => !empty($request->description) ? $request->description : null,
                        'status' => '1',
                    ];
                    $subscriptionData = Subscription::create($insert);
                    if (!empty($subscriptionData)) {
                        return Response::json(['success' => '1']);
                    } else {
                        return Response::json(['success' => '0']);
                    }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function updateSubscription(request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                if($request->subscription_id){
                    $update = [
                        // 'user_id' => Auth::id(),
                        'name' => !empty($request->name) ? $request->name : null,
                        'type' => !empty($request->type) ? $request->type : null,
                        'price' => !empty($request->price) ? $request->price : null,
                        'duration' => !empty($request->duration) ? $request->duration : null,
                        'description' => !empty($request->description) ? $request->description : null,
                    ];
                    $subscriptionData = Subscription::where('id',$request->subscription_id)->update($update);
                    if (!empty($subscriptionData)) {
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

    public function deleteSubscription(request $request)
    {
        if (!empty($request->subscriptionId)) {
            $subscription = Subscription::find($request->subscriptionId);
            if ($subscription->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

}

