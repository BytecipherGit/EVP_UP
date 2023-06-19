<form id="employee_basic_form_edit" action="{{ url('employee_info/update') }}" method="post" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $employeeExists ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <input type="hidden" id="verification_id" name="verification_id" value="{{ $verificationData ? $verificationData->id : '' }}" />
    <div class="row">
        <div class="col-lg-3">
            <div class="profile-add-img">
                <div class="circle">
                    <img class="profile-pic" id="profile-pic" name="profile"
                    @if (!empty($employeeExists->profile)) value="{{ $employeeExists ? $employeeExists->profile : '' }}" src="{{ $employeeExists->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif>
                  </div>
                <div class="p-image ml-auto">
                    <span class="upload-button" for="file-upload" id="upload-button"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                    <input class="file-upload" name="profile" id="file-upload" type="file" accept="image/*" />

                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="first_name">First Name<span style="color:red">*</span></label>
                        <input type="text" name="first_name" class="form-control" value="{{ $employeeExists ? $employeeExists->first_name : '' }}" placeholder="Enter Your First Name">
                         <strong class="error" id="first_name-error"></strong>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="{{ $employeeExists ? $employeeExists->middle_name : '' }}" placeholder="Enter Your Middle Name">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="last_name">Last Name<span style="color:red">*</span></label>
                        <input type="text" name="last_name" class="form-control" value="{{ $employeeExists ? $employeeExists->last_name : '' }}" placeholder="Enter Your Last Name">
                        <strong class="error" id="last_name-error"></strong>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="email">Official Email Id<span style="color:red">*</span></label>
                        <input type="text" name="email" class="form-control" value="{{ $employeeExists ? $employeeExists->email : '' }}" placeholder="Enter Your Email">
                        @error('email')
                        <p class="velidation">{{ $message }}</p>
                       @enderror
                        <strong class="error" id="email-error"></strong>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="phone">Phone Number<span style="color:red">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ $employeeExists ? $employeeExists->phone : '' }}" placeholder="Enter Your Number">
                        <strong class="error" id="phone-error"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mt-3">
            <h2>Personal</h2>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="dob">Date Of Birth<span style="color:red">*</span></label>
                <input type="date" name="dob" class="form-control" value="{{ $employeeExists ? $employeeExists->dob : '' }}" placeholder="DOB">
                <strong class="error" id="dob-error"></strong>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Select Blood Group<span style="color:red">*</span></label>
                <select class="form-control" name="blood_group" id="blood_group">
                    <option value="{{ $employeeExists ? $employeeExists->blood_group : '' }}"> {{ $employeeExists->blood_group ? $employeeExists->blood_group : 'Select Group' }}</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <strong class="error" id="blood_group-error"></strong>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Select Gender<span style="color:red">*</span></label>

                {{-- <div class="selectBox__value">Select Gender</div> --}}

                <select class="form-control" name="gender" id="gender">
                    <option value="{{ $employeeExists ? $employeeExists->gender : '' }}">{{ $employeeExists ? $employeeExists->gender : ' Select Gender' }}</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <strong class="error" id="gender-error"></strong>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Marital Status<span style="color:red">*</span></label>

                <select class="form-control" name="marital_status" id="marital_status">
                    <option value="{{ $employeeExists ? $employeeExists->marital_status : '' }}">{{ $employeeExists->marital_status ? $employeeExists->marital_status : 'Select Status' }}</option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                </select>
                <strong class="error" id="marital_status-error"></strong>
            </div>
        </div>

        <div class="col-md-12">
            <h4>Pan Card <span style="color:red">*</span></h4>     
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Pan Card Number<span style="color:red">*</span></label>
                <input type="text" name="pan_card_number" class="form-control" value="{{ $employeeExists ? $employeeExists->pan_card_number : '' }}" placeholder="Enter pan card number">
                <strong class="error" id="pan_card_number-error"></strong>
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Pan Card Id<span style="color:red">*</span></label>
                <input type="file" id="pan_card_id" name="pan_card_id" value="{{ $employeeExists ? $employeeExists->pan_card_id : '' }}" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
                <strong class="error" id="pan_card_id-error"></strong>
                {{-- @if(!empty($employeeExists->pan_card_id))
                <a href="{{ $employeeExists->pan_card_id ? $employeeExists->pan_card_id : '' }}" target="_blank" class="btn btn-primary">Uploaded Document</a>
             @endif --}}
            </div>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-4 ">
            <div class="form-group">
                <label>&nbsp;</label>
                @if (!empty($employeeExists->pan_card_id))
                    <a href="{{ $employeeExists->pan_card_id ? $employeeExists->pan_card_id : '#' }}" target="_blank" class="btn btn-primary"><i class="toggle-password fa fa-fw fa-eye"></i>View Document</a>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <h4>Aadhar Card <span style="color:red">*</span></h4>     
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Aadhar Card Number<span style="color:red">*</span></label>
                <input type="text" name="aadhar_card_number" class="form-control" value="{{ $employeeExists ? $employeeExists->pan_card_number : '' }}" placeholder="Enter aadhar card number">
                <strong class="error" id="aadhar_card_number-error"></strong>
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Aadhar Card Id<span style="color:red">*</span></label>
                <input type="file" id="aadhar_card_id" name="aadhar_card_id" value="{{ $employeeExists ? $employeeExists->aadhar_card_id : '' }}" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
                <strong class="error" id="aadhar_card_id-error"></strong>
                {{-- @if(!empty($employeeExists->aadhar_card_id))
                 <a href="{{ $employeeExists->aadhar_card_id ? $employeeExists->aadhar_card_id : '' }}" target="_blank" class="btn btn-primary Emp">Uploaded Document</a>
             @endif --}}
            </div>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-4 ">
            <div class="form-group">
                <label>&nbsp;</label>
                @if (!empty($employeeExists->aadhar_card_id))
                    <a href="{{ $employeeExists->aadhar_card_id ? $employeeExists->aadhar_card_id : '#' }}" target="_blank" class="btn btn-primary"><i class="toggle-password fa fa-fw fa-eye"></i>View Document</a>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <h4>Passport <span style="color:red">*</span></h4>     
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Passport Number<span style="color:red">*</span></label>
                <input type="text" name="passport_number" class="form-control" value="{{ $employeeExists ? $employeeExists->passport_number : '' }}" placeholder="Enter passport number">
                <strong class="error" id="passport_number-error"></strong>
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Passport Id<span style="color:red">*</span></label>
                <input type="file" id="passport_id" name="passport_id" value="{{ $employeeExists ? $employeeExists->passport_id : '' }}" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
                <strong class="error" id="passport_id-error"></strong>
                {{-- @if(!empty($employeeExists->passport_id))
                <a href="{{ $employeeExists->passport_id ? $employeeExists->passport_id : '' }}" target="_blank" class="btn btn-primary">Uploaded Document</a>
             @endif --}}
            </div>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-4 ">
            <div class="form-group">
                <label>&nbsp;</label>
                @if (!empty($employeeExists->passport_id))
                    <a href="{{ $employeeExists->passport_id ? $employeeExists->passport_id : '#' }}" target="_blank" class="btn btn-primary"><i class="toggle-password fa fa-fw fa-eye"></i>View Document</a>
                @endif
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label class="exitonboard doc"> <input type="checkbox" name="verification_type" class="checkboxexitform" <?php  if ($employeeExists->verification_type == '1') { ?> checked <?php } ?>/>Document Verification</label>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>3rd Party Verification Document</label>
                <input type="file" id="third_party_document" name="third_party_document" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label class="exitonboard doc"> 
                    <input type="checkbox" name="third_party_verification" class="checkboxexitform" <?php  if ($employeeExists->third_party_verification == '1') { ?> checked <?php } ?>> 3rd Party Verification </label>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="current_address">Current Address<span style="color:red">*</span></label>
                <textarea rows="3" name="current_address" placeholder="Address" class="form-control">{{ $employeeExists ? $employeeExists->current_address : '' }}</textarea>
                <strong class="error" id="current_address-error"></strong>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="permanent_address">Permanent Address<span style="color:red">*</span></label>
                <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control">{{ $employeeExists ? $employeeExists->permanent_address : '' }}</textarea>
                <strong class="error" id="permanent_address-error"></strong>
            </div>
        </div>
        <div class="col-xl-12 mt-3">
            <h2>Emergency Contact</h2>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_name">Name<span style="color:red">*</span></label>
                <input type="text" name="emg_name" class="form-control" value="{{ $employeeExists ? $employeeExists->emg_name : '' }}"
                    placeholder="Enter Name">
                <strong class="error" id="emg_name-error"></strong>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_relationship">Relationship<span style="color:red">*</span></label>
                <input type="text" name="emg_relationship" class="form-control"
                    value="{{ $employeeExists ? $employeeExists->emg_relationship : '' }}" placeholder="Enter Relation">
                <strong class="error" id="emg_relationship-error"></strong>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_phone">Phone Number<span style="color:red">*</span></label>
                <input type="text" name="emg_phone" class="form-control" value="{{ $employeeExists ? $employeeExists->emg_phone : '' }}"
                    placeholder="Number">
                <strong class="error" id="emg_phone-error"></strong>
            </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_address">Address<span style="color:red">*</span></label>
                <textarea rows="3" name="emg_address" class="form-control" value="{{ $employeeExists ? $employeeExists->emg_address : '' }}"  placeholder="Enter Address">{{ $employeeExists ? $employeeExists->emg_address : '' }}</textarea>
                <strong class="error" id="emg_address-error"></strong>
            </div>
        </div>
    </div>
    <div class="add-btn-part">
        <button type="reset" class="btn-secondary-cust">Cancel</button>
        <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Next</span></button>
    </div>
</form>

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
<!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->


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
                pan_card_number: "required",
                aadhar_card_number: "required",
                passport_number: "required",

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
                pan_card_number: "Pan card number is required",
                aadhar_card_number: "Aadhar card number is required",
                passport_number: "Passport number is required",
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

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="skill[' + i +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline1" name="skill_type[' +
            i +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline1">Beginner</label></span> <span><input type="radio" id="customRadioInline2" name="skill_type[' +
            i +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline2">Intermediate</label></span> <span><input type="radio" id="customRadioInline3" name="skill_type[' +
            i +
            ']" class="" value="Expert">  <label class="" for="customRadioInline3">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar1").click(function() {
        ++j;
        $("#dynamicAddRemove1").append('<tr><td><input type="text" name="lang[' + j +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline4" name="lang_type[' +
            j +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline4">Beginner</label></span>  <span><input type="radio" id="customRadioInline5" name="lang_type[' +
            j +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline5">Intermediate</label></span> <span><input type="radio" id="customRadioInline6" name="lang_type[' +
            j +
            ']" class="" value="Expert">  <label class="" for="customRadioInline6">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field1', function() {
        $(this).parents('tr').remove();
    });
</script>

<script>
    $('.extra-fields-customer1').click(function() {
        $('.customer_records1').clone().appendTo('.customer_records_dynamic1');
        $('.customer_records_dynamic1 .customer_records1').addClass('single remove');
        $('.single .extra-fields-customer1').remove();
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
            );
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
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
            );
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

<script>

    $("#exitemployee").click(function() {
           getExitEmployeeForm();
       });

       function getExitEmployeeForm(id = '') {
           let getFormUrl = '{{ url('exit-employee/form') }}';
           if (id !== '') {
               getFormUrl = getFormUrl + "/" + id;
           }
           $.ajax({
               url: getFormUrl,
               type: "get",
               datatype: "html",
           }).done(function(data) {

              $('#Heading').text("Exit employee");

               $('#exitemployeemodel').find('.modal-body').html(data);
               $('#exitemployeemodel').modal({
                   backdrop: 'static',
                   keyboard: false
               });
           }).fail(function(jqXHR, ajaxOptions, thrownError) {
               alert('No response from server');
           });
       }
       $('#exit_employee_form').on('submit', function(event) {
           event.preventDefault();
           var isAdd = $('#is_add').val();
           var url = '{{ url('exit-employee/submit') }}';

           $('.loadingImg').show();
           var formData = new FormData(this);
           $.ajax({
               url: url,
               type: 'POST',
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: formData,
               contentType: false,
               processData: false,
               success: function(data) {
                   if (data.errors) {
                       if (data.errors.date_of_exit) {
                           $('#date_of_exit-error').html(data.errors.date_of_exit[0]);
                       }
                       if (data.errors.reason_of_exit) {
                           $('#reason_of_exit-error').html(data.errors.reason_of_exit[0]);
                       }
                       $('.loadingImg').hide();
                   } else {
                       if (data.success != 0) {
                           $('.loadingImg').hide();
                           $('#date_of_exit-error').html('');
                           $('#reason_of_exit-error').html('');

                           $('#success').css('display', 'block');
                           setInterval(function() {
                               location.reload();
                           }, 5000);
                           window.location.href = '{{ url('employee') }}';

                       } else {
                           $('#failed').css('display', 'block');
                           setInterval(function() {
                               location.reload();
                           }, 3000);
                       }
                   }

               },
               error: function(xhr, textStatus, errorThrown) {
                   console.log(xhr.responseText);
               }
           });
       });
</script>
@stop