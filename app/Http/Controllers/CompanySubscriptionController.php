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

  protected $razorpay;

  public function __construct() {
    
       $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  }

    public function index(request $request)
    {

      if(Auth::check()){
       
        $subscriptionDetails = Subscription::leftJoin('company_subscriptions','company_subscriptions.subscription_id','=','subscriptions.id')
                              ->leftJoin('company_subscription_payment','company_subscription_payment.subscription_id','=','company_subscriptions.subscription_id')
                              ->select('subscriptions.*','subscriptions.plan_id','company_subscriptions.razorpay_subscription_id','company_subscription_payment.payment_status',('company_subscription_payment.id as company_pay_id'),'company_subscriptions.subscription_status')
                              ->groupBy('subscriptions.id')
                              ->get();

        $subscriptions = Subscription::where('name','!=','Free')->count();
        $companySub = CompanySubscription::where('company_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $paySub = CompanySubscriptionPayment::where('company_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $currentDate = date('Y-m-d');
        
        $subscriptionCount =  Subscription::join('company_subscription_payment','company_subscription_payment.subscription_id','=','subscriptions.id')
                              ->where('company_subscription_payment.company_id', Auth::id())->where('company_subscription_payment.payment_status','!=','Created')
                              ->count();
     
        return view('admin.subscription.index',compact('subscriptionDetails','companySub','paySub','currentDate','subscriptionCount','subscriptions'));
      }
    }

    public function deleteCompanySubscription(request $request)
    {
      //  dd($request->all());
        if (!empty($request->subscriptionId)) {
           $subscriptionID = $request->input('subscriptionId');
           $subscriptionData = $this->razorpay->subscription->fetch($subscriptionID);
           $subscriptionData->cancel();

           $subscriptionCancel = DB::table('company_subscription_payment')->where('id', $request->subId)->where('company_id',Auth::id())
            ->update([
                'razorpay_subscription_status' => 'Cancelled',
                'payment_status' => 'Cancelled',
            ]);

            $subscriptionStatus = DB::table('company_subscriptions')->where('razorpay_subscription_id', $subscriptionID)->where('company_id',Auth::id())
            ->update([
                'subscription_status' => 'Cancelled',
            ]);

            if (!empty($subscriptionStatus) && !empty($subscriptionCancel)) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

    public function createSubscription(Request $request)
    {
// dd($request->all());  

    if(Auth::check()){
      
      $currentDate = Carbon::now();

      $subscriptionCheck = (!empty(decrypt($request->id))) ? Subscription::find(decrypt($request->id)) : false;
          // dd($subscriptionCheck);
        // $subscriptionCheck = Subscription::where('id',$request->subscription_id)->first();
        $checkFreeSub = CompanySubscription::where('company_id',Auth::id())->where('name','=','Free')->orderBy('created_at','DESC')->first();
        $checkCompanySubExist = CompanySubscription::where('company_id',Auth::id())->where('name','!=','Free')->orderBy('created_at','DESC')->first();
// dd($checkFreeSub);
        $checkCompanySub = CompanySubscriptionPayment::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();
        $duration = $subscriptionCheck->duration;   

       if($checkCompanySub){   
         $end = Carbon::parse($checkCompanySub->end_date);
         $endDate = $end->addDays($duration)->format('Y-m-d');
        }
        // $total_count = parseInt(365 / $duration * 9);
        $totalCount = intval(365 / $duration * 9);
      // var_dump($totalCount);
      if($checkFreeSub){

        $subscription= $this->razorpay->subscription->create(array('plan_id' => $subscriptionCheck->plan_id ,'customer_notify' => 1,'quantity'=> 1, 
        'total_count' => $totalCount,'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
// dd($subscription);
           $updateSubscriptionData = CompanySubscription::where('company_id',Auth::id())
              ->update([

                  'company_id' => Auth::id(),
                  'razorpay_subscription_id' =>$subscription->id,
                  'subscription_id' =>  !empty(decrypt($request->id)) ? (decrypt($request->id)) : null,
                  'subscription_type' => !empty($subscriptionCheck->type) ? $subscriptionCheck->type : null,
                  'name' => !empty($subscriptionCheck->name) ? $subscriptionCheck->name : null,
                  'price' => !empty($subscriptionCheck->price) ? $subscriptionCheck->price : null, 
                  'description' => !empty($subscriptionCheck->description) ? $subscriptionCheck->description : null,
                  'start_date' => Carbon::now()->format('Y-m-d'),
                  'end_date' => Carbon::now()->addDays($duration)->format('Y-m-d'),
                  'subscription_status' => 'Created',
        
            ]);
             $checkSubscriptionData = CompanySubscription::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();

             if($checkSubscriptionData){
                $insert = [
                  'company_id' => Auth::id(),
                  'company_subscription_id' => !empty($checkSubscriptionData->id) ? $checkSubscriptionData->id : null,
                  'razorpay_subscription_id' => !empty($subscription->id) ? $subscription->id : null,
                  'subscription_id' => !empty($subscriptionCheck->id) ? $subscriptionCheck->id : null,
                  'name' => !empty($subscriptionCheck->name) ? $subscriptionCheck->name : null,
                  'razorpay_subscription_status' => 'Created',
                  'payment_status' => 'Created'
                ];

              $subscriptionDataExist = CompanySubscriptionPayment::create($insert);
          // dd($subscriptionDataExist);
              if (!empty($subscriptionDataExist)) {
                return view('admin.payment.razorpay_view',compact('subscriptionDataExist','subscriptionCheck'));
                } else {
                    return Response::json(['success' => '0']);
                }

           }else{
              return Response::json(['success' => '0']);
           }

      }else{

        if($checkCompanySubExist->end_date == $currentDate || $checkCompanySubExist->end_date < $currentDate ){

          $subscription= $this->razorpay->subscription->create(array('plan_id' => $subscriptionCheck->plan_id ,'customer_notify' => 1,'quantity'=> 1, 
          'total_count' => $totalCount,'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

             $updateSubscriptionData = CompanySubscription::where('company_id',Auth::id())
                ->update([

                    'company_id' => Auth::id(),
                    'razorpay_subscription_id' =>$subscription->id,
                    'subscription_id' =>  !empty($subscriptionCheck->id) ? $subscriptionCheck->id : null,
                    'subscription_type' => !empty($subscriptionCheck->type) ? $subscriptionCheck->type : null,
                    'name' => !empty($subscriptionCheck->name) ? $subscriptionCheck->name : null,
                    'price' => !empty($subscriptionCheck->price) ? $subscriptionCheck->price : null, 
                    'description' => !empty($subscriptionCheck->description) ? $subscriptionCheck->description : null,
                    // 'end_date' => Carbon::now()->addDays($duration)->format('Y-m-d'),
                    // 'start_date' => Carbon::now()->format('Y-m-d'),
                    'subscription_status' => 'Created',
          
              ]);

              $checkSubscriptionData = CompanySubscription::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();

              if($checkSubscriptionData){
                 $insert = [
                  'company_id' => Auth::id(),
                  'company_subscription_id' => !empty($checkSubscriptionData->id) ? $checkSubscriptionData->id : null,
                  'razorpay_subscription_id' => !empty($subscription->id) ? $subscription->id : null,
                  'subscription_id' => !empty($subscriptionCheck->subscription_id) ? $subscriptionCheck->subscription_id : null,
                  'name' => !empty($subscriptionCheck->name) ? $subscriptionCheck->name : null,
                  'razorpay_subscription_status' => 'Created',
                  'payment_status' => 'Created'
               ];
 
               $subscriptionDataExist = CompanySubscriptionPayment::create($insert);

               if (!empty($subscriptionDataExist)) {
                return view('admin.payment.razorpay_view',compact('subscriptionDataExist','subscriptionCheck'));
                } else {
                    return Response::json(['success' => '0']);
                }
 
            }else{
               return Response::json(['success' => '0']);
            }

           }
           else{

            // $subscriptionCheck = Subscription::where('id',(decrypt($request->id)))->first();
            $checkSubscriptionData = CompanySubscription::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();
        // dd($subscriptionCheck);
           $unixTimestamp = $checkSubscriptionData->end_date;
          //  dd($unixTimestamp);
            $subscription= $this->razorpay->subscription->create(array('plan_id' => $subscriptionCheck->plan_id ,'customer_notify' => 1,'quantity'=> 1, 
            'total_count' => $totalCount,'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

            if($checkSubscriptionData){
                $insert = [
                  'company_id' => Auth::id(),
                  'company_subscription_id' => null,
                  'razorpay_subscription_id' => !empty($subscription->id) ? $subscription->id : null,
                  'subscription_id' => !empty($subscriptionCheck->id) ? $subscriptionCheck->id : null,
                  'name' => !empty($subscriptionCheck->name) ? $subscriptionCheck->name : null,
                  'razorpay_subscription_status' => 'Created',
                  'payment_status' => 'Created'
              ];

              $subscriptionDataExist = CompanySubscriptionPayment::create($insert);

          }else{
              return Response::json(['success' => '0']);
          }

              if (!empty($subscriptionDataExist)) {
                  return view('admin.payment.razorpay_view',compact('subscriptionDataExist','subscriptionCheck'));
              } else {
                  return Response::json(['success' => '0']);
              }
              
            }
            
          }
       
     }
    }

}






