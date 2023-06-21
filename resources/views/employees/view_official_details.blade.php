<form id="employee_official_form" action="{{ url('employee_official/form/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $employeeExists ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
             <div class="row">
                 <div class="col-xl-12">
                     <h2>Official Info</h2>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-12">
                     <div class="form-group">
                         <label>Date of Joining<span style="color:red">*</span></label>
                         <input type="date" name="date_of_joining" value="{{ $employeeOfficials ? $employeeOfficials->date_of_joining : ''}}" class="form-control" placeholder="Date">
                         <strong class="error" id="date_of_joining-error"></strong>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-12">
                     <div class="form-group">
                         <label>Employee Type<span style="color:red">*</span></label>
                         <select class="form-control" name="emp_type" id="emp_type">
                             <option value="{{ $employeeOfficials ? $employeeOfficials->emp_type : ''}}">{{ $employeeOfficials ? $employeeOfficials->emp_type : 'Select employee type'}}</option>
                             <option value="Part Time">Part Time</option>
                             <option value="Full Time">Full Time</option>
                             <option value="Trainee">Trainee</option>
                             <option value="Freelancer">Freelancer</option>
                         </select>
                         <strong class="error" id="emp_type-error"></strong>
                     </div>
                 </div>
                 
                 <div class="col-xl-3 col-lg-6 col-md-12">
                     <div class="form-group">
                         <label>Work Location<span style="color:red">*</span></label>
                         <select class="form-control" name="work_location" id="work_location">
                             <option value="{{ $employeeOfficials ? $employeeOfficials->work_location : ''}}">{{ $employeeOfficials ? $employeeOfficials->work_location : 'Select work location'}}</option>
                             <option value="Bhopal, MP">Bhopal, MP</option>
                             <option value="Indore, MP">Indore, MP</option>
                             <option value="Pune, MH">Pune, MH</option>
                         </select>
                         <strong class="error" id="work_location-error"></strong>
                     </div>
                 </div>

                 <div class="col-xl-3 col-lg-6 col-md-12">
                     <div class="form-group">
                         <label>Employee Status<span style="color:red">*</span></label>
                         <select class="form-control" name="emp_status" id="emp_status">
                             {{-- <option value="{{ $employeeOfficials ? $employeeOfficials->emp_status : ''}}">{{ $employeeOfficials ? $employeeOfficials->emp_status : 'Select status'}}</option> --}}
                             <option value="1" {{ $employeeOfficials->emp_status == '1' ? 'selected' : '' }}>Active</option>
                             <option value="0" {{ $employeeOfficials->emp_status == '0' ? 'selected' : '' }}>Inactive</option>
                         </select>
                         <strong class="error" id="emp_status-error"></strong>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-5 col-md-10">
                     <div class="form-group">
                         <label>Designation<span style="color:red">*</span></label>
                         <input type="text" name="designation" class="form-control"  value="{{ $employeeOfficials ? $employeeOfficials->designation : ''}}" placeholder="Designation">
                         <strong class="error" id="designation-error"></strong>
                     </div>
                 </div>

                 <div class="col-xl-12 mt-3">
                     <h2>Salary Info</h2>
                 </div>

                 <div class="col-xl-3 col-lg-6 col-md-12">
                     <div class="form-group">
                         <label>LPA<span style="color:red">*</span></label>
                         <input type="text" name="lpa" class="form-control" value="{{ $employeeOfficials ? $employeeOfficials->lpa : ''}}" placeholder="Enter LPA">
                         <strong class="error" id="lpa-error"></strong>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="form-group">
                        <div class="add-btn-part">
                            <button type="button" id="exitemployee" class="btn-primary-cust button_background_color" style="color:white;background:red;"><span class="button_text_color">Employee Exit</span></button>     
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                     <div class="form-group">
                         <div class="add-btn-part">
                             <button type="reset" class="btn-secondary-cust"data-dismiss="modal">Cancel</button>
                             <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
                         </div>
                     </div>
                 </div>
             </div>
         </form>

  
    <div class="modal fade custu-modal-popup" id="exitemployeemodel" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <form id="exit_employee_form" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
                 <div class="modal-content">
                     <div class="modal-header">
                         <h2 class="modal-title" id="Heading">Employee exit</h2>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                         </button>
                     </div>      
                     <div class="modal-body">
                          <div class="comman-body">     
                          </div>
                     </div>
                     <div class="modal-footer">
                         <div class="loadingImg"></div>
                         <div style="font-size: 16px; display:none;" class="text-success" id="success">Employee successfully exit.</div>
                         <div style="font-size: 16px; display:none;" class="text-danger" id="failed">Employee already exit</div>
                         <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                         <button type="submit" id="scheduleInterviewSubmit" class="btn-primary-cust button_background_color"><span class="button_text_color">Submit</span></button>
                     </div>
                 </div>
             </form>
         </div>
     </div>         

  @section('pagescript')
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        window.jQuery || document.write('<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
      <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
     <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script>
     
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
   @stop