<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Employeeidentity;
use App\Models\Empqualification;
use App\Models\Empworkhistory;
use App\Models\Empskills;
use App\Models\Empofficial;
use App\Models\Exitemp;
use App\Models\EmployeeTest;
use App\Models\User;
use App\Models\CompanyEmployee;
use App\Models\Emplang;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Redirect;


class NewEmployeeController extends Controller
{

    public function index(request $request)
    {
      
        $employeeExists = (!empty($request->id)) ? Employee::find($request->id) : false;
        $qualificationExist = Empqualification::where('employee_id',$request->id)->first();
        $qualificationViewExist = Empqualification::where('employee_id',$request->id)->get();
        $workhistoryExists = Empworkhistory::where('employee_id',$request->id)->first();
        $workhistoryViewExist = Empworkhistory::where('employee_id',$request->id)->get();
        $employeeSkillsExists = Empskills:: where('employee_id',$request->id)->first();
        $employeeSkillsViewExists = Empskills:: where('employee_id',$request->id)->get();
        $employeeLanguageViewExists = Emplang:: where('employee_id',$request->id)->get();
        $employeeOfficials = Empofficial:: where('employee_id',$request->id)->first();

        return view('employees/add_employee',compact('employeeExists','qualificationExist','qualificationViewExist','workhistoryExists','workhistoryViewExist','employeeSkillsExists','employeeSkillsViewExists','employeeLanguageViewExists','employeeOfficials'));
    }

    public function createEmployee(request $request)
    {
        if (Auth::check()) {
            // $userDetails = HelpersHelper::getUserDetails(Auth::id());
            $validator = Validator::make($request->all(), [
                // 'first_name' => 'required|string|max:255',
                // 'last_name' => 'required|string|max:255',
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
    
           

             $empCode = substr(time(), -6) . sprintf('%04d', rand(0, 9999));
            if ($validator->passes()) {

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
                    $insert = [
                        'first_name' =>!empty($request->first_name) ? $request->first_name : null,
                        'profile' => $uploadProfile, 
                        'empCode' => $empCode,
                        'last_name'=>!empty($request->last_name) ? $request->last_name : null,
                        'middle_name'=>!empty($request->middle_name) ? $request->middle_name : null,
                        'email'=>!empty($request->email) ? $request->email : null,
                        'phone'=>!empty($request->phone) ? $request->phone : null,
                        'dob'=>!empty($request->dob) ? $request->dob : null,
                        'blood_group'=>!empty($request->blood_group) ? $request->blood_group : null,
                        'gender'=>!empty($request->gender) ? $request->gender : null,
                        'marital_status'=>!empty($request->marital_status) ? $request->marital_status : null,
                        'current_address'=>!empty($request->current_address) ? $request->current_address : null,
                        'permanent_address'=>!empty($request->permanent_address) ? $request->permanent_address : null,
                        'emg_name'=>!empty($request->emg_name) ? $request->emg_name : null,
                        'emg_relationship'=>!empty($request->emg_relationship) ? $request->emg_relationship : null,
                        'emg_phone'=>!empty($request->emg_phone) ? $request->emg_phone : null,
                        'emg_address'=>!empty($request->emg_address) ? $request->emg_address : null,
                        'document_type'=>!empty($request->document_type) ? $request->document_type : null,
                        'document_id'=>!empty($request->document_id) ? $request->document_id : null,
                        'document_number'=>!empty($request->document_number) ? $request->document_number : null,
                        'verification_type'=> $statusVerification,
                        'third_party_document'=>!empty($request->third_party_document) ? $request->third_party_document : null,
                        'third_party_verification'=> $statusThirdPartyVerification,
                    ];

                    $employee = Employee::create($insert);


                    if (!empty($employee)) {
                        
                        $employeeData = Employee::where('empCode',$empCode)->first();

                        if (!empty($employeeData)) {
                         $insertCompanyEmployee = [
                           'employee_id' => $employeeData->id,
                           'company_id' => Auth::id(),
                           'status' => '1',
                       ];
                        $companyemployeeData = CompanyEmployee::create($insertCompanyEmployee);
                        }

                     return redirect('employee_info/'.$employee->id.'/qualification')->with('message','Information added successfully');

                    } else {
                        return Response::json(['success' => '0']);
                    }

             
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        }

    }

    public function updateEmployee(request $request)
    {

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
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
          

            if ($validator->passes()) {

                $statusVerifications = '';
                if (!empty($request->verification_type) && $request->verification_type == true) {
                    
                    $statusVerifications = 1;
                } else {      
                    $statusVerifications = 0;
                }
        
                $statusThirdPartyVerifications = '';
                if (!empty($request->third_party_verification) && $request->third_party_verification == true) {
                    $statusThirdPartyVerifications = 1;
            
                } else {
                    $statusThirdPartyVerifications = 0;
                }

                if($request->employee_id){

                    $emplotyeeUpdate = Employee::where('id', $request->employee_id)
                    ->update([

                        'first_name' =>!empty($request->first_name) ? $request->first_name : null,
                        'profile' => $uploadProfile,
                        'last_name'=>!empty($request->last_name) ? $request->last_name : null,
                        'middle_name'=>!empty($request->middle_name) ? $request->middle_name : null,
                        'email'=>!empty($request->email) ? $request->email : null,
                        'phone'=>!empty($request->phone) ? $request->phone : null,
                        'dob'=>!empty($request->dob) ? $request->dob : null,
                        'blood_group'=>!empty($request->blood_group) ? $request->blood_group : null,
                        'gender'=>!empty($request->gender) ? $request->gender : null,
                        'marital_status'=>!empty($request->marital_status) ? $request->marital_status : null,
                        'current_address'=>!empty($request->current_address) ? $request->current_address : null,
                        'permanent_address'=>!empty($request->permanent_address) ? $request->permanent_address : null,
                        'emg_name'=>!empty($request->emg_name) ? $request->emg_name : null,
                        'emg_relationship'=>!empty($request->emg_relationship) ? $request->emg_relationship : null,
                        'emg_phone'=>!empty($request->emg_phone) ? $request->emg_phone : null,
                        'emg_address'=>!empty($request->emg_address) ? $request->emg_address : null,
                        'document_type'=>!empty($request->document_type) ? $request->document_type : null,
                        'document_id'=>!empty($request->document_id) ? $request->document_id : null,
                        'document_number'=>!empty($request->document_number) ? $request->document_number : null,
                        'verification_type'=> $statusVerifications,
                        'third_party_document'=>!empty($uploadThirdPartyDocument) ? $uploadThirdPartyDocument : null,
                        'third_party_verification'=> $statusThirdPartyVerifications,

                    ]);

                    if (!empty($emplotyeeUpdate)) {

                        return redirect('employee_info/'.$request->employee_id)->with('message','Information added successfully');
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
       
        
    return Response::json(['success' => '1']);
    }

    public function createEmployeeQualification(request $request)
    {
        // dd($request->all());
    
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'inst_name' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
                
            ]);

            $employeeDetails = Employee::where('id',$request->employee_id)->first();

            if(!empty($employeeDetails)){
                if ($validator->passes()) {

                    $uploadDocument = '';           
                    $uploadThirdPartyDocument = '';


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

                        $insert = [

                            'employee_id'=> $employeeDetails->id,
                            'inst_name'=>!empty($request->inst_name) ? $request->inst_name : null,
                            'degree'=> !empty($request->degree) ? $request->degree : null,
                            'subject'=> !empty($request->subject) ? $request->subject : null,
                            'duration_from'=> !empty($request->duration_from) ? $request->duration_from : null,
                            'duration_to'=>!empty($request->duration_to) ? $request->duration_to : null,
                            'document'=> $uploadDocument,
                            'qualification_verification_type'=> $statusVerification,
                            'third_party_qualification_document'=> $uploadThirdPartyDocument,
                            'third_party_qualification_verification'=> $statusThirdPartyVerification,
                    
            
                        ];

                        $qualificationData = Empqualification::create($insert);

                        // return redirect('employee/form/'.$employee->id.'/#qualification');

                        if (!empty($qualificationData)) {
                            return redirect('employee_info/'.$request->employee_id.'/qualification');
                        } else {
                            return Response::json(['success' => '0']);
                        }        
                } else {
                    return Response::json(['errors' => $validator->errors()]);
                }
            }
            else{
                return Response::json(['success' => '0']);
            }

        }

    }

    public function updateEmployeeQualification(request $request)
    {

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
            ]);

            $employeeDetails = Employee::where('id',$request->employee_id)->first();
            $qualificationDetails = Empqualification::where('id',$request->id)->first();

            if ($validator->passes()) {
                if($request->id){

                    $uploadDocument = '';           
                    $uploadThirdPartyDocument = '';


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

                    $update = [
                            'inst_name'=>!empty($request->inst_name) ? $request->inst_name : null,
                            'degree'=> !empty($request->degree) ? $request->degree : null,
                            'subject'=> !empty($request->subject) ? $request->subject : null,
                            'duration_from'=> !empty($request->duration_from) ? $request->duration_from : null,
                            'duration_to'=>!empty($request->duration_to) ? $request->duration_to : null,
                            'document'=> $uploadDocument,
                            'qualification_verification_type'=> $statusVerification,
                            'third_party_qualification_document'=> $uploadThirdPartyDocument,
                            'third_party_qualification_verification'=> $statusThirdPartyVerification,
                    ];

                    $qualificationData = Empqualification::where('id',$request->id)->update($update);

                    if (!empty($qualificationData)) {
                        return redirect('employee_info/'.$employeeDetails->id.'/qualification');
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

    public function createEmployeeWorkhistory(request $request)
    {

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
                
            ]);
            $employeeDetails = Employee::where('id',$request->employee_id)->first();

            if(!empty($employeeDetails)){
                if ($validator->passes()) {

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

                        $insert = [

                                'employee_id'=>$employeeDetails->id,
                                'com_name'=>!empty($request->com_name) ? $request->com_name : null,
                                'designation'=>!empty($request->designation) ? $request->designation : null,
                                'offer_letter'=>$uploadOfferDocument,
                                'work_duration_from'=>!empty($request->work_duration_from) ? $request->work_duration_from : null,
                                'work_duration_to'=>!empty($request->work_duration_to) ? $request->work_duration_to : null,
                                'exp_letter'=>$uploadExperienceDocument,
                                'salary_slip'=>$uploadSalaryDocument,
                                'workhistory_verification_type'=>$statusVerification,
                                'third_party_workhistory_document'=>$uploadThirdPartyDocument,
                                'third_party_workhistory_verification'=>$statusThirdPartyVerification,
                        ];

                        $workhistoryData = Empworkhistory::create($insert);

                        if (!empty($workhistoryData)) {

                            return redirect('employee_info/'.$employeeDetails->id.'/workhistory');

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
    }

    public function updateEmployeeWorkhistory(request $request)

    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
            ]);
            $employeeDetails = Employee::where('id',$request->employee_id)->first();
            $workhistoryDetails = Empworkhistory::where('id',$request->id)->first();

            if ($validator->passes()) {
                if($request->employee_id){

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
                    if (!empty($request->workhistory_verification_type) && $request->workhistory_verification_type == true) {
                        $statusVerification = 1;
                    } else {
                        $statusVerification = 0;
                    }
            
                    $statusThirdPartyVerification = '';
                    if (!empty($request->third_party_workhistory_verification) && $request->third_party_workhistory_verification == true) {
                        $statusThirdPartyVerification = 1;
                    } else {
                        $statusThirdPartyVerification = 0;
                    }

                    $update = [

                        'employee_id'=>$employeeDetails->id,
                        'com_name'=>!empty($request->com_name) ? $request->com_name : null,
                        'designation'=>!empty($request->designation) ? $request->designation : null,
                        'offer_letter'=>$uploadOfferDocument,
                        'work_duration_from'=>!empty($request->work_duration_from) ? $request->work_duration_from : null,
                        'work_duration_to'=>!empty($request->work_duration_to) ? $request->work_duration_to : null,
                        'exp_letter'=>$uploadExperienceDocument,
                        'salary_slip'=>$uploadSalaryDocument,
                        'workhistory_verification_type'=>$statusVerification,
                        'third_party_workhistory_document'=>$uploadThirdPartyDocument,
                        'third_party_workhistory_verification'=>$statusThirdPartyVerification,

                    ];

                    $workhistoryData = Empworkhistory::where('id',$request->id)->update($update);

                    if (!empty($workhistoryData)) {

                        return redirect('employee_info/'.$employeeDetails->id.'/workhistory');

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

    public function createEmployeeSkills(request $request)
    {

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                // 'title' => 'required|string|max:255',
                // 'descriptions' => 'required|string|max:255',
                
            ]);
            $employeeDetails = Employee::where('id',$request->employee_id)->first();
            $skillsExist = Empskills::where('employee_id',$request->employee_id)->first();
            $skillsLangExist = Emplang::where('employee_id',$request->employee_id)->first();
   
            if(!empty($employeeDetails)){
                if ($validator->passes()) {

                    for ($i=0; $i < count($request->skill); $i++) 
                    {   
                      $insertDataSkill = array(  
                        'employee_id' => $employeeDetails->id,
                        'skill' => $request->skill[$i],
                        'skill_type' => $request->skill_type[$i],

                        ); 
                        $skill = DB::table('employee_skills')->insert($insertDataSkill);  
                      }

                    for ($j=0; $j < count($request->lang); $j++) 
                    {   
                      $insertDatalang = array(  
                      'employee_id' => $employeeDetails->id,
                      'lang' =>  $request->lang[$j],
                      'lang_type' => $request->lang_type[$j],

                      ); 
                      
                     $language = DB::table('employee_language')->insert($insertDatalang);  
                  } 

                  return redirect('employee_info/'.$employeeDetails->id.'/skills');
                         
                } else {
                        return Response::json(['errors' => $validator->errors()]);
                    }

            } 
        }
    }

    public function addMoreEmployeeSkills(request $request)
    {

        $skillsExist = Empskills::where('employee_id',$request->employee_id)->first();
        $employeeDetails = Employee::where('id',$request->employee_id)->first();

         if(!empty($skillsExist)){
            $insert = [

                'employee_id'=> $employeeDetails->id,
                'skill'=>!empty($request->skill) ? $request->skill : null,
                'skill_type'=> !empty($request->skill_type) ? $request->skill_type : null,
              
            ];

            $skillsData = Empskills::create($insert);
          }

            return redirect('employee_info/'.$employeeDetails->id.'/skills');
    }

    public function addMorelangEmployeeSkills(request $request)
    {


        $skillsLangExist = Emplang::where('employee_id',$request->employee_id)->first();
        $employeeDetails = Employee::where('id',$request->employee_id)->first();
        
    if(!empty($skillsLangExist)){
        $insertLanguage = [

            'employee_id'=> $employeeDetails->id,
            'lang'=>!empty($request->lang) ? $request->lang : null,
            'lang_type'=> !empty($request->lang_type) ? $request->lang_type : null,
          
        ];

        $languageData = Emplang::create($insertLanguage);
    }

    return redirect('employee_info/'.$employeeDetails->id.'/skills');
  }

  public function createEmployeeOfficial(request $request)
  {

  // dd($request->all());
      if (Auth::check()) {
          $validator = Validator::make($request->all(), [
              // 'title' => 'required|string|max:255',
              // 'descriptions' => 'required|string|max:255',
              
          ]);

          $employeeDetails = Employee::where('id',$request->employee_id)->first();

          if(!empty($employeeDetails)){
              if ($validator->passes()) {

                      $insert = [

                        'employee_id'=>$employeeDetails->id,
                        'date_of_joining'=>!empty($request->date_of_joining) ? $request->date_of_joining : null,
                        'emp_type'=>!empty($request->emp_type) ? $request->emp_type : null,
                        'work_location'=>!empty($request->work_location) ? $request->work_location : null,
                        'emp_status'=> $request->emp_status,
                        'lpa'=>!empty($request->lpa) ? $request->lpa : null,
                        'designation'=>!empty($request->designation) ? $request->designation : null,

                      ];

                      $officialData = Empofficial::create($insert);
    //    dd($officialData);
                      if (!empty($officialData)) {
                          return redirect('employee');
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
  }

  public function updateEmployeeOfficial(request $request)
  {
    // dd($request->all());
      if (Auth::check()) {
          $validator = Validator::make($request->all(), [
              // 'title' => 'required|string|max:255',
              // 'descriptions' => 'required|string|max:255',
          ]);
          $employeeDetails = Employee::where('id',$request->employee_id)->first();

          if ($validator->passes()) {
              if($request->employee_id){

                  $update = [

                    'employee_id'=>$employeeDetails->id,
                    'date_of_joining'=>!empty($request->date_of_joining) ? $request->date_of_joining : null,
                    'emp_type'=>!empty($request->emp_type) ? $request->emp_type : null,
                    'work_location'=>!empty($request->work_location) ? $request->work_location : null,
                    'emp_status'=> $request->emp_status,
                    'designation'=>!empty($request->designation) ? $request->designation : null,
                    'lpa'=>!empty($request->lpa) ? $request->lpa : null,
                  
                  ];

                  $officialData = Empofficial::where('employee_id',$request->employee_id)->update($update);

                  if (!empty($officialData)) {

                      $officialEmpData = Empofficial::where('employee_id',$request->employee_id)->first();

                        CompanyEmployee::where('employee_id',$officialEmpData->employee_id)->update([
                            'start_date'  => $officialEmpData->date_of_joining,
                            'status' => $officialEmpData->emp_status
                          ]);
                          
                      return redirect('employee');

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

  public function updateLanguage(request $request)
  {
    // dd($request->all());
      if (Auth::check()) {
          $validator = Validator::make($request->all(), [
              // 'title' => 'required|string|max:255',
              // 'descriptions' => 'required|string|max:255',
          ]);
          $employeeDetails = Employee::where('id',$request->employee_id)->first();

          if ($validator->passes()) {
              if($request->employee_id){

                  $update = [

                    'lang'=>!empty($request->lang) ? $request->lang : null,
                    'lang_type'=> !empty($request->lang_type) ? $request->lang_type : null,
                  
                  ];

                  $languageData = Emplang::where('employee_id',$request->employee_id)->update($update);

                  if (!empty($languageData)) {
                    
                    return redirect('employee_info'.$employeeDetails->id.'/skills');
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


  public function updateSkills(request $request)
  {
    // dd($request->all());
      if (Auth::check()) {
          $validator = Validator::make($request->all(), [
              // 'title' => 'required|string|max:255',
              // 'descriptions' => 'required|string|max:255',
          ]);
          $employeeDetails = Employee::where('id',$request->employee_id)->first();
        //   $skillsDetails = Empskills::where('id',$request->id)->first();

          if ($validator->passes()) {
              if($request->employee_id){

                  $update = [

                    'skill'=>!empty($request->skill) ? $request->skill : null,
                    'skill_type'=> !empty($request->skill_type) ? $request->skill_type : null,
                  
                  ];

                  $skillsData = Empskills::where('employee_id',$request->employee_id)->update($update);

                  if (!empty($skillsData)) {

                    return redirect('employee_info/'.$employeeDetails->id.'/skills');

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




}