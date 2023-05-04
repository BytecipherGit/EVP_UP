
<form id="employee_basic_form" action="{{ url('employee/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $employeeExists ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <div class="row">
        <div class="col-lg-3">
            <div class="profile-add-img">
                <div class="circle">
                    <img class="profile-pic" id="profile-pic" name="profile"
                    @if (!empty($employeeExists->profile)) value="{{ $employeeExists->profile }}" src="{{ $employeeExists->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif required>
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
                    <option value="{{ $employeeExists ? $employeeExists->blood_group : '' }}">Select Group {{ $employeeExists ? $employeeExists->blood_group : '' }}</option>
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
                    <option value="{{ $employeeExists ? $employeeExists->gender : ''}} ">Select Gender</option>
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
                    <option value="{{ $employeeExists ? $employeeExists->marital_status : '' }}">Select Status</option>
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
                    <option value="{{$employeeExists ? $employeeExists->document_type : ''}}">Select document type</option>
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
                <input type="text" name="document_number" class="form-control" value="{{ $employeeExists ? $employeeExists->document_number : '' }}" placeholder="Enter document number">
                <strong class="error" id="document_number-error"></strong>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="form-group">
                <label>Document Id<span style="color:red">*</span></label>
                <input type="file" id="document_id" name="document_id" value="{{ $employeeExists ? $employeeExists->document_id : ''}}" class="form-control">
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
                <input type="file" id="third_party_document" name="third_party_document" class="form-control">
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
                <textarea rows="3" name="emg_address" class="form-control" placeholder="Enter Address"></textarea>
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
<script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
<!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->


