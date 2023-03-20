@extends('admin/layouts.emp_app')
@section('content')
@section('title','EVP - Employee view Details')

  <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Employees View Details</h1>
            <p></p>
          </div>
          <div class="col-lg-4">
            <div class="main-right-button-box">
              <a href="all-employee"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
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
            <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Official Use</a>
          </li>  

        </ul> 
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">
                <form> 
                  <div class="row">                  
                    <div class="col-lg-3">
                      <div class="profile-add-img">
                        <div class="circle">
                           <img class="profile-pic" id="profile-pic" src="{{ asset('assets') }}/admin/images/vijay-patil.png">
                         </div>
                         <div class="p-image ml-auto">
                           <span class="upload-button" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                            <input class="file-upload" id="file-upload" type="file" accept="image/*"/>
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-9">                    
                      <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>*First Name</label>
                            <input type="text" name="" class="form-control" value="vijay">
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>*Middle Name</label>
                            <input type="text" name="" class="form-control" value="Singh">
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>*Last Name</label>
                            <input type="text" name="" class="form-control" value="Sisodiya">
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>*Official Email Id</label>
                            <input type="text" name="" class="form-control" value="vijay123456@gmail.com">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="" class="form-control" value="9876543210">
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-xl-12 mt-3"><h2>Personal</h2></div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" name="" class="form-control" placeholder="DOB">
                      </div>
                    </div> 
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Select Blood Group</label>
                        <div class="selectBox active form-control">
                          <div class="selectBox__value">B+</div>
                          <div class="dropdown-menu" id="style-5">
                            <a class="dropdown-item">Blood Group</a>
                            <a class="dropdown-item">A+</a>
                            <a class="dropdown-item">A-</a>
                            <a class="dropdown-item active">B+</a>
                            <a class="dropdown-item">B_</a>
                            <a class="dropdown-item">O+</a>
                            <a class="dropdown-item">O-</a>
                            <a class="dropdown-item">AB+</a>
                            <a class="dropdown-item">AB-</a>
                          </div>
                        </div>
                      </div>                          
                    </div> 
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Select Gender</label>
                        <div class="selectBox active form-control">
                          <div class="selectBox__value">Male</div>
                          <div class="dropdown-menu">
                            <a class="dropdown-item">Select Gender</a>
                            <a class="dropdown-item active">Male</a>
                            <a class="dropdown-item">Female</a>
                            <a class="dropdown-item">Transgender</a>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                    <div class="col-xl-3 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Marital Status</label>
                        <div class="selectBox active form-control">
                          <div class="selectBox__value">Single</div>
                          <div class="dropdown-menu">
                            <a class="dropdown-item ">Marital Status</a>
                            <a class="dropdown-item">Married</a>
                            <a class="dropdown-item active">Single</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Current Address</label>
                        <textarea rows="3" class="form-control">Bangali Square Indore</textarea>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea rows="3" class="form-control">Ashok Nager Shajapur</textarea>
                      </div>
                    </div>
                    <div class="col-xl-12 mt-3"><h2>Emergency Contact</h2></div>                        
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="" class="form-control" value="BhanuSingh">
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Relationship</label>
                        <input type="text" name="" class="form-control" value="Father">
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="" class="form-control" value="9876543211">
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea rows="3" class="form-control">Ashok Nager Shajapur</textarea>
                      </div>
                    </div>
                  </div>                   
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="add-btn-part">
                        <button type="button" class="btn-secondary-cust">Back</button>
                        <button type="button" class="btn-primary-cust">Next</button>
                      </div>
                    </div>
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
                    <form>
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Uploaded Documents <span class="ml-auto on-head-right" data-toggle="modal" data-target="#identityAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>

                        <div class="col-xl-12">
                          <div class="eml-per-main">
                            <div class="table-responsive">
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
                                      <td>Pan Card</td>
                                      <td>AXXX11100X</td>
                                      <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                                      <td>
                                        <span class="d-flex tbl-iconBx">
                                          <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                          <a href="assets/admin/images/pan-card.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                          <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Aadhar Card</td>
                                      <td>AXXX1200X</td>
                                      <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                                      <td>
                                        <span class="d-flex  tbl-iconBx">
                                          <a class="docu-down" data-toggle="modal" data-target="#btninfo"><img src="{{ asset('assets') }}/admin/images/no-data.png"></a>
                                          <a href="assets/admin/images/pan-card.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                          <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                        </span>
                                      </td>
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
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
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
          <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    <form>
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>

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
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>                                    
                                    <td>B.E</td> 
                                    <td>New Science College Indore</td> 
                                    <td>Mechanical</td>
                                    <td>July / 2013</td>  
                                    <td>July / 2017</td>  
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                                    <td>
                                      <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                      <a href="assets/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                      <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                    </td>
                                  </tr>
                                  <tr>                                    
                                    <td>12th</td> 
                                    <td>CBSC</td> 
                                    <td>Mathematics</td>
                                    <td>July / 2012</td>  
                                    <td>March / 2013</td>  
                                    <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                                    <td>
                                      <a class="docu-down" data-toggle="modal" data-target="#qualificationinfo"><img src="{{ asset('assets') }}/admin/images/no-data.png"></a>
                                      <a href="assets/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                      <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                    </td>
                                  </tr>
                                </tbody>
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
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
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
          <div class="tab-pane" id="tabs-4" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    <form>
                      <div class="row">
                        <div class="col-xl-12">
                          <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#workHistorybtn"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                        </div>

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
                                    <td>ByteCipher</td>
                                    <td>14-01-2018</td>  
                                    <td>Present</td> 
                                    <td>React Native Developer</td>  
                                    <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a></td>
                                    <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a></td>
                                    <td><a href="assets/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="assets/admin/images/pdf-icon.png"></a></td>
                                    <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                                    <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td>
                                  </tr>
                                  <tr>      
                                    <td>ByteCipher</td>
                                    <td>14-01-2018</td>  
                                    <td>20-10-2029</td>
                                    <td>React Native Developer</td> 
                                    <td><a class="docu-down" data-toggle="modal" data-target="#workhisinfo"><img src="assets/admin/images/no-data.png"></a></td>
                                    <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="assets/admin/images/document.png"></a></td>
                                    <td><a href="assets/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="assets/admin/images/pdf-icon.png"></a></td>
                                    <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                                    <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td>
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
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
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
          <div class="tab-pane" id="tabs-5" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    <form>
                      <div class="row"> 
                        <div class="col-xl-6">
                          <div class="col-xl-12">
                            <h2>Skills <span class="ml-auto on-head-right" data-toggle="modal" data-target="#skillsAdd"><img src="assets/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
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
                                      <td>Figma</td>
                                      <td>Intermediate</td>
                                      <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td>
                                    </tr>
                                    <tr>
                                      <td>Java</td>
                                      <td>Expert</td>
                                      <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td>
                                    </tr>
                                  <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6">
                          <div class="col-xl-12">
                            <h2>known Language <span class="ml-auto on-head-right" data-toggle="modal" data-target="#skillsLanguageAdd"><img src="assets/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
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
                                      <td>English</td>
                                      <td>Expert</td>
                                    </tr>
                                    <tr>
                                      <td>Hindi</td>
                                      <td>Expert</td>
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
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
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
          <div class="tab-pane" id="tabs-6" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    <form>
                      <div class="row">
                        <div class="col-xl-12"><h2>Official Info</h2></div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" name="" class="form-control" value="#000101">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Date of Joining</label>
                            <input type="date" name="" class="form-control" value="12-03-2021">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Probation Period</label>
                            <input type="text" name="" class="form-control" value="60 Days">
                          </div>
                        </div> 
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Type</label>
                            <div class="selectBox active form-control">
                              <div class="selectBox__value">Full Time</div>
                              <div class="dropdown-menu" id="style-5">
                                <a class="dropdown-item">Employee Type</a>
                                <a class="dropdown-item">Part Time</a>
                                <a class="dropdown-item active">Full Time</a>
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
                              <div class="selectBox__value">Indore, MP</div>
                              <div class="dropdown-menu" id="style-5">
                                <a class="dropdown-item">Select Location</a>                                
                                <a class="dropdown-item">Bhopal, MP</a>
                                <a class="dropdown-item active">Indore, MP</a>
                                <a class="dropdown-item">Pune, MH</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee Status</label>
                            <div class="selectBox active form-control">
                              <div class="selectBox__value">Active</div>
                              <div class="dropdown-menu">
                                <a class="dropdown-item">Select Status</a>
                                <a class="dropdown-item active">Active</a>
                                <a class="dropdown-item">Inactive</a>
                              </div>
                            </div>
                          </div>
                        </div>  

                        <div class="col-xl-12 mt-3"><h2>Salary Info</h2></div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="" class="form-control" value="21,000">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>LPA</label>
                            <input type="text" name="" class="form-control" placeholder="2,52,000">
                          </div>
                        </div>

                        <div class="col-xl-12">
                          <div class="row salary-bg-on">
                            <div class="col-xl-12"><h6 class="d-flex">Appraisal <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn"><img src="assets/admin/images/button-plus-clr.png"> <small>Add</small></span></h6></div>
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
                                <input type="text" name="" class="form-control" value="Junior">
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
                                <input type="date" name="" class="form-control" value="20-03-2020">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 ">
                          <div class="row salary-bg-on">
                            <div class="col-xl-12"><h6 class="d-flex"> Promotion <span class="ml-auto on-head-right" data-toggle="modal" data-target="#salaryaddbtn"><img src="assets/admin/images/button-plus-clr.png"> <small>Add</small></span></h6></div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>From</label>
                                <input type="text" name="" class="form-control" placeholder="35,000">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>To</label>
                                <input type="text" name="" class="form-control" placeholder="4,20,000">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Last Desig.</label>
                                <input type="text" name="" class="form-control" placeholder="Junior">
                              </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Current Desig.</label>
                                <input type="text" name="" class="form-control" placeholder="Senior">
                              </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="" class="form-control" value="20-02-2021">
                              </div>
                            </div>
                          </div>
                        </div>

                        

                      <div class="col-xl-12">
                        <div class="form-group repo-mange-box mt-3">
                            <h2>Reporting Manager</h2>
                            <div class="row customer_recordsoff">
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" name="" class="form-control" value="Amit Sanvedi">
                                </div>
                              </div>
                              <div class="col-xl-2 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Type</label>
                                  <div class="selectBox active form-control">
                                    <div class="selectBox__value">Primary</div>
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
                                  <input type="text" name="" class="form-control" value="Software Development">
                                </div>
                              </div>
                              <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                  <label>Designation</label>
                                  <input type="text" name="" class="form-control" value="Chief Technology Officer (CTO)">
                                </div>
                              </div>                              
                              <a class="add-plus extra-fields-customeroff"><span><img src="assets/admin/images/button-plus.png"></span></a>
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
        </div>
      </div>

    </div>
    <!--- Main Container Close ----->
  
  <!--- Wapper Close -----> 

  <!-- The Modal Identity Add -->
  <div class="modal fade custu-modal-popup" id="identityAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Identity</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
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
                        <img class="profile-pic" id="profile-pic1" src="assets/admin/images/file-icon-img.png">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
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
                        <img class="profile-pic" id="profile-pic2" src="assets/admin/images/pan-card.png">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>School/College/Institute</label>
                    <input type="text" name="" class="form-control" placeholder="Enter Name">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Degree</label>
                    <input type="text" name="" class="form-control" placeholder="Ex. Bachelor's">
                  </div>
                  <div class="col-md-6">
                    <label>Subject</label>
                    <input type="text" name="" class="form-control" placeholder="Ex. CS">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic3" src="assets/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button3">Choose File</span>
                        <input class="file-upload" id="file-upload3" type="file" accept="image/*">
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
          <button type="button" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>  

  <!-- The Modal Qualification Edit -->
  <div class="modal fade custu-modal-popup" id="qualificationEdit" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Qualification</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>School/College/Institute</label>
                    <input type="text" name="" class="form-control" value="New Science College Indore">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Degree</label>
                    <input type="text" name="" class="form-control" value="B.E" >
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
                        <img class="profile-pic" id="profile-pic4" src="assets/admin/images/file-icon-img.png">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="document-body">
            <img src="assets/admin/images/job-offer-letter.png">
          </div>
          <a href="assets/admin/images/pan-card.png" target="_black">Download</a>
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
          <img src="assets/admin/images/info.png" class="img-size-wth">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="document-body">
            <img src="assets/admin/images/pan-card.png">
          </div>
          <a href="assets/admin/images/pan-card.png" target="_black">Download</a>
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
          <img src="assets/admin/images/info.png" class="img-size-wth">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Company Name</label>
                    <input type="text" name="" class="form-control" placeholder="ByteCipher">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation</label>
                    <input type="text" name="" class="form-control" placeholder="React Native Developer">
                  </div>                  
                </div>
              </div>  

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Offer Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic5" src="assets/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button5">Choose File</span>
                        <input class="file-upload" id="file-upload5" type="file" accept="image/*">
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
                        <img class="profile-pic" id="profile-pic6" src="assets/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button6">Choose File</span>
                        <input class="file-upload" id="file-upload6" type="file" accept="image/*">
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
                        <img class="profile-pic" id="profile-pic7" src="assets/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>pdf</span> </p>
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
          <button type="button" class="btn-primary-cust">Save</button>
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
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
                        <img class="profile-pic" id="profile-pic7" src="assets/admin/images/job-offer-letter.png">
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
                        <img class="profile-pic" id="profile-pic9" src="assets/admin/images/job-offer-letter.png">
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
                        <img class="profile-pic" id="profile-pic10" src="assets/admin/images/pdf-icon.png">
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
          <img src="assets/admin/images/info.png" class="img-size-wth">
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
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>             
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
    

  <!-- The Modal Skills Add -->
  <div class="modal fade custu-modal-popup" id="skillsAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Skills</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group inputtag-custom">
                <label>Add Skill</label>
                <div class="row customer_records1">
                  <div class="col-md-8">
                    <input type="text" class="form-control input-search-box typeahead" data-provide="typeahead" placeholder="Language">
                  </div>
                  <div class="col-md-8">
                    <h6>
                      <span><input type="radio" id="customRadioInline4" name="customRadioInlineL" class="">
                      <label class="" for="customRadioInline4">Beginner</label></span>
                      
                      <span><input type="radio" id="customRadioInline5" name="customRadioInlineL" class="" checked="">
                      <label class="" for="customRadioInline5">Intermediate</label></span>
                      <span><input type="radio" id="customRadioInline6" name="customRadioInlineL" class="" >
                      <label class="" for="customRadioInline6">Expert</label></span>
                    </h6>  
                  </div>
                  <a class="add-plus extra-fields-customer" ><span><img src="assets/admin/images/button-plus.png"></span></a>
                </div>
                <div class="customer_records_dynamic"></div>
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

  <!-- The Modal Language Add -->
  <div class="modal fade custu-modal-popup" id="skillsLanguageAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add known Language</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group inputtag-custom">
                <label>Add Language</label>
                <div class="row customer_records1">
                  <div class="col-md-8">
                    <input type="text" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language">
                  </div>
                  <div class="col-md-8">
                    <h6>
                      <span><input type="radio" id="customRadioInline4" name="customRadioInlineL" class="">
                      <label class="" for="customRadioInline4">Beginner</label></span>
                      
                      <span><input type="radio" id="customRadioInline5" name="customRadioInlineL" class="" checked="">
                      <label class="" for="customRadioInline5">Intermediate</label></span>
                      <span><input type="radio" id="customRadioInline6" name="customRadioInlineL" class="" >
                      <label class="" for="customRadioInline6">Expert</label></span>
                    </h6>  
                  </div>
                  <a class="add-plus extra-fields-customer1" ><span><img src="assets/admin/images/button-plus.png"></span></a>
                </div>
                <div class="customer_records_dynamic1"></div>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="assets/admin/js/bootstrap.min.js"></script> 
    <script src="assets/admin/js/file-upload.js"></script>    
    <script src="assets/admin/js/typeahead.min.js"></script>

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
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
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
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
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
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
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