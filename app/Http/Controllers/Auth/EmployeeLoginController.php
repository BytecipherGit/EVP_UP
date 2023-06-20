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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;

class EmployeeLoginController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
   public function index(request $request)
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
            'password' => $request->input('password'),
        ];
 
        $remember = $request->filled('remember'); // Check if "Remember Me" is checked


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


    // password reset 

    public function create(): View
    {
        return view('individualEmployee.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePassword(Request $request): RedirectResponse
    {
        $request->validate([
          'email' => 'required|email|exists:employee',
         ]);
                    
       $token = Str::random(64);
       $email = $request->email;  

      $emailExist = DB::table('password_resets')->where(['email'=> $request->email])->first();

       if(!$emailExist){
            DB::table('password_resets')->insert([
               'email' => $request->email, 
               'token' => $token, 
               'created_at' => Carbon::now()
            ]);

                    
           \Mail::send('individualEmployee.email.forgotPassword', ['token' => $token, 'email' => $email], function($message) use($request){
                 $message->to($request->email);
                 $message->subject('Reset Password');
             });

                    
            return back()->with('status', 'We have e-mailed your password reset link!');

      }else{
        return back()->with('status', 'We have already e-mailed your password reset link!');
       }
    }


    public function showResetPasswordForm($token,$email) 
    { 
        return view('individualEmployee.reset-password', ['token' => $token, 'email' => $email]);
     }


    /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:employee',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = Employee::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/employee_login')->with('status', 'Your password has been changed!');
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
