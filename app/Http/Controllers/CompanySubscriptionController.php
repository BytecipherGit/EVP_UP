<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Auth;

class CompanySubscriptionController extends Controller
{

    public function index(request $request)
    {
      if(Auth::check()){
        $checkPlanExist = Subscription::all();
        return view('admin.subscription.index',compact('checkPlanExist'));
      }
    }

}
