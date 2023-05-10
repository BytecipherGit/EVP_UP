<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request)
    {
        $getVerifiedCompany = User::where('status','=',1)->count();
        $getCompanyData = User::count();
        return view('superadmin/index',compact('getVerifiedCompany','getCompanyData'));
    }

    public function superAdminLogin(){
        return view('auth/superadminlogin');
    }

    public function getCompany(request $request)
    {
        $getCompany = User::all();
        return view('superadmin/organization',compact('getCompany'));
    }
    
    public function getCompanyDetails(request $request)
    {
        if ($request->id) {

            $companyDetails = User::where('id',$request->id)->first();  
            $address= User::join('cities','cities.id','=','users.city')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select(('states.name as stateName'),('countries.name as countryName'),('cities.name as cityName'))
                        ->where('users.id', $request->id)
                        ->first();

            return view('superadmin/organization_details',compact('companyDetails','address'));
            
        }else {
            return Response::json(['success' => '0']);
        }

    }


    public function logout(Request $request) {	  	  	
        Auth::logout();
        Session::flush();	  
        return redirect('/admin');
      }
}
