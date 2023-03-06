<!DOCTYPE html>
<html lang="en">

<head>
  <title>ByteCipher - Invite Employee Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/org-invite/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/main-container.css">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/org-invite/js/jquery.min.js"></script>

  
</head>

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-12">
            <h1>Onboarding</h1>
            <p>Here’s your report overview by today</p>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Qualification</a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Work History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Skills</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-controls="tab">Identity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Official Use</a>
          </li>  

        </ul> 
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                  @endif
                <form action="" method="post"  enctype="multipart/form-data">
                  @csrf 
          
                  {{-- <input type="hidden" name="id" value="{{ $basic->id }}"> --}}

                  <div class="row">                  
                    <div class="col-lg-3">
                      <div class="profile-add-img">
                        <div class="circle">
                          <img class="profile-pic" id="profile-pic" name="profile" @if ($basic->profile!== Null) value="/image/{{ old('profile', $basic->profile) }}" src="/image/{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/logo.png" @endif required>
                         </div>
                         <div class="p-image ml-auto">
                           <span class="upload-button" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                            <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*"/>
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-9">                    
                      <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="first_name">*First Name</label>
                            <input type="text" name="first_name" @if ($basic) value="{{ old('first_name', $basic->first_name) }}" @endif class="form-control" placeholder="Enter Your First Name" required>
                            @error('first_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name"  @if ($basic) value="{{ old('middle_name', $basic->middle_name) }}" @endif  class="form-control" placeholder="Enter Your Middle Name" >
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="last_name">*Last Name</label>
                            <input type="text" name="last_name" @if ($basic) value="{{ old('last_name', $basic->last_name) }}" @endif  class="form-control" placeholder="Enter Your Last Name" required>
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="email">*Official Email Id</label>
                            <input type="text" name="email" @if ($basic) value="{{ old('email', $basic->email) }}" @endif class="form-control" placeholder="Enter Your Email" required>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" @if ($basic) value="{{ old('phone', $basic->phone) }}" @endif class="form-control" placeholder="Enter Your Number" required>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-xl-12 mt-3"><h2>Personal</h2></div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control"  @if ($basic) value="{{ old('dob', $basic->dob) }}" @endif placeholder="DOB" required>
                      </div>
                    </div> 
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Select Blood Group</label>
                    
                          <select class="form-control" name="blood_group" id="blood_group" @if ($basic) value="{{ old('blood_group', $basic->blood_group) }}" @endif required>
                              <option @if ($basic) value="{{ old('blood_group', $basic->blood_group) }}" @endif>@if ($basic) {{ old('dob', $basic->blood_group) }} @endif</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                          </select>
                   
                      </div>                          
                    </div> 
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Select Gender</label>
                      
                          {{-- <div class="selectBox__value">Select Gender</div> --}}
                        
                            <select class="form-control" name="gender" @if ($basic) value="{{ old('gender', $basic->gender) }}" @endif  id="gender" required>
                              <option @if ($basic) value="{{ old('gender', $basic->gender) }}" @endif>@if ($basic) {{ old('gender', $basic->gender) }} @endif</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                        
                   
                      </div>
                    </div>  
                    
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Marital Status</label>
                    
                          <select class="form-control" name="marital_status" @if ($basic) value="{{ old('marital_status', $basic->marital_status) }}" @endif id="marital_status" required>
                            <option @if ($basic) value="{{ old('marital_status', $basic->marital_status) }}" @endif>@if ($basic) {{ old('marital_status', $basic->marital_status) }} @endif</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                          </select>
                 
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="current_address">Current Address</label>
                        <textarea rows="3" name="current_address" placeholder="Address" class="form-control" @if ($basic) value="{{ old('current_address', $basic->current_address) }}" @endif required>@if ($basic) {{old('current_address',$basic->current_address)}} @endif</textarea>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="permanent_address">Permanent Address</label>
                        <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control" @if ($basic) value="{{ old('permanent_address', $basic->permanent_address) }}" @endif required>@if ($basic) {{old('permanent_address',$basic->permanent_address)}} @endif</textarea>
                      </div>
                    </div>
                    <div class="col-xl-12 mt-3"><h2>Emergency Contact</h2></div>                        
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_name">Name</label>
                        <input type="text" name="emg_name" @if ($basic) value="{{ old('emg_name', $basic->emg_name) }}" @endif class="form-control" placeholder="Enter Name" required>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_relationship">Relationship</label>
                        <input type="text" name="emg_relationship" @if ($basic) value="{{ old('emg_relationship', $basic->emg_relationship) }}" @endif class="form-control" placeholder="Enter Relation" required>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_phone">Phone Number</label>
                        <input type="text" name="emg_phone" @if ($basic) value="{{ old('emg_phone', $basic->emg_phone) }}" @endif class="form-control" placeholder="Number" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_address">Address</label>
                        <textarea rows="3" name="emg_address" class="form-control" @if ($basic) value="{{ old('emg_address', $basic->emg_address) }}" @endif required>@if ($basic) {{old('emg_address',$basic->emg_address)}} @endif</textarea>
                      </div>
                    </div>
                  </div>                   
                      <div class="add-btn-part">
                        {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                        <button type="submit" name="basic-edit" class="btn-primary-cust">Save Changes</button>
                      </div>
                                                   
                    </form>         
              </div>
            </div>
          </div>
         
  
          <div class="tab-pane" id="tabs-2" role="tabpanel">
       
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        {{-- <div class="col-xl-12">
                          <h2>Uploaded Documents <span class="ml-auto on-head-right" data-toggle="modal" data-target="#identityAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div> --}}
                    

                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              @if($identity)
                              
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Type</th>
                                    <th>Id</th>
                                    <th>Verification</th>
                                    <th>Actions</th>
                                  </tr>
                                  </thead>
                                    <tr>
                                      <td>{{ $identity->id_type}}</td>
                                      <td>{{ $identity->id_number }}</td>
                                      <td><span class="verified-clr"><i class="fa fa-check"></i>{{ $identity->verification_type}}</span></td>
                                      <td>
                                        <span class="d-flex tbl-iconBx">
                                          <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                          <a href="{{ asset('assets') }}/admin/images/pan-card.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                          <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                        </span>
                                      </td>
                                    </tr>
                                   
                                  <tbody>
                                </tbody>
                              </table>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            {{-- <div class="add-btn-part">
                              <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>                
              </div>
            </div>
          </div>
         
          <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd">
                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                          </span></h2>
                        </div>
                    
                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              @if(!$qualification)
                              <p class="no-data-clg">No Data Available</p>  
                              @else
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Degree</th>
                                    <th>School/College/Institute</th>                                    
                                    <th>Subject</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Verification</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>                                    
                                    <td>{{$qualification->degree}}</td> 
                                    <td>{{$qualification->inst_name}}</td> 
                                    <td>{{$qualification->subject}}</td>
                                    <td>{{$qualification->duration_from}}</td>  
                                    <td>{{$qualification->duration_to}}</td>  
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> {{$qualification->verification_type}}</span></td>
                                    <td>
                                      <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                      <a href="{{ asset('assets') }}/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                      <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                    </td>
                                  </tr>
                              
                                </tbody>
                                <tbody>
                                </tbody>
                              </table>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            {{-- <div class="add-btn-part">
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-4" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    @if($workhistory)
                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#workHistorybtn">
                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                          </span></h2>
                        </div>
                        {{-- <p class="no-data-clg">No Data Available</p>   --}}

                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Company Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Designation</th>
                                    <th>Offer Letter</th>
                                    <th>Experience</th>
                                    <th>Salary Slips</th>
                                    <th>Verification</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                  <tr>
                                    <td>{{ $workhistory->com_name }}</td>
                                    <td>{{ $workhistory->work_duration_from }}</td>  
                                    <td>{{ $workhistory->work_duration_to }}</td> 
                                    <td>{{ $workhistory->designation }}</td>  
                                    <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a></td>
                                    <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a></td>
                                    <td><a href="{{ asset('assets') }}/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a></td>
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> {{ $workhistory->verification_type }}</span></td>
                                    <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                                  </tr>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            {{-- <div class="add-btn-part">
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </form>
                    @else
                    <p>No data Available</p>
                    @endif
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-5" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    @if($skills)
                    <form>
                      <div class="row"> 
                        <div class="col-xl-6">
                          <div class="col-xl-12">
                            <h2>Skills <span class="ml-auto on-head-right" data-toggle="modal" data-target="#skillsAdd">
                              {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                            </span></h2>
                          </div>
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Skill Name</th>
                                    <th>Competency Levels</th>
                                    <th>Action</th>
                                  </tr>
                                  </thead>
                                    <tr>
                                      <td>{{ $skills->skill }}</td>
                                      <td>{{ $skills->skill_type }}</td>
                                      <td><button type="button" class="border-none" data-toggle="modal" data-target="#skillsAdd"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                                    </tr>
                                   
                                  <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6">
                          <div class="col-xl-12">
                            <h2>known Language <span class="ml-auto on-head-right" data-toggle="modal" data-target="#skillsLanguageAdd">
                              {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                            </span></h2>
                          </div>
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Skill Name</th>
                                    <th>Competency Levels</th>
                                    <th>Action</th>
                                  </tr>
                                  </thead>
                                    <tr>
                                      <td>{{ $skills->lang }}</td>
                                      <td>{{ $skills->lang_type }}</td>
                                      <td><button type="button" class="border-none" data-toggle="modal" data-target="#langskillsAdd"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                                    </tr>
                                   
                                  <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save Changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    @else
                    <p>No Data Available</p>
                    @endif
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-6" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">

                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12"><h2>Official Info</h2></div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" @if ($official) value="#00{{ old('emp_id', $official->emp_id) }}" @endif  name="emp_id" class="form-control" placeholder="Id Number" readonly>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Date of Joining</label>
                            <input type="date" @if ($official) value="{{ old('doj', $official->doj) }}" @endif name="doj" class="form-control" placeholder="Date">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Probation Period</label>
                            <input type="text" @if ($official) value="{{ old('prob_period', $official->prob_period) }}" @endif name="prob_period" class="form-control" placeholder="In Day">
                          </div>
                        </div> 
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Type</label>
                            <select class="form-control" name="emp_type" id="emp_type" required>
                              <option name="emp_type" @if ($official) value="{{ old('emp_type', $official->emp_type) }}" @endif>@if ($official) {{ old('emp_type', $official->emp_type) }} @endif</option>
                              <option value="Part Time">Part Time</option>
                              <option value="Full Time">Full Time</option>
                              <option value="Trainee">Trainee</option>
                              <option value="Freelancer">Freelancer</option>
                            </select>
                          </div>                          
                        </div> 
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Work Location</label>
                            <select class="form-control" name="work_location" id="work_location" required>
                              <option name="work_location" @if ($official) value="{{ old('work_location', $official->work_location) }}" @endif>@if ($official) {{ old('work_location', $official->work_location) }} @endif</option>
                              <option value="Bhopal, MP">Bhopal, MP</option>
                              <option value="Indore, MP">Indore, MP</option>
                              <option value="Pune, MH">Pune, MH</option>-
                         
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Status</label>
                            <select name="emp_status" class="form-control" id="emp_status">
                              <option name="emp_status" @if ($official) value="{{ old('emp_status', $official->emp_status) }}" @endif>@if ($official) {{ old('emp_status', $official->emp_status) }} @endif</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>                              
                               </select>
                          </div>
                        </div>  

                        <div class="col-xl-12 mt-3"><h2>Salary Info</h2></div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Salary</label>
                            <input type="text" @if ($official) value="{{ old('salart_info', $official->salart_info) }}" @endif name="salart_info" class="form-control" placeholder="In Hand">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>LPA</label>
                            <input type="text" @if ($official) value="{{ old('lpa', $official->lpa) }}" @endif name="lpa" class="form-control" placeholder="Enter LPA">
                          </div>
                        </div>

                        <div class="col-xl-12">
                          <div class="row salary-bg-on">
                            <div class="col-xl-12"><h6 class="d-flex">Appraisal <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn">
                              {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                            </span></h6></div>
                            <div class="col-xl-2 col-lg-4 col-md-6">
                              <div class="form-group">
                                <label>From</label>
                                <input type="text" @if ($official) value="{{ old('app_from', $official->app_from) }}" @endif name="app_from" class="form-control" placeholder="10,000">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6">
                              <div class="form-group">
                                <label>To</label>
                                <input type="text" @if ($official) value="{{ old('app_to', $official->app_to) }}" @endif name="app_to" class="form-control" placeholder="To">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Last Desig.</label>
                                <input type="text" @if ($official) value="{{ old('last_app_desig', $official->last_app_desig) }}" @endif  name="last_app_desig" class="form-control" placeholder="Last Desig.">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Current Desig.</label>
                                <input type="text" @if ($official) value="{{ old('current_app_desig', $official->current_app_desig) }}" @endif name="current_app_desig" class="form-control" placeholder="Current Desig.">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" @if ($official) value="{{ old('app_date', $official->app_date) }}" @endif name="app_date" class="form-control" placeholder="Date">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 ">
                          <div class="row salary-bg-on">
                            <div class="col-xl-12"><h6 class="d-flex"> Promotion <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn">
                              {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                            </span></h6></div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>From</label>
                                <input type="text" @if ($official) value="{{ old('pro_from', $official->pro_from) }}" @endif name="pro_from" class="form-control" placeholder="10,000">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>To</label>
                                <input type="text" @if ($official) value="{{ old('pro_to', $official->pro_to) }}" @endif name="pro_to" class="form-control" placeholder="To">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Last Desig.</label>
                                <input type="text" @if ($official) value="{{ old('last_pro_desig', $official->last_pro_desig) }}" @endif name="last_pro_desig" class="form-control" placeholder="Last Desig.">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Current Desig.</label>
                                <input type="text" @if ($official) value="{{ old('current_pro_desig', $official->current_pro_desig) }}" @endif name="current_pro_desig" class="form-control" placeholder="Current Desig.">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" @if ($official) value="{{ old('pro_date', $official->pro_date) }}" @endif name="pro_date" class="form-control" placeholder="Date">
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-xl-12 mt-3"><h2>Reporting Manager</h2></div> -->
                        

                      <div class="col-xl-12">
                        <div class="form-group repo-mange-box mt-3">
                            <h2>Reporting Manager</h2>
                            <div class="row customer_recordsoff">
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" @if ($official) value="{{ old('mang_name', $official->mang_name) }}" @endif name="mang_name" class="form-control" placeholder="Name">
                                </div>
                              </div>
                              <div class="col-xl-2 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Type</label>
                                  {{-- <div class="selectBox active form-control">
                                    <div class="selectBox__value">Type</div>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item active">Type</a>
                                      <a class="dropdown-item">Primary</a>
                                      <a class="dropdown-item">Secondary</a>
                                    </div>
                                  </div> --}}
                                  <select name="mang_type" class="form-control" id="mang_type">
                                    <option name="mang_type" @if ($official) value="{{ old('mang_type', $official->mang_type) }}" @endif>@if ($official) {{ old('mang_type', $official->mang_type) }} @endif</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>                              
                                     </select>
                                </div>
                              </div>                                
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Department</label>
                                  <input type="text" @if ($official) value="{{ old('mang_dept', $official->mang_dept) }}" @endif name="mang_dept" class="form-control" placeholder="Department">
                                </div>
                              </div>
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Designation</label>
                                  <input type="text" @if ($official) value="{{ old('mang_desig', $official->mang_desig) }}" @endif name="mang_desig" class="form-control" placeholder="Designation">
                                </div>
                              </div>                              
                              {{-- <a class="add-plus extra-fields-customeroff"><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                            </div>
                            <div class="customer_records_dynamicoff"></div>
                        </div>
                       </div>  


                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                              <button type="submit" name="official-edit" class="btn-primary-cust">Save Changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--- Main Container Close ----->


      <!-- The Modal Skills Add -->
  <div class="modal fade custu-modal-popup" id="skillsAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Skills</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group inputtag-custom">
                <label>Add Skill</label>
                <div class="row customer_records1">
                  <div class="col-md-8">
                    <input type="text" class="form-control input-search-box typeahead" @if ($skills) value="{{ old('skill', $skills->skill) }}" @endif name="skill" data-provide="typeahead" placeholder="Language">
                  </div>
                  <div class="col-md-8">
                    <h6>
                      <span><input type="radio" id="customRadioInline4" name="skill_type" value="Beginner" class="" checked>
                      <label class="" for="customRadioInline4">Beginner</label></span>
                      
                      <span><input type="radio" id="customRadioInline5" name="skill_type" value="Intermediate"  class="">
                      <label class="" for="customRadioInline5">Intermediate</label></span>
                      <span><input type="radio" id="customRadioInline6" name="skill_type" value="Expert"  class="" >
                      <label class="" for="customRadioInline6">Expert</label></span>
                    </h6>  
                  </div>
                  {{-- <a class="add-plus extra-fields-customer" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                </div>
                <div class="customer_records_dynamic"></div>
                <div class="modal-footer">
                  {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                  {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                  <button type="submit" name="skill-edit" class="btn-primary-cust">Save Changes</button>
                </div>
            </div>
          </div>
        
        </div>
        </div>
      </div>
    </div>
  </form>
      <!-- The Modal language Skills Add -->
      <div class="modal fade custu-modal-popup" id="langskillsAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="exampleModalLabel">Edit Skills</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
              </button>
            </div>
            <div class="modal-body">
              <div class="comman-body">
                 <form method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group inputtag-custom">
                    <label>Add Skill</label>
                    <div class="row customer_records1">
                      <div class="col-md-8">
                        <input type="text" class="form-control input-search-box typeahead" @if ($skills) value="{{ old('lang', $skills->lang) }}" @endif name="lang" data-provide="typeahead" placeholder="Language">
                      </div>
                      <div class="col-md-8">
                        <h6>
                          <span><input type="radio" id="customRadioInline4" name="lang_type" value="Beginner"  class="">
                          <label class="" for="customRadioInline4">Beginner</label></span>
                          
                          <span><input type="radio" id="customRadioInline5" name="lang_type" class="" value="Intermediate"  checked="">
                          <label class="" for="customRadioInline5">Intermediate</label></span>
                          <span><input type="radio" id="customRadioInline6" name="lang_type" value="Expert" class="" >
                          <label class="" for="customRadioInline6">Expert</label></span>
                        </h6>  
                      </div>
                      <a class="add-plus extra-fields-customer" >
                        {{-- <span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span> --}}
                      </a>
                    </div>
                    <div class="customer_records_dynamic"></div>
                    <div class="modal-footer">
                      {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                      {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                      <button type="submit" name="skilllang-edit" class="btn-primary-cust">Save Changes</button>
                    </div>
                </div>
              </div>
            
            </div>
            </div>
          </div>
        </div>
      </form>
  <!-- The Modal Identity Add -->
  <div class="modal fade custu-modal-popup" id="identityAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Identity</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Id Type</div>
                      <div class="dropdown-menu" id="style-5">
                        <a class="dropdown-item active">Id Type</a>
                        <a class="dropdown-item">Pan Card</a>
                        <a class="dropdown-item">Aadhar Card</a>
                        <a class="dropdown-item">voter Id</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="" class="form-control" placeholder="Number">
                  </div>
                </div>                
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic1" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button1">Choose File</span>
                        <input class="file-upload" id="file-upload1" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Verification Type</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Verification Type</a>
                        <a class="dropdown-item">Verified</a>
                        <a class="dropdown-item">Not Verified</a>                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal Identity Edit -->
  <div class="modal fade custu-modal-popup" id="identityEdit" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Identity</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            @if($identity)
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <select   class="form-control" name="id_type" id="id_type">
                      <option @if ($identity) value="{{ old('id_type', $identity->id_type) }}" @endif>@if ($identity) {{ old('id_type', $identity->id_type) }} @endif</option>
                      <option value="Pan Card">Pan Card</option>
                      <option value="Aadhar Card">Aadhar Card</option>
                      <option value="Voter Id">Voter Id</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="id_number" @if ($identity) value="{{ old('id_number', $identity->id_number) }}" @endif class="form-control" >
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic2" name="document" @if ($identity->document!== Null) value="/image/{{ old('document', $identity->document) }}" src="/image/{{ $identity->document }}" @else src="{{ asset('assets') }}/admin/images/pan-card.png" @endif>
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button2">Choose File</span>
                        <input class="file-upload" name="document" id="file-upload2" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              {{-- <div class="col-lg-3">
                <div class="profile-add-img">
                  <div class="circle">
                    <img class="profile-pic" id="profile-pic" name="profile" @if ($basic->profile!== Null) value="/image/{{ old('profile', $basic->profile) }}" src="/image/{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/logo.png" @endif required>
                   </div>
                   <div class="p-image ml-auto">
                     <span class="upload-button" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                      <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*"/>
                   </div>
                </div>
              </div> --}}





              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option @if ($identity) value="{{ old('verification_type', $identity->verification_type) }}" @endif>@if ($identity) {{ old('verification_type', $identity->verification_type) }} @endif</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                <button type="submit" name="identity-edit" class="btn-primary-cust">Save Changes</button>
              </div>
          </div>
        </div>
      
      
      </div>
    </div>
  </div>
</form>

@endif
  <!-- The Modal Qualification Add -->
  <div class="modal fade custu-modal-popup" id="qualificationAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      @if($qualification)
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Qualification</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>School/College/Institute</label>
                    <input type="text" name="inst_name" class="form-control" placeholder="Enter Name">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Degree</label>
                    <input type="text" name="degree" @if ($qualification) value="{{ old('degree', $qualification->degree) }}" @endif class="form-control" placeholder="Ex. Bachelor's">
                  </div>
                  <div class="col-md-6">
                    <label>Subject</label>
                    <input type="text" name="subject" @if ($qualification) value="{{ old('subject', $qualification->subject) }}" @endif class="form-control" placeholder="Ex. CS">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="duration_from" class="form-control" @if ($qualification) value="{{ old('duration_from', $qualification->duration_from) }}" @endif placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="duration_to" class="form-control" @if ($qualification) value="{{ old('duration_to', $qualification->duration_to) }}" @endif placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic3" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button3">Choose File</span>
                        <input class="file-upload" name="document" id="file-upload3" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option @if ($qualification) value="{{ old('verification_type', $qualification->verification_type) }}" @endif>@if ($qualification) {{ old('verification_type', $qualification->verification_type) }} @endif</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
          </div>
        </div>
        @else
        <p>No Data Available</p>
        @endif
        <div class="modal-footer">
          {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
          <button type="submit" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>  
</form>
  <!-- The Modal Qualification Edit -->
  <div class="modal fade custu-modal-popup" id="qualificationEdit" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Qualification</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        @if($qualification)
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>School/College/Institute</label>
                    <input type="text" name="inst_name" @if ($qualification) value="{{ old('inst_name', $qualification->inst_name) }}" @endif class="form-control" placeholder="Enter Name">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Degree</label>
                    <input type="text" name="degree" @if ($qualification) value="{{ old('degree', $qualification->degree) }}" @endif class="form-control" placeholder="Ex. Bachelor's">
                  </div>
                  <div class="col-md-6">
                    <label>Field Of study</label>
                    <input type="text" name="subject" @if ($qualification) value="{{ old('subject', $qualification->subject) }}" @endif class="form-control" placeholder="Ex. CS">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="duration_from" class="form-control" @if ($qualification) value="{{ old('duration_from', $qualification->duration_from) }}" @endif placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="duration_to" class="form-control" @if ($qualification) value="{{ old('duration_to', $qualification->duration_to) }}" @endif placeholder="From">
                  </div>
                </div>
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic4" name="document" @if ($qualification->document!== Null) value="/image/{{ old('document', $qualification->document) }}" src="/image/{{ $qualification->document }}" @else value="" src="{{ asset('assets') }}/admin/images/file-icon-img.png" @endif/>
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button4">Choose File</span>
                        <input class="file-upload" name="document"  id="file-upload4" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option @if ($qualification) value="{{ old('verification_type', $qualification->verification_type) }}" @endif>@if ($qualification) {{ old('verification_type', $qualification->verification_type) }} @endif</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                <button type="submit" name="qualification-edit" class="btn-primary-cust">Save Changes</button>
              </div>
          </div>
        </div>
      @else
      <p>No Data Available</p>
      @endif
      
      </div>
    </div>
  </div>
</form>
  <!-- The Modal Docum INFO-->
  <div class="modal fade custu-modal-popup" id="qualificationdocument" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="document-body">
            <img src="{{ asset('assets') }}/admin/images/job-offer-letter.png">
          </div>
          <a href="{{ asset('assets') }}/admin/images/pan-card.png" target="_black">Download</a>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary">Save Changes</button> -->
        </div>
      </div>
    </div>
  </div>   
  
  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="qualificationinfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
          <h1>No Data Available</h1>
          <p>Upload your document file</p>
          <a data-dismiss="modal" data-toggle="modal" data-target="#qualificationEdit">Ok</a>
        </div>
      </div>
    </div>
  </div> 

  <!-- The Modal Docum INFO-->
  <div class="modal fade custu-modal-popup" id="exampleModaldocument" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Pan Card</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="document-body">
            <img src="{{ asset('assets') }}/admin/images/pan-card.png">
          </div>
          <a href="{{ asset('assets') }}/admin/images/pan-card.png" target="_black">Download</a>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary">Save Changes</button> -->
        </div>
      </div>
    </div>
  </div>   
  
  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
          <h1>No Data Available</h1>
          <p>Upload your document file</p>
          <a data-dismiss="modal" data-toggle="modal" data-target="#identityEdit">Ok</a>
        </div>
      </div>
    </div>
  </div>   
  <!-- The Modal Work Work HistoryBasic Edit -->
  <div class="modal fade custu-modal-popup" id="workHistoryedit" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Work History</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        @if($workhistory)
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Company Name</label>
                    <input type="text"  name="com_name" @if ($workhistory) value="{{ old('com_name', $workhistory->com_name) }}" @endif  class="form-control" value="ByteCipher">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Form</label>
                    <input type="date" name="work_duration_from" @if ($workhistory) value="{{ old('work_duration_from', $workhistory->work_duration_from) }}" @endif class="form-control" value="2018">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="work_duration_to" @if ($workhistory) value="{{ old('work_duration_to', $workhistory->work_duration_to) }}" @endif  class="form-control" value="2020">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation</label>
                    <input type="text" name="designation" @if ($workhistory) value="{{ old('designation', $workhistory->designation) }}" @endif  class="form-control" value="React Native Developer">
                  </div>
                </div>
              </div> 
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Offer Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic"  id="profile-pic8" @if ($workhistory->offer_letter!== Null) value="/image/{{ old('document', $workhistory->offer_letter) }}" src="/image/{{ $workhistory->offer_letter }}" @else src="{{ asset('assets') }}/admin/images/job-offer-letter.png" @endif>
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button8">Choose File</span>
                        <input class="file-upload"  name="offer_letter" id="file-upload8" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            



              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Experience Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic9" @if ($workhistory->exp_letter!== Null) value="/image/{{ old('exp_letter', $workhistory->exp_letter) }}" src="/image/{{ $workhistory->exp_letter }}" @else src="{{ asset('assets') }}/admin/images/job-offer-letter.png" @endif >
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button9">Choose File</span>
                        <input class="file-upload" name="exp_letter" id="file-upload9" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Salary Slips</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic10" @if ($workhistory->salary_slip!== Null) value="/image/{{ old('salary_slip', $workhistory->salary_slip) }}" src="/image/{{ $workhistory->salary_slip }}" @else src="{{ asset('assets') }}/admin/images/pdf-icon.png" @endif>
                      </div>
                      <p>You can drag or drop <span>pdf</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button10">Choose File</span>
                        <input class="file-upload"  name="salary_slip" id="file-upload10" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div> 
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option @if ($workhistory) value="{{ old('verification_type', $workhistory->verification_type) }}" @endif>@if ($workhistory) {{ old('verification_type', $workhistory->verification_type) }} @endif</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                <button type="submit" name="workhistory-edit" class="btn-primary-cust">Save Changes</button>
              </div>
          </div>
          @else
          <p>No Data Available</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</form>

  

  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="workhisinfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
          <h1>No Data Available</h1>
          <p>Upload your document file</p>
          <a data-dismiss="modal" data-toggle="modal" data-target="#workHistoryedit">Ok</a>
        </div>
      </div>
    </div>
  </div> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
    <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
   <!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->

    <script>
      $(".selectBox").on("click", function(e) {
        $(this).toggleClass("show");
        var dropdownItem = e.target;
        var container = $(this).find(".selectBox__value");
        container.text(dropdownItem.text);
        $(dropdownItem)
          .addClass("active")
          .siblings()
          .removeClass("active");
      });
    </script>

    
    <script>
      
        // Initializes  input( name of states)
        // with a typeahead
        var $input = $(".typeahead");
        $input.typeahead({
            source: [
                "Css",
                "Css3",
                "Java",
                "Figma",
                "Html",
                "Html5",
                "Laravel",
                "Php",
                "ios",
                "React Js",
                "React Native",
            ],
            autoSelect: true,
        });
  
        $input.change(function () {
            var current = $input.typeahead("getActive");
            matches = [];
  
            if (current) {
  
                // Some item from your input matches
                // with entered data
                if (current.name == $input.val()) {
                    matches.push(current.name);
                }
            }
        });
    </script>

    <script>
      
        var $input = $(".typeahead1");
        $input.typeahead({
            source: [
                "Bhojpuri",
                "Bengali",
                "English",
                "French",
                "Gujarati",
                "Hindi",
                "Russian",
                "Spanish",
                "Tamil",
            ],
            autoSelect: true,
        });
  
        $input.change(function () {
            var current = $input.typeahead("getActive");
            matches = [];
  
            if (current) {
  
                // Some item from your input matches
                // with entered data
                if (current.name == $input.val()) {
                    matches.push(current.name);
                }
            }
        });
    </script>

    <script>
      $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamic > .single').attr("class", "row");

        $('.customer_records_dynamic input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>


    <script>
      $('.extra-fields-customer1').click(function() {
        $('.customer_records1').clone().appendTo('.customer_records_dynamic1');
        $('.customer_records_dynamic1 .customer_records1').addClass('single remove');
        $('.single .extra-fields-customer1').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamic1 > .single').attr("class", "row");

        $('.customer_records_dynamic1 input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>


    <script>
      $('.extra-fields-customeroff').click(function() {
        $('.customer_recordsoff').clone().appendTo('.customer_records_dynamicoff');
        $('.customer_records_dynamicoff .customer_recordsoff').addClass('single remove');
        $('.single .extra-fields-customeroff').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamicoff > .single').attr("class", "row");

        $('.customer_records_dynamicoff input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>




</html>
