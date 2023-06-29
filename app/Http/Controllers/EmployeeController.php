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
use App\Models\CompanyEmployee;
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

        $uploadProfile = '';
        $uploadDocumentId = '';
        $uploadThirdPartyDocument = '';
        $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));

       if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/employee_document', $fileName);
        $uploadProfile = asset('storage/employee_document/' . $fileName);
         }

       if ($request->hasFile('document_id')) {
        $file = $request->file('document_id');
        $fileName = time() . '_' . $empCode .'_'. $file->getClientOriginalName();
        $file->storeAs('public/employee/employee_document', $fileName);
        $uploadDocumentId = asset('storage/employee/employee_document/' . $fileName);
         }

         if ($request->hasFile('third_party_document')) {
          $file = $request->file('third_party_document');
          $fileName = time() . '_' . $empCode .'_'. $file->getClientOriginalName();
          $file->storeAs('public/employee/third_party_documents', $fileName);
          $uploadThirdPartyDocument = asset('storage/employee/third_party_documents/' . $fileName);
           }

         $statusVerification = '';
         if (!empty($request->verification_type) && $request->verification_type == true) {
             $statusVerification = 1;
         } else {
             $statusVerification = 0;
         }

         $statusThirdPartyVerification = '';
         if (!empty($request->third_party_verification) && $request->third_party_verification == true) {
             $statusThirdPartyVerification = 1;
         } else {
             $statusThirdPartyVerification = 0;
         }

        $employe = new Employee();
        $employe->first_name=$request->input('first_name');
        $employe->profile=$uploadProfile;
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
        $employe->document_type=$request->input('document_type');
        $employe->document_id=$uploadDocumentId;
        $employe->document_number=$request->input('document_number');
        $employe->verification_type=$statusVerification;
        $employe->third_party_document=$uploadThirdPartyDocument;
        $employe->third_party_verification=$statusThirdPartyVerification;

        $employe->save();

        $employeeData = Employee::where('empCode',$empCode)->first();

         if (!empty($employeeData)) {
          $insertCompanyEmployee = [
            'employee_id' => $employeeData->id,
            'company_id' => Auth::id(),
            'status' => '1',
        ];
         $companyemployeeData = CompanyEmployee::create($insertCompanyEmployee);
         }

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

            if ($request->hasFile('profile')) {
              $file = $request->file('profile');
              $fileName = time() . '_' . $file->getClientOriginalName();
              $file->storeAs('public/employee_document', $fileName);
              $uploadProfile = asset('storage/employee_document/' . $fileName);
          }
         else{
          $image=DB::table('employee')->where('id',$request->id)->first();
          $uploadProfile=$image->profile;
          // print_r($image->profile);die();
         }

         if ($request->hasFile('document_id')) {
          $file = $request->file('document_id');
          $fileName = time() . '_'. $file->getClientOriginalName();
          $file->storeAs('public/employee/employee_document', $fileName);
          $uploadDocumentId = asset('storage/employee/employee_document/' . $fileName);
       }
       else{
        $document=DB::table('employee')->where('id',$request->id)->first();
        $uploadDocumentId=$document->document_id;
        // print_r($image->profile);die();
       }
          $basic_info=DB::table('employee')->where('id',$request->id)
          ->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'middle_name'=>$request->input('middle_name'),
                'email'=>$request->input('email'),
                'profile'=>$uploadProfile,
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
                'document_type'=>$request->input('document_type'),
                'document_id'=>$uploadDocumentId,
                'document_number'=>$request->input('document_number'),
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

               

              $employeeDetails=Employee::where('id',$request->id)->first();
              // print_r($basic_id);die();

              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                $file->storeAs('public/employee/documents', $fileName);
                $uploadDocument = asset('storage/employee/documents/' . $fileName);
                 }

              if ($request->hasFile('third_party_document')) {
                $file = $request->file('third_party_document');
                $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                $file->storeAs('public/employee/third_party_documents', $fileName);
                $uploadThirdPartyDocument = asset('storage/employee/third_party_documents/' . $fileName);
                 }
      
               $statusVerification = '';
               if (!empty($request->verification_type) && $request->verification_type == true) {
                   $statusVerification = 1;
               } else {
                   $statusVerification = 0;
               }
      
               $statusThirdPartyVerification = '';
               if (!empty($request->third_party_verification) && $request->third_party_verification == true) {
                   $statusThirdPartyVerification = 1;
               } else {
                   $statusThirdPartyVerification = 0;
               }

              $employee_ident = new Employeeidentity();
              $employee_ident->employee_id=$employeeDetails->id;
              $employee_ident->id_type=$request->input('id_type');
              $employee_ident->id_number=$request->input('id_number');
              $employee_ident->document=$uploadDocument;
              $employee_ident->verification_type=$statusVerification;
              $employee_ident->third_party_document=$uploadThirdPartyDocument;
              $employee_ident->third_party_verification=$statusThirdPartyVerification;

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

                $employeeDetails=Employee::where('id',$request->id)->first();

                if ($request->hasFile('document')) {
                  $file = $request->file('document');
                  $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                  $file->storeAs('public/employee/documents', $fileName);
                  $uploadDocument = asset('storage/employee/documents/' . $fileName);
                   }

               if ($request->hasFile('third_party_qualification_document')) {
                $file = $request->file('third_party_qualification_document');
                $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                $file->storeAs('public/employee/third_party_documents', $fileName);
                $uploadThirdPartyDocument = asset('storage/employee/third_party_documents/' . $fileName);
                 }
      
               $statusVerification = '';
               if (!empty($request->qualification_verification_type) && $request->qualification_verification_type == true) {
                   $statusVerification = 1;
               } else {
                   $statusVerification = 0;
               }
      
               $statusThirdPartyVerification = '';
               if (!empty($request->third_party_qualification_verification) && $request->third_party_qualification_verification == true) {
                   $statusThirdPartyVerification = 1;
               } else {
                   $statusThirdPartyVerification = 0;
               }

                $employee_qualf = new Empqualification();
                $employee_qualf->employee_id=$emp_id->id;
                $employee_qualf->inst_name=$request->input('inst_name');
                $employee_qualf->degree=$request->input('degree');
                $employee_qualf->subject=$request->input('subject');
                $employee_qualf->duration_from=$request->input('duration_from');
                $employee_qualf->duration_to=$request->input('duration_to');
                $employee_qualf->document=$uploadDocument;
                $employee_qualf->qualification_verification_type=$statusVerification;
                $employee_qualf->third_party_qualification_document=$uploadThirdPartyDocument;
                $employee_qualf->third_party_qualification_verification=$statusThirdPartyVerification;

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

                $employeeDetails=Employee::where('id',$request->id)->first();
                 $uploadOfferDocument = '';
                 $uploadExperienceDocument = '';
                 $uploadThirdPartyDocument = '';
                 $uploadSalaryDocument = '';

                if ($request->hasFile('offer_letter')) {
                  $file = $request->file('offer_letter');
                  $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                  $file->storeAs('public/employee/documents', $fileName);
                  $uploadOfferDocument = asset('storage/employee/documents/' . $fileName);
                   }

                if ($request->hasFile('exp_letter')) {
                  $file = $request->file('exp_letter');
                  $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                  $file->storeAs('public/employee/documents', $fileName);
                  $uploadExperienceDocument = asset('storage/employee/documents/' . $fileName);
                   }

                if ($request->hasFile('salary_slip')) {
                  $file = $request->file('salary_slip');
                  $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                  $file->storeAs('public/employee/documents', $fileName);
                  $uploadSalaryDocument = asset('storage/employee/documents/' . $fileName);
                   }

               if ($request->hasFile('third_party_workhistory_document')) {
                $file = $request->file('third_party_workhistory_document');
                $fileName = time() . '_' . $employeeDetails->empCode .'_'. $file->getClientOriginalName();
                $file->storeAs('public/employee/third_party_documents', $fileName);
                $uploadThirdPartyDocument = asset('storage/employee/third_party_documents/' . $fileName);
                 }
      
               $statusVerification = '';
               if (!empty($request->qualification_verification_type) && $request->qualification_verification_type == true) {
                   $statusVerification = 1;
               } else {
                   $statusVerification = 0;
               }
      
               $statusThirdPartyVerification = '';
               if (!empty($request->third_party_qualification_verification) && $request->third_party_qualification_verification == true) {
                   $statusThirdPartyVerification = 1;
               } else {
                   $statusThirdPartyVerification = 0;
               }
                $employee_work = new Empworkhistory();
                $employee_work->employee_id=$emp_id->id;
                $employee_work->com_name=$request->input('com_name');
                $employee_work->designation=$request->input('designation');
                $employee_work->offer_letter=$uploadOfferDocument;
                $employee_work->work_duration_from=$request->input('work_duration_from');
                $employee_work->work_duration_to=$request->input('work_duration_to');
                $employee_work->exp_letter=$uploadExperienceDocument;
                $employee_work->salary_slip=$uploadSalaryDocument;
                $employee_work->workhistory_verification_type=$statusVerification;
                $employee_work->third_party_workhistory_document=$uploadThirdPartyDocument;
                $employee_work->third_party_workhistory_verification=$statusThirdPartyVerification;
        
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
                  'date_of_joining' => ['required', 'string', 'max:255'],
                  'emp_type' => ['required', 'string', 'max:255'],
                  'work_location' => ['required', 'string', 'max:255'],
                  'emp_status' => ['required', 'string', 'max:255'],
                  'designation' => ['required', 'string', 'max:255'],
                  'lpa' => ['required', 'string', 'max:255'],
              
                  ]);

                $emp_id=Employee::where('id',$request->id)->first();
                
                $officialData = new Empofficial();
                $officialData->employee_id=$emp_id->id;
                $officialData->date_of_joining=$request->input('date_of_joining');
                $officialData->emp_type=$request->input('emp_type');
                $officialData->work_location=$request->input('work_location');
                $officialData->emp_status=$request->input('emp_status');
                $officialData->lpa=$request->input('lpa');
                $officialData->designation=$request->input('designation');

                $officialData->save();

                  CompanyEmployee::where('employee_id',$officialData->employee_id)->update([
                    'start_date'  => $officialData->date_of_joining,
                    'status' => $officialData->emp_status
                  ]);
              

                return redirect('employee');
             }
      
    }


      public function editEmployee(request $request,$id){
        // $basicinfo=Employee::where('id',$request->id)->first();
        if(isset($_POST['basic-edit'])){

          if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/employee_document', $fileName);
            $uploadProfile = asset('storage/employee_document/' . $fileName);
        }
         else{
          $image=DB::table('employee')->where('id',$request->id)->first();
          $uploadProfile=$image->profile;
          // print_r($image->profile);die();
         }
         if ($request->hasFile('document_id')) {
          $file = $request->file('document_id');
          $fileName = time() . '_'. $file->getClientOriginalName();
          $file->storeAs('public/employee/employee_document', $fileName);
          $uploadDocumentId = asset('storage/employee/employee_document/' . $fileName);
       }
       else{
        $document=DB::table('employee')->where('id',$request->id)->first();
        $uploadDocumentId=$document->document_id;
        // print_r($image->profile);die();
       }
         $basic_info=DB::table('employee')->where('id',$request->id)
         ->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'middle_name'=>$request->input('middle_name'),
                'email'=>$request->input('email'),
                'profile'=>$uploadProfile,
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
                'document_type'=>$request->input('document_type'),
                'document_id'=>$uploadDocumentId,
                'document_number'=>$request->input('document_number'),
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
            $qua_info['document']= $filename;
        }
        else{
          $image=DB::table('employee_qualifications')->where('id',$request->id)->get();
          foreach($image as $img){
          $filename=$img->document;
          }
        }
          $qua_info=DB::table('employee_qualifications')->where('id',$request->id)
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
            $work_info['offer_letter']= $filename1;
          }
          else{
            $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
            $filename1=$image->offer_letter;
       
          }

          if($request->file('exp_letter')){
            $file= $request->file('exp_letter');
            $filename2=$file->getClientOriginalName();
            $file->move(public_path().'/Image/',$filename2); 
            $work_info['exp_letter']= $filename2;
              }
              else{
                $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
                $filename2=$image->exp_letter;
              }

            if($request->file('salary_slip')){
              $file= $request->file('salary_slip');
              $filename3=$file->getClientOriginalName();
              $file->move(public_path().'/Image/',$filename3); 
              $work_info['salary_slip']= $filename3;
          }
          else{
            $image=DB::table('employee_workhistories')->where('id',$request->id)->first();
            $filename3=$image->salary_slip;
          
          }
          $work_info=DB::table('employee_workhistories')->where('id',$request->id)
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


        if(isset($_POST['skill-edit'])){
          
       
          // dd($skill->id);
          $identity_info=DB::table('employee_skills')->where('id', $request->id)
          ->update([
            
                  'skill'=>$request->input('skill'),
                  'skill_type'=>$request->input('skill_type'),
          
            ]);
          
        
          return redirect()->back()->with('message','Infomation updated successfully.');
          }

        if(isset($_POST['skilllang-edit'])){
          $identity_info=DB::table('employee_language')->where('id', $request->id)
          ->update([
                  'lang'=>$request->input('lang'),
                  'lang_type'=>$request->input('lang_type'),
          
            ]);
          return redirect()->back()->with('message','Infomation updated successfully.');
        }

        if(isset($_POST['official-edit'])){
          $employeeId = Employee::where('id',$request->id)->first();
          $dataExist =  Empofficial::where('employee_id', $request->id)->first();
// dd($employeeId);
            if(empty($dataExist)){

                $insertOfficialEmployeeData = [
                  'employee_id' => $employeeId->id,
                  'date_of_joining' => !empty($request->date_of_joining) ? $request->date_of_joining : null,
                  'emp_type' => !empty($request->emp_type) ? $request->emp_type : null,
                  'work_location' => !empty($request->work_location) ? $request->work_location : null,
                  'emp_status' => !empty($request->emp_status) ? $request->emp_status : null,
                  'lpa' => !empty($request->lpa) ? $request->lpa : null,
                  'designation' => !empty($request->designation) ? $request->designation : null,
              
                ];
                $employeeData = Empofficial::create($insertOfficialEmployeeData);
                // dd($employeeData);
                CompanyEmployee::where('employee_id',$employeeData->employee_id)->where('company_id',Auth::id())->update([
                  'start_date'  => $employeeData->date_of_joining,
                  'status' => $employeeData->emp_status
                ]);

            }
            else{

            $employeeData = DB::table('employee_officials')->where('employee_id',$request->id)
              ->update([
                      'date_of_joining'=>$request->input('date_of_joining'),
                      'emp_type'=>$request->input('emp_type'),
                      'work_location'=>$request->input('work_location'),
                      'emp_status'=>$request->input('emp_status'),
                      'lpa'=>$request->input('lpa'),
                      'designation'=>$request->input('designation'),
                  
                ]);

                CompanyEmployee::where('employee_id',$request->id)->where('company_id',Auth::id())->update([
                  'start_date'  => $request->input('date_of_joining'),
                  'status' => $request->input('emp_status')
                ]);

          }
          
          return redirect('employee');
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
        $official= Empofficial::join('company_employee','company_employee.employee_id','=','employee_officials.employee_id')->where('employee_officials.employee_id',$request->id)->where('company_employee.company_id',Auth::id())->first();

        return view('admin/edit-employee',compact('basic','identity','qualification','workhistory','skills','official','skill_item','lang_item','qual_item','ident_item','work_item'));
      }

      public function getAllEmp(){
      
        //  $allemp=DB::table('employee')->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')
        //                   ->select('employee.*', 'employee_officials.*')->get();
        
       $employeeDetails= CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                           ->join('employee','company_employee.employee_id','=','employee.id')
                           ->select('company_employee.*','users.id','employee.*')
                           ->where('company_employee.company_id',Auth::id())->get();
    
         return view('admin.datatable',compact('employeeDetails'));
      }


      public function downloadCsv(){
        $file= public_path(). "/employee-sample.csv";
        $headers = array(
                  'Content-Type: application/csv',
                );
    // dd($file);
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
                'emg_address' => $data['emg_address'],
                // 'document_type' => $data['document_type'],
                // 'document_id' => $data['document_id'],
                // 'document_number' => $data['document_number'],
                // 'status' => $data['status']
                ]
                
           );
         
            //  $identity= new Employeeidentity;
            //  $identity->id_type=$data['id_type'];
            //  $identity->employee_id=$id;
            //  $identity->id_number=$data['id_number'];
            //  $identity->verification_type='Not Verified';
            //  $identity->save();

             $qualification= new Empqualification;
             $qualification->employee_id=$id;

             $qualification->inst_name=$data['inst_name'];
             $qualification->degree=$data['degree'];
             $qualification->subject=$data['subject'];
             $qualification->duration_from=$data['duration_from'];
             $qualification->duration_to=$data['duration_to'];
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

                $employee_work->save();

                $employee_off = new Empofficial;
                $employee_off->employee_id=$id;
                $employee_off->date_of_joining=$data['date_of_joining'];
                $employee_off->emp_type=$data['emp_type'];
                $employee_off->work_location=$data['work_location'];
                $employee_off->emp_status='0';
                $employee_off->lpa=$data['lpa'];
                $employee_off->designation=$data['designation'];

                $employee_off->save();

                $companyEmp = new CompanyEmployee;
                $companyEmp->employee_id=$id;
                $companyEmp->company_id=Auth::id();
                $companyEmp->status='1';
                $companyEmp->start_date=$data['date_of_joining'];
                
                $companyEmp->save();
            
          }

          return redirect()->back()->with('message','Upload successfully');
        }
      else{
          return redirect()->back()->with('message','Not selected any file to upload');

       }
      }

      public function exitEmp($id){

         $officialData=Employee::join('employee_officials','employee.id','=','employee_officials.employee_id')
                      ->join('company_employee','company_employee.employee_id','=','employee.id')
                      ->select('employee_officials.*')
                      ->where('employee.id',$id)->first();

         $exitemp=Employee::join('company_employee','company_employee.employee_id','=','employee.id')
                    ->join('users','users.id','=','company_employee.company_id')
                    ->select('users.id','employee.*')
                    ->where('employee.id',$id)->first();

         return view('admin/employee-exit',compact('exitemp','officialData'));
      }

      public function exitEmployee(request $request,$id){
        
        $employee_id=Employee::where('id',$id)->first();

        $exitemp = new Exitemp();
        $exitemp->employee_id=$employee_id->id;
        $exitemp->date_of_exit=$request->input('date_of_exit');
        $exitemp->decipline=$request->input('decipline');
        $exitemp->reason_of_exit=$request->input('reason_of_exit');
        $exitemp->rating=$request->input('rating');
        $exitemp->document=$request->input('document');
      
        if($request->file('document')){
            $file= $request->file('document');
            $filename=$file;
            $file->move(public_path().'/Image/',$filename); 
            $exitemp['document']= $filename;
        }

        $exitemp->save();

        CompanyEmployee::where('employee_id',$exitemp->employee_id)->update([
          'end_date'  => $exitemp->date_of_exit,
          'status'  => '0',
        ]);
   
        // Employee::where('id',$exitemp->employee_id)->update([
        //   'status'  => '0'
        // ]);

        return redirect('employee')->with('message','Employee exit successfully');
     }

     public function addOldEmp(){
      
      $oldemployee=Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                ->where('company_employee.status',0)->where('company_employee.company_id',Auth::id())
                ->select('employee.*')->get();
// dd($oldemployee);
      return view('admin/post-employee',compact('oldemployee'));
      }

      public function postEmpDetails(request $request){
      
          $qualifications=Empqualification:: where('employee_id',$request->id)->get();
          $workdetails=Empworkhistory:: where('employee_id',$request->id)->get();

          $employeeDetails = Employee::leftJoin('company_employee','company_employee.employee_id','=','employee.id')
                          ->leftJoin('exit_employee', 'exit_employee.employee_id', '=', 'company_employee.employee_id')
                          ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                          ->where('employee.id',$request->id)->where('company_employee.company_id',Auth::id())
                          ->first();

          return view('admin/post-employee-details',compact('employeeDetails','workdetails','qualifications'));
      }

      public function currentEmp(){
  
        // $current=DB::table('employee')->join('employee_officials', 'employee.id', '=', 'employee_officials.employee_id')->select('employee.id','employee.*', 'employee_officials.*')
        //          ->where('employee.status',1)->get();
                 $current= CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                           ->join('employee','company_employee.employee_id','=','employee.id')->select('company_employee.*','users.id','employee.*')
                           ->where('company_employee.status',1)->where('company_employee.company_id',Auth::user()->id)->get();
        // print_r($current);die();
        return view('admin/current-employee',compact('current'));
      }

        public function exportsCSV()
        {
      
          $fileName = 'employee.csv';
          // $employee = Employee::all();
          $employee = Employee::leftJoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee_qualifications.employee_id')
                    // ->join('employee_skills', 'employee_skills.employee_id', '=', 'employee_workhistories.employee_id')
                    ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->where('company_employee.company_id',Auth::user()->id)
                    ->get();


    // dd($employee);
                  //   CompanyEmployee::join('users','users.id','=','company_employee.company_id')
                  //   ->join('employee','company_employee.employee_id','=','employee.id')->select('company_employee.*','users.id','employee.*')
                  //  ->where('company_employee.company_id',Auth::user()->id)->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        // $columns = array('First Name','Last Name','Middle Name','Email','Phone','Date of Birth','Blood Group','Gender','Marital Status','Current Address','Permanent Address','Emg Name','Emg Relationship','Emg Phone','Emg Address','Id Type','Id Number','Date of Joining','Promotion Period','Employee Type','Work Location','Employee Status','Salary','Lakhs Per Year','Appraisal From','Appraisal To','Last Appraisal Designation','Current Appraisal Designation','Appraisal Date','Promotion From','Promotion To','Last Promotion Designation','Current Promotion Designation','Promotion Date','Manager Name','Manager Type','Manager Department','Manager Designation','Skill','Skill Type','Language Known','Language Type','Company Name','Designation','Work Duration From','Work Duration To','Institute Name','Degree','Subject','Duration From','Duration To');
        $columns = array('First Name','Last Name','Middle Name','Email','Phone','Date of Birth','Blood Group','Gender','Marital Status','Current Address',
        'Permanent Address','Emg Name','Emg Relationship','Emg Phone','Emg Address','Id Type','Id Number','Date of Joining','Employee Type','Work Location',
        'Employee Status','Lakhs Per Year','Skill','Skill Type','Language Known','Language Type','Company Name','Designation','Work Duration From','Work Duration To','Institute Name','Degree','Subject','Duration From','Duration To');
      
        $callback = function() use($employee, $columns) {
            $file = fopen('php://output', 'w');
            // 
            fputcsv($file, $columns);
          
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
                $row['Date of Joining']    = $task->date_of_joining;
                $row['Employee Type']  = $task->emp_type;
                $row['Work Location']  = $task->work_location;
                $row['Employee Status']  = $task->emp_status;
                // $row['Salary']  = $task->salary;
                $row['Lakhs Per Year']  = $task->lpa;
                // $row['Appraisal From']  = $task->app_from;
                // $row['Appraisal To']  = $task->app_to;
                // $row['Last Appraisal Designation']  = $task->last_app_desig;
                // $row['Current Appraisal Designation']  = $task->current_app_desig;
                // $row['Appraisal Date']  = $task->app_date;
                // $row['Promotion From']  = $task->prob_from;

                // $row['Promotion To']  = $task->prob_to;
                // $row['Last Promotion Designation']    = $task->last_prob_desig;
                // $row['Current Promotion Designation']    = $task->current_prob_desig;
                // $row['Promotion Date']  = $task->prob_date;
                // $row['Manager Name']  = $task->mang_name;
                // $row['Manager Type']  = $task->mang_type;
                // $row['Manager Department']  = $task->mang_dept;
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
            
                
                fputcsv($file, array($row['First Name'], $row['Last Name'], $row['Middle Name'], $row['Email'], $row['Phone'],$row['Date of Birth'], $row['Blood Group'], $row['Gender'],$row['Marital Status'], $row['Current Address'], $row['Permanent Address'],$row['Emg Name'],$row['Emg Relationship'], $row['Emg Phone'], $row['Emg Address'],$row['Id Type'], $row['Id Number'],$row['Date of Joining'],$row['Employee Type'],$row['Work Location'], $row['Employee Status'],$row['Lakhs Per Year'],
                // $row['Last Appraisal Designation'],$row['Current Appraisal Designation'], $row['Appraisal Date'], $row['Promotion From'],
                // $row['Promotion To'], $row['Last Promotion Designation'], $row['Current Promotion Designation'], $row['Promotion Date'], $row['Manager Name'],$row['Manager Type'],$row['Manager Department'], $row['Manager Designation'],
                $row['Skill'], $row['Skill Type'], $row['Language Known'],$row['Language Type'],$row['Company Name'], $row['Designation'], $row['Work Duration From'],$row['Work Duration To'],
                $row['Institute Name'],$row['Degree'], $row['Subject'], $row['Duration From'],$row['Duration To']));
      
            }
          
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
    

    
