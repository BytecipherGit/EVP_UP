<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Session;

class EmployeeLoginController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
   public function index()
   {
       if (Auth::guard('employee')->check()) {
           return Redirect::route('employee_login.dashboard');
       }

       return View('individualEmployee.login');

   }
  
    public function store(request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if ($validator->passes()) {
            // if(Auth::guard('employee')->attempt(request(['email', 'password'])))
            if (Auth::guard('employee')->attempt($data, $request->remember)) 
            {
            return redirect('employee_login/dashboard');
            }else{
                return redirect()->back()->with('message','Incurrect login details.');
            }
    
        } else {
            return Response::json(['errors' => $this->validate->errors()]);
        }
    }

     /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('employee')->logout();

        return Redirect('employee_login');
    }
}
