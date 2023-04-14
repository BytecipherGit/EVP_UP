<?php

namespace App\Http\Controllers;

use App\Models\CompanyEmployee;
use App\Models\Employee;
use App\Models\EmployeeInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.search-history');
    }

    public function search(Request $request)
    {

        if (!empty($request->get('filterby')) && !empty($request->get('search'))) {
            $html = '';
            switch ($request->get('filterby')) {
                case ('name'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $empDetails = Employee::find($employee->id);
                            if ($empDetails) {
                                $html .= '<div id="myDIVsearch">
                                <div class="main-heading">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <h1>Candidate Detials</h1>
                                      <p>Here’s your report overview by today</p>
                                    </div>
                                  </div>
                                </div><!--- Main Heading ----->

                              <div class="search-hist-page">
                                <div class="search-hist-pro">
                                  <div class="pro-img">
                                    <div class="circle">
                                       <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
                                    </div>
                                  </div>
                                  <h2>
                                    Vijay Patil <b>(2 offer)</b>
                                    <span>React native developer at ByteCipher Private Limited.</span>
                                    <small>Mandu, India</small>
                                    <small>4.5 <span>reviews</span></small>
                                    <span class="d-flex">
                                      <a href="#" onclick="myFunction(' . $empDetails->id . ')" class="full-bg">View Full Profile</a>
                                      <a href="#" class="only-border-btn">Add Candidate</a>
                                    </span>
                                  </h2>
                                </div>
                              </div>


                              <div id="' . $empDetails->id . '" style="display: none;">

                                <div class="serch-main-box">
                                  <h2 class="">Basic Info</h2>
                                  <div class=" pt-1">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                          aria-selected="true">About</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                          aria-selected="false">Contact</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="search-tab-part">
                                          <p>Raw denim you probably have not heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                                          keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                                          placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                                          qui.</p>
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                  <p>+91 987 654 3210 <span>(mobile)</span></p>
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
                                                  <p>vijaysing@gmail.com</p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                              <div class="d-flex mt-3">
                                                <div class="icon-part">
                                                  <i class="fa fa-birthday-cake"></i>
                                                </div>
                                                <div class="coneant">
                                                  <h4>Birthday</h4>
                                                  <p>July 11</p>
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




                              </div>
                            </div>';
                            }
                        }
                        return FacadesResponse::json(['success' => true, 'value' => $html]);
                    }

                    break;
                case ('email'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('email', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    if (count($employees) > 0) {
                        $html .= '<div id="myDIVsearch">
                                    <div class="main-heading">
                                      <div class="row">
                                        <div class="col-lg-12">
                                          <h1>Candidate Detials</h1>
                                          <p>Here’s your report overview by today</p>
                                        </div>
                                      </div>
                                    </div>';
                        foreach ($employees as $key => $employee) {
                            $empDetails = Employee::find($employee->id);
                            // dd($empDetails);
                            if ($empDetails) {
                                $empCurrentCmpDetails = CompanyEmployee::leftJoin('users', 'users.id', '=', 'company_employee.company_id')->where('company_employee.employee_id', $employee->id)->first();
                                $empPhoto = !empty($empDetails->profile) ? $empDetails->profile : asset('assets/admin/images/vijay-patil.png');
                                $cmpName = !empty($empCurrentCmpDetails->org_name) ? $empCurrentCmpDetails->org_name : '';
                                $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->where('company_id', $empCurrentCmpDetails->company_id)->first();
                                $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';

                                // dd($empCurrentCmpDetails);
                                $html .= '<div class="search-hist-page">
                                    <div class="search-hist-pro">
                                      <div class="pro-img">
                                        <div class="circle">
                                           <img class="profile-pic" src="' . $empPhoto . '">
                                        </div>
                                      </div>
                                      <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '<b>(2 offer)</b>
                                        <span>' . $empPosition . ' at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->city . ',' . $empDetails->state . ', ' . $empDetails->country . '</small>
                                        <small>4.5 <span>reviews</span></small>
                                        <span class="d-flex">
                                          <a href="#" onclick="myFunction(' . $empDetails->id . ')" class="full-bg">View Full Profile</a>
                                          <a href="#" class="only-border-btn">Add Candidate</a>
                                        </span>
                                      </h2>
                                    </div>
                                  </div>


                                  <div id="' . $empDetails->id . '" style="display: none;">

                                    <div class="serch-main-box">
                                      <h2 class="">Basic Info</h2>
                                      <div class=" pt-1">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                          <li class="nav-item">
                                            <a class="nav-link active" id="home' . $empDetails->id . '-tab" data-toggle="tab" href="#home' . $empDetails->id . '" role="tab" aria-controls="home' . $empDetails->id . '"
                                              aria-selected="true">About</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="profile' . $empDetails->id . '-tab" data-toggle="tab" href="#profile' . $empDetails->id . '" role="tab" aria-controls="profile' . $empDetails->id . '"
                                              aria-selected="false">Contact</a>
                                          </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                          <div class="tab-pane fade show active" id="home' . $empDetails->id . '" role="tabpanel" aria-labelledby="home' . $empDetails->id . '-tab">
                                            <div class="search-tab-part">
                                              <p>Raw denim you probably have not heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                                              keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                                              placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                                              qui.</p>
                                            </div>
                                          </div>
                                          <div class="tab-pane fade" id="profile' . $empDetails->id . '" role="tabpanel" aria-labelledby="profile' . $empDetails->id . '-tab">
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
                                                      <p>' . $empDetails->phone . ' <span>(mobile)</span></p>
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
                                                      <p>' . $empDetails->email . '</p>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                  <div class="d-flex mt-3">
                                                    <div class="icon-part">
                                                      <i class="fa fa-birthday-cake"></i>
                                                    </div>
                                                    <div class="coneant">
                                                      <h4>Birthday</h4>
                                                      <p>' . $empDetails->dob . '</p>
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
                                                      <p>' . $empDetails->created_at . '</p>
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
          <h2 class="">Experience '.$empDetails->id.'</h2>
          <div class="d-flex pt-3">
            <div class="searc-icon-bx">
              <img src="assets/images/bytecipher.png">
            </div>
            <div class="searc-icon-bx-text">
              <h2>React Native Developer</h2>
              <h4>ByteCipher Private Limited · Full-time</h4>
              <p class="pt-2"><span>Dec 2019 - Present · 2 yrs 3 mos</span></p>
              <p><span>Indore, Madhya Pradesh, India</span></p>
              <p class="pt-2">"Raw denim you probably have not heard of them jean shorts Austin."</p>
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
            <img src="assets/images/verified-icon.png" class="verified-img">
          </div>
          <hr>
          <div class="d-flex pt-3">
            <div class="searc-icon-bx">
              <img src="assets/images/bytecipher.png">
            </div>
            <div class="searc-icon-bx-text">
              <h2>React Native Developer</h2>
              <h4>ByteCipher Private Limited · Full-time</h4>
              <p class="pt-2"><span>Dec 2019 - Present · 2 yrs 3 mos</span></p>
              <p><span>Indore, Madhya Pradesh, India</span></p>
              <p class="pt-2">"Raw denim you probably have not heard of them jean shorts Austin."</p>
              <fieldset class="rating">
                <input type="radio" id="textiles-star5" name="textiles-rating" value="5" />
                <label class = "full" for="textiles-star5"></label>
                <input type="radio" id="textiles-star4half" name="textiles-rating" value="4 and a half" checked="" />
                <label class="half" for="textiles-star4half"></label>

                <input type="radio" id="textiles-star4" name="textiles-rating" value="4" />
                <label class = "full" for="textiles-star4" ></label>
                <input type="radio" id="textiles-star3half" name="textiles-rating" value="3 and a half" />
                <label class="half" for="textiles-star3half"></label>

                <input type="radio" id="textiles-star3" name="textiles-rating" value="3" />
                <label class = "full" for="textiles-star3"></label>
                <input type="radio" id="textiles-star2half" name="textiles-rating" value="2 and a half" />
                <label class="half" for="textiles-star2half" ></label>

                <input type="radio" id="textiles-star2" name="textiles-rating" value="2" />
                <label class = "full" for="textiles-star2"></label>
                <input type="radio" id="textiles-star1half" name="textiles-rating" value="1 and a half" />
                <label class="half" for="textiles-star1half" ></label>

                <input type="radio" id="textiles-star1" name="textiles-rating" value="1" />
                <label class = "full" for="textiles-star1"></label>
                <input type="radio" id="textiles-starhalf" name="textiles-rating" value="half" />
                <label class="half" for="textiles-starhalf"></label>

              </fieldset>

            </div>
            <img src="assets/images/verified-icon.png" class="verified-img">
          </div>
        </div>

        <div class="serch-main-box">
          <h2 class="">Education'.$empDetails->id.'</h2>
          <div class="d-flex pt-3">
            <div class="searc-icon-bx">
              <img src="assets/images/Sage_University_logo.png">
            </div>
            <div class="searc-icon-bx-text">
              <h2>Truba College of Engineering Technology, Indore Bypass Road, Kailod Kartal, Indore-452020</h2>
              <h4>Bachelor of Engineering - BE, Electronics and TeleCommunications Engineering</h4>
              <p class="pt-2"><span>2016 - 2020</span></p>
            </div>
            <img src="assets/images/verified-icon.png" class="verified-img">
          </div>        
        </div>


                                  </div>
                                </div>';
                            }
                        }
                        return FacadesResponse::json(['success' => true, 'value' => $html]);
                    }
                    break;
                case ('mobile'):
                    $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('phone', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    return response()->json($data);
                    break;
                case ('empcode'):
                    $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('empCode', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    return response()->json($data);
                    break;
                case ('aadhar'):
                    $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Aadhar Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    return response()->json($data);
                    break;
                case ('pan'):
                    $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Pan Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    return response()->json($data);
                    break;
                default:
                    $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    return response()->json($data);
                    break;
            }
        } else {
            return FacadesResponse::json([]);
        }
    }

    // global search function
    /*public function search(Request $request)
{

if (!empty($request->get('filterby')) && !empty($request->get('search'))) {
switch ($request->get('filterby')) {
case ('name'):
$employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
->get();

$experiences = Employee::join('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_workhistories.*')
->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
->get();

$qualifications = Employee::join('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_qualifications.*')
->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
->get();

// dd($basicinfomation);
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn" onclick="getInterview()" id="scheduleInterview">Add Candidate</button>

</span>
</h2>
</div>
</div>
<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
</div>';
}

if ($experiences) {
foreach ($experiences as $key => $experience) {
$html .= '<div class="serch-main-box">
<h2 class="">Experience</h2>
<div class="d-flex pt-3">
<div class="searc-icon-bx">
<img src="assets/admin/images/bytecipher.png">
</div>
<div class="searc-icon-bx-text">
<h2>React Native Developer</h2>
<h4>' . $experience->com_name . ' · ' . $experience->emp_type . ' </h4>
<p class="pt-2"><span>' . $experience->work_duration_from . ' . ' . $experience->work_duration_to . '</span></p>
<p><span>' . $experience->work_location . '</span></p>
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
if ($qualifications) {
foreach ($qualifications as $key => $qualification) {

$html .= '<div class="serch-main-box">
<h2 class="">Education</h2>
<div class="d-flex pt-3">
<div class="searc-icon-bx">
<img src="assets/admin/images/Sage_University_logo.png">
</div>
<div class="searc-icon-bx-text">
<h2>' . !empty($qualification->inst_name) ? $qualification->inst_name : '' . '</h2>
<h4>' . $qualification->degree . ', ' . $qualification->subject . '</h4>
<p class="pt-2"><span>' . $qualification->duration_from . ' - ' . $qualification->duration_to . '</span></p>
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
$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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

$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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

$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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

$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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

$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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
$employees = Employee::leftjoin('employee_identity', 'employee_identity.employee_id', '=', 'employee.id')
->leftjoin('company_employee', 'company_employee.employee_id', '=', 'employee.id')
->leftjoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
->leftjoin('employee_skills', 'employee_skills.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'company_employee.employee_id')
->leftjoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'company_employee.employee_id')
->select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), 'employee.*', 'employee_identity.*', 'employee_officials.*', 'employee_skills.*', 'employee_qualifications.*', 'employee_workhistories.*')
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
<span>' . $employee->designation . 'at ByteCipher Pvt. Ltd </span>
<small>' . $employee->current_address . '</small>
<small>4.5 <span>reviews</span></small>
<span class="d-flex">
</span>
<span class="d-flex">
<button onclick="myFunction(' . $employee->empCode . ')" data-ID="' . $employee->empCode . '" class="full-bg">View Full Profile</button>
<button class="only-border-btn">Add Candidate</button>
</span>
</h2>
</div>
</div>

<div id=' . $employee->empCode . ' style="display: none;">
<input type="hidden" id="employee_code" name="employee_code" value="empCode">
<div class="serch-main-box">
<h2 class="">Basic Info</h2>
<div class=" pt-1">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home' . $employee->empCode . '" role="tab" aria-controls="home"
aria-selected="true">About</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile' . $employee->empCode . '" role="tab" aria-controls="profile"
aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home' . $employee->empCode . '" role="tabpanel" aria-labelledby="home-tab">
<div class="search-tab-part">
<p>Raw denim you probably havent heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
qui.</p>
</div>
</div>
<div class="tab-pane fade" id="profile' . $employee->empCode . '" role="tabpanel" aria-labelledby="profile-tab">
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
<p>' . $employee->phone . ' <span>(mobile)</span></p>
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
<p>' . $employee->email . '</p>
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
<h4>' . $employee->com_name . ' · ' . $employee->emp_type . ' </h4>
<p class="pt-2"><span>' . $employee->work_duration_from . ' . ' . $employee->work_duration_to . '</span></p>
<p><span>' . $employee->work_location . '</span></p>
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
<h2>' . $employee->inst_name . '</h2>
<h4>' . $employee->degree . ', ' . $employee->subject . '</h4>
<p class="pt-2"><span>' . $employee->duration_from . ' - ' . $employee->duration_to . '</span></p>
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
}*/
}
