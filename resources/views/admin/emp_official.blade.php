@extends('admin/layouts.emp_app')
@section('emp_identity')
@section('title','EVP - Onboarding-Employee')

<div class="tab-pane" id="tabs-6" role="tabpanel">
    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              @csrf
              <div class="row">
                <div class="col-xl-12"><h2>Official Info</h2></div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" name="emp_id" class="form-control" placeholder="Id Number">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" name="doj" class="form-control" placeholder="Date">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Probation Period</label>
                    <input type="text" name="pro_period" class="form-control" placeholder="In Day">
                  </div>
                </div> 
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Employee Type</label>
              
                    <select class="form-control" name="emp_type" id="emp_type">
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
                    <select class="form-control" name="work_location" id="work_location">
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
                    <select class="form-control" name="emp_status" id="emp_status">
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
                    <input type="text" name="salary" class="form-control" placeholder="In Hand">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>LPA</label>
                    <input type="text" name="lpa" class="form-control" placeholder="Enter LPA">
                  </div>
                </div>

                <div class="col-xl-12">
                  <div class="row salary-bg-on">
                    <div class="col-xl-12"><h6 class="d-flex">Appraisal <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn">
                      {{-- <img src="assets/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                    </span></h6></div>
                    <div class="col-xl-2 col-lg-4 col-md-6">
                      <div class="form-group">
                        <label>From</label>
                        <input type="text" name="app_from" class="form-control" placeholder="10,000">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-6">
                      <div class="form-group">
                        <label>To</label>
                        <input type="text" name="app_to" class="form-control" placeholder="To">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Last Desig.</label>
                        <input type="text" name="last_app_desig" class="form-control" placeholder="Last Desig.">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Current Desig.</label>
                        <input type="text" name="current_app_desig" class="form-control" placeholder="Current Desig.">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="app_date" class="form-control" placeholder="Date">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 ">
                  <div class="row salary-bg-on">
                    <div class="col-xl-12"><h6 class="d-flex"> Promotion <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn">
                      {{-- <img src="assets/admin/images/button-plus-clr.png"> <small>Add</small> --}}
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
                      {{-- <a class="add-plus extra-fields-customeroff"><span><img src="assets/admin/images/button-plus.png"></span></a> --}}
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

@endsection