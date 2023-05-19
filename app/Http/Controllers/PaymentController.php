<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\CompanySubscription;
use Illuminate\Support\Facades\Response;
use Session;
use Auth;
use Exception;

class PaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {        
        return view('admin.payment.razorpay_view');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
    

    public function getPaySuccess(Request $request)
    {
      // dd($request->all());
      if($request->all()){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $subscriptionId = 'sub_'.substr(str_shuffle($str_result),0, 15);
    //    dd($planId);
            $insert = [
                'company_id' => Auth::id(),
                'subscription_id' =>$subscriptionId,
                'subscription_type' => !empty($request->type) ? $request->type : null,
                'name' => !empty($request->name) ? $request->name : null,
                'price' => !empty($request->price) ? $request->price : null, 
                'description' => !empty($request->description) ? $request->description : null,
                'status' => '1',
            ];
            $subscriptionData = CompanySubscription::create($insert);
            if (!empty($subscriptionData)) {
                return redirect()->back();
            } else {
                return Response::json(['success' => '0']);
            }
        }
     }

}


