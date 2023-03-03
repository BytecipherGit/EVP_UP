<?php

namespace App\Http\Controllers;

use App\Models\Empinvite;
use App\Models\Employee;
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

      public function getemailsend(Request $request){
       
            $user_id_array = $request->input('id');
            $user = DB::table('emp_basicinfo')->whereIn('id', $user_id_array)->get();
              $users = Mail::to($request->email)
            ->send(new Emailinvite());
            if ($user) {
                return response('Update Successfully');
            }
        }

        public function sendemail(request $request){
      
          $emp = Employee::where('id',204)->first();
          // dd($emp->first_name);
          $data = array(
            'first_name'=>$emp->first_name,
            'email'=>$emp->email);
        // dd($data);
         $email=$emp->email;
         $name=$emp->first_name;
          Mail::send('org-invite/invite-email', $data, function($message) use ($email, $name){
             $message->to($email, $name)->subject
                ('Laravel Testing Mail with Attachment');
             $message->from('jharshita259@gmail.com','Virat Gandhi');
          });
          return redirect()->back()->with('message','Email Sent with attachment. Check your inbox.') ;
       
        }
      
     
}
