<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\CompanySubscription;
use Razorpay\Api\Api;
use Auth;

class CompanySubscriptionController extends Controller
{

    public function index(request $request)
    {
      if(Auth::check()){
        $checkPlanExist = Subscription::all();
        $companySubExits = CompanySubscription::where('company_id',Auth::id())->first();
        // dd($companySubExits);
        return view('admin.subscription.index',compact('checkPlanExist','companySubExits'));
      }
    }

}
