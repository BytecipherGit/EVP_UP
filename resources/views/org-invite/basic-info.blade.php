<!DOCTYPE html>
<html lang="en">
  <style>
    .error {
        color: red !important;
        font-weight: 400;
    }
  </style>
<head>
  <title>ByteCipher - Invite Employee Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/org-invite/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/main-container.css">
  <script src="{{ asset('assets') }}/admin/js/jquery.validate.min.js"></script>


  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/org-invite/js/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  
</head>

<div class="wapper">
  <!--- Main Container Start ----->
  <div class="main-container">

      <div class="main-heading">
          <div class="row">
              <div class="col-md-12">
                  <h1>Onboarding</h1>
                  <p>Here’s your report overview by today</p>
              </div>
          </div>
      </div>
      <!--- Main Heading ----->
      <div id="successMessage">
          @if (session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
          @endif
      </div>
      
      <div class="employee-tab-bar">
          <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">
              <li class="nav-item">
                  <li class="nav-item">
                  <a class="nav-link @if (Request::segment(3) == null) active @endif  secondary_color" data-toggle="tab" href="#basicInformation" role="tab">Basic Info</a>
                 {{-- <a href="#hardware" data-toggle="tab"><strong>Hardware(s)</strong></a></li> --}}

              </li>
              {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
        </li> --}}
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(3) == 'qualification') active @endif " data-toggle="tab" href="#qualification" role="tab">Qualification</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(3) == 'workhistory') active @endif" data-toggle="tab" href="#workhistory" role="tab">Work History</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(3) == 'skills') active @endif" data-toggle="tab" href="#skills" role="tab">Skills</a>
              </li>
              {{-- <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#official" role="tab">Official Use</a>
              </li> --}}

          </ul>
          <div class="tab-content">
              <div  class="tab-pane @if (Request::segment(3) == null) active @endif" id="basicInformation" role="tabpanel">
                  <div class="eml-persnal ">
                      <div class="add-emply-details">
                          @if (empty($employeeExists))
                              @include('employees.employee_basicinfo')
                          @else
                              @include('employees.edit_basicinfomation')
                          @endif
                      </div>
                  </div>
              </div>
      
              <div class="tab-pane @if (Request::segment(3) == 'qualification') active @endif" id="qualification" role="tabpanel">
                  <div class="eml-persnal ">
                      <div class="add-emply-details">
                          <div class="row">
                              <div class="col-xl-12">
                                {{-- <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd"><img src="assets/images/button-plus-clr.png"> <small>Add</small></span></h2> --}}
                     
                                <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#create_qualification" href="#" id="qualification_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                              @if (empty($qualificationExist))
                                  <p class="no-data-clg">No Data Available</p>
                              @else
                                  @include('employees.view_qualification')
                              @endif
                             </div>
                         </div>
                      </div>
                  </div>
              </div>

      
              <div class="tab-pane @if (Request::segment(3) == 'workhistory') active @endif" id="workhistory" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-xl-12">
                           <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#create_workhistory" href="#" id="workhistory_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                            @if (empty($workhistoryExists))
                                <p class="no-data-clg">No Data Available</p>
                            @else
                                @include('employees.view_workhistory')
                            @endif

                        </div>
                    </div>
                 </div>
                </div>
              </div>

              <div class="tab-pane @if (Request::segment(3) == 'skills') active @endif" id="skills" role="tabpanel">
                  <div class="eml-persnal ">
                    <div class="add-emply-details">                
                      <div class="row">
                        <div class="col-lg-12">
                          @if (empty($employeeSkillsExists))
                              @include('employees.employee_skills')
                          @else
                              @include('employees.view_employee_skills')
                         <form action="{{route('invite.employee.submit')}}">
                              <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? encrypt($employeeExists->id) : '' }}" />
                                    <div class="add-btn-part">
                                        <button type="reset" class="btn-secondary-cust"data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
                                    </div>
                                </div>
                            </div>
                         </form>
                          @endif
                        </div>
                      </div>                
                    </div>
                  </div>     
              </div>
          
          </div>
      </div>

  </div>
  <!--- Main Container Close ----->
</div>

<!--- Wapper Close ----->

<!-- The Modal Qualification Add -->
<div class="modal fade custu-modal-popup" id="create_qualification" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
                  @include('employees.employee_qualification')         
              </div>
          </div>
      </div>
  </div>
</div>

<!-- The Modal Workhistory Add -->
<div class="modal fade custu-modal-popup" id="create_workhistory" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h2 class="modal-title" id="exampleModalLabel">Add Workhistory</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
              </button>
          </div>
          <div class="modal-body">
              <div class="comman-body">
                  @include('employees.employee_workhistory')         
              </div>
          </div>
      </div>
  </div>
</div>


<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
  window.jQuery || document.write(
      '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>

<script>
    $(document).ready(function() {
    setTimeout(function(){
        $('#successMessage').fadeOut('fast');
    }, 2000);


        $("#employee_basic_form_edit").validate({

            rules: {
                first_name: "required",
                last_name: "required",
                email: "required",
                blood_group: "required",
                gender: "required",
                dob: "required",
                phone: "required",
                emg_phone: "required",
                permanent_address: "required",
                current_address: "required",
                marital_status: "required",
                emg_name: "required",
                emg_address: "required",
                emg_relationship: "required",
                document_type: "required",
                document_number: "required",
                // document_id: "required",

            },

            messages: {
                firstName: "first name is required",
                last_name: "Last name is required",
                email: "Email is required",
                blood_group: "Blood group is required",
                gender: "Gender  is required",
                dob: "Date of birth is required",
                phone: "Phone number is required",
                emg_phone: "Emergency phone number is required",
                permanent_address: "Permanent address is required",
                current_address: "Current address is required",
                marital_status: "Marital status is required",
                emg_name: "Emergency name is required",
                emg_relationship: "Emergency relationship is required",
                emg_address: "Emergency address is required",
                // document_id: "document id is required",
                document_number: "document number is required",
                document_type: "document type is required",

            }
        });

        $("#employee_qualification_form").validate({
            rules: {
                inst_name: "required",
                degree: "required",
                subject: "required",
                duration_from: "required",
                duration_to: "required",
                verification_type: "required",
                document: {
                    required: true,
                    extension: "pdf|doc|docx",
                }
            },

            messages: {
                inst_name: "Institute name is required",
                degree: "Degree is required",
                subject: "Subject is required",
                duration_from: "Duration date is required",
                duration_to: "Duration to is required",
                verification_type: "Verification type is required",
                document: {
                    required: "Document is required",
                    extension: "extension shuold not wrong",
                },
            }
        }); 

        $("#employee_qualification_form_edit").validate({
            rules: {
                inst_name: "required",
                degree: "required",
                subject: "required",
                duration_from: "required",
                duration_to: "required",
                verification_type: "required",
                // document: {
                //     required: true,
                //     extension: "pdf|doc|docx",
                // }
            },

            messages: {
                inst_name: "Institute name is required",
                degree: "Degree is required",
                subject: "Subject is required",
                duration_from: "Duration date is required",
                duration_to: "Duration to is required",
                verification_type: "Verification type is required",
                // document: {
                //     required: "Document is required",
                //     extension: "extension shuold not wrong",
                // },
            }
        }); 
        
        $("#employee_official_form").validate({
            rules: {
                date_of_joining: "required",
                emp_type: "required",
                work_location: "required",
                emp_status: "required",
                lpa: "required",
                designation: "required",
            },

            messages: {
                date_of_joining: "Date of joining is required",
                emp_type: "Employee type is required",
                work_location: "Work location is required",
                emp_status: "Employee status to is required",
                lpa: "LPA is required",
                designation: "Manager designation is required",

            }
        });

        $("#employee_workhistory_form").validate({
            rules: {
                com_name: "required",
                designation: "required",
                work_duration_to: "required",
                work_duration_from: "required",
                offer_letter: "required",
                verification_type: "required",
                exp_letter: "required",
                salary_slip: "required",
            },

            messages: {
                com_name: "Company name is required",
                designation: "Designation is required",
                work_duration_to: "Work duration is required",
                work_duration_from: "Work duration From is required",
                offer_letter: "Offer letter to is required",
                verification_type: "Verification type is required",
                exp_letter: "Experience letter is required",
                salary_slip: "Salary slip is required",
            }
        });

        $("#employee_workhistory_form_edit").validate({
            rules: {
                com_name: "required",
                designation: "required",
                work_duration_to: "required",
                work_duration_from: "required",
                // offer_letter: "required",
                verification_type: "required",
                // exp_letter: "required",
                // salary_slip: "required",
            },

            messages: {
                com_name: "Company name is required",
                designation: "Designation is required",
                work_duration_to: "Work duration is required",
                work_duration_from: "Work duration From is required",
                // offer_letter: "Offer letter to is required",
                verification_type: "Verification type is required",
                // exp_letter: "Experience letter is required",
                // salary_slip: "Salary slip is required",
            }
        });

        $("#employee_skills_form").validate({
            rules: {
                skill: "required",
                lang: "required",
            },

            messages: {
                skill: "Skill is required",
                lang: "Known language is required",

            }
        });

        $("#employee_skills_form_edit").validate({
            rules: {
                skill: "required",    
            },

            messages: {
                skill: "Skill is required",

            }
        });

        $("#employee_lang_form_edit").validate({
            rules: {
                lang: "required",
            },

            messages: {
                lang: "Language is required",

            }
        });

        $("#employee_lang_form").validate({
            rules: {
                lang: "required",
            },

            messages: {
                lang: "Language is required",

            }
        });

    });
</script> 