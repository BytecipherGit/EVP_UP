
<form id="employee_experience_form" action="{{ url('employee_experience/form') }}" method="post" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <input type="hidden" id="is_add" value="{{ $workExperiences ? '' : 1 }}" />
  <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee ? $employee->id : '' }}" />

                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Company Name<span style="color:red">*</span></label>
                                  <input type="text" name="com_name" class="form-control" placeholder="ByteCipher">
                                  <strong class="error" id="com_name-error"></strong>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-6">
                                  <label>From<span style="color:red">*</span></label>
                                  <input type="date" name="work_duration_from" class="form-control" placeholder="From">
                                  <strong class="error" id="work_duration_from-error"></strong>
                              </div>

                              <div class="col-md-6">
                                  <label>To<span style="color:red">*</span></label>
                                  <input type="date" name="work_duration_to" class="form-control" placeholder="To">
                                  <strong class="error" id="work_duration_to-error"></strong>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Designation<span style="color:red">*</span></label>
                                  <input type="text" name="designation" class="form-control" placeholder="React Native Developer">
                                  <strong class="error" id="designation-error"></strong>
                              </div>
                          </div>
                      </div>


                      <div class="form-group">
                          <label>Offer Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                              .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                          <div class="upload-img-file">
                              <input type="file" id="offer_letter" name="offer_letter" class="form-control" accept="image/jpg,image/doc,image/pdf" />
                              <strong class="error" id="offer_letter-error"></strong>
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Experience Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                              .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                          <div class="upload-img-file">
                              <input type="file" id="exp_letter" name="exp_letter" class="form-control"accept="image/jpg,image/doc,image/pdf" />
                              <strong class="error" id="exp_letter-error"></strong>
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Salary Slips<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                              .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                          <div class="upload-img-file">
                              <input type="file" id="salary_slip" name="salary_slip" class="form-control"  accept="image/jpg,image/doc,image/pdf" />
                              <strong class="error" id="salary_slip-error"></strong>
                          </div>
                      </div>

                    
          <div class="modal-footer">
              <button type="reset" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
          </div>
</form>
