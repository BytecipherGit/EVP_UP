@extends('admin/layouts.emp_editapp')
@section('edit')
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
                    <input type="text" name="" class="form-control" placeholder="Id Number">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" name="" class="form-control" placeholder="Date">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Probation Period</label>
                    <input type="text" name="" class="form-control" placeholder="In Day">
                  </div>
                </div> 
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Employee Type</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Employee Type</div>
                      <div class="dropdown-menu" id="style-5">
                        <a class="dropdown-item active">Employee Type</a>
                        <a class="dropdown-item">Part Time</a>
                        <a class="dropdown-item">Full Time</a>
                        <a class="dropdown-item">Trainee</a>
                        <a class="dropdown-item">Freelancer</a>
                      </div>
                    </div>
                  </div>                          
                </div> 
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Work Location</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Select Location</div>
                      <div class="dropdown-menu" id="style-5">
                        <a class="dropdown-item active">Select Location</a>                                
                        <a class="dropdown-item">Bhopal, MP</a>
                        <a class="dropdown-item">Indore, MP</a>
                        <a class="dropdown-item">Pune, MH</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Employee Status</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Select Status</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Select Status</a>
                        <a class="dropdown-item">Active</a>
                        <a class="dropdown-item">Inactive</a>
                      </div>
                    </div>
                  </div>
                </div>  

                <div class="col-xl-12 mt-3"><h2>Salary Info</h2></div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Salary</label>
                    <input type="text" name="" class="form-control" placeholder="In Hand">
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>LPA</label>
                    <input type="text" name="" class="form-control" placeholder="Enter LPA">
                  </div>
                </div>

                <div class="col-xl-12">
                  <div class="row salary-bg-on">
                    <div class="col-xl-12"><h6 class="d-flex">Appraisal <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h6></div>
                    <div class="col-xl-2 col-lg-4 col-md-6">
                      <div class="form-group">
                        <label>From</label>
                        <input type="text" name="" class="form-control" placeholder="10,000">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-6">
                      <div class="form-group">
                        <label>To</label>
                        <input type="text" name="" class="form-control" placeholder="To">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Last Desig.</label>
                        <input type="text" name="" class="form-control" placeholder="Last Desig.">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Current Desig.</label>
                        <input type="text" name="" class="form-control" placeholder="Current Desig.">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="" class="form-control" placeholder="Date">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 ">
                  <div class="row salary-bg-on">
                    <div class="col-xl-12"><h6 class="d-flex"> Promotion <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h6></div>
                    <div class="col-xl-2 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>From</label>
                        <input type="text" name="" class="form-control" placeholder="10,000">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>To</label>
                        <input type="text" name="" class="form-control" placeholder="To">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Last Desig.</label>
                        <input type="text" name="" class="form-control" placeholder="Last Desig.">
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Current Desig.</label>
                        <input type="text" name="" class="form-control" placeholder="Current Desig.">
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-12">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="" class="form-control" placeholder="Date">
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
                          <input type="text" name="" class="form-control" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-5 col-md-10">
                        <div class="form-group">
                          <label>Type</label>
                          <div class="selectBox active form-control">
                            <div class="selectBox__value">Type</div>
                            <div class="dropdown-menu">
                              <a class="dropdown-item active">Type</a>
                              <a class="dropdown-item">Primary</a>
                              <a class="dropdown-item">Secondary</a>
                            </div>
                          </div>
                        </div>
                      </div>                                
                      <div class="col-xl-3 col-lg-5 col-md-10">
                        <div class="form-group">
                          <label>Department</label>
                          <input type="text" name="" class="form-control" placeholder="Department">
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-5 col-md-10">
                        <div class="form-group">
                          <label>Designation</label>
                          <input type="text" name="" class="form-control" placeholder="Designation">
                        </div>
                      </div>                              
                      <a class="add-plus extra-fields-customeroff"><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a>
                    </div>
                    <div class="customer_records_dynamicoff"></div>
                </div>
              </div>  


                <div class="col-md-12">
                  <div class="form-group">
                    <div class="add-btn-part">
                      <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn-primary-cust">Save</button>
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
@endsection