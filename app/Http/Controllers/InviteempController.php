<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employeeidentity;
use App\Models\Empofficial;
use App\Models\Empqualification;
use App\Models\Empskills;
use App\Models\Empworkhistory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Redirect;
use Response;

class InviteempController extends Controller
{

    public function index()
    {
        $empinvite = Employee::where('status', '2')->where('company_id', Auth::id())->get();
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
        return redirect('invite-employee')->with('message', 'Employee Delete Successfully.');
    }

    public function geteditInvite(request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:12'],

        ]);
        $data = DB::table('emp_basicinfo')->where('id', $request->id)
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),

            ]);

        return redirect('invite-employee')->with('message', 'Infomation Updated Successfully.');

    }

    public function getInviteEmp(request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:12'],

        ]);

        $employee = new Employee();

        $employee->first_name = $request->input('first_name');
        $employee->company_id = Auth::id();
        $employee->middle_name = $request->input('middle_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->status = '2';

        $employee->save();
        return redirect('invite-employee');
    }

    public function getCsvInvite(Request $request)
    {

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

                $info = new Employee;
                $info->first_name = $data['first_name'];
                $info->last_name = $data['last_name'];
                $info->company_id = Auth::id();
                $info->middle_name = $data['middle_name'];
                $info->email = $data['email'];
                $info->phone = $data['phone'];
                $info->status = '2';
                $info->save();

            }

            // print_r($information);die();
            return redirect()->back()->with('message', 'Upload successfully');
        } else {
            return redirect()->back()->with('message', 'Not selected any File To Upload');

        }
    }

    public function exportsCSVInvite(Request $request)
    {
        $fileName = 'invite_employee.csv';
        $employee = Employee::all();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $columns = array('First Name', 'Last Name', 'Middle Name', 'Email', 'Phone');
        $callback = function () use ($employee, $columns) {
            $file = fopen('php://output', 'w');
            //
            fputcsv($file, $columns);
            // print_r($columns);die();
            foreach ($employee as $task) {
                $row['First Name'] = $task->first_name;
                $row['Last Name'] = $task->last_name;
                $row['Middle Name'] = $task->middle_name;
                $row['Email'] = $task->email;
                $row['Phone'] = $task->phone;

                fputcsv($file, array($row['First Name'], $row['Last Name'], $row['Middle Name'], $row['Email'], $row['Phone']));
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

    public function downloadQualDoc(request $request)
    {
        $data = Empqualification::where('emp_id', $request->id)->first();
        $file = public_path() . '/image/' . $data->document;
        $headers = array(
            'Content-Type: application/jpg',
        );

        return Response::download($file, 'qualification.jpg', $headers);
    }

    public function downloadOfferDoc(request $request)
    {
        $work = Empworkhistory::where('emp_id', $request->id)->first();
        $file = public_path() . '/image/' . $work->offer_letter;
        $headers = array(
            'Content-Type: application/jpg',
        );

        return Response::download($file, 'Offer Letter.jpg', $headers);
    }

    public function downloadIdDoc(request $request)
    {
        $identity = Employeeidentity::where('emp_id', $request->id)->first();
        $file = public_path() . '/image/' . $identity->document;
        $headers = array(
            'Content-Type: application/jpg',
        );

        return Response::download($file, 'Employee Id.jpg', $headers);
    }

    public function downloadExpDoc(request $request)
    {
        $data = Empworkhistory::where('emp_id', $request->id)->first();
        $file = public_path() . '/image/' . $data->exp_letter;
        $headers = array(
            'Content-Type: application/jpg',
        );

        return Response::download($file, 'Exp. Letter.jpg', $headers);
    }

    public function sendInvidationToEmployee(request $request)
    {

        $temp = array();
        $users_id = $request->id;
        if (is_array($users_id)) {
            foreach ($users_id as $key => $ids) {
                $temp[] = $ids;
            }
        }
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
        $empid = Employee::where('id', $request->id)->first();
        return view('org-invite/index', compact('empid'));
    }

    public function getBasicDetails(request $request, $id)
    {

        $basic = Employee::where('id', $request->id)->first();
        $identity = Employeeidentity::where('emp_id', $request->id)->get();
        $ident = Employeeidentity::where('emp_id', $request->id)->first();
        $qualification = Empqualification::where('emp_id', $request->id)->get();
        $quali = Empqualification::where('emp_id', $request->id)->first();
        $workhistory = Empworkhistory::where('emp_id', $request->id)->get();
        $workh = Empworkhistory::where('emp_id', $request->id)->first();
        $skills = Empskills::where('emp_id', $request->id)->first();
        $official = Empofficial::where('emp_id', $request->id)->first();

        return view('org-invite/basic-info', compact('basic', 'identity', 'qualification', 'ident', 'workhistory', 'quali', 'workh', 'skills', 'official'));
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
                $image = DB::table('emp_basicinfo')->where('id', $request->id)->first();
                $filename = $image->profile;
                // print_r($image->profile);die();
            }
            $basic_info = DB::table('emp_basicinfo')->where('id', $request->id)
                ->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'middle_name' => $request->input('middle_name'),
                    'email' => $request->input('email'),
                    'profile' => $filename,
                    'phone' => $request->input('phone'),
                    'dob' => $request->input('dob'),
                    'blood_group' => $request->input('blood_group'),
                    'gender' => $request->input('gender'),
                    'marital_status' => $request->input('marital_status'),
                    'current_address' => $request->input('current_address'),
                    'permanent_address' => $request->input('permanent_address'),
                    'emg_name' => $request->input('emg_name'),
                    'emg_relationship' => $request->input('emg_relationship'),
                    'emg_phone' => $request->input('emg_phone'),
                    'emg_address' => $request->input('emg_address'),
                    'status' => '1',
                ]);

            return redirect()->back()->with('tabs-1_active', true)->with('message', 'Infomation Updated Successfully.');

        }

        if (isset($_POST['identity'])) {

            $request->validate([
                'id_type' => ['required', 'string', 'max:255'],
                'id_number' => ['required', 'string', 'max:255'],
                //  'verification_type' => ['required', 'string', 'max:255'],
                // 'document' => ['required','file','mimes:jpeg,png,pdf,docs,doc','max:2048']
            ]);

            $basic_id = Employee::where('id', $request->id)->first();
            // print_r($basic_id);die();
            $emp_ident = new Employeeidentity();
            $emp_ident->emp_id = $basic_id->id;
            $emp_ident->id_type = $request->input('id_type');
            $emp_ident->id_number = $request->input('id_number');
            $emp_ident->document = $request->input('document');
            $emp_ident->verification_type = 'Not Verified';

            if ($request->has('document')) {
                $image = $request->file('document');
                $emp_ident->document = $image->getClientOriginalName();
                $image->move(public_path('/Image'), $image->getClientOriginalName());
            }

            $emp_ident->save();
            $identityinfo = Empqualification::where('emp_id', $request->id)->first();
            if (empty($identityinfo)) {

                $basic = Employeeidentity::where('emp_id', $request->id)->first();
                $id = $basic->emp_id;

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
            $emp_qualf->emp_id = $identity_id->id;
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

            $qualifinfo = Empworkhistory::where('emp_id', $request->id)->first();
            if (empty($qualifinfo)) {

                $qual = Empqualification::where('emp_id', $request->id)->first();
                $id = $qual->emp_id;
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
            $emp_work->emp_id = $identity_id->id;
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
            $workinfo = Empskills::where('emp_id', $request->id)->first();
            if (empty($workinfo)) {

                $work = Empworkhistory::where('emp_id', $request->id)->first();
                $id = $work->emp_id;
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

            $request->validate([
                'skill' => ['required', 'string', 'max:255'],
                'lang' => ['required', 'string', 'max:255'],
            ]);
            $identity_id = Employee::where('id', $request->id)->first();
            $emp_skill = new Empskills();
            $emp_skill->emp_id = $identity_id->id;
            $emp_skill->skill = $request->input('skill');
            $emp_skill->skill_type = $request->input('skill_type');
            $emp_skill->lang = $request->input('lang');
            $emp_skill->lang_type = $request->input('lang_type');

            $emp_skill->save();
            $official = Empofficial::where('emp_id', $request->id)->first();
            if (empty($official)) {

                $skill = Empskills::where('emp_id', $request->id)->first();
                $id = $skill->emp_id;
                // $table=$basic->getTable();
                // return view('admin/basic-info/'.$id ,compact('basic'));
                return redirect('basic-info/' . $id)->with('tabs-5_active', true);

            } else {
                return redirect()->back()->with('tabs-5_active', true);
            }

            return redirect()->back();
        }

        if (isset($_POST['submit'])) {
            $identity = Employeeidentity::where('emp_id', $request->id)->first();
            $quali = Empqualification::where('emp_id', $request->id)->first();
            $skills = Empskills::where('emp_id', $request->id)->first();
            $work = Empworkhistory::where('emp_id', $request->id)->first();
            if (empty($identity) || empty($quali) || empty($work) || empty($skills)) {
                return redirect()->back()->with('tabs-2_active', true)->with('msg', 'Please ');
            } else {
                return redirect('confirmation');
            }

        }

    }

}
