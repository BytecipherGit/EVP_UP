<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employeeidentity;
use App\Models\Empofficial;
use App\Models\Empqualification;
use App\Models\Empskills;
use App\Models\Emplang;
use App\Models\CompanyEmployee;
use App\Models\EmployeeInterview;
use App\Models\Empworkhistory;
use App\Mail\DynamicEmail;
use App\Models\Verification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as HelpersHelper;
use Mail;
use Config;
use Redirect;
use Illuminate\Support\Facades\Response;

class InviteempController extends Controller
{

    public function index()
    {
        $empinvite = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                    ->where('company_employee.status',2)
                    ->where('company_employee.company_id',Auth::id())
                    ->select('employee.*')->get();
        return view('admin/invite-employee', compact('empinvite'));
    }

    public function inviteEmp()
    {
        return view('admin/add-invite-emp');
    }

    public function editInviteEmp($id)
    {
        $invite = Employee::where('id', $id)->first();
        return view('admin/edit-invite-emp', compact('invite'));
    }

    public function deleteInvite(request $request, $id)
    {
        Employee::where('id', $request->id)->delete();
        return redirect('invite_employee')->with('message', 'Employee delete successfully.');
    }

    public function geteditInvite(request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'email' => 'required|email|unique:employee,email,' . $request->id,
            'phone' => 'required|max:12|min:10',
        ]);


        $data = DB::table('employee')->where('id', $request->id)
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),

            ]);
         

        return redirect('invite_employee')->with('message', 'Infomation updated successfully.');

    }

    public function getInviteEmp(request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required','string'],
            'email' => ['required','unique:employee','email'],
            'middle_name' => ['required', 'string', 'max:255'],
            'phone' => ['required','max:12','min:10'],

        ]);

        $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));
        
        $employee = new Employee();
        $employee->first_name = $request->input('first_name');
        $employee->empCode = $empCode;
        $employee->middle_name = $request->input('middle_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        // $employee->status = '2';

        $employee->save();
        
        if(!empty($employee)){

            $insertCompanyEmployee = [
                'employee_id' => $employee->id,
                'company_id' => Auth::id(),
                'status' => '2',
            ];
            $companyemployeeData = CompanyEmployee::create($insertCompanyEmployee);
        }

        return redirect('invite_employee');
    }

    public function getCsvInvite(Request $request)
    {
        // dd($request->all());

        if ($request->has('upload-file')) {
            $upload = $request->file('upload-file');
            $filePath = $upload->getRealPath();
            //open and read
            $file = fopen($filePath, 'r');

            $header = fgetcsv($file);

            // dd($header);
            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]_[ ]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
            // dd($escapedHeader);
            //looping through othe columns
            while ($columns = fgetcsv($file)) {
                if ($columns[0] == "") {
                    continue;
                }

                //trim data
                foreach ($columns as $key => $value) {
                    $value = preg_replace('/\D/', '', $value);

                }

                $data = array_combine($escapedHeader, $columns);
                // setting type
                foreach ($data as $key => $value) {
                    // $value=($key=="role" || $key=="pin")?(string)$value: (integer)$value;
                    $value = ($key == "first_name") ? (string) $value : (integer) $value;
                }
                $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));

                $info = new Employee;
                $info->first_name = $data['first_name'];
                $info->last_name = $data['last_name'];
                $info->empCode = $empCode;
                $info->middle_name = $data['middle_name'];
                $info->email = $data['email'];
                $info->phone = $data['phone'];
                $info->save();
// dd($info);
                if(!empty($info)){

                    $insertCompanyEmployee = [
                        'employee_id' => $info->id,
                        'company_id' => Auth::id(),
                        'status' => '2',
                    ];
                    $companyemployeeData = CompanyEmployee::create($insertCompanyEmployee);
               }
        }

            // print_r($information);die();
            return redirect()->back()->with('message', 'Upload successfully');
        } else {
            return redirect()->back()->with('message', 'Not select any file to upload');

        }
    }

    public function exportsCSVInvite(Request $request)
    {
        $fileName = 'invite_employee.csv';
        // $employee = Employee::all();
           $employee= CompanyEmployee::join('employee','company_employee.employee_id','=','employee.id')
                       ->select('company_employee.*','employee.*')
                       ->where('company_employee.status',2)
                       ->where('company_employee.company_id',Auth::user()->id)->get();
// dd($employee);
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $columns = array('First Name','Middle Name','Last Name','Email','Phone');
        $callback = function () use ($employee, $columns) {
            $file = fopen('php://output', 'w');
            //
            fputcsv($file, $columns);
            // print_r($columns);die();
            foreach ($employee as $task) {
                
                $row['First Name'] = $task->first_name;
                $row['Middle Name'] = $task->middle_name;
                $row['Last Name'] = $task->last_name;
                $row['Email'] = $task->email;
                $row['Phone'] = $task->phone;

                fputcsv($file, array($row['First Name'],$row['Middle Name'], $row['Last Name'], $row['Email'], $row['Phone']));
                //  print_r($file);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadInviteCsv()
    {
        $file = public_path() . "/invite-sample.csv";
        $headers = array(
            'Content-Type: application/csv',
        );

        return Response::download($file, 'invite-sample.csv', $headers);
    }

    public function downloadQualificationDoc(request $request)
    {

        $data = Empqualification::where('id', $request->id)->first();
        $filename = $data->document;
        $filename = str_replace(url('/') . '/storage/', "", $filename);
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404);

    }

    public function downloadOfferDocument(request $request)
    {
        $data = Empworkhistory::where('id', $request->id)->first();
        // dd($data);
        $filename = $data->offer_letter;
        $filename = str_replace(url('/') . '/storage/', "", $filename);
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404);
    }

    public function downloadIdDoc(request $request)
    {
        $data = Employeeidentity::where('id', $request->id)->first();
        $filename = $data->document;
        $filename = str_replace(url('/') . '/storage/', "", $filename);
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404);
    }

    public function downloadExpDoc(request $request)
    {
 
        $data = Empworkhistory::where('id', $request->id)->first();
        $filename = $data->exp_letter;
        $filename = str_replace(url('/') . '/storage/', "", $filename);
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404);
    }

    public function sendInvitationToEmployee(request $request)
    {
        // dd($request->all());

        $temp = array();
        $users_id = $request->id;
        if (is_array($users_id)) {
            foreach ($users_id as $key => $ids) {
                $temp[] = $ids;
            }
        }

        $emp = DB::table('employee')->whereIn('id', $temp)->get();
        $info = array();
        
        foreach ($emp as $row) {
            $info[] = array(
                'first_name' => $row->first_name,
                'id' => $row->id,
                'email' => $row->email,
                'last_name' => $row->last_name,
            );
        }

        if (!empty($info)) {
            foreach ($info as $row) {
                if (!empty($row['email']) && !empty($row['first_name']) && !empty($row['last_name'])) {
                    $email = $row['email'];
                }
                
                $name = $row['first_name'] . ' ' . $row['last_name'];
                $send_name = ['first' => $name];
                $send_id = ['ids' => encrypt($row['id'])];
                $company_name = ['company_name' => Auth::user()->name];
    
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

                
                Mail::send('org-invite/invite-email', ['mailName' => $company_name, 'mailId' => $send_id, 'companyId' => encrypt(Auth::id())], function ($message) use ($email, $name) {
                    $message->to($email, $name)->subject('ByteCipher Pvt Ltd Interview Invitation Email');
                   $message->from(Config::get('mail.from.address'),Config::get('mail.from.name'));
                });
            }
            return Response::json(['success' => '1']);
        }
        // return redirect()->back()->with('message', 'Email Send with attachment. Check your inbox.');

    }

    public function sendemail(request $request)
    {

        $temp = array();
        $users_id = $request->id;
       dd($users_id);
        if (is_array($users_id)) {
            foreach ($users_id as $key => $ids) {
                $temp[] = $ids;
            }
        }
        dd($temp);
        // print_r($temp); die();
        $emp = DB::table('employee')->whereIn('id', $temp)->get();

        $info = array();
        foreach ($emp as $row) {
            $info[] = array(
                'first_name' => $row->first_name,
                'id' => $row->id,
                'email' => $row->email,
                'last_name' => $row->last_name,
            );
        }

        if (!empty($info)) {
            foreach ($info as $row) {
                if (!empty($row['email']) && !empty($row['first_name']) && !empty($row['last_name'])) {
                    $email = $row['email'];
                }

                $name = $row['first_name'] . ' ' . $row['last_name'];
                $dat = ['first' => $name];
                $id = ['ids' => $row['id']];
                Mail::send('org-invite/invite-email', ['data' => $dat, 'data2' => $id], function ($message) use ($email, $name) {
                    $message->to($email, $name)->subject
                        ('ByteCipher Pvt Ltd Interview Invitation Email');
                    $message->from('jharshita259@gmail.com', 'ByteCipher Pvt Ltd');
                });
            }

        }

        return redirect()->back()->with('message', 'Email Send with attachment. Check your inbox.');

    }

    public function getConfig(request $request)
    {

        $employee = Employee::join('company_employee','company_employee.employee_id','=','employee.id')
                    ->where('company_employee.employee_id', decrypt($request->id))
                    ->where('company_employee.company_id', decrypt($request->companyId))->first();
        // $chcekEmployeeExist = CompanyEmployee::where('employee_id',decrypt($request->id))->first();
    //    dd($employee);
        if($employee->status == '2'){
            return view('org-invite/index', compact('employee'));
        }else{
            return redirect('/response_submited');
        }
    }

    public function getInviteEmployeeDetails(request $request, $id)
    {
        // dd($request->id);
       if($request->id){

            $employeeExists = (!empty(decrypt($request->id))) ? Employee::find(decrypt($request->id)) : false;
            $companyEmployeeExist = CompanyEmployee::where('employee_id',decrypt($request->id))->first();
            $qualificationExist = Empqualification::where('employee_id',decrypt($request->id))->first();
            $qualificationViewExist = Empqualification::where('employee_id',decrypt($request->id))->get();
            $workhistoryExists = Empworkhistory::where('employee_id',decrypt($request->id))->first();
            $workhistoryViewExist = Empworkhistory::where('employee_id',decrypt($request->id))->get();
            $employeeSkillsExists = Empskills:: where('employee_id',decrypt($request->id))->first();
            $employeeSkillsViewExists = Empskills:: where('employee_id',decrypt($request->id))->get();
            $employeeLanguageViewExists = Emplang:: where('employee_id',decrypt($request->id))->get();
            $employeeOfficials = Empofficial:: where('employee_id',decrypt($request->id))->first();
            $verificationData = Verification:: where('employee_id',decrypt($request->id))->where('verification_document_type','=','identity_document')->first();
            $qualificationStatus = Verification:: where('employee_id',decrypt($request->id))->where('verification_document_type','=','qualification_document')->first();
            $experienceStatus = Verification:: where('employee_id',decrypt($request->id))->where('verification_document_type','=','experience_document')->first();
       }

        return view('org-invite/basic-info',compact('employeeExists','companyEmployeeExist','qualificationExist','qualificationViewExist','workhistoryExists','workhistoryViewExist','employeeSkillsExists','employeeSkillsViewExists','employeeLanguageViewExists','employeeOfficials','verificationData','qualificationStatus','experienceStatus'));
    }

    public function inviteEmployeeForm(request $request)
    {

        if(!empty($request->employee_id)){

          $updateInfo = DB::table('company_employee')->where('employee_id', decrypt($request->employee_id))
            ->update([
                  'status' => '1',
              ]);

           return redirect('/success');
        }
    }
     
    public function getInviteDetails(request $request)
    {

        //For Update Basic Information
        if (isset($_POST['basic-edit'])) {

            if ($request->file('profile')) {
                $file = $request->file('profile');
                $filename = $file->getClientOriginalName();
                $file->move(public_path() . '/Image/', $filename);
                $basic_info['profile'] = $filename;
            } else {
                $image = DB::table('employee')->where('id', $request->id)->first();
                $filename = $image->profile;
                // print_r($image->profile);die();
            }
            $basic_info = DB::table('employee')->where('id', $request->id)
                ->update([
                    'first_name' => !empty($request->first_name) ? $request->first_name : null,
                    'last_name' => !empty($request->last_name) ? $request->last_name : null,
                    'middle_name' =>!empty($request->middle_name) ? $request->middle_name : null,
                    'email' =>!empty($request->email) ? $request->email : null,
                    'profile' => $filename,
                    'phone' =>!empty($request->phone) ? $request->phone : null,
                    'dob' => !empty($request->dob) ? $request->dob : null,
                    'blood_group' => !empty($request->blood_group) ? $request->blood_group : null,
                    'gender' => !empty($request->gender) ? $request->gender : null,
                    'marital_status' =>!empty($request->marital_status) ? $request->marital_status : null,
                    'current_address' => !empty($request->current_address) ? $request->current_address : null,
                    'permanent_address' => !empty($request->permanent_address) ? $request->permanent_address : null,
                    'emg_name' =>!empty($request->emg_name) ? $request->emg_name : null,
                    'emg_relationship' => !empty($request->emg_relationship) ? $request->emg_relationship : null,
                    'emg_phone' => !empty($request->emg_phone) ? $request->emg_phone : null,
                    'emg_address' => !empty($request->emg_address) ? $request->emg_address : null,
                    'status' => '1',
                ]);

            return redirect()->back()->with('tabs-1_active', true)->with('message', 'Infomation updated successfully.');

        }

        if (isset($_POST['identity'])) {

            $request->validate([
                'id_type' => ['required', 'string', 'max:255'],
                'id_number' => ['required', 'string', 'max:255'],
                //  'verification_type' => ['required', 'string', 'max:255'],
                // 'document' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']
            ]);

            $basicInfo = Employee::where('id', $request->id)->first();
            // print_r($basicInfo);die();
            $employee_ident = new Employeeidentity();
            $employee_ident->employee_id = $basicInfo->id;
            $employee_ident->id_type =  !empty($request->id_type) ? $request->id_type : null;
            $employee_ident->id_number = !empty($request->id_number) ? $request->id_number : null;
            $employee_ident->document = !empty($request->document) ? $request->document : null;
            $employee_ident->verification_type = 'Not Verified';

            if ($request->has('document')) {
                $image = $request->file('document');
                $employee_ident->document = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }

            $employee_ident->save();

            $official = new Empofficial();
            $official->employee_id=$basicInfo->id;
            $official->save();

            $identityinfo = Empqualification::where('employee_id', $request->id)->first();
            if (empty($identityinfo)) {

                $basic = Employeeidentity::where('employee_id', $request->id)->first();
                $id = $basic->employee_id;

                return redirect('basic-info/' . $id)->with('tabs-2_active', true);

            } else {
                return redirect()->back()->with('tabs-2_active', true);
            }

            return redirect()->back();

        }

        if (isset($_POST['qulification'])) {

            $request->validate([
                'inst_name' => ['required', 'string', 'max:255'],
                'degree' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:255'],
                'duration_from' => ['required'],
                'duration_to' => ['required'],
                //  'verification_type' => ['required','string', 'max:255'],
                // 'document' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']

            ]);

            $identity_id = Employee::where('id', $request->id)->first();
            $emp_qualf = new Empqualification();
            $emp_qualf->employee_id = $identity_id->id;
            $emp_qualf->inst_name = $request->input('inst_name');
            $emp_qualf->degree = $request->input('degree');
            $emp_qualf->subject = $request->input('subject');
            $emp_qualf->duration_from = $request->input('duration_from');
            $emp_qualf->duration_to = $request->input('duration_to');
            $emp_qualf->document = $request->input('document');
            $emp_qualf->verification_type = 'Not Verified';

            if ($request->has('document')) {
                $image = $request->file('document');
                $emp_qualf->document = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }

            $emp_qualf->save();

            $qualifinfo = Empworkhistory::where('employee_id', $request->id)->first();
            if (empty($qualifinfo)) {

                $qual = Empqualification::where('employee_id', $request->id)->first();
                $id = $qual->employee_id;
                return redirect('basic-info/' . $id)->with('tabs-3_active', true);
            } else {
                return redirect()->back()->with('tabs-3_active', true);
            }

            return redirect()->back();
        }

        if (isset($_POST['workhistory'])) {

            $request->validate([
                'com_name' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'work_duration_to' => ['required'],
                'work_duration_from' => ['required'],
                //  'verification_type' => ['required','string', 'max:255'],
                // 'offer_letter' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048'],
                // 'exp_letter' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048'],
                // 'salary_slip' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']

            ]);

            $identity_id = Employee::where('id', $request->id)->first();
            $emp_work = new Empworkhistory();
            $emp_work->employee_id = $identity_id->id;
            $emp_work->com_name = $request->input('com_name');
            $emp_work->designation = $request->input('designation');
            $emp_work->offer_letter = $request->input('offer_letter');
            $emp_work->work_duration_from = $request->input('work_duration_from');
            $emp_work->work_duration_to = $request->input('work_duration_to');
            $emp_work->exp_letter = $request->input('exp_letter');
            $emp_work->salary_slip = $request->input('salary_slip');
            $emp_work->verification_type = 'Not Verified';

            if ($request->has('offer_letter')) {
                $image = $request->file('offer_letter');
                $emp_work->offer_letter = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }
            if ($request->has('exp_letter')) {
                $image = $request->file('exp_letter');
                $emp_work->exp_letter = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }
            if ($request->has('salary_slip')) {
                $image = $request->file('salary_slip');
                $emp_work->salary_slip = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }

            $emp_work->save();
            $workinfo = Empskills::where('employee_id', $request->id)->first();
            if (empty($workinfo)) {

                $work = Empworkhistory::where('employee_id', $request->id)->first();
                $id = $work->employee_id;
                // $table=$basic->getTable();
                // return view('admin/basic-info/'.$id ,compact('basic'));
                return redirect('basic-info/' . $id)->with('tabs-4_active', true);

            } else {
                // return redirect()->back();
                return redirect()->back()->with('tabs-4_active', true);
            }
            return redirect()->back();

        }

        if (isset($_POST['workskill'])) {

            // $request->validate([
            //     'skill' => ['required', 'string', 'max:255'],
            //     'lang' => ['required', 'string', 'max:255'],
            // ]);
            $identity_id = Employee::where('id', $request->id)->first();
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

            $officialData = Empofficial::where('employee_id', $request->id)->first();
            if (empty($officialData)) {

                $skill = Empskills::where('employee_id', $request->id)->first();
                $id = $skill->employee_id;
                return redirect('basic-info/' . $id)->with('tabs-5_active', true);

            } else {
                return redirect()->back()->with('tabs-5_active', true);
            }

            return redirect()->back();
        }

        if (isset($_POST['submit'])) {
            $identity = Employeeidentity::where('employee_id', $request->id)->first();
            $quali = Empqualification::where('employee_id', $request->id)->first();
            $skills = Empskills::where('employee_id', $request->id)->first();
            $work = Empworkhistory::where('employee_id', $request->id)->first();
            if (empty($identity) || empty($quali) || empty($work) || empty($skills)) {
                return redirect()->back()->with('tabs-2_active', true);
            } else {
                return redirect('confirmation');
            }

        }

    }

}
