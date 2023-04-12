<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Empinvite;
use App\Models\Employee;
use App\Models\CompanyEmployee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allemployee = CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                       ->join('employee','company_employee.employee_id','=','employee.id')->select('company_employee.*','users.id','employee.*')
                       ->where('company_employee.company_id',Auth::user()->id)->count();

        $current = CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                    ->join('employee','company_employee.employee_id','=','employee.id')->select('company_employee.*','users.id','employee.*')
                    ->where('employee.status', 1)->where('company_employee.company_id',Auth::user()->id)->count();
                    
        $empinvite =  CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                    ->join('employee','company_employee.employee_id','=','employee.id')->select('company_employee.*','users.id','employee.*')
                    ->where('employee.status', 2)->where('company_employee.company_id',Auth::user()->id)->count();

        // dd($allemployee);
        return view('company/index',compact('current','empinvite','allemployee'));
    }

    public function getPasswordReset()
    {
        return view('company/change-password');
    }

      
    // public function logout(Request $request) {	  	  	
    //     Auth::logout();
    //     Session::flush();	  
    //     return redirect('/');
    //   }

      public function changePassword(request $request){

        $request->validate([
            // 'password' => ['required', 'confirmed'],
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

         return back()->with("status", "Password changed successfully!");
        // $password=User::where('id',Auth::id())
        // ->update([
        //   'password'=>Hash::make($request->new_password)
        //   ]);
        //   // echo($desi); die();
        //   return redirect()->back()->with('message',"Your password Updated Successfully..");
        
      }


     
}