<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Rules\EmailDomain;
use Illuminate\View\View;
use Response;
use App\Mail\CompanyRegisterationMail;
use App\Mail\CompanyResetVerifyMail;
use App\Mail\CompanyVerificationMail;
use App\Mail\CompanyVerificationMessage;
use Illuminate\Support\Facades\Mail as FacadesMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data['countries'] = Country::get(["name","id"]);
        return view('auth.register',$data);
    }


    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, new EmailDomain],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'org_name' => ['required', 'string', 'max:255'],
            'org_web' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'pin' => ['required', 'string','max:255'],
            // 'g-recaptcha-response' => ['required','captcha']

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'org_name' => $request->org_name,
            'org_web' =>$request->org_web,
            'designation' =>$request->designation,
            'department' =>$request->department,
            'address' =>$request->address,
            'country' =>$request->country,
            'state' =>$request->state,
            'city' =>$request->city,
            'pin' =>$request->pin,
            'password' => Hash::make($request->password),
            'status' => '0',
        ]);

        

        event(new Registered($user));
    
        if($user){
            $mailData = [
                'name' => !empty($request->name) ? $request->name : '',
            ];
            FacadesMail::to($request->email)->send(new CompanyRegisterationMail($mailData));
       
            $verifyMailData = [
                'name' => !empty($request->name) ? $request->name : '',
                'id' => encrypt($user->id),
                'status' => $user->status
            ];
            FacadesMail::to($request->email)->send(new CompanyVerificationMail($verifyMailData));
        }

        // Auth::login($user);

        // return redirect(RouteServiceProvider::ADMIN);
       if($user->status == '1'){
        return redirect('login')->with('message','Thanks for your registration.');
       }
       else{
    
        return redirect('verify_status')->with('message','Thanks for your registration.');
       }
     
    }

    public function resetMailSend(request $request){

        if (!empty($request->id)) {
            $user = User::find($request->id);
            if (!empty($user->email)) {
                $verifyMailData = [
                    'name' => !empty($user->name) ? $user->name : '',
                    'id' => encrypt($user->id),
                    'status' => $user->status,
                ];
                FacadesMail::to($user->email)->send(new CompanyResetVerifyMail($verifyMailData));

               return redirect()->back()->with('message','Reset verification link has been sent to your email address.');
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }


}
