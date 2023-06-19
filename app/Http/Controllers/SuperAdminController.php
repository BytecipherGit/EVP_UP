<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Mail\CompanyRegisterationMail;
use App\Mail\CompanyResetVerifyMail;
use App\Mail\CompanyVerificationMail;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Documents;
use App\Rules\EmailDomain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Models\CompanyTemplate;
use App\Models\CompanyEmailTemplate;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Models\EmailConfiguration;
use App\Models\ThemeSetting;
use Illuminate\Validation\Rules;
use Storage;
use Auth;

class SuperAdminController extends Controller
{


    /**
     * Display the login view.
     */
    public function index()
    {

        if (!Auth::check()) {
            return view('auth.superadminlogin');
        } else {
            return redirect('admin/dashboard');
        }
       
    }

    use AuthenticatesUsers;

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        if (Auth::check()) {
          if (Auth::user()->role == 'superadmin'){  
                return redirect()->intended(RouteServiceProvider::SUPERADMIN);
             } 
               elseif(Auth::user()->role == 'admin') {
                Auth::logout();
                Session::flush();
               return redirect()->back()->with('message','Incurrect login details.');
             }
               
        } else {
            return redirect('admin');
        }
       
    }
    public function dashboard(request $request)
    {
        $getVerifiedCompany = User::where('status','=',1)->count();
        $getCompanyData = User::count();

        return view('superadmin.index',compact('getVerifiedCompany','getCompanyData'));        
    }

    public function getCompanyForm(request $request)
    {
        $countries = Country::get(["name", "id"]);
        $companyData = (!empty($request->id)) ? User::find($request->id) : false;
        // dd($companyData);
        return view('superadmin.create_organization',compact( 'countries','companyData'));
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function getCompany(request $request)
    {
        $getCompany = User::all();
        return view('superadmin/organization',compact('getCompany'));
    }

    public function getVerifiedCompany(request $request)
    {
        $getverifiedCompany = User::where('status','=','1')->get();
        return view('superadmin/verified_organization',compact('getverifiedCompany'));
    }
    
    public function getCompanyDetails(request $request)
    {
        if ($request->id) {

            $companyDetails = User::where('id',$request->id)->first();  
            $companyDocuments = Documents::where('user_id',$request->id)->get();
            $documentExist = Documents::where('user_id',$request->id)->first();
            $address= User::join('cities','cities.id','=','users.city')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select(('states.name as stateName'),('countries.name as countryName'),('cities.name as cityName'))
                        ->where('users.id', $request->id)
                        ->first();
                        
            $activeTab = $request->input('tab', 'tab2');
            return view('superadmin.organization_details',compact('companyDetails','address','companyDocuments','documentExist','activeTab'));
            
        }else {
            return Response::json(['success' => '0']);
        }

    }

    public function createCompany(request $request)
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
            // 'captcha' => ['required', 'captcha'],
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

        if ($user->status == '1') {
            return redirect('login')->with('message', 'Thanks for your registration.');
            } else {
            return redirect('admin/organization')->with('message', 'Company successfully registered.');
        }

    }

    public function getUpdateCompanyForm(request $request)
    {
        $countries = Country::get(["name", "id"]);
        $companyData = (!empty($request->id)) ? User::find($request->id) : false;
        $address= User::join('cities','cities.id','=','users.city')
                    ->join('states','states.id','=','cities.state_id')
                    ->join('countries','countries.id','=','states.country_id')
                    ->select(('states.name as stateName'),('states.id as stateId'),('countries.name as countryName'),('countries.id as countryId'),('cities.name as cityName'),('cities.id as cityId'))
                    ->where('users.id', $request->id)
                    ->first();  
        //  dd($address);
        return view('superadmin.update_organization',compact( 'countries','companyData','address'));
    }


    public function updateCompanyForm(request $request)
    {
        if (Auth::check()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email', new EmailDomain,
                'org_name' => 'required|string|max:255',
                'org_web' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'pin' => 'required|string|max:255',
            ]);

            if ($validator->passes()) {
                if($request->id){
                    $update = [

                        'name' => !empty($request->name) ? $request->name : null,
                        'email' => !empty($request->email) ? $request->email : null,
                        'org_name' => !empty($request->org_name) ? $request->org_name : null,
                        'org_web' => !empty($request->org_web) ? $request->org_web : null,
                        'designation' => !empty($request->designation) ? $request->designation : null,
                        'department' =>  !empty($request->department) ? $request->department : null,
                        'address' => !empty($request->address) ? $request->address : null,
                        'country' =>  !empty($request->country) ? $request->country : null,
                        'city' => !empty($request->city) ? $request->city : null,
                        'state' =>  !empty($request->state) ? $request->state : null,
                        'pin' =>  !empty($request->pin) ? $request->pin : null,

                    ];
                    $companyData = User::where('id',$request->id)->update($update);

                    if (!empty($companyData)) {
                        return redirect('admin/organization')->with('message','Company has been updated successfully.');
                        // return Response::json(['success' => '1']);
                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function deleteCompany(request $request)
    {
        // dd($request->companyId);
        if (!empty($request->companyId)) {
            $company = User::find($request->companyId);
            if ($company->delete()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }


    public function changeCompanyStatus(request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);
        $document_id = $request->get('id');
        $status = $request->get('status');
        if ($validator->passes()) {
            if ($status == 0) {
                DB::table('documents')->where('id', $document_id)->update(['status' => 1]);
                return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
            } else {
                DB::table('documents')->where('id', $document_id)->update(['status' => 0]);
                return Response::json(['status' => 'success', 'msg' => 'Successfully updated']);
            }
        } else {
            return Response::json(['status' => 'error', 'msg' => 'Unable to updated']);
        }
    }

    public function downloadDocument(request $request)
    {
        $data = Documents::where('id', $request->id)->first();
        $filename = $data->document;
        $filename = str_replace(url('/') . '/storage/', "", $filename);
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404);
    }

    public function change_password(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->validate($request, [
                'old' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::find(Auth::id());
            $hashedPassword = $user->password;

            if (Hash::check($request->old, $hashedPassword)) {
                //Change the password
                $user->fill([
                    'password' => Hash::make($request->password),
                ])->save();

                $request->session()->flash('success', 'Password successfully updated.');

                return back();
            }

            $request->session()->flash('failure', 'Password not change.');

            return back();
        } else {
            return view('superadmin.change_password');
        }

    }

    public function destroy(request $request)
      {
    
          Auth::guard('web')->logout();
  
          $request->session()->invalidate();
  
          $request->session()->regenerateToken();
  
          return redirect('admin');
      }

}
