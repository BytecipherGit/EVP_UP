
<style>
   .velidation {
    color: red;
    font-size: 12px;
    display: block;
    margin: 5px 0;
    display: flex;
    }
</style>
<form id="employee_basic_form" action="{{ url('employee/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $employeeExists ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <input type="hidden" id="verification_id" name="verification_id" value="{{ $verificationData ? $verificationData->id : '' }}" />
    <div class="row">
        <div class="col-lg-3">
            <div class="profile-add-img">
                <div class="circle">
                    <img class="profile-pic" id="profile-pic" name="profile"
                    @if (!empty($employeeExists->profile)) value="{{ old('profile') }}" src="{{ $employeeExists->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif required>
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
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter Your First Name">
                         <strong class="error" id="first_name-error"></strong>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}" placeholder="Enter Your Middle Name">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="last_name">Last Name<span style="color:red">*</span></label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter Your Last Name">
                        <strong class="error" id="last_name-error"></strong>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="email">Official Email Id<span style="color:red">*</span></label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Your Email">
                        @error('email')
                         <p class="velidation">{{ $message }}</p>
                        @enderror
                        <strong class="error" id="email-error"></strong>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="phone">Phone Number<span style="color:red">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Your Number">
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
                <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" placeholder="DOB">
                <strong class="error" id="dob-error"></strong>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Select Blood Group<span style="color:red">*</span></label>
                <select class="form-control" name="blood_group" id="blood_group">
                    <option value="{{ old('blood_group') }}">{{ old('blood_group') ?  old('blood_group') : 'Select Blood Group' }}</option>
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
                <select class="form-control" name="gender" id="gender">
                    <option value="{{ old('gender') }}">{{ old('gender') ? old('gender'): 'Select Gender'}}</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <strong class="error" id="gender-error"></strong>
                </select>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Marital Status<span style="color:red">*</span></label>

                <select class="form-control" name="marital_status" id="marital_status">
                    <option value="{{ old('marital_status') }}">{{ old('marital_status') ? old('marital_status'): 'Select Status'}}</option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                </select>
                <strong class="error" id="marital_status-error"></strong>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Document Type<span style="color:red">*</span></label>
                <select name="document_type" class="form-control" id="document_type">
                    <option value="{{ old('document_type') }}">{{ old('document_type') ? old('document_type'): 'Select Document Type'}}</option>
                    <option value="Pan Card">Pan Card</option>
                    <option value="Aadhar Card">Aadhar Card</option>
                    <option value="Passport">Passport</option>
                </select>
                <strong class="error" id="document_type-error"></strong>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Document Number<span style="color:red">*</span></label>
                <input type="text" name="document_number" class="form-control" value="{{ old('document_number') }}" placeholder="Enter document number">
                <strong class="error" id="document_number-error"></strong>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Document Id<span style="color:red">*</span></label>
                <input type="file" id="document_id" name="document_id" value="{{ old('document_id') }}" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
                <strong class="error" id="document_id-error"></strong>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label class="exitonboard doc"> <input type="checkbox" name="verification_type" class="checkboxexitform">Document Verification</label>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label>3rd Party Verification Document</label>
                <input type="file" id="third_party_document" name="third_party_document" class="form-control" accept="image/jpeg,image/doc,image/pdf" >
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label class="exitonboard doc"> <input type="checkbox" name="third_party_verification" class="checkboxexitform"> 3rd Party Verification </label>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="current_address">Current Address<span style="color:red">*</span></label>
                <textarea rows="3" name="current_address" placeholder="Address" class="form-control">{{ old('current_address') }}</textarea>
                <strong class="error" id="current_address-error"></strong>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="permanent_address">Permanent Address<span style="color:red">*</span></label>
                <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control">{{ old('permanent_address') }}</textarea>
                <strong class="error" id="permanent_address-error"></strong>
            </div>
        </div>
        <div class="col-xl-12 mt-3">
            <h2>Emergency Contact</h2>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_name">Name<span style="color:red">*</span></label>
                <input type="text" name="emg_name" class="form-control" value="{{ old('emg_name') }}"
                    placeholder="Enter Name">
                <strong class="error" id="emg_name-error"></strong>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_relationship">Relationship<span style="color:red">*</span></label>
                <input type="text" name="emg_relationship" class="form-control" value="{{ old('emg_relationship') }}" placeholder="Enter Relation">
                <strong class="error" id="emg_relationship-error"></strong>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_phone">Phone Number<span style="color:red">*</span></label>
                <input type="text" name="emg_phone" class="form-control" value="{{ old('emg_phone') }}" placeholder="Number">
                <strong class="error" id="emg_phone-error"></strong>
            </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
                <label for="emg_address">Address<span style="color:red">*</span></label>
                <textarea rows="3" name="emg_address" class="form-control" placeholder="Enter Address">{{ old('emg_address') }}</textarea>
                <strong class="error" id="emg_address-error"></strong>
            </div>
        </div>
    </div>
    <div class="add-btn-part">
        <button type="reset" class="btn-secondary-cust">Cancel</button>
        <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Next</span></button>
    </div>
</form>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

 {{-- <script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script> --}}

{{--<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script> --}}
<!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->

<script>
    $(document).ready(function() {

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

    });
</script>



