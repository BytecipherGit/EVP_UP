@extends('admin/layouts/emp_app')
@section('employee_identity')
@section('title','EVP - Onboarding-Employee')

 <!--- Main Container Start ----->

    
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
                <div class="row">                  
                  <div class="col-lg-3">
                    <div class="profile-add-img">
                      <div class="circle">
                         <img class="profile-pic" id="profile-pic" src="assets/admin/images/user-img.png" required>
                       </div>
                       <div class="p-image ml-auto">
                         <span class="upload-button" id="upload-button"><img src="assets/admin/images/edit-icon.png"></span>
                          <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*" required/>
                       </div>
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
                          <label for="middle_name">*Middle Name</label>
                          <input type="text" name="middle_name" class="form-control" placeholder="Enter Your Middle Name" required >
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
                      <textarea rows="3" name="emg_address" class="form-control" required></textarea>
                    </div>
                  </div>
                </div>                   
                    <div class="add-btn-part">
                      {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                      <button type="submit" name="basic" class="btn-primary-cust">Next</button>
                    </div>
                                                 
                          
            </div>
          </div>
        </div>
      </form>   
      
       
    


  <!--- Main Container Close ----->

  {{-- Identity Field --}}
  {{-- @yield('employee_identity');
  @yield('emp_quali'); --}}

   
@endsection