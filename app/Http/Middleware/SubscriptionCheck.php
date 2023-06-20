<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CompanySubscriptionPayment;
use App\Models\CompanySubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $checkSubscription = CompanySubscriptionPayment::where('company_id',Auth::id())->where('payment_status','=','Active')->orderBy('created_at', 'desc')->first();
        $checkFreeSubscription = CompanySubscription::where('company_id',Auth::id())->where('subscription_status','=','Active')->orderBy('created_at', 'desc')->first();
       if($checkSubscription || $checkFreeSubscription){
           return $next($request);
       }else{
        // return $next($request);
           return redirect()->route('company.suscription');
        }
      
    }
}
