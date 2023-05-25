<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Helpers\Helper as HelpersHelper;
use App\Models\CompanySubscriptionPayment;
use App\Models\CompanySubscription;
use Illuminate\Support\Facades\Response;
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
                              // ->where('company_subscriptions.company_id',Auth::id())
                              ->groupBy('subscriptions.id')
                              // ->orderBy('company_subscription_payment.id','DESC')
                              ->get();

        $subscriptions = Subscription::where('name','!=','Free')->count();
        $companySub = CompanySubscription::where('company_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $paySub = CompanySubscriptionPayment::where('company_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $currentDate = date('Y-m-d');
        
        $subscriptionCount =  Subscription::join('company_subscription_payment','company_subscription_payment.subscription_id','=','subscriptions.id')
                              ->where('company_subscription_payment.company_id', Auth::id())
                              ->count();

  // dd($subscriptions. $subscriptionCount);
     
        return view('admin.subscription.index',compact('subscriptionDetails','companySub','paySub','currentDate','subscriptionCount','subscriptions'));
      }
    }

    public function createSubscription(Request $request)
    {
// dd($request->all());
    if(Auth::check()){
      
      $startDate = Carbon::now();
      $tomorrow = Carbon::tomorrow();
      $unixTimestamp = $tomorrow->timestamp;
      $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
      $checkSubscription = (!empty(decrypt($request->id))) ? Subscription::find(decrypt($request->id)) : false;
      // dd($checkSubscription);
     $checkFreeSub = CompanySubscription::where('company_id',Auth::id())->where('name','=','Free')->orderBy('created_at','DESC')->first();
     $checkCompanySub = CompanySubscription::where('company_id',Auth::id())->where('name','!=','Free')->where('end_date','<',Carbon::now())->orderBy('created_at','DESC')->first();
    //  dd($checkFreeSub);
        $duration = $checkSubscription->duration;  

         $subscription= $api->subscription->create(array('plan_id' => $checkSubscription->plan_id , 'customer_notify' => 1,'quantity'=>5, 'total_count' => 6, 'start_at' => 
          $unixTimestamp, 'addons' => array(array('item' => array('name' => 
          'Delivery charges', 'amount' => 30000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
    //  dd($subscription_id);
       if($checkCompanySub || $checkFreeSub){
          $updateSubscriptionData = CompanySubscription::where('company_id',Auth::id())
                ->update([

                    'company_id' => Auth::id(),
                    'razorpay_subscription_id' =>$subscription->id,
                    'subscription_id' =>$checkSubscription->id,
                    'subscription_type' => !empty($checkSubscription->type) ? $checkSubscription->type : null,
                    'name' => !empty($checkSubscription->name) ? $checkSubscription->name : null,
                    'price' => !empty($checkSubscription->price) ? $checkSubscription->price : null, 
                    'description' => !empty($checkSubscription->description) ? $checkSubscription->description : null,
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => Carbon::now()->addDays($duration)->format('Y-m-d'),
                    'status' => '1'
          
              ]);
            }
          }
            $subscriptionData = CompanySubscription::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();

            // dd($subscriptionData);
  //       $employee = InterviewEmployeeRounds::where('id', $request->interviewEmpRoundsId)
  //       ->update([
  //           'interviewee_comment' => $request->input('employee_comment'),
  //           'interviewee_comment_date' => Carbon::now(),
  //           'employee_interview_status' => $request->interview_status,
  //           'isEmployeeResponseSubmitted' => true,
  //       ]);
  // $subscriptionData = CompanySubscription::create($insert);
  
      if (!empty($subscriptionData)) {
          return view('admin.payment.razorpay_view',compact('subscriptionData'));
      } else {
          return Response::json(['success' => '0']);
      }

    }
}






