

<form id="employee_qualification_form_edit" action="{{ url('qualification/form/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
  <input type="hidden" id="id" name="id" value="{{ $qualification ? $qualification->id : '' }}" />
  <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
  <input type="hidden" id="verification_id" name="verification_id" value="{{ $qualificationStatus ? $qualificationStatus->id : '' }}" />

  
     <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label>School/College/Institute<span style="color:red">*</span></label>
                    <input type="text" name="inst_name" class="form-control" value="{{ $qualification ? $qualification->inst_name : ''}}" placeholder="Enter Name">
                    <strong class="error" id="inst_name-error"></strong>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Degree<span style="color:red">*</span></label>
                    <input type="text" name="degree" class="form-control" value="{{ $qualification ? $qualification->degree : ''}}" placeholder="Ex. Bachelor's">
                    <strong class="error" id="degree-error"></strong>
                </div>

                <div class="col-md-6">
                    <label>Subject<span style="color:red">*</span></label>
                    <input type="text" name="subject" class="form-control" value="{{ $qualification ? $qualification->subject : ''}}" placeholder="Ex. CS">
                    <strong class="error" id="subject-error"></strong>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>From<span style="color:red">*</span></label>
                    <input type="date" name="duration_from" class="form-control" value="{{ $qualification ? $qualification->duration_from : ''}}" placeholder="From">
  
                    <strong class="error" id="duration_from-error"></strong>
                </div>
                <div class="col-md-6">
                    <label>To<span style="color:red">*</span></label>
                    <input type="date" name="duration_to" class="form-control" value="{{ $qualification ? $qualification->duration_to : ''}}" placeholder="To">
                    <strong class="error" id="duration_to-error"></strong>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Attech File<span style="color:red">*</span></br><b>File type:</b> Only .jpeg, .pdf,
                .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
            <div class="upload-img-file">
                <input type="file" id="document" name="document" class="form-control" value="{{ $qualification ? $qualification->document : ''}}" accept="image/jpg,image/doc,image/pdf" />
                <strong class="error" id="document-error"></strong>
  
            </div>
        </div>

      <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label class="exitonboard"> <input type="checkbox" <?php  if ($qualification->qualification_verification_type == '1') { ?> checked <?php } ?> name="qualification_verification_type" class="checkboxexitform">Document Verification</label>
                </div>
            </div>
        </div>
  
        {{-- <div class="form-group">        
            <div class="row">
              <div class="col-md-12">
                <label class="exitonboard"> <input type="checkbox" <?php  if //($qualification->third_party_qualification_verification == '1') { ?> checked <?php //} ?> name="third_party_qualification_verification" class="checkboxexitform"> 3rd Party Verification </label>
              </div>
          </div>
        </div> --}}
     
           <div class="form-group">
            <div class="row">
              <div class="col-md-12">
              <label>3rd Party Verification Document</label>
              <label class="exitonboard"> <input type="checkbox" <?php  if ($qualification->third_party_qualification_verification == '1') { ?> checked <?php } ?> name="third_party_qualification_verification" class="checkboxexitform"> 3rd Party Verification </label>
              <input type="file" id="third_party_qualification_document" name="third_party_qualification_document" class="form-control">
              </div>
            </div>
          </div>

          
        <div class="modal-footer">
          <div id="loadingImg"></div>
          <div style="font-size: 16px; display:none;" class="text-success" id="success">Position successfully created.</div>
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" id="interviewProcessSubmit" class="btn-primary-cust button_background_color"><span class="button_text_color">Submit</span></button>
        </div>
  
  </form>
 

{{-- <p>hii{{ $qualification->id }}</p> --}}
