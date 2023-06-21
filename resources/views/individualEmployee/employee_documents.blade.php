<form id="employee_experience_doc" action="{{ url('employee_documents/form') }}" method="post" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <form>
                <div class="row">
                    <div class="col-xl-12">
                        <h2>Uploaded Documents</h2>
                    </div>
                </div>

                <div class="document_basic">
                    <div class="row customer_records1">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5> Pan Card</h5>
                            </div>
                        </div>
                        {{-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Document Type</label>
                                    <h5> Pan Card</h5>
                                </div>
                            </div> --}}
                        <div class="col-xl-5 col-lg-5 col-md-6">
                            <div class="form-group">
                                <label>Pan Card Number <span style="color:red">*</span></label>
                                <input type="text" name="pan_card_number" class="form-control"
                                    value="{{ $employee ? $employee->pan_card_number : '' }}"
                                    placeholder="Enter pan card number">
                                {{-- <strong class="error" id="pan_card_number-error"></strong> --}}
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-6">
                            <div class="form-group">
                                <label>Pan Card Id <span style="color:red">*</span></label>
                                <input type="file" id="pan_card_id" name="pan_card_id"
                                    value="{{ $employee ? $employee->pan_card_id : '' }}" class="form-control"
                                    accept="image/jpeg,image/doc,image/pdf">
                                <strong class="error" id="pan_card_id-error"></strong>
                                {{-- @if (!empty($employee->pan_card_id))
                                    <a href="{{ $employee->pan_card_id ? $employee->pan_card_id : '#'}}" target="_blank" class="btn btn-primaryEmp">Uploaded Document</a>
                                    @endif --}}
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 ">
                            <div class="form-group">
                                <label>&nbsp;</label>

                                @if (!empty($employee->pan_card_id))
                                    <a href="{{ $employee->pan_card_id ? $employee->pan_card_id : '#' }}"
                                        target="_blank" class="btn btn-primaryEmp"><i
                                            class="toggle-password fa fa-fw fa-eye"></i> View Document</a>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                {{-- <label>Document Type</label> --}}
                                        {{-- <h5> Aadhar Card</h5>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5> Aadhar Card</h5>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Aadhar Card Number <span style="color:red">*</span></label>
                                <input type="text" name="aadhar_card_number" class="form-control"
                                    value="{{ $employee ? $employee->aadhar_card_number : '' }}"
                                    placeholder="Enter aadhar card number">
                                <strong class="error" id="aadhar_card_number-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Aadhar Card Id <span style="color:red">*</span></label>
                                <input type="file" id="aadhar_card_id" name="aadhar_card_id" value="{{ $employee ? $employee->aadhar_card_id : '' }}" class="form-control" accept="image/jpeg,image/doc,image/pdf">
                                {{-- <strong class="error" id="aadhar_card_id-error"></strong>
                                        @if (!empty($employee->aadhar_card_id))
                                        <a href="{{ $employee->aadhar_card_id ? $employee->aadhar_card_id : '#'}}" target="_blank" class="btn btn-primaryEmp">Uploaded Document</a>
                                    @endif --}}
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-4 ">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                @if (!empty($employee->aadhar_card_id))
                                    <a href="{{ $employee->aadhar_card_id ? $employee->aadhar_card_id : '#' }}" target="_blank" class="btn btn-primaryEmp"><i class="toggle-password fa fa-fw fa-eye"></i> View Document</a>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Document Type</label>
                                    <h5> Passport</h5>
                                </div>
                            </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5> Passport</h5>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Passport Number <span style="color:red">*</span></label>
                                <input type="text" name="passport_number" class="form-control" value="{{ $employee ? $employee->passport_number : '' }}" placeholder="Enter passport number">
                                <strong class="error" id="passport_number-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Passport Id <span style="color:red">*</span></label>
                                <input type="file" id="passport_id" name="passport_id" value="{{ $employee ? $employee->passport_id : '' }}" class="form-control" accept="image/jpeg,image/doc,image/pdf">
                                <strong class="error" id="passport_id-error"></strong>
                                {{-- @if (!empty($employee->passport_id))
                                    <a href="{{ $employee->passport_id ? $employee->passport_id : '#' }}" target="_blank" class="btn btn-primaryEmp">Uploaded Document</a>
                                @endif --}}
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-4 ">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                @if (!empty($employee->passport_id))
                                    <a href="{{ $employee->passport_id ? $employee->passport_id : '#' }}" target="_blank" class="btn btn-primaryEmp"><i class="toggle-password fa fa-fw fa-eye"></i> View Document</a>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="add-plus mt-custom-plus extra-fields-customer1"><span><img src="assets/images/button-plus.png"></span></div> --}}
                    </div>
                    {{-- <div class="customer_records_dynamic1"></div> --}}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="add-btn-part">
                            <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn-primary-cust">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
