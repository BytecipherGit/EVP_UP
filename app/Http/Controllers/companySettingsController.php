<?php

namespace App\Http\Controllers;
use App\Models\CompanyProfile;
use App\Models\CompanyAddress;
use App\Models\Department;
use App\Models\User;
use App\Models\EmailConfiguration;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Session;
use App\Models\Designation;

use Illuminate\Http\Request;

class companySettingsController extends Controller
{

    public function profiledata(){

        $profile = User::where('id',Auth::id())->first();
        $department = Department::all();
        $designat = Designation::all();
        $plans = Plan::latest()->first();
        $smtpDetails = EmailConfiguration::where('company_id',Auth::id())->first();

        return view('admin/settings', compact('profile','department','designat','plans','smtpDetails'));
    
    }

      public function updateCompanyProfile(request $request)
      {

       if(isset($_POST['profile'])){

        if($request->file('company_logo')){
          $file= $request->file('company_logo');
          $filename=$file->getClientOriginalName();
          $file->move(public_path().'/Image/',$filename); 
          $add['company_logo']= $filename;

          }
          else{
            $image=DB::table('users')->where('id',Auth::id())->first();
            $filename=$image->company_logo;
            // print_r($image);die();
           }

        $profile=DB::table('users')->where('id',Auth::id())
                 ->update([
                               
                  'org_name'=>!empty($request->org_name) ? $request->org_name : null,
                  'brand_name'=>!empty($request->brand_name) ? $request->brand_name : null,
                  'org_web'=>!empty($request->org_web) ? $request->org_web : null,
                  'domain_name'=> !empty($request->domain_name) ? $request->domain_name : null,
                  'industry'=> !empty($request->industry) ? $request->industry : null,
                  'phone_number'=> !empty($request->phone_number) ? $request->phone_number : null,
                  'company_logo'=>$filename,
                  'description'=>!empty($request->description) ? $request->description : null,

       ]);
      
        return redirect()->back()->with('message',"Profile data successfully added"); 
      }

       if(isset($_POST['add_address'])){

        $address=DB::table('users')->where('id',Auth::id())
        ->update([
            'address'=>!empty($request->address) ? $request->address : null,
            'cor_office_address'=> !empty($request->cor_office_address) ? $request->cor_office_address : null,
         ]);
       
        return redirect()->back()->with('success',"Address successfully added");
       }

       if(isset($_POST['dept'])){

        $department=new Department();
        $department->department=!empty($request->department) ? $request->department : null;
        $department->sub_department=!empty($request->sub_department) ? $request->sub_department : null;
        $department->save();

        return redirect()->back()->with('succ',"Data successfully added");
       
       }

       if(isset($_POST['designation'])){

        $desi=new Designation();
        $desi->designation_name=!empty($request->designation_name) ? $request->designation_name : null;
        $desi->save();

        return redirect()->back()->with('msg',"Data successfully added");
       }

      
       if(isset($_POST['plan'])){

        $planss= new Plan();
        $planss->plan_name=!empty($request->plan_name) ? $request->plan_name : null;
        $planss->authority=!empty($request->authority) ? $request->authority : null;
        $planss->plan_type=!empty($request->plan_type) ? $request->plan_type : null;

        $planss->save();

        return redirect()->back()->with('msg',"Data successfully added");
       }

        if(isset($_POST['department_edit'])){

          $depart= DB::table('departments')->where('id',$request->id)
          ->update([
            'department'=>!empty($request->department) ? $request->department : null,
            'sub_department'=>!empty($request->sub_department) ? $request->sub_department : null,
            ]);

        return redirect()->back()->with('succ',"Data successfully added");

        }

        if(isset($_POST['desig_edit'])){
 
        $desi=DB::table('designations')->where('id',$request->id)
        ->update([

            'designation_name'=>!empty($request->designation_name) ? $request->designation_name : null,
          ]);

          return redirect()->back()->with('succ',"Data successfully added");
        }
      }

      public function createSmtpForm(request $request)
        {
          if (Auth::check()) {
          
            $smtpData=DB::table('email_configurations')->where('company_id',Auth::id())
               ->update([

                  'company_id'=> Auth::id(),
                  'driver'=> !empty($request->driver) ? $request->driver : null,
                  'host'=>!empty($request->host) ? $request->host : null,
                  'port'=> !empty($request->port) ? $request->port : null,
                  'from_address'=> !empty($request->from_address) ? $request->from_address : null,
                  'from_name'=> !empty($request->from_name) ? $request->from_name : null,
                  'encryption'=>!empty($request->encryption) ? $request->encryption : null,
                  'username'=> !empty($request->username) ? $request->username : null,
                  'password'=> !empty($request->password) ? $request->password : null,
            
               ]);
               return redirect()->back()->with('succ',"Data successfully added");
   
         }
      }
        
}
