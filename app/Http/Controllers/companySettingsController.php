<?php

namespace App\Http\Controllers;
use App\Models\CompanyProfile;
use App\Models\CompanyAddress;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Session;
// use Illuminate\Support\Facades\Input;
use App\Models\Designation;

use Illuminate\Http\Request;

class companySettingsController extends Controller
{

    public function profiledata(){
        $profile = CompanyProfile::latest()->first();
        $address = CompanyAddress::latest()->first();
        $department = Department::all();
        $designat = Designation::all();
        $plans = Plan::latest()->first();
    
        return view('admin/settings', compact('profile','address','department','designat','plans'));
        // return view('admin/settings');
    }

    public function getprofile(request $request){
       if(isset($_POST['profile'])){
        if($request->file('logo')){
          $file= $request->file('logo');
          $filename=$file->getClientOriginalName();
          $file->move(public_path().'/Image/',$filename); 
          $add['logo']= $filename;
          }
          else{
            $image=DB::table('company_profile')->where('com_name',$request->com_name)->first();
            $filename=$image->logo;
            // print_r($image);die();
           }
        $profile=DB::table('company_profile')->where('com_name',$request->com_name)
        ->update([

        'com_name'=> $request->input('com_name'),
        'brand_name'=> $request->input('brand_name'),
        'website'=> $request->input('website'),
        'domain_name'=> $request->input('domain_name'),
        'industry'=> $request->input('industry'),
        'phone'=> $request->input('phone'),
        'logo'=>$filename,
        'description'=> $request->input('description'),

      ]);
      
        return redirect()->back()->with('message',"Profile Data Successfully Added");

      }


      if(isset($_POST['address'])){
        $address=DB::table('company_addresses')->where('reg_office',$request->reg_office)
        ->update([
        'reg_office'=> $request->input('reg_office'),
        'cor_office'=> $request->input('cor_office'),
         ]);
       
        return redirect()->back()->with('success',"Address Successfully Added");
      }

      if(isset($_POST['dept'])){
        $department=new Department();
        $department->department=$request->input('department');
        $department->sub_department=$request->input('sub_department');
        $department->save();
        return redirect()->back()->with('succ',"Data Successfully Added");
      
      }


      if(isset($_POST['designation'])){
        $desi=new Designation();
        $desi->designation_name=$request->input('designation_name');
        $desi->save();
        return redirect()->back()->with('msg',"Data Successfully Added");
      }

      
      if(isset($_POST['plan'])){
        $planss=new Plan();
        $planss->plan_name=$request->input('plan_name');
        $planss->authority=$request->input('authority');
        $planss->plan_type=$request->input('plan_type');
        $planss->save();
        return redirect()->back()->with('msg',"Data Successfully Added");
      }
        // return('admin/settings');

        if(isset($_POST['department_edit'])){
        // $department=new Department();
        $depart= DB::table('departments')->where('id',$request->id)
        ->update([
          'department'=>$request->input('department'),
          'sub_department'=>$request->input('sub_department')
          ]);
        return redirect()->back()->with('succ',"Data Successfully Added");
        }

        if(isset($_POST['desig_edit'])){
        // $desi=new Designation();
        $desi=DB::table('designations')->where('id',$request->id)
        ->update([
          'designation_name'=>$request->input('designation_name')
          ]);
          // echo($desi); die();
          return redirect()->back()->with('succ',"Data Successfully Added");
        }
        
    }
}
