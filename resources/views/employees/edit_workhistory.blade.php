<form id="employee_workhistory_form_edit" action="{{ url('workhistory/form/update') }}" method="post" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $workhistoryExists ? '' : 1 }}" />
    <input type="hidden" id="id" name="id" value="{{ $workhistory ? $workhistory->id : '' }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <input type="hidden" id="verification_id" name="verification_id" value="{{ $experienceStatus ? $experienceStatus->id : '' }}" />


    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label>Company Name<span style="color:red">*</span></label>
                <input type="text" name="com_name" class="form-control"
                    value="{{ $workhistory ? $workhistory->com_name : '' }}" placeholder="ByteCipher">
                <strong class="error" id="com_name-error"></strong>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>From<span style="color:red">*</span></label>
                <input type="date" name="work_duration_from" class="form-control"
                    value="{{ $workhistory ? $workhistory->work_duration_from : '' }}" placeholder="From">
                <strong class="error" id="work_duration_from-error"></strong>
            </div>

            <div class="col-md-6">
                <label>To<span style="color:red">*</span></label>
                <input type="date" name="work_duration_to" class="form-control"
                    value="{{ $workhistory ? $workhistory->work_duration_to : '' }}" placeholder="To">
                <strong class="error" id="work_duration_to-error"></strong>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label>Designation<span style="color:red">*</span></label>
                <input type="text" name="designation" class="form-control"
                    value="{{ $workhistory ? $workhistory->designation : '' }}" placeholder="React Native Developer">
                <strong class="error" id="designation-error"></strong>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label>Offer Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
            .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
        <div class="upload-img-file">
            <input type="file" id="offer_letter" name="offer_letter" class="form-control" value="{{ $workhistory ? $workhistory->offer_letter : '' }}" accept="image/jpg,image/doc,image/pdf" />
            <strong class="error" id="offer_letter-error"></strong>
        </div>
    </div>

    <div class="form-group">
        <label>Experience Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
            .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
        <div class="upload-img-file">
            <input type="file" id="exp_letter" name="exp_letter" value="{{ $workhistory ? $workhistory->exp_letter : '' }}" class="form-control"accept="image/jpg,image/doc,image/pdf" />
            <strong class="error" id="exp_letter-error"></strong>
        </div>
    </div>

    <div class="form-group">
        <label>Salary Slips<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
            .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
        <div class="upload-img-file">
            <input type="file" id="salary_slip" name="salary_slip" class="form-control" value="{{ $workhistory ? $workhistory->salary_slip : '' }}" accept="image/jpg,image/doc,image/pdf" />
            <strong class="error" id="salary_slip-error"></strong>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label class="exitonboard"> <input type="checkbox" name="workhistory_verification_type"
                       <?php  if ($workhistory->workhistory_verification_type == '1') { ?> checked <?php } ?>  class="checkboxexitform">Document
                    Verification</label>
            </div>
        </div>
    </div>

    {{-- <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label class="exitonboard"> <input type="checkbox" name="third_party_workhistory_verification" <?php // if ($workhistory->third_party_workhistory_verification == '1') { ?> checked <?php// } ?> class="checkboxexitform"> 3rd Party
                    Verification </label>
            </div>
        </div>
    </div> --}}

    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label>3rd Party Verification Document</label>
                <label class="exitonboard"> <input type="checkbox" name="third_party_workhistory_verification" <?php  if ($workhistory->third_party_workhistory_verification == '1') { ?> checked <?php } ?> class="checkboxexitform"> 3rd Party
                    Verification </label>
                <input type="file" id="third_party_workhistory_document" name="third_party_workhistory_document" class="form-control">
            </div>
        </div>
    </div>

    


    <div class="modal-footer">
        <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
        <button type="submit" name="workhistory" class="btn-primary-cust button_background_color"><span
                class="button_text_color">Save</span></button>
    </div>
</form>
