<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Response;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.search-history');
    }

    // global search function
    public function search(Request $request)
    {
       
        if (!empty($request->get('filterby')) && !empty($request->get('search'))) {
            switch ($request->get('filterby')) {
                case ('name'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();

                    // $basicinfomation = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    // ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                    // ->get();

                    $experiences = Employee::join('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*','employee_workhistories.*')
                    ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();

                    $qualifications = Employee::join('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*','employee_qualifications.*')
                    ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    
                // dd($employees);
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                        <div class="search-hist-pro">
                                         <div class="pro-img">
                                            <div class="circle">
                                              <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                             </div>                
                                         </div>
                                        <h2>' . $employee->value . '
                                            <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                            <small>' . $employee->current_address . '</small>
                                            <small>4.5 <span>reviews</span></small>
                                            <span class="d-flex">
                                            </span>
                                            <span class="d-flex">
                                              <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                                <button class="only-border-btn" onclick="getInterview()" id="scheduleInterview">Add Candidate</button>
                                            
                                             </span> 
                                        </h2>
                                        </div>
                                    </div> 
                                    <div id='.$employee->empCode.' style="display: none;">
                                <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                            <div class="serch-main-box">
                                <h2 class="">Basic Info</h2>
                                <div class=" pt-1">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                                        aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                                        aria-selected="false">Contact</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="search-tab-part">
                                        <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                                        Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                                        keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                                        placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                                        qui.</p>
                                    </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="search-tab-part">                  
                                        <h1>Contact Info </h1>
                                        <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="d-flex mt-3">
                                            <div class="icon-part">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="coneant">
                                                <h4>Phone</h4>
                                                <p>'.$employee->phone.' <span>(mobile)</span></p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="d-flex mt-3">
                                            <div class="icon-part">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="coneant">
                                                <h4>Email</h4>
                                                <p>'.$employee->email.'</p>
                                            </div>
                                            </div>
                                        </div>
                                         <div class="col-lg-4 col-md-6">
                                            <div class="d-flex mt-3">
                                            <div class="icon-part">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="coneant">
                                                <h4>Join </h4>
                                                <p>June 15, 2020</p>
                                            </div>
                                            </div>
                                        </div>
                                        </div>  
                                    </div>
                                    </div>
                                </div>

                                </div>       
                            </div> 
                            ';
                        }

                      if($experiences){
                         foreach ($experiences as $key => $experience) {
                            $html .= '<div class="serch-main-box">
                                <h2 class="">Experience</h2>
                                <div class="d-flex pt-3">
                                <div class="searc-icon-bx">
                                    <img src="assets/admin/images/bytecipher.png">
                                </div>
                                <div class="searc-icon-bx-text">
                                    <h2>React Native Developer</h2>
                                    <h4>'.$experience->com_name .' · '.$experience->emp_type .' </h4>
                                    <p class="pt-2"><span>'.$experience->work_duration_from .' . '.$experience->work_duration_to .'</span></p>
                                    <p><span>' . $experience->work_location .'</span></p>
                                    <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                                    <fieldset class="rating">
                                    <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                                    <label class = "full" for="textiles-star51"></label>
                                    <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                                    <label class="half" for="textiles-star4half1"></label>

                                    <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                                    <label class = "full" for="textiles-star41" ></label>
                                    <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                                    <label class="half" for="textiles-star3half1"></label>

                                    <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                                    <label class = "full" for="textiles-star31"></label>
                                    <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                                    <label class="half" for="textiles-star2half1" ></label>

                                    <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                                    <label class = "full" for="textiles-star21"></label>
                                    <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                                    <label class="half" for="textiles-star1half1" ></label>

                                    <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                                    <label class = "full" for="textiles-star11"></label>
                                    <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                                    <label class="half" for="textiles-starhalf1"></label>

                                    </fieldset>
                                </div>
                                <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                                </div>  
                                <hr>      
                            </div>';

                         }
                        }
                        if($qualifications){
                         foreach ($qualifications as $key => $qualification) {
                            $html .='<div class="serch-main-box">
                                <h2 class="">Education</h2>
                                <div class="d-flex pt-3">
                                <div class="searc-icon-bx">
                                    <img src="assets/admin/images/Sage_University_logo.png">
                                </div>
                                <div class="searc-icon-bx-text">
                                    <h2>'.$qualification->inst_name .'</h2>
                                    <h4>'.$qualification->degree .', '.$qualification->subject .'</h4>
                                    <p class="pt-2"><span>'.$qualification->duration_from .' - '.$qualification->duration_to .'</span></p>
                                </div>
                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                </div>        
                            </div>
                            
                        </div>';
                         }
                        }
                      
                    } else {
                        $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                            <h2>Not found </h2>
                                </div>
                        </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('email'):
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('email', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
                    $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('email', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
             <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('mobile'):
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('phone', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
            $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('phone', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
            <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('empcode'):
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('empCode', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
                    $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('empCode', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
            <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('aadhar'):
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('document_type', 'Aadhar Card')
                    //     ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
                    $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('document_type', 'Aadhar Card')
                    ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
            <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('pan'):
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('document_type', 'Pan Card')
                    //     ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
                $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('document_type', 'Pan Card')
                    ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
            <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                default:
                    // $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                    //     ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                    //     ->get();
                    $employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
                    ->leftjoin('company_employee','company_employee.employee_id','=','employee.id')
                    ->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                    ->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
                    ->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
                    ->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*','employee_skills.*','employee_qualifications.*','employee_workhistories.*')
                    ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                             <div class="pro-img">
                                <div class="circle">
                                  <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                 </div>                
                             </div>
                            <h2>' . $employee->value . '
                                <span>'. $employee->designation . 'at ByteCipher Pvt. Ltd </span>
                                <small>' . $employee->current_address . '</small>
                                <small>4.5 <span>reviews</span></small>
                                <span class="d-flex">
                                </span>
                                <span class="d-flex">
                                  <button onclick="myFunction('. $employee->empCode .')" data-ID="'.$employee->empCode.'" class="full-bg">View Full Profile</button> 
                                    <button class="only-border-btn">Add Candidate</button>
                                 </span> 
                            </h2>
                            </div>
                        </div>
                        
            <div id='.$employee->empCode.' style="display: none;">
                    <input type="hidden" id="employee_code" name="employee_code" value="empCode">
                <div class="serch-main-box">
                    <h2 class="">Basic Info</h2>
                    <div class=" pt-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'.$employee->empCode.'" role="tab" aria-controls="home"
                            aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile'.$employee->empCode.'" role="tab" aria-controls="profile"
                            aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home'.$employee->empCode.'" role="tabpanel" aria-labelledby="home-tab">
                        <div class="search-tab-part">
                            <p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. 
                            Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                            keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                            placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                            qui.</p>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile'.$employee->empCode.'" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="search-tab-part">                  
                            <h1>Contact Info </h1>
                            <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Phone</h4>
                                    <p>'.$employee->phone.' <span>(mobile)</span></p>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Email</h4>
                                    <p>'.$employee->email.'</p>
                                </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6">
                                <div class="d-flex mt-3">
                                <div class="icon-part">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="coneant">
                                    <h4>Join </h4>
                                    <p>June 15, 2020</p>
                                </div>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>

                    </div>       
                </div>
                
                <div class="serch-main-box">
                    <h2 class="">Experience</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/bytecipher.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>React Native Developer</h2>
                        <h4>'.$employee->com_name .' · '.$employee->emp_type .' </h4>
                        <p class="pt-2"><span>'.$employee->work_duration_from .' . '.$employee->work_duration_to .'</span></p>
                        <p><span>' . $employee->work_location .'</span></p>
                        <p class="pt-2">"Raw denim you probably havent heard of them jean shorts Austin."</p>
                        <fieldset class="rating">
                        <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
                        <label class = "full" for="textiles-star51"></label>
                        <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
                        <label class="half" for="textiles-star4half1"></label>

                        <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
                        <label class = "full" for="textiles-star41" ></label>
                        <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
                        <label class="half" for="textiles-star3half1"></label>

                        <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
                        <label class = "full" for="textiles-star31"></label>
                        <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
                        <label class="half" for="textiles-star2half1" ></label>

                        <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
                        <label class = "full" for="textiles-star21"></label>
                        <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
                        <label class="half" for="textiles-star1half1" ></label>

                        <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
                        <label class = "full" for="textiles-star11"></label>
                        <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
                        <label class="half" for="textiles-starhalf1"></label>

                        </fieldset>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">        
                    </div>  
                    <hr>      
                </div>

                <div class="serch-main-box">
                    <h2 class="">Education</h2>
                    <div class="d-flex pt-3">
                    <div class="searc-icon-bx">
                        <img src="assets/admin/images/Sage_University_logo.png">
                    </div>
                    <div class="searc-icon-bx-text">
                        <h2>'.$employee->inst_name .'</h2>
                        <h4>'.$employee->degree .', '.$employee->subject .'</h4>
                        <p class="pt-2"><span>'.$employee->duration_from .' - '.$employee->duration_to .'</span></p>
                    </div>
                    <img src="assets/admin/images/verified-icon.png" class="verified-img">
                    </div>        
                </div>
                
            </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
            }
        } else {
            return FacadesResponse::json([]);
        }

        /*if ($request->get('search')) {
    // $output = "";
    $employees = Employee::select(FacadesDB::raw("CONCAT(first_name,' ', last_name) as value"), "id", "current_address")
    ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')->orWhere('phone', 'LIKE', '%' . $request->get('search') . '%')
    ->orWhere('document_number', 'LIKE', '%' . $request->get('search') . '%')->orWhere('empCode', 'LIKE', '%' . $request->get('search') . '%')
    ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%')
    ->get();
    $html = '';
    if (count($employees) > 0) {
    foreach ($employees as $key => $employee) {
    $html .= ' <div class="search-hist-page">
    <div class="search-hist-pro">
    <h2>' . $employee->value . '
    <span>React native developer at ByteCipher Private Limited.</span>
    <small>' . $employee->current_address . '</small>
    <small>4.5 <span>reviews</span></small>
    <span class="d-flex">
    </span>
    </h2>
    </div>
    </div>';
    }
    } else {
    $html .= '<div class="search-hist-page">
    <div class="search-hist-pro">
    <h2>Not found </h2>
    </div>
    </div>';
    }
    return Response::json(['success' => true, 'value' => $html]);
    }*/

    }
}
