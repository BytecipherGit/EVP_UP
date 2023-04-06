<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Employeeidentity;
use App\Models\Empqualification;
use App\Models\Empworkhistory;
use App\Models\Empskills;
use App\Models\Empofficial;
use App\Models\Exitemp;
use App\Models\User;
use App\Models\Emplang;
use Response;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function index(request $request){
  
        $basic=Employee:: where('id',$request->id)->first();
        $identity=Employeeidentity:: where('employee_id',$request->id)->get();
        $ident=Employeeidentity:: where('employee_id',$request->id)->first();
        $qual_item=Empqualification:: where('employee_id',$request->id)->get();
        $quali=Empqualification:: where('employee_id',$request->id)->first();
        $workhistory=Empworkhistory:: where('employee_id',$request->id)->get();
        $workh=Empworkhistory:: where('employee_id',$request->id)->first();
        $skills=Empskills:: where('employee_id',$request->id)->first();
        $skill_item=Empskills:: where('employee_id',$request->id)->get();
        $lang_item=Emplang:: where('employee_id',$request->id)->get();
        $official= Empofficial::where('employee_id',$request->id)->first();
    
        return view('admin/add-employee',compact('basic','identity','qual_item','ident','workhistory','quali','workh','skills','official','lang_item','skill_item'));
    }

        public function editQualification(){
          return view('admin/edit_qualification');
    }

    public function editWorkhistory(){
      return view('admin/edit_workhistory');
    }

    public function editSkills(){
      return view('admin/edit_skills');
    }

    public function editOfficial(){
      return view('admin/edit_official');
    }

    public function basicInfo(request $request){
    
        if(isset($_POST['basic'])){

       $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'unique:employee,email', 'email'],
        'blood_group' => ['required'],
        'gender' => ['required'],
        'dob' => ['required'],
        'phone' => ['required','max:12'],
        'emg_phone' => ['required','max:12'],
        'permanent_address' => ['required','string', 'max:255'],
        'current_address' => ['required','string', 'max:255'],
        'marital_status' => ['required'],
        'emg_name' => ['required','string', 'max:255'],
        'emg_relationship' => ['required','string', 'max:255'],
        'emg_address' => ['required','string', 'max:255'],

        ]);
        $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));

        $employe = new Employee();
        $employe->first_name=$request->input('first_name');
        $employe->profile=$request->input('profile');
        $employe->empCode = $empCode;
        $employe->last_name=$request->input('last_name');
        $employe->middle_name=$request->input('middle_name');
        $employe->email=$request->input('email');
        $employe->phone=$request->input('phone');
        $employe->dob=$request->input('dob');
        $employe->blood_group=$request->input('blood_group');
        $employe->gender=$request->input('gender');
        $employe->marital_status=$request->input('marital_status');
        $employe->current_address=$request->input('current_address');
        $employe->permanent_address=$request->input('permanent_address');
        $employe->emg_name=$request->input('emg_name');
        $employe->emg_relationship=$request->input('emg_relationship');
        $employe->emg_phone=$request->input('emg_phone');
        $employe->emg_address=$request->input('emg_address');


         if($request->has('profile')) {
          $image = $request->file('profile');
          $employe->profile = $image->getClientOriginalName();
          $image->move(public_path('/Image'), $image->getClientOriginalName());
         }
     
         $employe->save();
    
          $basicinfo = Employeeidentity::where('employee_id',$request->id)->first();
          if (empty($basicinfo)) {
      
            $basic=Employee::where('email',$request->email)->first();
            $id=$basic->id;
            $table = $basic->getTable();
            return redirect('add-employee/'.$id)->with('tabs-3_active', true);

           }

           else{
            return redirect()->back()->with('tabs-3_active', true);
      
           }
         }
          
           //For Update Basic Information
          if(isset($_POST['basic-edit'])){

            if($request->file('profile')){
            $file= $request->file('profile');
            $filename=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename); 
            $basic_info['profile']= $filename;
          }
         else{
          $image=DB::table('employee')->where('id',$request->id)->first();
          $filename=$image->profile;
          // print_r($image->profile);die();
         }
          $basic_info=DB::table('employee')->where('id',$request->id)
          ->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'middle_name'=>$request->input('middle_name'),
                'email'=>$request->input('email'),
                'profile'=>$filename,
                'phone'=>$request->input('phone'),
                'dob'=>$request->input('dob'),
                'blood_group'=>$request->input('blood_group'),
                'gender'=>$request->input('gender'),
                'marital_status'=>$request->input('marital_status'),
                'current_address'=>$request->input('current_address'),
                'permanent_address'=>$request->input('permanent_address'),
                'emg_name'=>$request->input('emg_name'),
                'emg_relationship'=>$request->input('emg_relationship'),
                'emg_phone'=>$request->input('emg_phone'),
                'emg_address'=>$request->input('emg_address'),
               ]);

               return redirect()->back()->with('tabs-3_active', true)->with('message','Infomation updated successfully.');
            
          }

            if(isset($_POST['identity'])){

              $request->validate([
                'id_type' => ['required', 'string', 'max:255'],
                'id_number' => ['required', 'string', 'max:255'],
                'verification_type' => ['required', 'string', 'max:255'],
                'document' => ['required','file','mimes:jpeg,pdf,docs,doc','max:2048']
                ]);

              $basic_id=Employee::where('id',$request->id)->first();
              // print_r($basic_id);die();
              $employee_ident = new Employeeidentity();
              $employee_ident->employee_id=$basic_id->id;
              $employee_ident->id_type=$request->input('id_type');
              $employee_ident->id_number=$request->input('id_number');
              $employee_ident->document=$request->input('document');
              $employee_ident->verification_type=$request->input('verification_type');
            

              if($request->has('document')) {
                $image = $request->file('document');
                $employee_ident->document = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
                }
      
              $employee_ident->save();
              $identityinfo = Empqualification::where('employee_id',$request->id)->first();
              if (empty($identityinfo)) {
          
                $basic=Employeeidentity::where('employee_id',$request->id)->first();
                $id=$basic->employee_id;
            
                return redirect('add-employee/'.$id)->with('tabs-2_active', true);
          
                 }
               else{
                return redirect()->back()->with('tabs-2_active', true);
               }
           
               return redirect()->back()->with('tabs-2_active', true);
             
            }

          
              if(isset($_POST['qulification'])){

              $request->validate([
                'inst_name' => ['required', 'string', 'max:255'],
                'degree' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:255'],
                'duration_from' => ['required'],
                'duration_to' => ['required'],
                'verification_type' => ['required','string', 'max:255'],
                // 'document' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']
              
                ]);
                
                $identity_id=Employee::where('id',$request->id)->first();
                $employee_qualf = new Empqualification();
                $employee_qualf->employee_id=$identity_id->id;
                $employee_qualf->inst_name=$request->input('inst_name');
                $employee_qualf->degree=$request->input('degree');
                $employee_qualf->subject=$request->input('subject');
                $employee_qualf->duration_from=$request->input('duration_from');
                $employee_qualf->duration_to=$request->input('duration_to');
                $employee_qualf->document=$request->input('document');
                $employee_qualf->verification_type=$request->input('verification_type');
              
                if($request->has('document')) {
                  $image = $request->file('document');
                  $employee_qualf->document = $image->getClientOriginalName();
                  $image->move(public_path('/Image'), $image->getClientOriginalName());
                 }
        
                $employee_qualf->save();
             
                $qualifinfo = Empworkhistory::where('employee_id',$request->id)->first();
                if (empty($qualifinfo)) {
            
                  $qual=Empqualification::where('employee_id',$request->id)->first();
                  $id=$qual->employee_id;
                  return redirect('add-employee/'.$id)->with('tabs-3_active', true);
                 }
                 else{
                  return redirect()->back()->with('tabs-3_active', true);
                 }

                 return redirect()->back()->with('tabs-3_active', true);
              }


              if(isset($_POST['workhistory'])){

              $request->validate([
                'com_name' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'work_duration_to' => ['required'],
                'work_duration_from' => ['required'],
                'verification_type' => ['required','string', 'max:255'],
                // 'offer_letter' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048'],
                // 'exp_letter' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048'],
                // 'salary_slip' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']

                ]);

                $identity_id=Employee::where('id',$request->id)->first();
                $employee_work = new Empworkhistory();
                $employee_work->employee_id=$identity_id->id;
                $employee_work->com_name=$request->input('com_name');
                $employee_work->designation=$request->input('designation');
                $employee_work->offer_letter=$request->input('offer_letter');
                $employee_work->work_duration_from=$request->input('work_duration_from');
                $employee_work->work_duration_to=$request->input('work_duration_to');
                $employee_work->exp_letter=$request->input('exp_letter');
                $employee_work->salary_slip=$request->input('salary_slip');
                $employee_work->verification_type=$request->input('verification_type');
              

                if($request->has('offer_letter')) {
                  $image = $request->file('offer_letter');
                  $employee_work->offer_letter = $image->getClientOriginalName();
                  $image->move(public_path('/Image'), $image->getClientOriginalName());
                }
                if($request->has('exp_letter')) {
                  $image = $request->file('exp_letter');
                  $employee_work->exp_letter = $image->getClientOriginalName();
                  $image->move(public_path('/Image'), $image->getClientOriginalName());
                }
                if($request->has('salary_slip')) {
                $image = $request->file('salary_slip');
                $employee_work->salary_slip = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
                }
        
        
                $employee_work->save();
                $workinfo = Empskills::where('employee_id',$request->id)->first();
                if (empty($workinfo)) {
            
                  $work=Empworkhistory::where('employee_id',$request->id)->first();
                  $id=$work->employee_id;
                  // $table=$basic->getTable();
                  // return view('admin/add-employee/'.$id ,compact('basic'));
                  return redirect('add-employee/'.$id)->with('tabs-4_active', true);
            
                 }
                 else{
                  // return redirect()->back();
                  return redirect()->back()->with('tabs-4_active', true);
                 }
                 return redirect()->back();
                 
              }

              if(isset($_POST['workskill'])){
                // dd($request->all());

        
                $identity_id=Employee::where('id',$request->id)->first();
                for ($i=0; $i < count($request->skill); $i++) 
                {   
                  $insertDataSkill = array(  
                    'employee_id' => $identity_id->id,
                    'skill' => $request->skill[$i],
                    'skill_type' => $request->skill_type[$i],
                    ); 
                    DB::table('employee_skills')->insert($insertDataSkill);  
                  }
              for ($j=0; $j < count($request->lang); $j++) 
              {   
                $insertDatalang = array(  
                  'employee_id' => $identity_id->id,
                  'lang' =>  $request->lang[$j],
                  'lang_type' => $request->lang_type[$j],
                  ); 
                  
                
                  DB::table('employee_language')->insert($insertDatalang);  
            }
          
                $official = Empofficial::where('employee_id',$request->id)->first();
                if (empty($official)) {
            
                  $skill=Empskills::where('employee_id',$request->id)->first();
                  $id=$skill->employee_id;
                  // $table=$basic->getTable();
                  // return view('admin/add-employee/'.$id ,compact('basic'));
                  return redirect('add-employee/'.$id)->with('tabs-5_active', true);
            
                   }
                 else{
                  return redirect()->back()->with('tabs-5_active', true);
                 }

                 return redirect()->back();
              }

              if(isset($_POST['more-skill'])){
                $userid=Employee::where('id',$request->id)->first();

                $skill = new Empskills();
                $skill->employee_id=$userid->id;
                $skill->skill = $request->input('skill'); ;
                $skill->skill_type=$request->input('skill_type');
                $skill->save();
                return redirect()->back()->with('tabs-5_active', true);
              }


              if(isset($_POST['more-lang'])){
                $userid=Employee::where('id',$request->id)->first();
                
                $lang = new Emplang();
                $lang->employee_id=$userid->id;
                $lang->lang = $request->input('lang'); ;
                $lang->lang_type=$request->input('lang_type');
                $lang->save();
                return redirect()->back()->with('tabs-5_active', true);
              }

              if(isset($_POST['official'])){

                $request->validate([
                  'doj' => ['required', 'string', 'max:255'],
                  'prob_period' => ['required', 'string', 'max:255'],
                  'emp_type' => ['required', 'string', 'max:255'],
                  'work_location' => ['required', 'string', 'max:255'],
                  'emp_status' => ['required', 'string', 'max:255'],
                  'salary' => ['required', 'string', 'max:255'],
                  'lpa' => ['required', 'string', 'max:255'],
                  'app_from' => ['required', 'string', 'max:255'],
                  'app_to' => ['required', 'string', 'max:255'],
                  'pro_to' => ['required', 'string', 'max:255'],
                  'last_app_desig' => ['required', 'string', 'max:255'],
                  'current_app_desig' => ['required', 'string', 'max:255'],
                  'app_date' => ['required','date'],
                  'pro_from' => ['required', 'string', 'max:255'],
                  'last_pro_desig' => ['required', 'string', 'max:255'],
                  'current_pro_desig' => ['required', 'string', 'max:255'],
                  'pro_date' => ['required','date'],
                  'mang_name' => ['required', 'string', 'max:255'],
                  'mang_type' => ['required', 'string', 'max:255'],
                  'mang_dept' => ['required', 'string', 'max:255'],
                  'mang_desig' => ['required', 'string', 'max:255']
                 
                  ]);

                $identity_id=Employee::where('id',$request->id)->first();
                $employee_off = new Empofficial();
                $employee_off->employee_id=$identity_id->id;
                $employee_off->doj=$request->input('doj');
                $employee_off->prob_period=$request->input('prob_period');
                $employee_off->emp_type=$request->input('emp_type');
                $employee_off->work_location=$request->input('work_location');
                $employee_off->emp_status=$request->input('emp_status');
                $employee_off->salary=$request->input('salary');
                $employee_off->lpa=$request->input('lpa');
                $employee_off->app_from=$request->input('app_from');
                $employee_off->app_to=$request->input('app_to');
                $employee_off->last_app_desig=$request->input('last_app_desig');
                $employee_off->current_app_desig=$request->input('current_app_desig');
                $employee_off->app_date=$request->input('app_date');
                $employee_off->pro_from=$request->input('pro_from');
                $employee_off->pro_to=$request->input('pro_to');
                $employee_off->last_pro_desig=$request->input('last_pro_desig');
                $employee_off->current_pro_desig=$request->input('current_pro_desig');
                $employee_off->pro_date=$request->input('pro_date');
                $employee_off->mang_name=$request->input('mang_name');
                $employee_off->mang_type=$request->input('mang_type');
                $employee_off->mang_dept=$request->input('mang_dept');
                $employee_off->mang_desig=$request->input('mang_desig');
            
          
                $employee_off->save();

                return redirect('employee');
             }
        
         }


      public function editEmployee(request $request,$id){
        // $basicinfo=Employee::where('id',$request->id)->first();
        if(isset($_POST['basic-edit'])){

            if($request->file('profile')){
            $file= $request->file('profile');
            $filename=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename); 
            $basic_info['profile']= $filename;
          }
         else{
          $image=DB::table('employee')->where('id',$request->id)->first();
          $filename=$image->profile;
          // print_r($image->profile);die();
         }
         $basic_info=DB::table('employee')->where('id',$request->id)
         ->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'middle_name'=>$request->input('middle_name'),
                'email'=>$request->input('email'),
                'profile'=>$filename,
                'phone'=>$request->input('phone'),
                'dob'=>$request->input('dob'),
                'blood_group'=>$request->input('blood_group'),
                'gender'=>$request->input('gender'),
                'marital_status'=>$request->input('marital_status'),
                'current_address'=>$request->input('current_address'),
                'permanent_address'=>$request->input('permanent_address'),
                'emg_name'=>$request->input('emg_name'),
                'emg_relationship'=>$request->input('emg_relationship'),
                'emg_phone'=>$request->input('emg_phone'),
                'emg_address'=>$request->input('emg_address'),
        ]);

        return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['identity-edit'])){
          if($request->file('document')){
            $file= $request->file('document');
            $filename=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename); 
            $identity_info['document']= $filename;
        }
        else{
          $image2=DB::table('employee_identity')->where('id',$request->id)->first();
          $filename=$image2->document;
        
        }
  
          $identity_info=DB::table('employee_identity')->where('id',$request->id)
          ->update([
                  'id_type'=>$request->input('id_type'),
                  'id_number'=>$request->input('id_number'),
                  'document'=>$filename,
                  'verification_type'=>$request->input('verification_type'),
          
            ]);
          return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['qualification-edit'])){
          if($request->file('document')){
            $file= $request->file('document');
            $filename=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename); 
            $qua_inf['document']= $filename;
        }
        else{
          $image=DB::table('employee_qualifications')->where('id',$request->id)->get();
          foreach($image as $img){
          $filename=$img->document;
          }
        }
          $qua_inf=DB::table('employee_qualifications')->where('id',$request->id)
          ->update([
                  'inst_name'=>$request->input('inst_name'),
                  'degree'=>$request->input('degree'),
                  'subject'=>$request->input('subject'),
                  'duration_from'=>$request->input('duration_from'),
                  'duration_to'=>$request->input('duration_to'),
                  'document'=>$filename,
                  'verification_type'=>$request->input('verification_type'),
          
            ]);
          return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['workhistory-edit'])){
          if($request->file('offer_letter')){
            $file= $request->file('offer_letter');
            $filename1=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename1); 
            $work_inf['offer_letter']= $filename1;
          }
          else{
            $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
            $filename1=$image->offer_letter;
       
          }

          if($request->file('exp_letter')){
            $file= $request->file('exp_letter');
            $filename2=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename2); 
            $work_inf['exp_letter']= $filename2;
              }
              else{
                $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
                $filename2=$image->exp_letter;
              }

            if($request->file('salary_slip')){
              $file= $request->file('salary_slip');
              $filename3=$file->getClientOriginalName();
              $file->move(public_path().'/Image/',$filename3); 
              $work_inf['salary_slip']= $filename3;
          }
          else{
            $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
            $filename3=$image->salary_slip;
          
          }
          $work_inf=DB::table('employee_workhistories')->where('id',$request->id)
              ->update([
                  'com_name'=>$request->input('com_name'),
                  'designation'=>$request->input('designation'),
                  'offer_letter'=>$filename1,
                  'work_duration_from'=>$request->input('work_duration_from'),
                  'work_duration_to'=>$request->input('work_duration_to'),
                  'exp_letter'=>$filename2,
                  'salary_slip'=>$filename3,
                  'verification_type'=>$request->input('verification_type'),
          
            ]);
          return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['official-edit'])){
          $identity_inf=DB::table('employee_officials')->where('employee_id',$id)
          ->update([
                  'doj'=>$request->input('doj'),
                  'prob_period'=>$request->input('prob_period'),
                  'emp_type'=>$request->input('emp_type'),
                  'work_location'=>$request->input('work_location'),
                  'emp_status'=>$request->input('emp_status'),
                  'salary'=>$request->input('salary'),
                  'lpa'=>$request->input('lpa'),
                  'app_from'=>$request->input('app_from'),
                  'app_to'=>$request->input('app_to'),
                  'last_app_desig'=>$request->input('last_app_desig'),
                  'current_app_desig'=>$request->input('current_app_desig'),
                  'app_date'=>$request->input('app_date'),
                  'pro_from'=>$request->input('pro_from'),
                  'pro_to'=>$request->input('pro_to'),
                  'last_pro_desig'=>$request->input('last_pro_desig'),
                  'current_pro_desig'=>$request->input('current_pro_desig'),
                  'pro_date'=>$request->input('pro_date'),
                  'mang_name'=>$request->input('mang_name'),
                  'mang_type'=>$request->input('mang_type'),
                  'mang_dept'=>$request->input('mang_dept'),
                  'mang_desig'=>$request->input('mang_desig'),
          
            ]);


          return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['skill-edit'])){
          
       
          // dd($skill->id);
          $identity_inf=DB::table('employee_skills')->where('id', $request->id)
          ->update([
            
                  'skill'=>$request->input('skill'),
                  'skill_type'=>$request->input('skill_type'),
          
            ]);
          
        
          return redirect()->back()->with('message','Infomation updated successfully.');
          }

        if(isset($_POST['skilllang-edit'])){
          $identity_inf=DB::table('employee_language')->where('id', $request->id)
          ->update([
                  'lang'=>$request->input('lang'),
                  'lang_type'=>$request->input('lang_type'),
          
            ]);
          return redirect()->back()->with('message','Infomation updated successfully.');
        }

      }
     
     
      public function getEditEmployee(request $request,$id){
        $basic=Employee::where('id',$id)->first();
        $identity=Employeeidentity::where('employee_id',$request->id)->first();
        $qualification=Empqualification::where('employee_id',$request->id)->first();
        $qual_item=Empqualification::where('employee_id',$request->id)->get();
        $workhistory=Empworkhistory::where('employee_id',$request->id)->first();
        $skills=Empskills::where('employee_id',$request->id)->first();
        $skill_item=Empskills:: where('employee_id',$request->id)->get();
        $lang_item=Emplang:: where('employee_id',$request->id)->get();
        $ident_item=Employeeidentity::where('employee_id',$request->id)->get();
        $work_item=Empworkhistory::where('employee_id',$request->id)->get();
        $official= Empofficial::where('employee_id',$request->id)->first();

        return view('admin/edit-employee',compact('basic','identity','qualification','workhistory','skills','official','skill_item','lang_item','qual_item','ident_item','work_item'));
      }

      public function basicIndex2(request $request, $id){
        $segment = $request->segment(2);
        $basicinfo=Employee::where('id',$segment)->first();
        return view('admin/edit_employee',compact('basicinfo'));
      }

      public function getAllEmp(){
      
         $allemp=DB::table('employee')->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')
                          ->select('employee.*', 'employee_officials.*')->get();

         return view('admin/datatable',compact('allemp'));
      }


      public function downloadCsv(){
        $file= public_path(). "/employee-sample.csv";
        $headers = array(
                  'Content-Type: application/csv',
                );
    
        return Response::download($file, 'sample.csv', $headers);
      }

      public function getCsvEmp(Request $request){
      
         //get file check has
        //  $request->validate([
        //     'upload-file' => ['required'],
          
        // ]);

         if ($request->has('upload-file')) {
          $upload=$request->file('upload-file');
          $filePath=$upload->getRealPath();
          //open and read
          $file=fopen($filePath, 'r');
  
          $header= fgetcsv($file);
  
          // dd($header);
          $escapedHeader=[];
          //validate
          foreach ($header as $key => $value) {
              $lheader=strtolower($value);
              $escapedItem=preg_replace('/[^a-z]_[ ]/', '', $lheader);
              array_push($escapedHeader, $escapedItem);
          }
          // dd($escapedHeader);
          //looping through othe columns
          while($columns=fgetcsv($file))
          {
              if($columns[0]=="")
              {
                  continue;
              }
              // dd($columns);
              //trim data
              foreach ($columns as $key => $value) {
                  $value=preg_replace('/\D/','',$value);
                 
              }
            
            $data= array_combine($escapedHeader, $columns);
            //  dd($data);
             // setting type
             foreach ($data as $key => $value) {
              // $value=($key=="role" || $key=="pin")?(string)$value: (integer)$value;
                $value=($key=="first_name")?(string)$value: (integer)$value;
             }
            //  dd($data);
            //  $email=$data['email'];
            $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));
             // Table update
             $id = DB::table('employee')->insertGetId(
              [
                'first_name' => $data['first_name'], 
                'last_name' => $data['last_name'],
                'empCode' => $empCode,
                'first_name' => $data['first_name'], 
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'], 
                'email' => $data['email'],
                'phone' => $data['phone'], 
                'dob' => $data['dob'],
                'blood_group' => $data['blood_group'], 
                'marital_status' => $data['marital_status'], 
                'gender' => $data['gender'],
                'current_address' => $data['current_address'],
                'permanent_address' => $data['permanent_address'], 
                'emg_name' => $data['emg_name'],
                'emg_relationship' => $data['emg_relationship'], 
                'emg_phone' => $data['emg_phone'],
                'emg_address' => $data['emg_address']
                // 'status' => $data['status']
                ]
                
           );
         
             $identity= new Employeeidentity;
             $identity->id_type=$data['id_type'];
             $identity->employee_id=$id;
             $identity->id_number=$data['id_number'];
             $identity->verification_type='Not Verified';
             $identity->save();

             $qualification= new Empqualification;
             $qualification->employee_id=$id;

             $qualification->inst_name=$data['inst_name'];
             $qualification->degree=$data['degree'];
             $qualification->subject=$data['subject'];
             $qualification->duration_from=$data['duration_from'];
             $qualification->duration_to=$data['duration_to'];
             $qualification->verification_type='Not Verified';
             $qualification->save();


             $skills= new Empskills;
             $skills->employee_id=$id;
             $skills->skill=$data['skill'];
             $skills->skill_type=$data['skill_type'];
             $skills->save();

             $skills= new Emplang;
             $skills->employee_id=$id;
             $skills->lang=$data['lang'];
             $skills->lang_type=$data['lang_type'];
             $skills->save();



                $employee_work = new Empworkhistory;
                $employee_work->employee_id=$id;
                $employee_work->com_name=$data['com_name'];
                $employee_work->designation=$data['designation'];
                $employee_work->work_duration_from=$data['work_duration_from'];
                $employee_work->work_duration_to=$data['work_duration_to'];
                $employee_work->verification_type='Not Verified';

                $employee_work->save();

                $employee_off = new Empofficial;
                $employee_off->employee_id=$id;
                $employee_off->doj=$data['doj'];
                $employee_off->prob_period=$data['prob_period'];
                $employee_off->emp_type=$data['emp_type'];
                $employee_off->work_location=$data['work_location'];
                $employee_off->emp_status=$data['emp_status'];
                $employee_off->salary=$data['salary'];
                $employee_off->lpa=$data['lpa'];
                $employee_off->app_from=$data['app_from'];
                $employee_off->app_to=$data['app_to'];
                $employee_off->last_app_desig=$data['last_app_desig'];
                $employee_off->current_app_desig=$data['current_app_desig'];
                $employee_off->app_date=$data['app_date'];
                $employee_off->pro_from=$data['pro_from'];
                $employee_off->pro_to=$data['pro_to'];
                $employee_off->last_pro_desig=$data['last_pro_desig'];
                $employee_off->current_pro_desig=$data['current_pro_desig'];
                $employee_off->pro_date=$data['pro_date'];
                $employee_off->mang_name=$data['mang_name'];
                $employee_off->mang_type=$data['mang_type'];
                $employee_off->mang_dept=$data['mang_dept'];
                $employee_off->mang_desig=$data['mang_desig'];

                $employee_off->save();

            
          }
       
          // print_r($information);die();
          return redirect()->back()->with('message','Upload successfully');
      }
      else{
          return redirect()->back()->with('message','Not selected any file to upload');

      }
      }

      public function exitEmp($id){
         $exitemp=DB::table('employee')->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')->select('employee.id','employee.*', 'employee_officials.*')
         ->where('employee.id',$id)->first();
         return view('admin/employee-exit',compact('exitemp'));
      }

      public function exitEmployee(request $request,$id){
        $employee_id=Employee::where('id',$id)->first();
        $exitemp = new Exitemp();
        $exitemp->employee_id=$employee_id->id;
        $exitemp->do_exit=$request->input('do_exit');
        $exitemp->decipline=$request->input('decipline');
        $exitemp->reason=$request->input('reason');
        $exitemp->rating=$request->input('rating');
        $exitemp->document=$request->input('document');
      
        if($request->file('document')){
            $file= $request->file('document');
            $filename=$file;
            $file->move(public_path().'/Image/',$filename); 
            $exitemp['document']= $filename;
        }

        $exitemp->save();

       Employee::where('id',$exitemp->employee_id)->update([
          'status'  => '0'
        ]);

        return redirect('employee')->with('message','Employee exit successfully');
     }

     public function pastEmp(){
      $pastemp=DB::table('exit_employee')->join('employee', 'exit_employee.employee_id', '=', 'employee.id')
      ->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')->select('employee.id','employee.*', 'exit_employee.*','employee_officials.*')->get();
      return view('admin/post-employee',compact('pastemp'));
      }

      public function postEmpDetails(request $request){
      
          // return redirect('edit-employee/40/identity');
          $basic=Employee:: where('id',$request->id)->first();
          $identity=Employeeidentity:: where('employee_id',$request->id)->get();
          $qualification=Empqualification:: where('employee_id',$request->id)->get();
          $workhistory=Empworkhistory:: where('employee_id',$request->id)->first();
          $workdetails=Empworkhistory:: where('employee_id',$request->id)->get();
          $skills=Empskills:: where('employee_id',$request->id)->first();
          $skill_item=Empskills:: where('employee_id',$request->id)->get();
          $lang_item=Emplang:: where('employee_id',$request->id)->get();
          $official= Empofficial::where('employee_id',$request->id)->first();
          $exitemp= Exitemp::where('employee_id',$request->id)->first();
          return view('admin/post-employee-details',compact('basic','identity','qualification','workhistory','skills','official','exitemp','skill_item','lang_item','workdetails'));
      }

      public function currentEmp(){
  
        $current=DB::table('employee')->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')->select('employee.id','employee.*', 'employee_officials.*')
        ->where('employee.status',1)->get();
        // print_r($current);die();
        return view('admin/current-employee',compact('current'));
      }

        public function exportsCSV(Request $request)
        {
          $fileName = 'employee.csv';
          // $employee = Employee::all();
          $employee = Employee::join('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->join('employee_officials', 'employee_officials.employee_id', '=', 'employee_identity.employee_id')
                    ->join('employee_skills', 'employee_skills.employee_id', '=', 'employee_officials.employee_id')
                    ->join('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee_skills.employee_id')
                    ->join('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee_workhistories.employee_id')
                    ->get(['employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*']);
    
                  
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        $columns = array('First Name','Last Name','Middle Name','Email','Phone','Date of Birth','Blood Group','Gender','Marital Status','Current Address','Permanent Address','Emg Name','Emg Relationship','Emg Phone','Emg Address','Id Type','Id Number','Date of Joining','Promotion Period','Employee Type','Work Location','Employee Status','Salary','Lakhs Per Year','Appraisal From','Appraisal To','Last Appraisal Designation','Current Appraisal Designation','Appraisal Date','Promotion From','Promotion To','Last Promotion Designation','Current Promotion Designation','Promotion Date','Manager Name','Manager Type','Manager Department','Manager Designation','Skill','Skill Type','Language Known','Language Type','Company Name','Designation','Work Duration From','Work Duration To','Institute Name','Degree','Subject','Duration From','Duration To');
        $callback = function() use($employee, $columns) {
            $file = fopen('php://output', 'w');
            // 
            fputcsv($file, $columns);
            // print_r($columns);die();
            foreach ($employee as $task) {
                $row['First Name']  = $task->first_name;
                $row['Last Name']    = $task->last_name;
                $row['Middle Name']    = $task->middle_name;
                $row['Email']  = $task->email;
                $row['Phone']  = $task->phone;
                $row['Date of Birth']  = $task->dob;
                $row['Blood Group']  = $task->blood_group;
                $row['Gender']  = $task->gender;
                $row['Marital Status']  = $task->marital_status;
                $row['Current Address']  = $task->current_status;
                $row['Permanent Address']  = $task->permanent_address;
                $row['Emg Name']  = $task->emg_name;
                $row['Emg Relationship']  = $task->emg_relationship;
                $row['Emg Phone']  = $task->emg_phone;
                $row['Emg Address']  = $task->emg_address;
                
                $row['Id Type']  = $task->id_type;
                $row['Id Number']    = $task->id_number;
                $row['Date of Joining']    = $task->doj;
                $row['Promotion Period']  = $task->prob_period;
                $row['Employee Type']  = $task->emp_type;
                $row['Work Location']  = $task->work_location;
                $row['Employee Status']  = $task->emp_status;
                $row['Salary']  = $task->salary;
                $row['Lakhs Per Year']  = $task->lpa;
                $row['Appraisal From']  = $task->app_from;
                $row['Appraisal To']  = $task->app_to;
                $row['Last Appraisal Designation']  = $task->last_app_desig;
                $row['Current Appraisal Designation']  = $task->current_app_desig;
                $row['Appraisal Date']  = $task->app_date;
                $row['Promotion From']  = $task->prob_from;

                $row['Promotion To']  = $task->prob_to;
                $row['Last Promotion Designation']    = $task->last_prob_desig;
                $row['Current Promotion Designation']    = $task->current_prob_desig;
                $row['Promotion Date']  = $task->prob_date;
                $row['Manager Name']  = $task->mang_name;
                $row['Manager Type']  = $task->mang_type;
                $row['Manager Department']  = $task->mang_dept;
                $row['Manager Designation']  = $task->mang_desig;
                $row['Skill']  = $task->skill;
                $row['Skill Type']  = $task->skill_type;
                $row['Language Known']  = $task->lang;

                $row['Language Type']  = $task->lang_type;
                $row['Company Name']  = $task->com_name;
                $row['Designation']  = $task->designation;
                $row['Work Duration From']  = $task->work_duration_from;
                $row['Work Duration To']  = $task->work_duration_to;
                $row['Institute Name']  = $task->inst_name;
                $row['Degree']  = $task->degree;
                $row['Subject']  = $task->subject;
                $row['Duration From']  = $task->duration_from;
                $row['Duration To']  = $task->duration_to;
            
           
                fputcsv($file, array($row['First Name'], $row['Last Name'], $row['Middle Name'], $row['Email'], $row['Phone'],$row['Date of Birth'], $row['Blood Group'], $row['Gender'],$row['Marital Status'], $row['Current Address'], $row['Permanent Address'],
                $row['Emg Name'],$row['Emg Relationship'], $row['Emg Phone'], $row['Emg Address'],$row['Id Type'], $row['Id Number'],
                $row['Date of Joining'], $row['Promotion Period'], $row['Employee Type'],$row['Work Location'], $row['Employee Status'], $row['Salary'],$row['Lakhs Per Year'], $row['Appraisal From'], $row['Appraisal To'],
                $row['Last Appraisal Designation'],$row['Current Appraisal Designation'], $row['Appraisal Date'], $row['Promotion From'],
                $row['Promotion To'], $row['Last Promotion Designation'], $row['Current Promotion Designation'], $row['Promotion Date'], $row['Manager Name'],$row['Manager Type'],$row['Manager Department'], $row['Manager Designation'],$row['Skill'], $row['Skill Type'], $row['Language Known'],$row['Language Type'],$row['Company Name'], $row['Designation'], $row['Work Duration From'],$row['Work Duration To'],
                $row['Institute Name'],$row['Degree'], $row['Subject'], $row['Duration From'],$row['Duration To']));
            //  print_r($file);
              }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

   


}
    

    

