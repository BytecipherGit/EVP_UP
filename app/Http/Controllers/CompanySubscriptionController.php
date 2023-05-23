<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Helpers\Helper as HelpersHelper;
use App\Models\CompanySubscriptionPayment;
use App\Models\CompanySubscription;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Auth;

class CompanySubscriptionController extends Controller
{

    public function index(request $request)
    {

      if(Auth::check()){
       
        $subscriptionDetails = Subscription::leftJoin('company_subscriptions','company_subscriptions.subscription_id','=','subscriptions.id')
                              ->leftJoin('company_subscription_payment','company_subscription_payment.subscription_id','=','company_subscriptions.subscription_id')
                              ->select('subscriptions.*','subscriptions.plan_id','company_subscriptions.razorpay_subscription_id','company_subscription_payment.payment_status',('company_subscription_payment.id as company_pay_id'),'company_subscriptions.status')
                              ->groupBy('subscriptions.id')
                              // ->orderBy('company_subscription_payment.id','DESC')
                              ->get();

  
  // dd($subscriptionDetails);
        return view('admin.subscription.index',compact('subscriptionDetails'));
      }
    }

    public function createSubscription(Request $request)
    {
// dd($request->all());
      $startDate = Carbon::now();
      $tomorrow = Carbon::tomorrow();
      $unixTimestamp = $tomorrow->timestamp;
      $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
      $checkSubscription = (!empty($request->id)) ? Subscription::find($request->id) : false;
      // dd($checkSubscription);
         $subscription= $api->subscription->create(array('plan_id' => $checkSubscription->plan_id , 'customer_notify' => 1,'quantity'=>5, 'total_count' => 6, 'start_at' => 
          $unixTimestamp, 'addons' => array(array('item' => array('name' => 
          'Delivery charges', 'amount' => 30000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
    //  dd($subscription_id);
          $insert = [
            'company_id' => Auth::id(),
            'razorpay_subscription_id' =>$subscription->id,
            'subscription_id' =>$checkSubscription->id,
            'subscription_type' => !empty($checkSubscription->type) ? $checkSubscription->type : null,
            'name' => !empty($checkSubscription->name) ? $checkSubscription->name : null,
            'price' => !empty($checkSubscription->price) ? $checkSubscription->price : null, 
            'description' => !empty($checkSubscription->description) ? $checkSubscription->description : null,
            'start_date' => $checkSubscription->created_at->format('Y-m-d'),
            'end_date' =>$checkSubscription->created_at->addDays(7)->format('Y-m-d'),
            'status' => '1'
     
         
        ];
  $subscriptionData = CompanySubscription::create($insert);

  if (!empty($subscriptionData)) {
      // $redirectUrl = 'javascript:void(0)';
      // return back()->with($redirectUrl);
      // return redirect()->away('company_suscription')->with('script', '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>');
      return view('admin.payment.razorpay_view',compact('subscriptionData'));
  } else {
      return Response::json(['success' => '0']);
  }

    }
}






