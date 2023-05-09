         <form id="employee_official_form" action="{{ url('employee_official/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                    <input type="date" name="date_of_joining" class="form-control"
                                        placeholder="Date">
                                    @error('date_of_joining')
                                        <span class="velidation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="date_of_joining-error"></strong>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Employee Type<span style="color:red">*</span></label>
                                    <select class="form-control" name="emp_type" id="emp_type">
                                        <option value="">Select Employee Type</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Trainee">Trainee</option>
                                        <option value="Freelancer">Freelancer</option>
                                    </select>
                                    @error('emp_type')
                                        <span class="velidation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="emp_type-error"></strong>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Work Location<span style="color:red">*</span></label>
                                    <select class="form-control" name="work_location" id="work_location">
                                        <option value="">Select Work Location</option>
                                        <option value="Bhopal, MP">Bhopal, MP</option>
                                        <option value="Indore, MP">Indore, MP</option>
                                        <option value="Pune, MH">Pune, MH</option>

                                    </select>
                                    @error('work_location')
                                        <span class="velidation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="work_location-error"></strong>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Employee Status<span style="color:red">*</span></label>
                                    <select class="form-control" name="emp_status" id="emp_status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('emp_status')
                                        <span class="velidation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="emp_status-error"></strong>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-5 col-md-10">
                                <div class="form-group">
                                    <label>Designation<span style="color:red">*</span></label>
                                    <input type="text" name="designation" class="form-control"
                                        placeholder="Designation">
                                    <strong class="error" id="designation-error"></strong>
                                </div>
                            </div>

                            <div class="col-xl-12 mt-3">
                                <h2>Salary Info</h2>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>LPA<span style="color:red">*</span></label>
                                    <input type="text" name="lpa" class="form-control" placeholder="Enter LPA">
                                    @error('lpa')
                                        <span class="velidation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="lpa-error"></strong>
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
               