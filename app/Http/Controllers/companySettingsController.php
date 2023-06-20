<?php

namespace App\Http\Controllers;
use App\Models\CompanyProfile;
use App\Models\CompanyAddress;
use App\Models\Department;
use App\Models\User;
use App\Models\EmailConfiguration;
use Auth;
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

                  'org_name'=> $request->input('org_name'),
                  'brand_name'=> $request->input('brand_name'),
                  'org_web'=> $request->input('org_web'),
                  'domain_name'=> $request->input('domain_name'),
                  'industry'=> $request->input('industry'),
                  'phone_number'=> $request->input('phone_number'),
                  'company_logo'=>$filename,
                  'description'=> $request->input('description'),

       ]);
      
        return redirect()->back()->with('message',"Profile data successfully added");

       }

       if(isset($_POST['add_address'])){

        $address=DB::table('users')->where('id',Auth::id())
        ->update([
            'address'=> $request->input('address'),
            'cor_office_address'=> $request->input('cor_office_address'),
         ]);
       
        return redirect()->back()->with('success',"Address successfully added");
       }

       if(isset($_POST['dept'])){

        $department=new Department();
        $department->department=$request->input('department');
        $department->sub_department=$request->input('sub_department');
        $department->save();

        return redirect()->back()->with('succ',"Data successfully added");
       
       }

       if(isset($_POST['designation'])){

        $desi=new Designation();
        $desi->designation_name=$request->input('designation_name');
        $desi->save();

        return redirect()->back()->with('msg',"Data successfully added");
       }

      
       if(isset($_POST['plan'])){

        $planss=new Plan();
        $planss->plan_name=$request->input('plan_name');
        $planss->authority=$request->input('authority');
        $planss->plan_type=$request->input('plan_type');

        $planss->save();

        return redirect()->back()->with('msg',"Data successfully added");
       }

        if(isset($_POST['department_edit'])){

          $depart= DB::table('departments')->where('id',$request->id)
          ->update([
            'department'=>$request->input('department'),
            'sub_department'=>$request->input('sub_department')
            ]);

        return redirect()->back()->with('succ',"Data successfully added");

        }

        if(isset($_POST['desig_edit'])){
 
        $desi=DB::table('designations')->where('id',$request->id)
        ->update([

            'designation_name'=>$request->input('designation_name')
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

           }
            return redirect()->back()->with('succ',"Data successfully added");
        }
        
}
