@extends('company/layouts.app')
@section('content')
@section('title','EVP - Onboarding-Employee')

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
            <a @if ($basic) class="nav-link" @else class="nav-link active" @endif data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li>
       
          <li class="nav-item">
            <a  class="nav-link {{ session('tabs-3_active') ? 'active': '' }}" data-toggle="tab" href="#tabs-3" role="tab">Qualification</a>
          </li>     
      
          <li class="nav-item">
            <a class="nav-link {{ session('tabs-4_active') ? 'active': '' }}" data-toggle="tab" href="#tabs-4" role="tab">Work History</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link {{ session('tabs-5_active') ? 'active': '' }}" data-toggle="tab" href="#tabs-5" role="tab">Skills</a>
          </li>                 
          <li class="nav-item">
            <a class="nav-link {{ session('tabs-2_active') ? 'active': '' }}"  data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
          </li>                                                                         
          <li class="nav-item"> 
            <a class="nav-link {{ session('tabs-6_active') ? 'active': '' }}"  data-toggle="tab" href="#tabs-6" role="tab">Official Use</a>
          </li>  

        </ul> 
    
        <div class="tab-content">
          @if(!$basic)
          <div id="tabs-1"  @if ($basic) class="tab-pane" @else class="tab-pane active" @endif >
            {{-- <div id="tab1" class="tab {{ !session('tab2_active') ? 'active', null }} ">  --}}
            <div class="eml-persnal ">
              <div class="add-emply-details">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                  @endif
                <form action="" method="post" enctype="multipart/form-data">
                  @csrf 
                  <div class="row">                  
                    <div class="col-lg-3">
                      <div class="profile-add-img">
                        <div class="circle">
                           <img class="profile-pic" id="profile-pic" name="profile" src="{{ asset('assets') }}/admin/images/user-img.png">
                         </div>
                         <div class="p-image ml-auto">
                           <span class="upload-button" for="file-upload" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                            <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*" required/>
                         </div>
                         {{-- <input type="file" name="image" value="{{ old('image') }}" class="custom-file-input" id="validatedCustomFile" required>
                           <label class="custom-file-label" for="validatedCustomFile">Choose file...</label> --}}
                      </div>
                    </div>
                    
                    <div class="col-lg-9">                    
                      <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="first_name">*First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter Your First Name" required>
                            @error('first_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" placeholder="Enter Your Middle Name" >
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="last_name">*Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Your Last Name" required>
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="email">*Official Email Id</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Your Email" required>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Your Number" required>
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
                        <input type="date" name="dob" class="form-control" placeholder="DOB" required>
                      </div>
                    </div> 
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Select Blood Group</label>
                    
                          <select class="form-control" name="blood_group" id="blood_group" required>
                              <option value="">Select Group</option>
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
                        
                            <select class="form-control" name="gender" id="gender" required>
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                        
                   
                      </div>
                    </div>  
                    
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Marital Status</label>
                    
                          <select class="form-control" name="marital_status" id="marital_status" required>
                            <option value="">Select Status</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                          </select>
                 
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="current_address">Current Address</label>
                        <textarea rows="3" name="current_address" placeholder="Address" class="form-control" required></textarea>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="permanent_address">Permanent Address</label>
                        <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control" required></textarea>
                      </div>
                    </div>
                    <div class="col-xl-12 mt-3"><h2>Emergency Contact</h2></div>                        
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_name">Name</label>
                        <input type="text" name="emg_name" class="form-control" placeholder="Enter Name" required>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_relationship">Relationship</label>
                        <input type="text" name="emg_relationship" class="form-control" placeholder="Enter Relation" required>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_phone">Phone Number</label>
                        <input type="text" name="emg_phone" class="form-control" placeholder="Number" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="emg_address">Address</label>
                        <textarea rows="3" name="emg_address" class="form-control" placeholder="Enter Address" required></textarea>
                      </div>
                    </div>
                  </div>                   
                      <div class="add-btn-part">
                        {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                        <button type="submit" name="basic" class="btn-primary-cust">Next</button>
                      </div>
                                                   
                    </form>      
              </div>
            </div>
          </div>
          @else
          <div class="tab-pane" id="tabs-1" role="tabpanel">
            {{-- <div id="tabs-1"  class="tab-pane {{ !session('tabs-6_active') ? 'active': '' }} "> --}}
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
                          <img class="profile-pic" id="profile-pic" name="profile" @if ($basic->profile!== Null) value="/image/{{ old('profile', $basic->profile) }}" src="/image/{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif required>
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
                            <label for="middle_name">*Middle Name</label>
                            <input type="text" name="middle_name"  @if ($basic) value="{{ old('middle_name', $basic->middle_name) }}" @endif  class="form-control" placeholder="Enter Your Middle Name">
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
                        <button type="submit" name="basic-edit" class="btn-primary-cust">Next</button>
                      </div>
                                                   
                    </form>         
              </div>
            </div>
          </div>
          @endif
       
          <div   class="tab-pane {{ session('tabs-2_active') ? 'active': '' }}" id="tabs-2" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Uploaded Documents <span class="ml-auto on-head-right" data-toggle="modal" data-target="#identityAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>
                        {{-- <p class="no-data-clg">No Data Available</p>   --}}
                     @if($ident)
             
                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Type</th>
                                    <th>Id</th>
                                    <th>Verification</th>
                                    {{-- <th>Actions</th> --}}
                                  </tr>
                                </thead>
                                @foreach($identity as $ident)
                                  <tbody>
                                    <tr>
                                      <td>{{ $ident['id_type']}}</td>
                                      <td>{{ $ident['id_number']}}</td>
                                      <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                                      {{-- <td>
                                        <span class="d-flex tbl-iconBx">
                                          <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><img src="assets/admin/images/document.png"></a>
                                          <a href="assets/admin/images/pan-card.png" target="_black" class="docu-download"><img src="assets/admin/images/download-icon.png"></a>
                                          <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="assets/admin/images/edit-icon.png"></button>
                                        </span>
                                      </td> --}}
                                    </tr>
                                </tbody>
                                @endforeach
                              </table>
                           
                            </div>
                          </div>
                        </div>
                        @else
                        <p class="no-data-clg">No Data Available</p> 
                        @endif
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                              {{-- <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button> --}}
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
          <div id="tabs-3" class="tab-pane {{ session('tabs-3_active') ? 'active': '' }} ">
            {{-- <div id="tab1" class="tab {{ !session('tab2_active') ? 'active', null }} ">  --}}
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>
                        {{-- <p class="no-data-clg">No Data Available</p>   --}}
                        @if($quali)
                      
                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Degree</th>
                                    <th>School/College/Institute</th>                                    
                                    <th>Subject</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Verification</th>
                                    {{-- <th>Action</th> --}}
                                  </tr>
                                </thead>
                                @foreach($qualification as $quaf)
                                <tbody>
                                  <tr>                                    
                                    <td>{{ $quaf['degree']}}</td> 
                                    <td>{{ $quaf['inst_name']}}</td> 
                                    <td>{{ $quaf['subject']}}</td>
                                    <td>{{ $quaf['duration_from']}}</td>  
                                    <td>{{ $quaf['duration_to']}}</td>  
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> {{ $quaf['verification_type']}}</span></td>
                                    {{-- <td>
                                      <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a>
                                      <a href="assets/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="assets/admin/images/download-icon.png"></a>
                                      <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="assets/admin/images/edit-icon.png"></button>
                                    </td> --}}
                                  </tr>
                                  
                                </tbody>
                                @endforeach
                              </table>
                            </div>
                          </div>
                        </div>
                      
              @else
              <p class="no-data-clg">No Data Available</p>
                 @endif
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                              {{-- <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button> --}}
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
          {{-- <div @if($quali && !$workhistory) class="tab-pane active" @else class="tab-pane" @endif id="tabs-4" role="tabpanel"> --}}
            <div id="tabs-4" class="tab-pane  {{ session('tabs-4_active') ? 'active': '' }}">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#workHistorybtn"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>
                        {{-- <p class="no-data-clg">No Data Available</p>   --}}
                    @if($workh)
                        @foreach($workhistory as $work)
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
                                    {{-- <th>Offer Letter</th> --}}
                                    {{-- <th>Experience</th> --}}
                                    {{-- <th>Salary Slips</th> --}}
                                    <th>Verification</th>
                                    {{-- <th>Action</th> --}}
                                  </tr>
                                </thead>
                           
                                <tbody>
                                  <tr>
                                    <td>{{ $work['com_name']}}</td>
                                    <td>{{ $work['work_duration_from']}}</td>  
                                    <td>{{ $work['work_duration_to']}}</td> 
                                    <td>{{ $work['designation']}}</td>  
                                    {{-- <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a></td> --}}
                                    {{-- <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a></td> --}}
                                    {{-- <td><a href="assets/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="assets/admin/images/pdf-icon.png"></a></td> --}}
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> {{ $work['verification_type']}}</span></td>
                                    {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td> --}}
                                  </tr>
                                </tbody>
                              
                              </table>
                            </div>
                          </div>
                        </div>
                        @endforeach
            @else
            <p class="no-data-clg">No Data Available</p> 
            @endif
            
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                              {{-- <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button> --}}
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
          @if(!$skills)
          <div class="tab-pane" id="tabs-5" role="tabpanel">
          
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                     <form method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group inputtag-custom">
                        <h2>Skills</h2>

                        <label>Add Your Skill</label>
                        <div class="row customer_records">
                          <div class="col-xl-5 col-lg-10 col-md-10">
                            <input type="text" class="form-control input-search-box typeahead" name="skill" placeholder="Add Skill" required>
                          </div>
                          <div class="col-xl-5 col-lg-10 col-md-10">
                            <h6>
                            <span><input type="radio" id="customRadioInline1" name="skill_type" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline1">Beginner</label></span>  
                            <span><input type="radio" id="customRadioInline2" name="skill_type" class="" value="Intermediate"> <label class="" for="customRadioInline2">Intermediate</label></span>
                            <span><input type="radio" id="customRadioInline3" name="skill_type" class="" value="Expert"><label class="" for="customRadioInline3">Expert</label></span>

                            </h6>  

                          </div>

                        {{-- <a class="add-plus extra-fields-customer" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                        </div>
                        <div class="customer_records_dynamic"></div>
                      </div>

                      <div class="form-group inputtag-custom mt-3 mb-5">
                        <h2>known Language</h2>

                        <label>Add Language</label>
                        <div class="row customer_records1">
                          <div class="col-xl-5 col-lg-10 col-md-10">
                            <input type="text" name="lang" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language" required>
                          </div>
                          <div class="col-xl-5 col-lg-10 col-md-10">
                            <h6>
                              <span><input type="radio" id="customRadioInline4" name="lang_type" class="" value="Beginner" checked="">
                                <label class="" for="customRadioInline4">Beginner</label></span>  
                              
                            <span><input type="radio" id="customRadioInline5" name="lang_type" class="" value="Intermediate" >
                              <label class="" for="customRadioInline5">Intermediate</label></span>
                              <span><input type="radio" id="customRadioInline6" name="lang_type" value="Expert"  class="" >
                                <label class="" for="customRadioInline6">Expert</label></span>
                            </h6>  
                          </div>
                          {{-- <a class="add-plus extra-fields-customer1" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                        </div>
                        <div class="customer_records_dynamic1"></div>
                      </div>

                      <div class="col-md-12 ">
                        <div class="form-group">
                          <div class="add-btn-part">
                            {{-- <button type="" class="btn-secondary-cust">Back</button> --}}
                            <button type="submit" name="workskill" class="btn-primary-cust">Next</button>
                          </div>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>                
              </div>
            </div>
          </div>
       
       @else
        <div class="tab-pane {{ session('tabs-5_active') ? 'active': '' }}" id="tabs-5" role="tabpanel">
          <div class="eml-persnal ">
            <div class="add-emply-details">                
              <div class="row">
                <div class="col-lg-12">
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
                                  {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                  <tr>
                                    <td>{{ $skills->skill }}</td>
                                    <td>{{ $skills->skill_type }}</td>
                                    {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#skillsAdd"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td> --}}
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
                                </tr>
                                </thead>
                                  <tr>
                                    <td>{{ $skills->lang }}</td>
                                    <td>{{ $skills->lang_type }}</td>
                                    {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#langskillsAdd">
                                      <img src="{{ asset('assets') }}/admin/images/edit-icon.png">
                                      </button
                                      ></td> --}}
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
                            {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                            {{-- <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button> --}}
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

        @endif
          <div class="tab-pane {{ session('tabs-6_active') ? 'active': '' }}" id="tabs-6" role="tabpanel">
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
                            <input type="text" name="emp_id" class="form-control" @if($basic) value="#00{{ $basic->id }}" @else value="" @endif placeholder="Id Number" readonly>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Date of Joining</label>
                            <input type="date" name="doj" class="form-control" placeholder="Date" required>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Probation Period</label>
                            <input type="text" name="pro_period" class="form-control" placeholder="In Day" required>
                          </div>
                        </div> 
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Type</label>
                      
                            <select class="form-control" name="emp_type" id="emp_type" required>
                              <option value="">Select Employee Type</option>
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
                              <option value="">Select Work Location</option>
                              <option value="Bhopal, MP">Bhopal, MP</option>
                              <option value="Indore, MP">Indore, MP</option>
                              <option value="Pune, MH">Pune, MH</option>
                         
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Status</label>
                            <select class="form-control" name="emp_status" id="emp_status" required>
                              <option value="">Select Status</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                            
                            </select>
                          </div>
                        </div>  

                        <div class="col-xl-12 mt-3"><h2>Salary Info</h2></div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" placeholder="In Hand" required>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>LPA</label>
                            <input type="text" name="lpa" class="form-control" placeholder="Enter LPA" required>
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
                                <input type="text" name="app_from" class="form-control" placeholder="10,000" required>
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6">
                              <div class="form-group">
                                <label>To</label>
                                <input type="text" name="app_to" class="form-control" placeholder="To" required>
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Last Desig.</label>
                                <input type="text" name="last_app_desig" class="form-control" placeholder="Last Desig." required>
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Current Desig.</label>
                                <input type="text" name="current_app_desig" class="form-control" placeholder="Current Desig." required>
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Date">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 ">
                          <div class="row salary-bg-on">
                            <div class="col-xl-12"><h6 class="d-flex"> Promotion <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn">
                              {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                            </span>
                            </h6></div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>From</label>
                                <input type="text" name="pro_from" class="form-control" placeholder="10,000">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>To</label>
                                <input type="text" name="pro_to" class="form-control" placeholder="To">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Last Desig.</label>
                                <input type="text" name="last_pro_desig" class="form-control" placeholder="Last Desig.">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Current Desig.</label>
                                <input type="text" name="current_pro_desig" class="form-control" placeholder="Current Desig.">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="pro_date" class="form-control" placeholder="Date">
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
                                  <input type="text" name="mang_name" class="form-control" placeholder="Name">
                                </div>
                              </div>
                              <div class="col-xl-2 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Type</label>
                                  <select class="form-control" name="mang_type" id="mang_type">
                                    <option value="">Select Type</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                  
                                  </select>
                                </div>
                              </div>                                
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Department</label>
                                  <input type="text" name="mang_dept" class="form-control" placeholder="Department">
                                </div>
                              </div>
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Designation</label>
                                  <input type="text" name="mang_desig" class="form-control" placeholder="Designation">
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
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="submit" name="official" class="btn-primary-cust">Save</button>
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
      </div>

    </div>
  </form>
    <!--- Main Container Close ----->

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
             <form method="post" enctype="multipart/form-data" action="">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <select class="form-control" name="id_type" id="id_type">
                      <option value="">Select Id </option>
                      <option value="Pan Card">Pan Card</option>
                      <option value="Aadhar Card">Aadhar Card</option>
                      <option value="Voter Id">Voter Id</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="id_number" class="form-control" placeholder="Number">
                  </div>
                </div>                
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      {{-- <div class="circle">
                        <img class="profile-pic" id="profile-pic" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div> --}}
                      {{-- <div class="p-image ml-auto"> --}}
                        <input type="file" name="document" id="file-upload" class="myfrm form-control" required>
                     {{-- </div> --}}

                  

                     
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
               
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option value="">Select Type </option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
               
                  </div>
                </div>
              </div>
         
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
          {{-- <button type="submit" name="identity" class="btn-primary-cust" >Save</button> --}}
          <button type="submit" name="identity" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>
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
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Pan Card</div>
                      <div class="dropdown-menu" id="style-5">
                        <a class="dropdown-item ">Id Type</a>
                        <a class="dropdown-item active"></a>
                        <a class="dropdown-item">Aadhar Card</a>
                        <a class="dropdown-item">voter Id</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="" class="form-control" value="AXXX11100X">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic2" src="{{ asset('assets') }}/admin/images/pan-card.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button2">Choose File</span>
                        <input class="file-upload" id="file-upload2" type="file" accept="image/*">
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
                      <div class="selectBox__value">Verified</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item ">Verification Type</a>
                        <a class="dropdown-item active">Verified</a>
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
          <button type="button" class="btn-primary-cust" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- The Modal Qualification Add -->
  <div class="modal fade custu-modal-popup" id="qualificationAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                    <input type="text" name="degree" class="form-control" placeholder="Ex. Bachelor's">
                  </div>
                  <div class="col-md-6">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="Ex. CS">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="duration_from" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="duration_to" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      {{-- <div class="circle">
                        <img class="profile-pic" id="profile-pic3" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div> --}}
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" for="file-upload3" id="upload-button3">Choose File</span>
                        {{-- <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>  --}}
                        <input class="file-upload" name="document" id="file-upload3" type="file">
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
                      <option value="">Verification Type</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="qulification" class="btn-primary-cust">Save</button>
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
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>School/College/Institute</label>
                    <input type="text" name="inst_name" class="form-control" value="New Science College Indore">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Degree</label>
                    <input type="text" name="" class="form-control" placeholder="B.E" >
                  </div>
                  <div class="col-md-6">
                    <label>Field Of study</label>
                    <input type="text" name="" class="form-control" value="Mechanical">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="" class="form-control" value="2013">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="" class="form-control" value="2017">
                  </div>
                </div>
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic4" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button4">Choose File</span>
                        <input class="file-upload" id="file-upload4" type="file" accept="image/*">
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
                      <div class="selectBox__value">Verified</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item ">Verification Type</a>
                        <a class="dropdown-item active">Verified</a>
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
          <button type="button" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div> 

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


  <!-- The Modal Work Work HistoryBasic-->
  <div class="modal fade custu-modal-popup" id="workHistorybtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Work History</h2>
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
                    <label>Company Name</label>
                    <input type="text" name="com_name" class="form-control" placeholder="ByteCipher" required>
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="work_duration_from" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="work_duration_to" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" placeholder="React Native Developer" required>
                  </div>                  
                </div>
              </div>  

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Offer Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic"  name="offer_letter"  id="profile-pic5" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button5">Choose File</span>
                        <input class="file-upload" name="offer_letter" id="file-upload5" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>


             
              {{-- <div class="company-pro">
                <div class="circle">
                 <img class="profile-pic" id="profile-pic" name="logo" @if ($profile->logo!== Null) value="/image/{{ old('logo', $profile->logo) }}" src="/image/{{ $profile->logo }}" @else src="assets/admin/images/logo.png" @endif required>
               </div>
               <p>You can drag or drop <span>your file logo here.</span> </p>
               <div class="p-image ml-auto">
                 <span class="upload-button" id="upload-button">Choose File</span>
                  <input class="file-upload"  name="logo" id="file-upload" type="file" accept="image/*"/>
               </div>
              </div> --}}

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Experience Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic"  name="exp_letter" id="profile-pic6" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button6">Choose File</span>
                        <input class="file-upload" name="exp_letter" id="file-upload6" type="file" accept="image/*">
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
                        <img class="profile-pic"  id="profile-pic7" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>pdf</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button7">Choose File</span>
                        <input class="file-upload" name="salary_slip" id="file-upload7" type="file" accept="image/*">
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
                      <option value="">Verification Type</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="workhistory" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div> 
</form>
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
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Company Name</label>
                    <input type="text" name="" class="form-control" value="ByteCipher">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Form</label>
                    <input type="date" name="" class="form-control" value="2018">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="" class="form-control" value="2020">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation</label>
                    <input type="text" name="" class="form-control" value="React Native Developer">
                  </div>
                </div>
              </div> 
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Offer Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic7" src="{{ asset('assets') }}/admin/images/job-offer-letter.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button7">Choose File</span>
                        <input class="file-upload" id="file-upload7" type="file" accept="image/*">
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
                        <img class="profile-pic" id="profile-pic9" src="{{ asset('assets') }}/admin/images/job-offer-letter.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button9">Choose File</span>
                        <input class="file-upload" id="file-upload9" type="file" accept="image/*">
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
                        <img class="profile-pic" id="profile-pic10" src="{{ asset('assets') }}/admin/images/pdf-icon.png">
                      </div>
                      <p>You can drag or drop <span>pdf</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button10">Choose File</span>
                        <input class="file-upload" id="file-upload10" type="file" accept="image/*">
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
                      <div class="selectBox__value">Verified</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item ">Verification Type</a>
                        <a class="dropdown-item active">Verified</a>
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
          <button type="button" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div> 

  

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


  <!-- The Modal Salary Add -->
  <div class="modal fade custu-modal-popup" id="salaryaddbtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Appraisal</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
             <form method="post" enctype="multipart/form-data">             
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="text" name="" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="text" name="" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
               <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Last Desig.</label>
                    <input type="text" name="" class="form-control" placeholder="Last Desig.">
                  </div>
                  <div class="col-md-6">
                    <label>Current Desig.</label>
                    <input type="text" name="" class="form-control" placeholder="Last Desig.">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Date</label>
                    <input type="date" name="" class="form-control" placeholder="date">
                  </div>                  
                </div>
              </div>  
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
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


@endsection