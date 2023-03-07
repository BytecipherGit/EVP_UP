<?php

namespace App\Http\Controllers;

use App\Models\Empinvite;
use App\Models\Employee;
use App\Models\Employeeidentity;
use App\Models\Empqualification;
use App\Models\Empworkhistory;
use App\Models\Empskills;
use App\Models\Empofficial;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Mail;
use Illuminate\Support\Facades\DB;

class InviteempController extends Controller
{

      public function index(){
        $empinvite= Employee::where('status','2')->get();
        return view('admin/invite-employee',compact('empinvite'));
      }

      public function inviteEmp(){
        return view('admin/add-invite-emp');
      }

      public function editInviteEmp($id){
        $invite=Employee::where('id',$id)->first();
        return view('admin/edit-invite-emp',compact('invite'));
      }

      public function deleteInvite(request $request, $id){
       Employee::where('id',$request->id)->delete();
        return redirect('invite-employee')->with('message','Employee Delete Successfully.');
      }

      public function geteditInvite(request $request){
        $data=DB::table('emp_basicinfo')->where('id',$request->id)
        ->update([
               'first_name'=>$request->input('first_name'),
               'last_name'=>$request->input('last_name'),
               'middle_name'=>$request->input('middle_name'),
               'email'=>$request->input('email'),
               'phone'=>$request->input('phone'),
               
       ]);

       return redirect('invite-employee')->with('message','Infomation Updated Successfully.');
      
      }

      public function getInviteEmp(request $request){
        
        // $request->validate([
        //     'first_name' => ['required'],
        //     'last_name' => ['required'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        // ]);

        $employee= new Employee();
      
        $employee->first_name=$request->input('first_name');
        $employee->middle_name=$request->input('middle_name');
        $employee->last_name=$request->input('last_name');
        $employee->email=$request->input('email');
        $employee->phone=$request->input('phone');
        $employee->status='2';

        $employee->save();
        return redirect('invite-employee');
      }

      public function getCsvInvite(Request $request){
    

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
            // Table update
        
        
            $info= new Employee;
            $info->first_name=$data['first_name'];
            $info->last_name=$data['last_name'];
            $info->middle_name=$data['middle_name'];
            $info->email=$data['email'];
            $info->phone=$data['phone'];
            $info->status='2';
            $info->save();

         }
      
         // print_r($information);die();
         return redirect()->back()->with('message','Upload successfully');
     }
     else{
         return redirect()->back()->with('message','Not selected any File To Upload');

         }
     }

     public function exportsCSVInvite(Request $request)
     {
       $fileName = 'invite_employee.csv';
       $employee = Employee::all();
           
     $headers = array(
         "Content-type"        => "text/csv",
         "Content-Disposition" => "attachment; filename=$fileName",
         "Pragma"              => "no-cache",
         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
         "Expires"             => "0"
     );

     $columns = array('First Name','Last Name','Middle Name','Email','Phone');
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
           
             fputcsv($file, array($row['First Name'], $row['Last Name'], $row['Middle Name'], $row['Email'], $row['Phone']));
              //  print_r($file);
           }

         fclose($file);
     };

            return response()->stream($callback, 200, $headers);
        }

        public function downloadInviteCsv(){
          $file= public_path(). "/invite-sample.csv";
          $headers = array(
                    'Content-Type: application/csv',
                  );

          return Response::download($file, 'invite-sample.csv', $headers);
        }

        public function sendemail(request $request){

          $temp = array();
          $users_id=$request->input('id');
          if (is_array($users_id))
          {
          foreach($users_id as $key => $ids){
            $temp[] = $ids;
          }
          }
          // print_r($temp); die();
          $emp = DB::table('emp_basicinfo')->whereIn('id', $temp)->get();

        
            $info = array();
            foreach ($emp as $row) {
                $info[] = array(
                   'first_name' => $row->first_name,
                    'id' => $row->id, 
                    'email' => $row->email,
                    'last_name' => $row->last_name,
                );
            }

            if(!empty($info)){
              foreach($info as $row){
                if(!empty($row['email']) && !empty($row['first_name']) && !empty($row['last_name']))
                $email = $row['email'];
                $name = $row['first_name'].' '.$row['last_name'];
                $dat=['first' => $name];
                $id=['ids' => $row['id']];
                Mail::send('org-invite/invite-email', ['data' => $dat,'data2'=> $id], function($message) use($email, $name){
                  $message->to($email, $name)->subject
                     ('ByteCipher Pvt Ltd Interview Invitation Email');
                  $message->from('jharshita259@gmail.com','ByteCipher Pvt Ltd');
                   });
              }
             
            }
            
       
              return redirect()->back()->with('message','Email Send with attachment. Check your inbox.') ;
          
        }

        public function getConfig(request $request){
          $empid=Employee::where('id',$request->id)->first();
          return view('org-invite/index',compact('empid'));
        }

        public function getBasicDetails(request $request,$id){

          $basic=Employee:: where('id',$request->id)->first();
          $identity=Employeeidentity:: where('emp_id',$request->id)->get();
          $ident=Employeeidentity:: where('emp_id',$request->id)->first();
          $qualification=Empqualification:: where('emp_id',$request->id)->get();
          $quali=Empqualification:: where('emp_id',$request->id)->first();
          $workhistory=Empworkhistory:: where('emp_id',$request->id)->get();
          $workh=Empworkhistory:: where('emp_id',$request->id)->first();
          $skills=Empskills:: where('emp_id',$request->id)->first();
          $official= Empofficial::where('emp_id',$request->id)->first();
      
          return view('org-invite/basic-info',compact('basic','identity','qualification','ident','workhistory','quali','workh','skills','official'));
        }

        public function getInviteDetails(request $request){

            // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        // ]);
        if(isset($_POST['basic'])){
          $employe = new Employee();
          $employe->first_name=$request->input('first_name');
          $employe->profile=$request->input('profile');
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
      
            $basicinfo = Employeeidentity::where('emp_id',$request->id)->first();
            if (empty($basicinfo)) {
        
              $basic=Employee::where('email',$request->email)->first();
              $id=$basic->id;
              $table = $basic->getTable();
              return redirect('basic-info/'.$id)->with('tabs-3_active', true);
  
             }
  
             else{
              return redirect()->back()->with('tabs-3_active', true);
        
             }
             return redirect()->back();
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
                $image=DB::table('emp_basicinfo')->where('id',$request->id)->first();
                $filename=$image->profile;
           
              }
                $basic_info=DB::table('emp_basicinfo')->where('id',$request->id)
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
  
                 return redirect()->back()->with('tabs-3_active', true)->with('message','Infomation Updated Successfully.');
              
            }
  
     
        
           
         
              if(isset($_POST['identity'])){
                $basic_id=Employee::where('id',$request->id)->first();
                // print_r($basic_id);die();
                $emp_ident = new Employeeidentity();
                $emp_ident->emp_id=$basic_id->id;
                $emp_ident->id_type=$request->input('id_type');
                $emp_ident->id_number=$request->input('id_number');
                $emp_ident->document=$request->input('document');
                $emp_ident->verification_type=$request->input('verification_type');
              
  
                if($request->has('document')) {
                  $image = $request->file('document');
                  $emp_ident->document = $image->getClientOriginalName();
                  $image->move(public_path('/Image'), $image->getClientOriginalName());
                  }
        
                $emp_ident->save();
                $identityinfo = Empqualification::where('emp_id',$request->id)->first();
                if (empty($identityinfo)) {
            
                  $basic=Employeeidentity::where('emp_id',$request->id)->first();
                  $id=$basic->emp_id;
              
                  return redirect('basic-info/'.$id)->with('tabs-2_active', true);
            
                   }
                 else{
                  return redirect()->back()->with('tabs-2_active', true);
                 }
             
                  return redirect()->back();
               
              }
  
            
                if(isset($_POST['qulification'])){
                  $identity_id=Employee::where('id',$request->id)->first();
                  $emp_qualf = new Empqualification();
                  $emp_qualf->emp_id=$identity_id->id;
                  $emp_qualf->inst_name=$request->input('inst_name');
                  $emp_qualf->degree=$request->input('degree');
                  $emp_qualf->subject=$request->input('subject');
                  $emp_qualf->duration_from=$request->input('duration_from');
                  $emp_qualf->duration_to=$request->input('duration_to');
                  $emp_qualf->document=$request->input('document');
                  $emp_qualf->verification_type=$request->input('verification_type');
                
                  if($request->has('document')) {
                    $image = $request->file('document');
                    $emp_qualf->document = $image->getClientOriginalName();
                    $image->move(public_path('/Image'), $image->getClientOriginalName());
                   }
          
                  $emp_qualf->save();
               
                  $qualifinfo = Empworkhistory::where('emp_id',$request->id)->first();
                  if (empty($qualifinfo)) {
              
                    $qual=Empqualification::where('emp_id',$request->id)->first();
                    $id=$qual->emp_id;
                    return redirect('basic-info/'.$id)->with('tabs-3_active', true);
                   }
                   else{
                    return redirect()->back()->with('tabs-3_active', true);
                   }
  
                    return redirect()->back();
                }
  
  
                if(isset($_POST['workhistory'])){
                  $identity_id=Employee::where('id',$request->id)->first();
                  $emp_work = new Empworkhistory();
                  $emp_work->emp_id=$identity_id->id;
                  $emp_work->com_name=$request->input('com_name');
                  $emp_work->designation=$request->input('designation');
                  $emp_work->offer_letter=$request->input('offer_letter');
                  $emp_work->work_duration_from=$request->input('work_duration_from');
                  $emp_work->work_duration_to=$request->input('work_duration_to');
                  $emp_work->exp_letter=$request->input('exp_letter');
                  $emp_work->salary_slip=$request->input('salary_slip');
                  $emp_work->verification_type=$request->input('verification_type');
                
  
                  if($request->has('offer_letter')) {
                    $image = $request->file('offer_letter');
                    $emp_work->offer_letter = $image->getClientOriginalName();
                    $image->move(public_path('/Image'), $image->getClientOriginalName());
                  }
                  if($request->has('exp_letter')) {
                    $image = $request->file('exp_letter');
                    $emp_work->exp_letter = $image->getClientOriginalName();
                    $image->move(public_path('/Image'), $image->getClientOriginalName());
                  }
                  if($request->has('salary_slip')) {
                  $image = $request->file('salary_slip');
                  $emp_work->salary_slip = $image->getClientOriginalName();
                  $image->move(public_path('/Image'), $image->getClientOriginalName());
                  }
          
          
                  $emp_work->save();
                  $workinfo = Empskills::where('emp_id',$request->id)->first();
                  if (empty($workinfo)) {
              
                    $work=Empworkhistory::where('emp_id',$request->id)->first();
                    $id=$work->emp_id;
                    // $table=$basic->getTable();
                    // return view('admin/add-employee/'.$id ,compact('basic'));
                    return redirect('basic-info/'.$id)->with('tabs-4_active', true);
              
                   }
                   else{
                    // return redirect()->back();
                    return redirect()->back()->with('tabs-4_active', true);
                   }
                   return redirect()->back();
                   
                }
  
                if(isset($_POST['workskill'])){
                  $identity_id=Employee::where('id',$request->id)->first();
                  $emp_skill = new Empskills();
                  $emp_skill->emp_id=$identity_id->id;
                  $emp_skill->skill=$request->input('skill');
                  $emp_skill->skill_type=$request->input('skill_type');
                  $emp_skill->lang=$request->input('lang');
                  $emp_skill->lang_type=$request->input('lang_type');
                
                  $emp_skill->save();
                  $official = Empofficial::where('emp_id',$request->id)->first();
                  if (empty($official)) {
              
                    $skill=Empskills::where('emp_id',$request->id)->first();
                    $id=$skill->emp_id;
                    // $table=$basic->getTable();
                    // return view('admin/add-employee/'.$id ,compact('basic'));
                    return redirect('basic-info/'.$id)->with('tabs-5_active', true);
              
                     }
                   else{
                    return redirect()->back()->with('tabs-5_active', true);
                   }
  
                   return redirect()->back();
                }
  
                if(isset($_POST['official'])){
                  $identity_id=Employee::where('id',$request->id)->first();
                  $emp_off = new Empofficial();
                  $emp_off->emp_id=$identity_id->id;
                  $emp_off->doj=$request->input('doj');
                  $emp_off->prob_period=$request->input('prob_period');
                  $emp_off->emp_type=$request->input('emp_type');
                  $emp_off->work_location=$request->input('work_location');
                  $emp_off->emp_status=$request->input('emp_status');
                  $emp_off->salary=$request->input('salary');
                  $emp_off->lpa=$request->input('lpa');
                  $emp_off->app_from=$request->input('app_from');
                  $emp_off->app_to=$request->input('app_to');
                  $emp_off->last_app_desig=$request->input('last_app_desig');
                  $emp_off->current_app_desig=$request->input('current_app_desig');
                  $emp_off->app_date=$request->input('app_date');
                  $emp_off->pro_from=$request->input('pro_from');
                  $emp_off->pro_to=$request->input('pro_to');
                  $emp_off->last_pro_desig=$request->input('last_pro_desig');
                  $emp_off->current_pro_desig=$request->input('current_pro_desig');
                  $emp_off->pro_date=$request->input('pro_date');
                  $emp_off->mang_name=$request->input('mang_name');
                  $emp_off->mang_type=$request->input('mang_type');
                  $emp_off->mang_dept=$request->input('mang_dept');
                  $emp_off->mang_desig=$request->input('mang_desig');
              
            
                  $emp_off->save();
  
                  return redirect('confirmation');
               }

        }
      
       
}
