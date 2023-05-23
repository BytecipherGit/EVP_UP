<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionPayment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
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

      if($request->all()){

            $insert = [
                'company_id' => Auth::id(),
                'company_subscription_id' => !empty($request->id) ? $request->id : null,
                'razorpay_subscription_id' => !empty($request->razorpay_subscription_id) ? $request->razorpay_subscription_id : null,
                'subscription_id' => !empty($request->subscription_id) ? $request->subscription_id : null,
                'payment_id' => !empty($request->razorpay_payment_id) ? $request->razorpay_payment_id : null,
                'status' => 'Active',
            ];
            $subscriptionData = CompanySubscriptionPayment::create($insert);
            if (!empty($subscriptionData)) {
                return redirect('company_suscription');
            } else {
                return Response::json(['success' => '0']);
            }
        }
     }

     public function deleteSubscription(request $request)
     {
        // dd($request->subId);
         if (!empty($request->subscriptionId)) {
            $subscriptionId = $request->input('subscriptionId');

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $subscription = $api->subscription->fetch($subscriptionId);
            $subscription->cancel();

            $subscriptionStatus = DB::table('company_subscription_payment')->where('id', $request->subId)
             ->update([
                 'payment_status' => 'Cancelled',
             ]);

             $subscriptionStatus = DB::table('company_subscriptions')->where('razorpay_subscription_id', $subscriptionId)
             ->update([
                 'status' => '0',
             ]);

             if (!empty($subscriptionStatus)) {
                 return Response::json(['success' => '1']);
             } else {
                 return Response::json(['success' => '0']);
             }
         } else {
             return Response::json(['success' => '0']);
         }
     }

}
// $subscriptionId = $request->input('subscription_id');

// $api = new Api($key_id, $secret);

// try {
//     $subscription = $api->subscription->fetch($subscriptionId);
//     $subscription->cancel();

