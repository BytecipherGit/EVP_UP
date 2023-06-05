<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CompanyRegisterationMail;
use App\Mail\CompanyResetVerifyMail;
use App\Mail\CompanyVerificationMail;
use App\Models\City;
use App\Models\CompanyEmailTemplate;
use App\Models\CompanyTemplate;
use App\Models\Country;
use App\Models\State;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\EmailConfiguration;
use App\Models\Subscription;
use App\Models\CompanySubscription;
use App\Rules\EmailDomain;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Razorpay\Api\Api;
use App\Helpers\Helper as HelpersHelper;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\View\View;
use Carbon\Carbon;
use Response;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('auth.register', $data);
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    public function autocomplete(Request $request)
    {
        $data = User::select("name as value", "id")
            ->where('name', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class, new EmailDomain],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'org_name' => ['required', 'string', 'max:255'],
            'org_web' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'pin' => ['required', 'string', 'max:255'],
            'captcha' => ['required', 'captcha'],
            // 'g-recaptcha-response' => ['required','captcha']

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'org_name' => $request->org_name,
            'org_web' => $request->org_web,
            'designation' => $request->designation,
            'department' => $request->department,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pin' => $request->pin,
            'password' => Hash::make($request->password),
            'status' => '0',
        ]);

        event(new Registered($user));

        
        if ($user) {
            //Insert default theme setting record in Theme_setting table like company logo, primary_color & secondry_color
            $getThemeSettingRecords = ThemeSetting::where('company_id',0)->get();
            if(count($getThemeSettingRecords) > 0){
                foreach ($getThemeSettingRecords as $getThemeSettingRecord) {
                    $insertThemeRecord = array(
                        'company_id' => $user->id,
                        'title' => $getThemeSettingRecord->title,
                        'key' => $getThemeSettingRecord->key,
                        'value' => $getThemeSettingRecord->value,
                    );
                    ThemeSetting::create($insertThemeRecord);
                }
            }

        // Condition for template add
         $emailtemplate = CompanyTemplate::all();
            foreach ($emailtemplate as $emailtemp) {
                $insertTemplatesRecords = array(
                    'company_id' => $user->id,
                    'template_id' => $emailtemp->id,
                    'email_type' => $emailtemp->email_type,
                    'content' => $emailtemp->content,
                    'status' => 'True',
                );

                CompanyEmailTemplate::create($insertTemplatesRecords);
            }

    // Add subscription details 
     $getSubscriptionRecords = Subscription::where('type','Free')->get();

     if(count($getSubscriptionRecords) > 0){
        foreach ($getSubscriptionRecords as $getSubscriptionRecord) {
            $duration = $getSubscriptionRecord->duration;
                $insertSubscriptionRecord = array(
                    'company_id' => $user->id,
                    'subscription_id' => $getSubscriptionRecord->id,
                    'subscription_type' => $getSubscriptionRecord->type,
                    'description' => $getSubscriptionRecord->description,
                    'name' => $getSubscriptionRecord->name,
                    'price' => $getSubscriptionRecord->price,
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => Carbon::now()->addDays($duration)->format('Y-m-d'),
                    'subscription_status' => 'Active',
                );
                CompanySubscription::create($insertSubscriptionRecord);
            }
        }

     // Insert Compant id  for SMTP Details 
           $insertSMTPRecords = array(
                 'company_id' => $user->id,
                 'driver'=> 'smtp',
                 'host'=>'smtp.gmail.com',
                 'port'=> '587',
                 'from_address'=> 'jharshita259@gmail.com',
                 'from_name'=> '${APP_NAME}',
                 'encryption'=>'tls',
                 'username'=> 'jharshita259@gmail.com',
                 'password'=> 'bfhagppogpishvbq',
             
             );

             EmailConfiguration::create($insertSMTPRecords);
     }


        if ($user) {
            $mailData = [
                'name' => !empty($request->name) ? $request->name : '',
            ];
            FacadesMail::to($request->email)->send(new CompanyRegisterationMail($mailData));

            $verifyMailData = [
                'name' => !empty($request->name) ? $request->name : '',
                'id' => encrypt($user->id),
                'status' => $user->status,
            ];
            FacadesMail::to($request->email)->send(new CompanyVerificationMail($verifyMailData));
        }

        // Auth::login($user);

        // return redirect(RouteServiceProvider::ADMIN);
        if ($user->status == '1') {
            return redirect('login')->with('message', 'Thanks for your registration.');
        } else {

            return redirect('account_verify')->with('message', 'Thanks for your registration.');
        }

    }

    public function reloadCaptcha()
    {
        // dd('hello');
        return response()->json(['captcha' => captcha_img()]);
    }

    public function resetMailSend(request $request)
    {

        if (!empty($request->id)) {
            $user = User::find($request->id);
            if (!empty($user->email)) {
                $verifyMailData = [
                    'name' => !empty($user->name) ? $user->name : '',
                    'id' => encrypt($user->id),
                    'status' => $user->status,
                ];

                $emailDetails = HelpersHelper::getSmtpConfig(Auth::id());

                $config = array(
                    'driver'     => $emailDetails->driver,
                    'host'       => $emailDetails->host,
                    'port'       => $emailDetails->port,
                    'from'       => array('address' => $emailDetails->from_address, 'name' => $emailDetails->from_name),
                    'encryption' => $emailDetails->encryption,
                    'username'   => $emailDetails->username,
                    'password'   => $emailDetails->password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
                
                FacadesMail::to($user->email)->send(new CompanyResetVerifyMail($verifyMailData));

                return redirect()->back()->with('message', 'Reset verification link has been sent to your email address.');
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }

}
