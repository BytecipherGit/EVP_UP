<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $interview ? '' : 1 }}" />
<input type="hidden" id="interview_id" name="interview_id" value="{{ $interview ? $interview->id : '' }}" />
<div class="form-group">
    <label>First Name<span style="color:red">*</span></label>
    <input type="type" name="first_name" class="form-control" placeholder="First Name">
    <strong class="error" id="first_name-error"></strong>
</div>
<div class="form-group">
    <label>Last Name<span style="color:red">*</span></label>
    <input type="type" name="last_name" class="form-control" placeholder="Last Name">
    <strong class="error" id="last_name-error"></strong>
</div>
<div class="form-group">
    <label>Email<span style="color:red">*</span></label>
    <input type="email" name="email" class="form-control" placeholder="Email">
    <strong class="error" id="email-error"></strong>
</div>
<div class="form-group">
    <label>Position<span style="color:red">*</span></label>
    <input type="type" name="position" class="form-control" placeholder="Position">
    <strong class="error" id="position-error"></strong>
</div>
<div class="form-group">
    <label>Select Interview Round<span style="color:red">*</span></label>
    @if ($interviewProcesses)
        <select id="interview_process" name="interview_process" class="form-control">
            @foreach ($interviewProcesses as $interviewProcess)
                <option value="{{ $interviewProcess->id }}">{{ $interviewProcess->title }}</option>
            @endforeach
        </select>
    @endif
    <strong class="error" id="interview_process-error"></strong>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-5">
            <label>Date<span style="color:red">*</span></label>
            <input type="date" name="interview_date" class="form-control">
            <strong class="error" id="interview_date-error"></strong>
        </div>
        <div class="col-md-3">
            <label>Start Time<span style="color:red">*</span></label>
            <input type="time" name="interview_start_time" class="form-control">
            <strong class="error" id="interview_start_time-error"></strong>
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <span class="time-schud">And</span>
        </div>
        <div class="col-md-3">
            <label>Duration<span style="color:red">*</span></label>
            <select class="form-control" id="duration" name="duration">
                <option value="30M">30M</option>
                <option value="1H">1H</option>
                <option value="2H">2H</option>
            </select>
            <strong class="error" id="duration-error"></strong>
        </div>
    </div>
</div>

<div class="schudinter-tab">
    <h1 class="schudh1">Interview Type</h1>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="InterviewTypeVideo" data-id="Video" data-toggle="tab" href="#tabs-1"
                role="tab"><img src="assets/admin/images/video-call.png"> Video</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="InterviewTypePhone" data-toggle="tab" data-id="Telephonic" href="#tabs-2"
                role="tab"><img src="assets/admin/images/phone-call.png">Phone</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="form-group">
                <label>Use Third-party Video Conference Service<span style="color:red">*</span></label>
                <input type="type" name="video_link" class="form-control" placeholder="Video Meeting Link">
                <strong class="error" id="video_link-error"></strong>
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="form-group">
                <label>Interviewer's Phone Number<span style="color:red">*</span></label>
                <input type="type" name="phone" class="form-control" placeholder="Phone Number">
                <strong class="error" id="phone-error"></strong>
            </div>
        </div>
        <input type="hidden" id="interview_type" name="interview_type" value="Video">
        <div class="form-group">
            <label>Interviewer name<span style="color:red">*</span></label>
            @if ($cmpEmployees)
                <select id="interview_process" name="interview_process" class="form-control">
                    <option value="">Select Employeee</option>
                    @foreach ($cmpEmployees as $cmpEmployee)
                        <option value="{{ $cmpEmployee->id }}">{{ $cmpEmployee->first_name.' '.$cmpEmployee->last_name }}</option>
                    @endforeach
                </select>
            @endif
            <strong class="error" id="interview_process-error"></strong>
        </div>
        <div class="form-group">
            <label>Interview Instruction<span style="color:red">*</span></label>
            <textarea name="interview_instruction" rows="3" class="form-control" placeholder="Interview Instruction"></textarea>
            <strong class="error" id="interview_instruction-error"></strong>
        </div>
        {{-- <div class="form-group">
                <label>Add Additianal Employers</label>
                <input type="type" name="" class="form-control"
                    placeholder="Enter one pr more emails separated by a comma">
            </div> --}}
        <div class="form-group">
            <label>Attech Resume<span style="color:red">*</span>
                <h6>Only .jpeg, .pdf, .docs, or .doc files allowed.</h6>
            </label>
            <div class="upload-img-file">
                <input type="file" id="attachment" name="attachment" class="form-control">
                <strong class="error" id="attachment-error"></strong>
            </div>
        </div>

    </div>
</div>

<script>
    $("#InterviewTypeVideo").on("click", function() {
        var dataId = $(this).attr("data-id");
        $('#interview_type').val(dataId);
        // alert("The data-id of clicked item is: " + dataId);
    });
    $("#InterviewTypePhone").on("click", function() {
        var dataId = $(this).attr("data-id");
        // alert("The data-id of clicked item is: " + dataId);
        $('#interview_type').val(dataId);
    });
</script>
