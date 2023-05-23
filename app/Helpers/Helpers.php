<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\EmailConfiguration;
use App\Models\CompanySubscription;
use App\Models\Subscription;

class Helper {

    public static function helperfunction1(){
        return "helper function 1 response";
    }

    public static function getUserDetails($id=0){
        $user = User::find($id);
        return $user;
    }

    public static function getPaymentStatus($subscriptionId){
        if(!empty($subscriptionId)){
            $activeSubscriptions = DB::table('company_subscription_payment')->where('subscription_id', $subscriptionId)->orderBy('id','desc')->first();
            if(!empty($activeSubscriptions->payment_status)){
                return $activeSubscriptions->payment_status;
            } else {
                return '';
            }
        }
    }

    public static function getSubscriptionStatus($subscriptionId){
        if(!empty($subscriptionId)){
            $subscriptionStatus = DB::table('company_subscriptions')->where('subscription_id', $subscriptionId)->orderBy('id','desc')->first();
            if(!empty($subscriptionStatus->status)){
                return $subscriptionStatus->status;
            } else {
                return '';
            }
        }
    }

    public static function getPaymentId($subscriptionId){
        if(!empty($subscriptionId)){
            $subscriptionPaymentId = DB::table('company_subscription_payment')->where('subscription_id', $subscriptionId)->orderBy('id','desc')->first();
            // dd($subscriptionPaymentId);
            if(!empty($subscriptionPaymentId->id)){
                // dd($subscriptionPaymentId->id);
                return $subscriptionPaymentId->id;
            } else {
                return '';
            }
        }
    }

    public static function getSmtpConfig($id=0)
    {
        $mail = EmailConfiguration::where('company_id',$id)->first();
        // dd($mail);
        if ($mail) {
            return $mail;     
        }
      
     }


}