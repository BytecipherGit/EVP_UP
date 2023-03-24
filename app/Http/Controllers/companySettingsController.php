<?php

namespace App\Http\Controllers;
use App\Models\CompanyProfile;
use App\Models\CompanyAddress;
use App\Models\Department;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Session;
// use Illuminate\Support\Facades\Input;
use App\Models\Designation;

use Illuminate\Http\Request;

class companySettingsController extends Controller
{

    public function profiledata(){
        $profile = User::where('id',Auth::id())->first();
        $department = Department::all();
        $designat = Designation::all();
        $plans = Plan::latest()->first();
    
        return view('admin/settings', compact('profile','department','designat','plans'));
    
    }

    public function updateCompanyProfile(request $request){
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
      
        return redirect()->back()->with('message',"Profile Data Successfully Added");

      }


      if(isset($_POST['add_address'])){
        $address=DB::table('users')->where('id',Auth::id())
        ->update([
        'address'=> $request->input('address'),
        'cor_office_address'=> $request->input('cor_office_address'),
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
