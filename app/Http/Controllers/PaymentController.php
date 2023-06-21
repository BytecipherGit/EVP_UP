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
use Illuminate\Support\Facades\Log;
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

            $payment = $this->razorpay->payment->fetch($request->razorpay_payment_id);
// dd($payment);
             $checkCompanyPayment = CompanySubscriptionPayment::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();
             $checkCompanyPaymentDate = CompanySubscriptionPayment::where('company_id',Auth::id())->whereNotNull('razorpay_payment_id')->orderBy('created_at','DESC')->first();

             if($checkCompanyPaymentDate){   
                $date = Carbon::parse($checkCompanyPaymentDate->end_date);
                $endDate = $date->addDays($duration)->format('Y-m-d');
               }

            $updateSubscriptionPaymentData = CompanySubscriptionPayment::where('company_id',Auth::id())->where('id',$request->id)
            ->update([

                'razorpay_subscription_status' => 'Active',
                'company_subscription_id' => !empty($checkCompanyPayment->company_subscription_id) ? $checkCompanyPayment->company_subscription_id : null,
                'payment_price' => !empty($payment->amount) ? $payment->amount : null,
                'payment_status' =>'Active',
                'razorpay_payment_id' => !empty($payment->id) ? $payment->id : null,
                'razorpay_token_id' => !empty($payment->token_id) ? $payment->token_id : null,
                'start_date' => !empty($checkCompanyPaymentDate->end_date) ? $checkCompanyPaymentDate->end_date : Carbon::now()->format('Y-m-d'), 
                'end_date' => !empty($endDate) ? $endDate : Carbon::now()->addDays($duration)->format('Y-m-d'),
      
            ]);

            $checkpayment = CompanySubscriptionPayment::where('company_id',Auth::id())->orderBy('created_at','DESC')->first();


            if (!empty($updateSubscriptionPaymentData)) {
                if(($checkpayment->company_subscription_id)){
                        $updateSubscriptionData = CompanySubscription::where('company_id',Auth::id())
                            ->update([
                                'subscription_type' => !empty($subscription->type) ? $subscription->type : null,
                                'name' => !empty($subscription->name) ? $subscription->name : null,
                                'price' => !empty($subscription->price) ? $subscription->price : null, 
                                'description' => !empty($subscription->description) ? $subscription->description : null,
                                'end_date' => Carbon::now()->addDays($duration)->format('Y-m-d'),
                                'start_date' => Carbon::now()->format('Y-m-d'),
                                'subscription_status' => 'Active',
                            ]);
                   }
                   
                return redirect('company_suscription');
            } else {
                return false;
            }

        } else{
            return false;
        }
     }

     public function deleteSubscription(request $request)
     {
        // dd($request->all());
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

     public function createRecurringSubscriptionPayment(Request $request)
     {

        Log::info('Webhook request:', $request->all());
        $payload = $request->input('payload');
        $token_id = $payload['payment']['entity']['token_id'];

        Log::info($token_id);
    //  dd($request->all());

    //    $checkSubscription = (!empty(decrypt($request->id))) ? Subscription::find(decrypt($request->id)) : false;
           // dd($checkSubscription);
        //  $checkFreeSub = CompanySubscription::where('company_id',Auth::id())->where('name','!=','Free')->orderBy('created_at','DESC')->first();
         $checkCompanySubExist = CompanySubscriptionPayment::where('razorpay_token_id', $token_id)->orderBy('created_at','DESC')->first();
         Log::info($checkCompanySubExist);
        //  $duration = $checkSubscription->duration;  
      
         if($checkCompanySubExist){
        
            $subscriptionCheck = (!empty($checkCompanySubExist->subscription_id)) ? Subscription::find($checkCompanySubExist->subscription_id) : false;
            $duration = $subscriptionCheck->duration;   

            $end = Carbon::parse($checkCompanySubExist->end_date);
            $endDate = $end->addDays($duration)->format('Y-m-d');
   
             $insert = [
                 'company_id' => $checkCompanySubExist->company_id,
                 'company_subscription_id' => null,
                 'razorpay_subscription_id' => !empty($checkCompanySubExist->razorpay_subscription_id) ? $checkCompanySubExist->razorpay_subscription_id : null,
                 'subscription_id' => !empty($checkCompanySubExist->subscription_id) ? $checkCompanySubExist->subscription_id : null,
                 'name' => !empty($checkCompanySubExist->name) ? $checkCompanySubExist->name : null,
                 'payment_price' => !empty($payload['payment']['entity']['amount']) ? $payload['payment']['entity']['amount'] : null,
                //  'payment_object' => !empty($payment) ? $payment : null,
                 'razorpay_payment_id' => !empty($payload['payment']['entity']['razorpay_payment_id']) ? $payload['payment']['entity']['razorpay_payment_id'] : null,
                 'razorpay_token_id' => !empty($token_id) ? $token_id : null,
                 'start_date' => !empty($checkCompanySubExist->end_date) ? $checkCompanySubExist->end_date : Carbon::now()->format('Y-m-d'), 
                 'end_date' => !empty($endDate) ? $endDate : Carbon::now()->addDays($duration)->format('Y-m-d'),
                 'razorpay_subscription_status' => 'Active'
              ];

              $subscriptionDataExist = CompanySubscriptionPayment::create($insert);

            }else{
                return false;
            }
     }

  }
