<?php

namespace App\Http\Controllers;

use App\Models\CompanyEmployee;
use App\Models\Employee;
use App\Models\EmployeeInterview;
use Illuminate\Http\Request;
use App\Models\Empofficial;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
                                  $cmpAddress = !empty($empCurrentCmpDetails->address) ? $empCurrentCmpDetails->address : '';
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();
                              
                                  $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                                  $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                              ->where('exit_employee.employee_id', $employee->id)
                                              ->groupBy('company_employee.id' )
                                              ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                              ->first();

                                              $html .= '<div class="search-hist-page">
                                              <div class="search-hist-pro">
                                                <div class="pro-img">
                                                  <div class="circle">
                                                     <img class="profile-pic" src="' . $empPhoto . '">
                                                  </div>
                                                </div>
                                                <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                                <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                                <small>' . $empDetails->current_address. '</small>';
        
                                               if(!empty($reviewEmp)){     
                                                  $html .= '<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                               }
        
                                                $html .='<span class="d-flex">
                                                  <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                                  <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                                <p>' . $empDetails->phone . ' </p>
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
                                                            </div>';
                                                            if(!empty($joinDate)){
                                                                     
                                                                 $html .='<div class="col-lg-4 col-md-6">
                                                                 <div class="d-flex mt-3">
                                                                   <div class="icon-part">
                                                                     <i class="fa fa-users"></i>
                                                                   </div>
                                                                   <div class="coneant">
                                                                     <h4>Join </h4>
                                                                     <p>' . $joinDate->date_of_joining . '</p>
                                                                    </div>';
                                                             }
                                                                 $html .='</div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
          
                                                </div>
                                              </div>';
                                              // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                              //           ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                              //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                              //           ->select('employee_workhistories.*','employee_officials.*')
                                              //           ->get();
                                            $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                        ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                        ->where('employee.id',$empDetails->id)
                                                        ->select('users.org_name','company_employee.*','users.address')
                                                        ->get();
                                              if(count($experiences) > 0){
                                                // foreach($experiences as $key => $experience){
                                                
                                                  $html .= '<div class="serch-main-box">
                                                           <h2 class="">Experience</h2>
                                                          ';
          
                                                          foreach($experiences as $key => $experience){
                                                            $html .='<div class="d-flex pt-3">
                                                            <div class="searc-icon-bx">
                                                              <img src="assets/admin/images/bytecipher.png">
                                                            </div>
                                                            <div class="searc-icon-bx-text">
                                                              <h2>'.$experience->designation.'</h2>
                                                              <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                              <p class="pt-2"><span> '.$experience->start_date.' - ' ;
                                                              
                                                              if(empty($experience->end_date)){
                                                                $html .= 'Present </span></p>';
                                                              }
                                                              else{
                                                                  $html .= $experience->end_date.'</span></p>';
                                                              }
        
                                                             $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                              <p class="pt-2">'.$experience->review.'</p>';
        
                                                    if(!empty($experience->rating)){
                                                          $html .='<fieldset class="rating">';
                                                              if($experience->rating == 5){
        
                                                                $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half"></label>';
                                                              }
        
                                                              if($experience->rating == 4.5){
                                                                $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 4){
                                                                  $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 3.5){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 3){
                                                                  $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                                  <label class = "full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                                  <label class = "full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half"></label>';
                                                              }
        
                                                              if($experience->rating == 2.5){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 2){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 1.5){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 1){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                  <label class ="full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                  <label class="half" ></label>';
                                                              }
        
                                                              if($experience->rating == 0.5){
                                                                  $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                  <label class="half" ></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                  <label class = "full" ></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                  <label class = "full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                  <label class="half"></label>
                  
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                  <label class="full"></label>
                                                                  <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                                  <label class="half"></label></fieldset>';
                                                              }
                                                            }
                                                              $html .='</div>
                                                            <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                          }
                                                  $html .= '</div>';
          
                                               }
                                         $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                                  ->where('employee_qualifications.employee_id',$empDetails->id)
                                                  ->select('employee_qualifications.*')
                                                  ->get();
                                            if(count($educations)>0){
                                                  $html .= '<div class="serch-main-box"> 
                                                      <h2 class="">Education Details</h2>';
                                              foreach($educations as $education){
                                                      $html .='<div class="d-flex pt-3">
                                                        <div class="searc-icon-bx">
                                                          <img src="assets/admin/images/Sage_University_logo.png">
                                                        </div>
                                                        <div class="searc-icon-bx-text">
                                                          <h2>'.$education->inst_name.'</h2>
                                                          <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                          <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                        </div>
                                                        <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                                      </div><hr>';
                                                      }
                                                    $html .='</div>';  
                                             }
                                                  
                                            $html .= '</div>
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
                                $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                                $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();

                                $html .= '<div class="search-hist-page">
                                    <div class="search-hist-pro">
                                      <div class="pro-img">
                                        <div class="circle">
                                           <img class="profile-pic" src="' . $empPhoto . '">
                                        </div>
                                      </div>
                                      <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                      <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                      <small>' . $empDetails->current_address. '</small>';
                                      if($reviewEmp){
                                        $html .='<small>'. number_format($reviewEmp->rating, 1, '.', ',') .'  <span> reviews</span></small>';
                                        }
                                      $html .='<span class="d-flex">
                                        <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                        <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                      <p>' . $empDetails->phone . ' </p>
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
                                                  </div>';
                                                  if(!empty($joinDate)){
                                                           
                                                       $html .='<div class="col-lg-4 col-md-6">
                                                       <div class="d-flex mt-3">
                                                         <div class="icon-part">
                                                           <i class="fa fa-users"></i>
                                                         </div>
                                                         <div class="coneant">
                                                           <h4>Join </h4>
                                                           <p>' . $joinDate->date_of_joining . '</p>
                                                          </div>';
                                                   }
                                                       $html .='</div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                      </div>
                                    </div>';
                                    // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                    //          ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                    //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                    //           ->select('employee_workhistories.*','employee_officials.*')
                                    //           ->get();
                                    $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                              ->join('users', 'users.id', '=', 'company_employee.company_id')
                                              ->where('employee.id',$empDetails->id)
                                              ->select('users.org_name','company_employee.*','users.address')
                                              ->get();

                                    if(count($experiences) > 0){
                                      // foreach($experiences as $key => $experience){
                                      
                                        $html .= '<div class="serch-main-box">
                                                 <h2 class="">Experience</h2>
                                                ';

                                                foreach($experiences as $key => $experience){
                                                  $html .='<div class="d-flex pt-3">
                                                  <div class="searc-icon-bx">
                                                    <img src="assets/admin/images/bytecipher.png">
                                                  </div>
                                                  <div class="searc-icon-bx-text">
                                                    <h2>'.$experience->designation.'</h2>
                                                    <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                    <p class="pt-2"><span> '.$experience->start_date.' - ';

                                                    if(empty($experience->end_date)){
                                                      $html .= 'Present </span></p>';
                                                    }
                                                    else{
                                                        $html .= $experience->end_date.'</span></p>';
                                                    }

                                                   $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                    <p class="pt-2">'.$experience->review.'</p>';

                                             if(!empty($experience->rating)){
                                                      $html .='<fieldset class="rating">';
                                                          if($experience->rating == 5){
    
                                                            $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half"></label>';
                                                          }
    
                                                          if($experience->rating == 4.5){
                                                            $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                            <label class = "full" ></label>
                                                            <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                            <label class="half" ></label>
            
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                            <label class = "full" ></label>
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                            <label class="half" ></label>
            
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                            <label class = "full" ></label>
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                            <label class="half" ></label>
            
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                            <label class = "full" ></label>
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                            <label class="half" ></label>
            
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                            <label class = "full" ></label>
                                                            <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                            <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 4){
                                                              $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 3.5){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 3){
                                                              $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                              <label class = "full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half"></label>
              
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half"></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                              <label class = "full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half"></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half"></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half"></label>';
                                                          }
    
                                                          if($experience->rating == 2.5){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 2){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 1.5){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 1){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class ="full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                          }
    
                                                          if($experience->rating == 0.5){
                                                              $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half"></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half"></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class="full"></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                              <label class="half"></label></fieldset>';
                                                          }
                                                        }
                                                          $html .='</div>
                                                        <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                      }
                                        $html .= '</div>';

                                     }
                               $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                        ->where('employee_qualifications.employee_id',$empDetails->id)
                                        ->select('employee_qualifications.*')
                                        ->get();
                                  if(count($educations)>0){
                                        $html .= '<div class="serch-main-box"> 
                                            <h2 class="">Education Details</h2>';
                                    foreach($educations as $education){
                                            $html .='<div class="d-flex pt-3">
                                              <div class="searc-icon-bx">
                                                <img src="assets/admin/images/Sage_University_logo.png">
                                              </div>
                                              <div class="searc-icon-bx-text">
                                                <h2>'.$education->inst_name.'</h2>
                                                <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                              </div>
                                              <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                            </div><hr>';
                                            }
                                          $html .='</div>';  
                                   }
                                        
                                  $html .= '</div>
                                </div>';
                            }
                        }
                        return FacadesResponse::json(['success' => true, 'value' => $html]);
                    }
                    break;
                case ('mobile'):
                  $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('phone', 'LIKE', '%' . $request->get('search') . '%')
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
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                  $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                                $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();

                                  $html .= '<div class="search-hist-page">
                                      <div class="search-hist-pro">
                                        <div class="pro-img">
                                          <div class="circle">
                                             <img class="profile-pic" src="' . $empPhoto . '">
                                          </div>
                                        </div>
                                        <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                        <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->current_address. '</small>';

                                       if(!empty($reviewEmp)){     
                                          $html .= '<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                       }

                                        $html .='<span class="d-flex">
                                          <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                          <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                        <p>' . $empDetails->phone . ' </p>
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
                                                    </div>';
                                                    if(!empty($joinDate)){
                                                             
                                                         $html .='<div class="col-lg-4 col-md-6">
                                                         <div class="d-flex mt-3">
                                                           <div class="icon-part">
                                                             <i class="fa fa-users"></i>
                                                           </div>
                                                           <div class="coneant">
                                                             <h4>Join </h4>
                                                             <p>' . $joinDate->date_of_joining . '</p>
                                                            </div>';
                                                     }
                                                         $html .='</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                        </div>
                                      </div>';
                                      // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                      //           ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                      //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                      //           ->select('employee_workhistories.*','employee_officials.*')
                                      //           ->get();
                                    $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                ->where('employee.id',$empDetails->id)
                                                ->select('users.org_name','company_employee.*','users.address')
                                                ->get();
                                      if(count($experiences) > 0){
                                        // foreach($experiences as $key => $experience){
                                        
                                          $html .= '<div class="serch-main-box">
                                                   <h2 class="">Experience</h2>
                                                  ';
  
                                                  foreach($experiences as $key => $experience){
                                                    $html .='<div class="d-flex pt-3">
                                                    <div class="searc-icon-bx">
                                                      <img src="assets/admin/images/bytecipher.png">
                                                    </div>
                                                    <div class="searc-icon-bx-text">
                                                      <h2>'.$experience->designation.'</h2>
                                                      <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                      <p class="pt-2"><span> '.$experience->start_date.' - ' ;
                                                      
                                                      if(empty($experience->end_date)){
                                                        $html .= 'Present </span></p>';
                                                      }
                                                      else{
                                                          $html .= $experience->end_date.'</span></p>';
                                                      }

                                                     $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                      <p class="pt-2">'.$experience->review.'</p>';

                                            if(!empty($experience->rating)){
                                                  $html .='<fieldset class="rating">';
                                                      if($experience->rating == 5){

                                                        $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half"></label>';
                                                      }

                                                      if($experience->rating == 4.5){
                                                        $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                        <label class = "full" ></label>
                                                        <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                        <label class="half" ></label>
        
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                        <label class = "full" ></label>
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                        <label class="half" ></label>
        
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                        <label class = "full" ></label>
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                        <label class="half" ></label>
        
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                        <label class = "full" ></label>
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                        <label class="half" ></label>
        
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                        <label class = "full" ></label>
                                                        <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                        <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 4){
                                                          $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 3.5){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 3){
                                                          $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                          <label class = "full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half"></label>
          
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half"></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                          <label class = "full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half"></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half"></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half"></label>';
                                                      }

                                                      if($experience->rating == 2.5){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 2){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 1.5){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 1){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                          <label class ="full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                          <label class="half" ></label>';
                                                      }

                                                      if($experience->rating == 0.5){
                                                          $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                          <label class = "full" ></label>
                                                          <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                          <label class="half" ></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                          <label class = "full" ></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                          <label class="half"></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                          <label class = "full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                          <label class="half"></label>
          
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                          <label class="full"></label>
                                                          <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                          <label class="half"></label></fieldset>';
                                                      }
                                                    }
                                                      $html .='</div>
                                                    <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                  }
                                          $html .= '</div>';
  
                                       }
                                 $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                          ->where('employee_qualifications.employee_id',$empDetails->id)
                                          ->select('employee_qualifications.*')
                                          ->get();
                                    if(count($educations)>0){
                                          $html .= '<div class="serch-main-box"> 
                                              <h2 class="">Education Details</h2>';
                                      foreach($educations as $education){
                                              $html .='<div class="d-flex pt-3">
                                                <div class="searc-icon-bx">
                                                  <img src="assets/admin/images/Sage_University_logo.png">
                                                </div>
                                                <div class="searc-icon-bx-text">
                                                  <h2>'.$education->inst_name.'</h2>
                                                  <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                  <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                </div>
                                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                              </div><hr>';
                                              }
                                            $html .='</div>';  
                                     }
                                          
                                    $html .= '</div>
                                  </div>';
                              }
                          }
                          return FacadesResponse::json(['success' => true, 'value' => $html]);
                      }
                    break;
                case ('empcode'):
                  $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('empCode', 'LIKE', '%' . $request->get('search') . '%')
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
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                  $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                               $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();

                                  $html .= '<div class="search-hist-page">
                                      <div class="search-hist-pro">
                                        <div class="pro-img">
                                          <div class="circle">
                                             <img class="profile-pic" src="' . $empPhoto . '">
                                          </div>
                                        </div>
                                        <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '<b></b>
                                        <span>' . $empPosition.'  at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->current_address. '</small>';
                                   if($reviewEmp){
                                         $html .='<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                       }
                                        $html .='<span class="d-flex">
                                          <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                          <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                        <p>' . $empDetails->phone . ' </p>
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
                                                    </div>';
                                                    if(!empty($joinDate)){
                                                             
                                                         $html .='<div class="col-lg-4 col-md-6">
                                                         <div class="d-flex mt-3">
                                                           <div class="icon-part">
                                                             <i class="fa fa-users"></i>
                                                           </div>
                                                           <div class="coneant">
                                                             <h4>Join </h4>
                                                             <p>' . $joinDate->date_of_joining . '</p>
                                                            </div>';
                                                     }
                                                         $html .='</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                        </div>
                                      // </div>';
                                      // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                      //           ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                      //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                      //           ->select('employee_workhistories.*','employee_officials.*')
                                      //           ->get();
                                       $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                ->where('employee.id',$empDetails->id)
                                                ->select('users.org_name','company_employee.*','users.address')
                                                ->get();

                                      if(count($experiences) > 0){
                                        // foreach($experiences as $key => $experience){
                                        
                                          $html .= '<div class="serch-main-box">
                                                   <h2 class="">Experience</h2>
                                                  ';
  
                                                  foreach($experiences as $key => $experience){
                                                    $html .='<div class="d-flex pt-3">
                                                    <div class="searc-icon-bx">
                                                      <img src="assets/admin/images/bytecipher.png">
                                                    </div>
                                                    <div class="searc-icon-bx-text">
                                                      <h2>'.$experience->designation.'</h2>
                                                      <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                      <p class="pt-2"><span> '.$experience->start_date.' - '; 
                                                      
                                                      if(empty($experience->end_date)){
                                                        $html .= 'Present </span></p>';
                                                      }
                                                      else{
                                                          $html .= $experience->end_date.'</span></p>';
                                                      }

                                                    $html .='<p><span>Indore, Madhya Pradesh, India</span></p>
                                                      <p class="pt-2">'.$experience->review.'</p>';

                                               if(!empty($experience->rating)){
                                                        $html .='<fieldset class="rating">';
                                                            if($experience->rating == 5){
      
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 4.5){
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 4){
                                                                $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3){
                                                                $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half"></label>
                
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 2.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 2){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class ="full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 0.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class="full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                                <label class="half"></label></fieldset>';
                                                            }
                                                          }
                                                            $html .='</div>
                                                          <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                        }
                                          $html .= '</div>';
  
                                       }
                                 $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                          ->where('employee_qualifications.employee_id',$empDetails->id)
                                          ->select('employee_qualifications.*')
                                          ->get();
                                    if(count($educations)>0){
                                          $html .= '<div class="serch-main-box"> 
                                              <h2 class="">Education Details</h2>';
                                      foreach($educations as $education){
                                              $html .='<div class="d-flex pt-3">
                                                <div class="searc-icon-bx">
                                                  <img src="assets/admin/images/Sage_University_logo.png">
                                                </div>
                                                <div class="searc-icon-bx-text">
                                                  <h2>'.$education->inst_name.'</h2>
                                                  <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                  <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                </div>
                                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                              </div><hr>';
                                              }
                                            $html .='</div>';  
                                     }
                                          
                                    $html .= '</div>
                                  </div>';
                              }
                          }
                          return FacadesResponse::json(['success' => true, 'value' => $html]);
                      }
                    break;
                case ('aadhar'):
                  $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Aadhar Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
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
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                 $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                           $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();

                                  $html .= '<div class="search-hist-page">
                                      <div class="search-hist-pro">
                                        <div class="pro-img">
                                          <div class="circle">
                                             <img class="profile-pic" src="' . $empPhoto . '">
                                          </div>
                                        </div>
                                        <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                        <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->current_address. '</small>';
                                  if($reviewEmp){
                                          $html .='<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                   }
                                       $html .=' <span class="d-flex">
                                          <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                          <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                        <p>' . $empDetails->phone . ' </p>
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
                                                    </div>';
                                                    if(!empty($joinDate)){
                                                             
                                                         $html .='<div class="col-lg-4 col-md-6">
                                                         <div class="d-flex mt-3">
                                                           <div class="icon-part">
                                                             <i class="fa fa-users"></i>
                                                           </div>
                                                           <div class="coneant">
                                                             <h4>Join </h4>
                                                             <p>' . $joinDate->date_of_joining . '</p>
                                                            </div>';
                                                     }
                                                         $html .='</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                        </div>
                                      </div>';
                                      // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                      //           ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                      //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                      //           ->select('employee_workhistories.*','employee_officials.*')
                                      //           ->get();

                                     $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                ->where('employee.id',$empDetails->id)
                                                ->select('users.org_name','company_employee.*','users.address')
                                                ->get();
                                      if(count($experiences) > 0){
                                        // foreach($experiences as $key => $experience){
                                        
                                          $html .= '<div class="serch-main-box">
                                                   <h2 class="">Experience</h2>
                                                  ';
  
                                                  foreach($experiences as $key => $experience){
                                                    $html .='<div class="d-flex pt-3">
                                                    <div class="searc-icon-bx">
                                                      <img src="assets/admin/images/bytecipher.png">
                                                    </div>
                                                    <div class="searc-icon-bx-text">
                                                      <h2>'.$experience->designation.'</h2>
                                                      <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                      <p class="pt-2"><span> '.$experience->start_date.' - ';
                                                      
                                                      if(empty($experience->end_date)){
                                                        $html .= 'Present </span></p>';
                                                      }
                                                      else{
                                                          $html .= $experience->end_date.'</span></p>';
                                                      }

                                                     $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                      <p class="pt-2">'.$experience->review.'</p>';

                                             if(!empty($experience->rating)){
                                                        $html .='<fieldset class="rating">';
                                                            if($experience->rating == 5){
      
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 4.5){
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 4){
                                                                $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3){
                                                                $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half"></label>
                
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 2.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 2){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class ="full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 0.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class="full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                                <label class="half"></label></fieldset>';
                                                            }
                                                          }
                                                            $html .='</div>
                                                          <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                        }
                                          $html .= '</div>';
  
                                       }
                                 $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                          ->where('employee_qualifications.employee_id',$empDetails->id)
                                          ->select('employee_qualifications.*')
                                          ->get();
                                    if(count($educations)>0){
                                          $html .= '<div class="serch-main-box"> 
                                              <h2 class="">Education Details</h2>';
                                      foreach($educations as $education){
                                              $html .='<div class="d-flex pt-3">
                                                <div class="searc-icon-bx">
                                                  <img src="assets/admin/images/Sage_University_logo.png">
                                                </div>
                                                <div class="searc-icon-bx-text">
                                                  <h2>'.$education->inst_name.'</h2>
                                                  <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                  <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                </div>
                                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                              </div><hr>';
                                              }
                                            $html .='</div>';  
                                     }
                                          
                                    $html .= '</div>
                                  </div>';
                              }
                          }
                          return FacadesResponse::json(['success' => true, 'value' => $html]);
                      }
                    break;
                case ('pan'):
                  $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Pan Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
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
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                  $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                            $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();

                                  $html .= '<div class="search-hist-page">
                                      <div class="search-hist-pro">
                                        <div class="pro-img">
                                          <div class="circle">
                                             <img class="profile-pic" src="' . $empPhoto . '">
                                          </div>
                                        </div>
                                        <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                        <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->current_address. '</small>';

                                        if($reviewEmp){
                                          $html .='<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                          }
                                      $html .= '<span class="d-flex">
                                          <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                          <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                        <p>' . $empDetails->phone . ' </p>
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
                                                    </div>';
                                                    if(!empty($joinDate)){
                                                             
                                                         $html .='<div class="col-lg-4 col-md-6">
                                                         <div class="d-flex mt-3">
                                                           <div class="icon-part">
                                                             <i class="fa fa-users"></i>
                                                           </div>
                                                           <div class="coneant">
                                                             <h4>Join </h4>
                                                             <p>' . $joinDate->date_of_joining . '</p>
                                                            </div>';
                                                     }
                                                         $html .='</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                        </div>
                                      </div>';
                                      // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                      //           ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                      //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                      //           ->select('employee_workhistories.*','employee_officials.*')
                                      //           ->get();
                                     $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                ->where('employee.id',$empDetails->id)
                                                ->select('users.org_name','company_employee.*','users.address')
                                                ->get();          
                                      if(count($experiences) > 0){
                                        // foreach($experiences as $key => $experience){
                                        
                                          $html .= '<div class="serch-main-box">
                                                   <h2 class="">Experience</h2>
                                                  ';
  
                                                  foreach($experiences as $key => $experience){
                                                    $html .='<div class="d-flex pt-3">
                                                    <div class="searc-icon-bx">
                                                      <img src="assets/admin/images/bytecipher.png">
                                                    </div>
                                                    <div class="searc-icon-bx-text">
                                                      <h2>'.$experience->designation.'</h2>
                                                      <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                      <p class="pt-2"><span> '.$experience->start_date.' - ';
                                                      
                                                      if(empty($experience->end_date)){
                                                        $html .= 'Present </span></p>';
                                                      }
                                                      else{
                                                          $html .= $experience->end_date.'</span></p>';
                                                      }

                                                     $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                      <p class="pt-2">'.$experience->review.'</p>';

                                              if(!empty($experience->rating)){
                                                        $html .='<fieldset class="rating">';
                                                            if($experience->rating == 5){
      
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 4.5){
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 4){
                                                                $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3){
                                                                $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half"></label>
                
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 2.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 2){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class ="full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 0.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class="full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                                <label class="half"></label></fieldset>';
                                                            }
                                                          }
                                                            $html .='</div>
                                                          <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                        }
                                          $html .= '</div>';
  
                                       }
                                 $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                          ->where('employee_qualifications.employee_id',$empDetails->id)
                                          ->select('employee_qualifications.*')
                                          ->get();
                                    if(count($educations)>0){
                                          $html .= '<div class="serch-main-box"> 
                                              <h2 class="">Education Details</h2>';
                                      foreach($educations as $education){
                                              $html .='<div class="d-flex pt-3">
                                                <div class="searc-icon-bx">
                                                  <img src="assets/admin/images/Sage_University_logo.png">
                                                </div>
                                                <div class="searc-icon-bx-text">
                                                  <h2>'.$education->inst_name.'</h2>
                                                  <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                  <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                </div>
                                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                              </div><hr>';
                                              }
                                            $html .='</div>';  
                                     }
                                          
                                    $html .= '</div>
                                  </div>';
                              }
                          }
                          return FacadesResponse::json(['success' => true, 'value' => $html]);
                      }
                    break;
                default:
                $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
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
                                  $interviewEmp = EmployeeInterview::where('employee_id', $employee->id)->first();
                                  $joinDate = Empofficial::where('employee_id', $employee->id)->first();

                                  $empPosition = !empty($interviewEmp->position) ? $interviewEmp->position : '';
                                $reviewEmp = CompanyEmployee::join('exit_employee','exit_employee.employee_id','=','company_employee.employee_id')
                                ->where('exit_employee.employee_id', $employee->id)
                                ->groupBy('company_employee.id' )
                                ->select(DB::raw( 'AVG( exit_employee.rating) as rating'))
                                ->first();
                                  $html .= '<div class="search-hist-page">
                                      <div class="search-hist-pro">
                                        <div class="pro-img">
                                          <div class="circle">
                                             <img class="profile-pic" src="' . $empPhoto . '">
                                          </div>
                                        </div>
                                        <h2> ' . $empDetails->first_name . ' ' . $empDetails->middle_name . ' ' . $empDetails->last_name . '
                                        <span>'.$empPosition.'  at ' . $cmpName . '.</span>
                                        <small>' . $empDetails->current_address. '</small>';
                                      if($reviewEmp){
                                           $html .='<small>'. number_format($reviewEmp->rating, 1, '.', ',') .' <span>reviews</span></small>';
                                           }
                                       $html .= '<span class="d-flex">
                                          <button onclick="myFunction(' . $empDetails->id . ')" class="full-bg button_background_color"><span class="button_text_color btnspan">View Full Profile</span></button>
                                          <button class="full-bg button_background_color" onclick="getInterview(' . $empDetails->id . ')" id="scheduleInterview" style="margin-left: 15px;"><span class="button_text_color btnspan">Add Candidate</span></button>
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
                                                        <p>' . $empDetails->phone . ' </p>
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
                                                    </div>';
                                                    if(!empty($joinDate)){
                                                             
                                                         $html .='<div class="col-lg-4 col-md-6">
                                                         <div class="d-flex mt-3">
                                                           <div class="icon-part">
                                                             <i class="fa fa-users"></i>
                                                           </div>
                                                           <div class="coneant">
                                                             <h4>Join </h4>
                                                             <p>' . $joinDate->date_of_joining . '</p>
                                                            </div>';
                                                     }
                                                         $html .='</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                        </div>
                                      </div>';
                                      // $experiences = Employee::leftJoin('employee_workhistories', 'employee_workhistories.employee_id', '=', 'employee.id')
                                      //          ->leftJoin('employee_officials', 'employee_officials.employee_id', '=', 'employee.id')
                                      //           ->where('employee_workhistories.employee_id',$empDetails->id)
                                      //           ->select('employee_workhistories.*','employee_officials.*')
                                      //           ->get();
                                      $experiences = Employee::join('company_employee', 'company_employee.employee_id', '=', 'employee.id')
                                                ->join('users', 'users.id', '=', 'company_employee.company_id')
                                                ->where('employee.id',$empDetails->id)
                                                ->select('users.org_name','company_employee.*','users.address')
                                                ->get();
                                      if(count($experiences) > 0){
                                        // foreach($experiences as $key => $experience){
                                        
                                          $html .= '<div class="serch-main-box">
                                                   <h2 class="">Experience</h2>
                                                  ';
  
                                                  foreach($experiences as $key => $experience){
                                                    $html .='<div class="d-flex pt-3">
                                                    <div class="searc-icon-bx">
                                                      <img src="assets/admin/images/bytecipher.png">
                                                    </div>
                                                    <div class="searc-icon-bx-text">
                                                      <h2>'.$experience->designation.'</h2>
                                                      <h4>'.$experience->org_name.'  '.$experience->emp_type.'</h4>
                                                      <p class="pt-2"><span> '.$experience->start_date.' - '; 

                                                      if(empty($experience->end_date)){
                                                        $html .= 'Present </span></p>';
                                                      }
                                                      else{
                                                          $html .= $experience->end_date.'</span></p>';
                                                      }

                                                     $html .= '<p><span>Indore, Madhya Pradesh, India</span></p>
                                                      <p class="pt-2">'.$experience->review.'</p>';

                                                if(!empty($experience->rating)){
                                                        $html .='<fieldset class="rating">';
                                                            if($experience->rating == 5){
      
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 4.5){
                                                              $html .= '<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5" checked=""/>
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                              <label class="half" ></label>
              
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                              <label class = "full" ></label>
                                                              <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                              <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 4){
                                                                $html .=' <input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 3){
                                                                $html .='<input type="radio" name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half"></label>
                
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" checked=""/>
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half"></label>';
                                                            }
      
                                                            if($experience->rating == 2.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 2){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" checked=""/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" checked=""/>
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 1){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5"/>
                                                                <label class ="full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" checked="" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" />
                                                                <label class="half" ></label>';
                                                            }
      
                                                            if($experience->rating == 0.5){
                                                                $html .='<input type="radio"  name="textiles-rating'.$experience->id.'" value="5" />
                                                                <label class = "full" ></label>
                                                                <input type="radio"  name="textiles-rating'.$experience->id.'" value="4.5"  />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="4"/>
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3.5" />
                                                                <label class="half" ></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="3" />
                                                                <label class = "full" ></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="2" />
                                                                <label class = "full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1.5" />
                                                                <label class="half"></label>
                
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="1" />
                                                                <label class="full"></label>
                                                                <input type="radio" name="textiles-rating'.$experience->id.'" value="0.5" checked=""/>
                                                                <label class="half"></label></fieldset>';
                                                            }
                                                          }
                                                            $html .='</div>
                                                          <img src="assets/admin/images/verified-icon.png" class="verified-img"></div><hr>';
                                                        }
                                          $html .= '</div>';
  
                                       }
                                 $educations = Employee::leftJoin('employee_qualifications', 'employee_qualifications.employee_id', '=', 'employee.id')
                                          ->where('employee_qualifications.employee_id',$empDetails->id)
                                          ->select('employee_qualifications.*')
                                          ->get();
                                    if(count($educations)>0){
                                          $html .= '<div class="serch-main-box"> 
                                              <h2 class="">Education Details</h2>';
                                      foreach($educations as $education){
                                              $html .='<div class="d-flex pt-3">
                                                <div class="searc-icon-bx">
                                                  <img src="assets/admin/images/Sage_University_logo.png">
                                                </div>
                                                <div class="searc-icon-bx-text">
                                                  <h2>'.$education->inst_name.'</h2>
                                                  <h4>'.$education->degree.' , '.$education->subject.'</h4>
                                                  <p class="pt-2"><span>'.$education->duration_from.' - '.$education->duration_to.'</span></p>
                                                </div>
                                                <img src="assets/admin/images/verified-icon.png" class="verified-img">
                                              </div><hr>';
                                              }
                                            $html .='</div>';  
                                     }
                                          
                                    $html .= '</div>
                                  </div>';
                              }
                          }
                          return FacadesResponse::json(['success' => true, 'value' => $html]);
                      }
                    break;
            }
        } else {
            return FacadesResponse::json([]);
        }
    }
}