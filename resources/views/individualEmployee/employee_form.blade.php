
@extends('individualEmployee.layouts.app')
@section('content')
@section('title', 'EVP - Employee Profile')

<!--- Wapper Start ----->
  <div class="wapper">

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-12">
            <h1>Welcome to EVP</h1>
            {{-- <p>Lorem Ipsum is simply dummy text</p> --}}
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div id="successMessage">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
     </div>
      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link @if (Request::segment(3) == null) active @endif" data-toggle="tab" href="#tabs-1" role="tab">Optional Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::segment(3) == 'occupation') active @endif" data-toggle="tab" href="#occupation" role="tab">Occupation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::segment(3) == 'experience') active @endif" data-toggle="tab" href="#experience" role="tab">Work Experience</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::segment(3) == 'documents') active @endif" data-toggle="tab" href="#documents" role="tab">Documents</a>
          </li>  

        </ul> 
        <div class="tab-content">
          <div class="tab-pane @if (Request::segment(3) == null) active @endif" id="tabs-1" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                <div class="row">
                  <div class="col-lg-12">
                    <form id="employee_update_form" action="{{ url('employee_login/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                      @csrf                    
                      <div class="row">
                        <div class="col-xl-12 mt-3">
                            <h2>Personal</h2>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="dob">Date Of Birth<span style="color:red">*</span></label>
                                <input type="date" name="dob" class="form-control" value="{{ $employee ? $employee->dob : '' }}" placeholder="DOB">
                                <strong class="error" id="dob-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Select Blood Group<span style="color:red">*</span></label>
                                <select class="form-control" name="blood_group" id="blood_group">
                                    <option value="A+" {{ $employee->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $employee->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $employee->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $employee->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="O+" {{ $employee->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $employee->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                    <option value="AB+"{{ $employee->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-"{{ $employee->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                </select>
                                <strong class="error" id="blood_group-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Select Gender<span style="color:red">*</span></label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="Male" {{ $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $employee->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <strong class="error" id="gender-error"></strong>
                                </select>
                            </div>
                        </div>
                
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Marital Status<span style="color:red">*</span></label>
                
                                <select class="form-control" name="marital_status" id="marital_status">
                                    <option value="Married" {{ $employee->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Single" {{ $employee->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                                </select>
                                <strong class="error" id="marital_status-error"></strong>
                            </div>
                        </div> 

                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                              <label for="email">Email Id<span style="color:red">*</span></label>
                              <input disabled type="text" name="email" class="form-control disabled" value="{{ $employee ? $employee->email : '' }}" >
                              @error('email')
                               <p class="velidation">{{ $message }}</p>
                              @enderror
                              <strong class="error" id="email-error"></strong>
                          </div>
                      </div>

                      <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                              <label for="phone">Phone Number<span style="color:red">*</span></label>
                              <input type="text" name="phone" class="form-control" value="{{ $employee ? $employee->phone : '' }}" placeholder="Enter Your Number">
                              <strong class="error" id="phone-error"></strong>
                          </div>
                      </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="current_address">Current Address<span style="color:red">*</span></label>
                                <textarea rows="3" name="current_address" placeholder="Address" class="form-control">{{ $employee->current_address ? $employee->current_address: '' }}</textarea>
                                <strong class="error" id="current_address-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address<span style="color:red">*</span></label>
                                <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control">{{ $employee->permanent_address ? $employee->permanent_address: '' }}</textarea>
                                <strong class="error" id="permanent_address-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h2>Emergency Contact</h2>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="emg_name">Name<span style="color:red">*</span></label>
                                <input type="text" name="emg_name" class="form-control" value="{{ $employee->emg_name ? $employee->emg_name: '' }}"
                                    placeholder="Enter Name">
                                <strong class="error" id="emg_name-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="emg_relationship">Relationship<span style="color:red">*</span></label>
                                <input type="text" name="emg_relationship" class="form-control" value="{{ $employee->emg_relationship ? $employee->emg_relationship: '' }}" placeholder="Enter Relation">
                                <strong class="error" id="emg_relationship-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="emg_phone">Phone Number<span style="color:red">*</span></label>
                                <input type="text" name="emg_phone" class="form-control" value="{{ $employee->emg_phone ? $employee->emg_phone: '' }}" placeholder="Number">
                                <strong class="error" id="emg_phone-error"></strong>
                            </div>
                        </div>
                
                
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="emg_address">Address<span style="color:red">*</span></label>
                                <textarea rows="3" name="emg_address" class="form-control" placeholder="Enter Address">{{ $employee->emg_address ? $employee->emg_address: '' }}</textarea>
                                <strong class="error" id="emg_address-error"></strong>
                            </div>
                        </div>
                      </div>

                      <div class="add-btn-part">
                        <button type="reset" class="btn-secondary-cust">Cancel</button>
                        <button type="submit" class="btn-primary-cust button_background_color" href="#tabs-2"><span class="button_text_color">Save</span></button>
                     </div>
                    </form>
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="tab-pane @if (Request::segment(3) == 'occupation') active @endif" id="occupation" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                  @include('individualEmployee.employee_occupation')
              </div>
            </div>
          </div>
          <div class="tab-pane @if (Request::segment(3) == 'experience') active @endif" id="experience" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">    
                <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#create_workhistory" href="#" id="workhistory_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"><small> Add More</small></span></h2>            
              
                @if ($workExperiences->isEmpty())
                 <p class="no-data-clg">No Data Available</p>
                   @else
                 @include('individualEmployee.view_employee_experience')
                @endif
              </div>
            </div>
          </div>
          <div class="tab-pane @if (Request::segment(3) == 'documents') active @endif" id="documents" role="tabpanel">
            <div class="eml-persnal ">
              <div class="add-emply-details">                
                @include('individualEmployee.employee_documents') 
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--- Main Container Close ----->
  </div>
  <!--- Wapper Close ----->

<!-- Modal Reviews-->
  <div class="modal fade custu-no-select custom-modal confirm-modal" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="{{ asset('assets') }}/company/images/confirm-icon.png" class="img-size-wth">   
          <p>You are Successfully register</p>
          <a href="#" data-dismiss="modal">Ok</a>
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
                @include('individualEmployee.employee_experience')         
            </div>
        </div>
    </div>
</div>
</div>
 
@endsection


@section('pagescript')

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
  window.jQuery || document.write(
      '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
{{-- <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script>  --}}

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
    $(document).ready(function() {
      setTimeout(function(){
          $('#successMessage').fadeOut('fast');
      }, 2000);

      $("#employee_update_form").validate({

          rules: {
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
          },

          messages: {
            
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
            
            }

         });



       $("#employee_update").validate({
          rules: {
              date_of_joining: "required",
              work_location: "required",
              designation: "required",
              dob: "required",
          },

          messages: {
            
                date_of_joining: "Date of joining is required",
                work_location: "Work location is required",
                designation: "Designation  is required",
                dob: "Date of birth is required",
               
            }

          });

          $("#employee_experience_form").validate({
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
                exp_letter: "Experience letter is required",
                salary_slip: "Salary slip is required",
            }
        });

        $("#employee_experience_form_edit").validate({
            rules: {
                com_name: "required",
                designation: "required",
                work_duration_to: "required",
                work_duration_from: "required",

            },

            messages: {
                com_name: "Company name is required",
                designation: "Designation is required",
                work_duration_to: "Work duration is required",
                work_duration_from: "Work duration From is required",

            }
        });

        $("#employee_experience_doc").validate({
            rules: {
                pan_card_number: "required",
                // pan_card_id: "required",
                // aadhar_card_id: "required",
                aadhar_card_number: "required",
                // passport_id: "required",
                passport_number: "required",

            },

            messages: {
                pan_card_number: "Pan card number is required",
                // pan_card_id: "Pan card id is required",
                // aadhar_card_id: "Aadhar card id is required",
                aadhar_card_number: "Aadhar card number is required",
                // passport_id: "Passport id is required",
                passport_number: "Passport number is required",

            }
        });

      });
      
    </script>
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
      $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/company/images/minus-icon.png"></span></a>');
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

<script type="text/javascript">
  var i = 0;
  $("#dynamic-ar").click(function() {
      ++i;
      $("#dynamicAddRemove").append('<tr><td class="col-xl-4 col-lg-6 col-md-12"><div class="form-group"><label>Id Type</label><select class="form-control" name="id_type[' + 
            i +
            ']" id="id_type"><option value="Pan Card">Pan Card</option><option value="Aadhar Card">Aadhar Card</option> <option value="Voter Id">Voter Id</option> </select> <strong class="error" id="id_type-error"></strong> </div> </td><td class="col-xl-3 col-lg-6 col-md-12"><div class="form-group"><label>Id Number<span style="color:red">*</span></label><input type="text" name="id_number[' + 
            i +
            ']" class="form-control" placeholder="Number"><strong class="error" id="id_number-error"></strong></div> </td><td class="col-xl-3 col-lg-6 col-md-12"><div class="form-group"><label>Upload File<span style="color:red">*</span></label><input type="file" id="document" name="document[' + 
            i +
            ']" class="form-control" accept="image/jpeg,image/doc,image/pdf"/></div><td class="addskill"><a href="" class="remove-field btn-remove-customer add-plus minus-icon2"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
  var i = 0;
  $("#dynamic-ar1").click(function() {
      ++i;
      $("#dynamicAddRemove1").append('<tr><td class="col-xl-3 col-lg-6 col-md-12"> <div class="form-group"><label>Company Name<span style="color:red">*</span></label><input type="text" name="com_name[' +
         i +
        ']" class="form-control" placeholder="Name"></div></td> <td class="col-xl-3 col-lg-6 col-md-12"><div class="form-group"><label>From<span style="color:red">*</span></label><input type="date" name="work_duration_from[' +
        i +
         ']" class="form-control" placeholder="From"></div></td><td class="col-xl-3 col-lg-6 col-md-12"><div class="form-group"><label>To<span style="color:red">*</span></label><input type="date" name="work_duration_to[' +
        i +
        ']" class="form-control" placeholder="To"></div><div class="form-group"> <label>Designation<span style="color:red">*</span></label><input type="text" name="designation[' +
        i +
        ']" class="form-control" placeholder="Designation"> </div><td class="addskill"><a href="" class="remove-field btn-remove-customer add-plus minus-icon2"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

    <script>
      $('.extra-fields-customer1').click(function() {
        $('.customer_records1').clone().appendTo('.customer_records_dynamic1');
        $('.customer_records_dynamic1 .customer_records1').addClass('single remove');
        $('.single .extra-fields-customer1').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon2"><span><img src="{{ asset('assets') }}/company/images/minus-icon.png"></span></a>');
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


 @stop