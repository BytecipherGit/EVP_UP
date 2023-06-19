<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Empofficial;
use App\Models\Empworkhistory;
use App\Models\Employeeidentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Session;

class IndividualEmployeeController extends Controller
{
   
    public function index(request $request)
    {
        $employeeID = Auth::guard('employee')->user()->id;
       
     if (!empty($employeeID)) {
            $employee = Employee::where('id',$employeeID)->first();
            $employeeInfo = Empofficial::where('employee_id',$employeeID)->first();
            $workHistory = Empworkhistory::where('employee_id',$employeeID)->first();
            $workExperiences = Empworkhistory::where('employee_id',$employeeID)->get();
            $employeeidentity = Employeeidentity::where('employee_id',$employeeID)->first();

            return view('individualEmployee/employee_form',compact('employee','employeeInfo','workHistory','employeeidentity','workExperiences'));

        } else {
            return Response::json(['success' => '0']);
        }
       
    }

    public function updateDetails(request $request)
    {

        $employeeID = Auth::guard('employee')->user()->id;
       
        if (!empty($employeeID)) {

            $validator = Validator::make($request->all(), [
                'emg_name' => 'required|string|max:255',
                'emg_relationship' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {
                if($employeeID){
                    $update = [
                        'dob'=>!empty($request->dob) ? $request->dob : null,
                        'blood_group'=>!empty($request->blood_group) ? $request->blood_group : null,
                        'phone'=>!empty($request->phone) ? $request->phone : null,
                        'gender'=>!empty($request->gender) ? $request->gender : null,
                        'marital_status'=>!empty($request->marital_status) ? $request->marital_status : null,
                        'current_address'=>!empty($request->current_address) ? $request->current_address : null,
                        'permanent_address'=>!empty($request->permanent_address) ? $request->permanent_address : null,
                        'emg_name'=>!empty($request->emg_name) ? $request->emg_name : null,
                        'emg_relationship'=>!empty($request->emg_relationship) ? $request->emg_relationship : null,
                        'emg_phone'=>!empty($request->emg_phone) ? $request->emg_phone : null,
                        'emg_address'=>!empty($request->emg_address) ? $request->emg_address : null,
                    ];
                    $employeeData = Employee::where('id',$employeeID)->update($update);
// dd($employeeData);
                    if (!empty($employeeData)) {
                        // return Response::json(['success' => '1']);
                        return redirect('employee_login/dashboard')->with('message','Information added successfully');

                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }
    }

    public function uploadOccupation(request $request)
    {

        $employeeID = Auth::guard('employee')->user()->id;
       
        if (!empty($employeeID)) {

            $validator = Validator::make($request->all(), [
                // 'emg_name' => 'required|string|max:255',
                // 'emg_relationship' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {

                if($employeeID){

                    $chcekDataExist = Empofficial::where('employee_id',$employeeID)->first();

                if($chcekDataExist){
                      $update = [

                        'date_of_joining'=>!empty($request->date_of_joining) ? $request->date_of_joining : null,
                        'work_location'=>!empty($request->work_location) ? $request->work_location : null,
                        'designation'=>!empty($request->designation) ? $request->designation : null,
                      
                      ];
    
                      $employeeData = Empofficial::where('employee_id',$employeeID)->update($update);
                    }
                     else{

                        $insert = [

                            'employee_id'=> $employeeID,
                            'emp_type'=>!empty($request->emp_type) ? $request->emp_type : null,
                            'work_location'=>!empty($request->work_location) ? $request->work_location : null,
                            'emp_status'=>!empty($request->emp_status) ? $request->emp_status : '0',
                            'lpa'=>!empty($request->lpa) ? $request->lpa : null,
                            'date_of_joining'=>!empty($request->date_of_joining) ? $request->date_of_joining : null,
                            'designation'=>!empty($request->designation) ? $request->designation : null,

                         ];

                         $employeeData = Empofficial::create($insert);

                    //    dd($officialData);
                    }
                   
  
                    if (!empty($employeeData)) {
                        // return Response::json(['success' => '1']);
                        return redirect('employee_login/dashboard/occupation')->with('message','Information added successfully');
                        // return redirect()->back()->with('message','Information added successfully');

                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }
    }


    public function experienceForm(request $request)
    {

        $employeeID = Auth::guard('employee')->user()->id;
        $employeeEmpCode = Auth::guard('employee')->user()->empCode;
       
        if (!empty($employeeID)) {

            $validator = Validator::make($request->all(), [
                // 'emg_name' => 'required|string|max:255',
                // 'emg_relationship' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {

                if($employeeID){

                    $uploadOfferDocument = '';
                    $uploadExperienceDocument = '';
                    $uploadSalaryDocument = '';
   
                   if ($request->hasFile('offer_letter')) {
                     $file = $request->file('offer_letter');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadOfferDocument = asset('storage/employee/documents/' . $fileName);
                      }
   
                   if ($request->hasFile('exp_letter')) {
                     $file = $request->file('exp_letter');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadExperienceDocument = asset('storage/employee/documents/' . $fileName);
                      }
   
                   if ($request->hasFile('salary_slip')) {
                     $file = $request->file('salary_slip');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadSalaryDocument = asset('storage/employee/documents/' . $fileName);
                      }
   

                            $insert = [

                                'employee_id'=>$employeeID,
                                'com_name'=>!empty($request->com_name) ? $request->com_name : null,
                                'designation'=>!empty($request->designation) ? $request->designation : null,
                                'work_duration_from'=>!empty($request->work_duration_from) ? $request->work_duration_from : null,
                                'work_duration_to'=>!empty($request->work_duration_to) ? $request->work_duration_to : null,
                                'offer_letter'=>$uploadOfferDocument,
                                'exp_letter'=>$uploadExperienceDocument,
                                'salary_slip'=>$uploadSalaryDocument,
                        ];

                        $workhistoryData = Empworkhistory::create($insert);
                            
            //  dd($workhistoryData);
                    if (!empty($workhistoryData)) {
                        // return Response::json(['success' => '1']);
                        return redirect('employee_login/dashboard/experience')->with('message','Information added successfully');
                        // return redirect()->back()->with('message','Information added successfully');

                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }
    }

    public function updateEmployeeExperience(request $request)

    {

     $employeeID = Auth::guard('employee')->user()->id;
     $employeeEmpCode = Auth::guard('employee')->user()->empCode;

     if (!empty($employeeID)) {

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
            ]);

            $workhistoryDetails = Empworkhistory::where('id',$request->id)->first();

            if ($validator->passes()) {
                
                    $uploadOfferDocument = '';
                    $uploadExperienceDocument = '';
                    $uploadSalaryDocument = '';
   
                   if ($request->hasFile('offer_letter')) {
                     $file = $request->file('offer_letter');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadOfferDocument = asset('storage/employee/documents/' . $fileName);
                      }
   
                   if ($request->hasFile('exp_letter')) {
                     $file = $request->file('exp_letter');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadExperienceDocument = asset('storage/employee/documents/' . $fileName);
                      }
   
                   if ($request->hasFile('salary_slip')) {
                     $file = $request->file('salary_slip');
                     $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                     $file->storeAs('public/employee/documents', $fileName);
                     $uploadSalaryDocument = asset('storage/employee/documents/' . $fileName);
                      }
            


                    $employeeWorkhistoryData = Empworkhistory::where('id',$request->id)->first();
                    $update = [

                        'employee_id'=>$employeeID,
                        'com_name'=>!empty($request->com_name) ? $request->com_name : null,
                        'designation'=>!empty($request->designation) ? $request->designation : null,
                        'offer_letter'=>!empty($uploadOfferDocument) ? $uploadOfferDocument : $employeeWorkhistoryData->offer_letter, 
                        'work_duration_from'=>!empty($request->work_duration_from) ? $request->work_duration_from : null,
                        'work_duration_to'=>!empty($request->work_duration_to) ? $request->work_duration_to : null,
                        'exp_letter'=>!empty($uploadExperienceDocument) ? $uploadExperienceDocument : $employeeWorkhistoryData->exp_letter, 
                        'salary_slip'=>!empty($uploadSalaryDocument) ? $uploadSalaryDocument : $employeeWorkhistoryData->salary_slip,

                    ];

                    $workhistoryData = Empworkhistory::where('id',$request->id)->update($update);

                    if (!empty($workhistoryData)) {
      
                        return redirect('employee_login/dashboard/experience')->with('message','Information added successfully');
              
                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }

        } else{
            return Response::json(['success' => '0']);
        }

    }

    public function uploadDocuments(request $request)
    {

        $employeeID = Auth::guard('employee')->user()->id;
        $employeeEmpCode = Auth::guard('employee')->user()->empCode;

        if (!empty($employeeID)) {

            $validator = Validator::make($request->all(), [
                // 'emg_name' => 'required|string|max:255',
                // 'emg_relationship' => 'required|string|max:255',
            ]);
            if ($validator->passes()) {

                if($employeeID){
                $experienceExist = Employee::where('id',$employeeID)->first();
                    $uploadPanCardId = '';
                    $uploadAadharCardId = '';
                    $uploadPassportId = '';

                    if ($request->hasFile('pan_card_id')) {
                        $file = $request->file('pan_card_id');
                        $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                        $file->storeAs('public/employee/employee_document', $fileName);
                        $uploadPanCardId = asset('storage/employee/employee_document/' . $fileName);
                        }
            
                        if ($request->hasFile('aadhar_card_id')) {
                            $file = $request->file('aadhar_card_id');
                            $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                            $file->storeAs('public/employee/employee_document', $fileName);
                            $uploadAadharCardId = asset('storage/employee/employee_document/' . $fileName);
                        }
            
                        if ($request->hasFile('passport_id')) {
                                $file = $request->file('passport_id');
                                $fileName = time() . '_' . $employeeEmpCode .'_'. $file->getClientOriginalName();
                                $file->storeAs('public/employee/employee_document', $fileName);
                                $uploadPassportId = asset('storage/employee/employee_document/' . $fileName);
                        }

                      $update = [

                        'pan_card'=>'Pan Card',
                        'pan_card_id'=>!empty($uploadPanCardId) ? $uploadPanCardId : $experienceExist->pan_card_id,
                        'pan_card_number'=>!empty($request->pan_card_number) ? $request->pan_card_number : null,
                        'aadhar_card'=>'Aadhar Card',
                        'aadhar_card_id'=>!empty($uploadAadharCardId) ? $uploadAadharCardId : $experienceExist->aadhar_card_id,
                        'aadhar_card_number'=>!empty($request->aadhar_card_number) ? $request->aadhar_card_number : null,
                        'passport'=>'Passport',
                        'passport_id'=>!empty($uploadPassportId) ? $uploadPassportId : $experienceExist->passport_id,
                        'passport_number'=>!empty($request->passport_number) ? $request->passport_number : null,
                      
                      ];
    
                    $employeeData = Employee::where('id',$employeeID)->update($update);
                    // dd($employeeData);
                    }
  
                    if (!empty($employeeData)) {
                        // return Response::json(['success' => '1']);
                        return redirect('employee_login/dashboard/documents')->with('message','Information added successfully');
                        // return redirect()->back()->with('message','Information added successfully');

                    } else {
                        return Response::json(['success' => '0']);
                    }
                } else {
                    return Response::json(['success' => '0']);
                }
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }
    

    public function changePassword(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->validate($request, [
                'old' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);
            $employeeID = Auth::guard('employee')->user()->id;

            $employee = Employee::find($employeeID);
            $hashedPassword = $employee->password;

            if (Hash::check($request->old, $hashedPassword)) {
                //Change the password
                $employee->fill([
                    'password' => Hash::make($request->password),
                ])->save();

                $request->session()->flash('success', 'Password successfully updated.');

                return back();
            }

            $request->session()->flash('failure', 'Password not change.');

            return back();
        } else {
            return view('individualEmployee.changePassword');
        }

    }

}
