@extends('admin/layouts.emp_editapp')
@section('edit')
@section('title','EVP - Onboarding-Employee')


<div class="tab-content">
    <div class="tab-pane active" id="tabs-1" role="tabpanel">
      <div class="eml-persnal ">
        <div class="add-emply-details">
          @if (session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
            @endif
          <form action="" method="post">
            @csrf 
    
            {{-- <input type="hidden" name="id" value="{{ $basicinfo->id }}"> --}}

            <div class="row">                  
              <div class="col-lg-3">
                <div class="profile-add-img">
                  <div class="circle">
                     <img class="profile-pic" id="profile-pic" name="profile" @if ($basicinfo->profile!== Null) value="public/images/{{ old('profile', $basicinfo->profile) }}" src="public/images/{{ $basicinfo->profile }}" @else src="{{ asset('assets') }}/admin/images/logo.png" @endif required>
                   </div>
                   <div class="p-image ml-auto">
                     <span class="upload-button" name="profile" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                      <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*"/>
                   </div>
                </div>
              </div>
              <div class="col-lg-9">                    
                <div class="row">
                  <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                      <label for="first_name">*First Name</label>
                      <input type="text" name="first_name" @if ($basicinfo) value="{{ old('first_name', $basicinfo->first_name) }}" @endif class="form-control" placeholder="Enter Your First Name" required>
                      @error('first_name')
                      <span class="text-danger pass">{{ $message }}</span>
                      @enderror 
                    </div>
                  </div>  
                  <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                      <label for="middle_name">*Middle Name</label>
                      <input type="text" name="middle_name"  @if ($basicinfo) value="{{ old('middle_name', $basicinfo->middle_name) }}" @endif  class="form-control" placeholder="Enter Your Middle Name" required >
                    </div>
                  </div>  
                  <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                      <label for="last_name">*Last Name</label>
                      <input type="text" name="last_name" @if ($basicinfo) value="{{ old('last_name', $basicinfo->last_name) }}" @endif  class="form-control" placeholder="Enter Your Last Name" required>
                    </div>                          
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label for="email">*Official Email Id</label>
                      <input type="text" name="email" @if ($basicinfo) value="{{ old('email', $basicinfo->email) }}" @endif class="form-control" placeholder="Enter Your Email" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="text" name="phone" @if ($basicinfo) value="{{ old('phone', $basicinfo->phone) }}" @endif class="form-control" placeholder="Enter Your Number" required>
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
                  <input type="date" name="dob" class="form-control"  @if ($basicinfo) value="{{ old('dob', $basicinfo->dob) }}" @endif placeholder="DOB" required>
                </div>
              </div> 
              <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="form-group">
                  <label>Select Blood Group</label>
              
                    <select class="form-control" name="blood_group" id="blood_group" @if ($basicinfo) value="{{ old('blood_group', $basicinfo->blood_group) }}" @endif required>
                        <option @if ($basicinfo) value="{{ old('blood_group', $basicinfo->blood_group) }}" @endif>@if ($basicinfo) {{ old('dob', $basicinfo->blood_group) }} @endif</option>
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
                  
                      <select class="form-control" name="gender" @if ($basicinfo) value="{{ old('gender', $basicinfo->gender) }}" @endif  id="gender" required>
                        <option @if ($basicinfo) value="{{ old('gender', $basicinfo->gender) }}" @endif>@if ($basicinfo) {{ old('gender', $basicinfo->gender) }} @endif</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                  
             
                </div>
              </div>  
              
              <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="form-group">
                  <label>Marital Status</label>
              
                    <select class="form-control" name="marital_status" @if ($basicinfo) value="{{ old('marital_status', $basicinfo->marital_status) }}" @endif id="marital_status" required>
                      <option @if ($basicinfo) value="{{ old('marital_status', $basicinfo->marital_status) }}" @endif>@if ($basicinfo) {{ old('marital_status', $basicinfo->marital_status) }} @endif</option>
                      <option value="Married">Married</option>
                      <option value="Single">Single</option>
                    </select>
           
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="current_address">Current Address</label>
                  <textarea rows="3" name="current_address" placeholder="Address" class="form-control" @if ($basicinfo) value="{{ old('current_address', $basicinfo->current_address) }}" @endif required>@if ($basicinfo) {{old('current_address',$basicinfo->current_address)}} @endif</textarea>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="permanent_address">Permanent Address</label>
                  <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control" @if ($basicinfo) value="{{ old('permanent_address', $basicinfo->permanent_address) }}" @endif required>@if ($basicinfo) {{old('permanent_address',$basicinfo->permanent_address)}} @endif</textarea>
                </div>
              </div>
              <div class="col-xl-12 mt-3"><h2>Emergency Contact</h2></div>                        
              <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="emg_name">Name</label>
                  <input type="text" name="emg_name" @if ($basicinfo) value="{{ old('emg_name', $basicinfo->emg_name) }}" @endif class="form-control" placeholder="Enter Name" required>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="emg_relationship">Relationship</label>
                  <input type="text" name="emg_relationship" @if ($basicinfo) value="{{ old('emg_relationship', $basicinfo->emg_relationship) }}" @endif class="form-control" placeholder="Enter Relation" required>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="emg_phone">Phone Number</label>
                  <input type="text" name="emg_phone" @if ($basicinfo) value="{{ old('emg_phone', $basicinfo->emg_phone) }}" @endif class="form-control" placeholder="Number" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="form-group">
                  <label for="emg_address">Address</label>
                  <textarea rows="3" name="emg_address" class="form-control" @if ($basicinfo) value="{{ old('emg_address', $basicinfo->emg_address) }}" @endif required>@if ($basicinfo) {{old('emg_address',$basicinfo->emg_address)}} @endif</textarea>
                </div>
              </div>
            </div>                   
                <div class="add-btn-part">
                  {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                  <button type="submit" name="basic-edit" class="btn-primary-cust">Next</button>
                </div>
                                             
                      
        </div>
      </div>
    </div>
  </form>   

@endsection