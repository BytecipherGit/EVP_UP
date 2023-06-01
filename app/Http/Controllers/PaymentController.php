<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use App\Models\CompanySubscriptionPayment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Auth;
use Exception;

class PaymentController extends Controller
{

    protected $razorpay;

    public function __construct() {
         $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }
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
    public function getPaySuccess(Request $request)
    {
// dd($request->all());
      if($request->all()){
           $subscription = Subscription::where('id',$request->subscription_id)->first();
           $checkCompanySub = CompanySubscriptionPayment::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();
           $duration = $subscription->duration;   

          if($checkCompanySub){   
            $end = Carbon::parse($checkCompanySub->end_date);
            $endDate = $end->addDays($duration)->format('Y-m-d');
           }
            // dd($endDate);
            $startDate = Carbon::now();
            $tomorrow = Carbon::tomorrow();
            $unixTimestamp = $tomorrow->timestamp;

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $subscriptions= $api->subscription->create(array('plan_id' => $subscription->plan_id , 'customer_notify' => 1,'quantity'=>5, 'total_count' => 6, 'start_at' => 
            $unixTimestamp, 'addons' => array(array('item' => array('name' => 
            'Delivery charges', 'amount' => 30000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

            $insert = [
                'company_id' => Auth::id(),
                'company_subscription_id' => !empty($request->id) ? $request->id : null,
                'razorpay_subscription_id' => !empty($subscriptions->id) ? $subscriptions->id : null,
                'subscription_id' => !empty($request->subscription_id) ? $request->subscription_id : null,
                'name' => !empty($request->subscription_name) ? $request->subscription_name : null,
                'payment_price' => !empty($request->subscription_price) ? $request->subscription_price : null,
                'payment_id' => !empty($request->razorpay_payment_id) ? $request->razorpay_payment_id : null,
                'start_date' => !empty($checkCompanySub->end_date) ? $checkCompanySub->end_date : Carbon::now()->format('Y-m-d'), 
                'end_date' => !empty($endDate) ? $endDate : Carbon::now()->addDays($duration)->format('Y-m-d'),
                'status' => 'Active',
            ];

            $subscriptionData = CompanySubscriptionPayment::create($insert);
            if (!empty($subscriptionData)) {
                return redirect('company_suscription');
            } else {
                return false;
                // return Response::json(['success' => '0']);
            }
        } else{
            return false;
        }
     }

     public function deleteSubscription(request $request)
     {
        // dd($request->all());
         if (!empty($request->subscriptionId)) {
            $subscriptionId = $request->input('subscriptionId');

            // $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $subscriptionData = $this->razorpay->subscription->fetch($subscriptionId);
            $subscriptionData->cancel();

            $subscriptionCancel = DB::table('company_subscription_payment')->where('id', $request->subId)->where('company_id',Auth::id())
             ->update([
                 'payment_status' => 'Cancelled',
             ]);

             $subscriptionStatus = DB::table('company_subscriptions')->where('razorpay_subscription_id', $subscriptionId)->where('company_id',Auth::id())
             ->update([
                 'status' => '0',
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

  }
