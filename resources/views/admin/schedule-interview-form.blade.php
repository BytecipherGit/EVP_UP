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
    <label>First Name</label>
    <input type="type" name="first_name" class="form-control" placeholder="First Name">
    <strong class="error" id="first_name-error"></strong>
</div>
<div class="form-group">
    <label>Last Name</label>
    <input type="type" name="last_name" class="form-control" placeholder="Last Name">
    <strong class="error" id="last_name-error"></strong>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email">
    <strong class="error" id="email-error"></strong>
</div>
<div class="form-group">
    <label>Designation</label>
    <input type="type" name="designation" class="form-control" placeholder="Designation">
    <strong class="error" id="designation-error"></strong>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-5">
            <label>Date</label>
            <input type="date" name="interview_date" class="form-control">
            <strong class="error" id="interview_date-error"></strong>
        </div>
        <div class="col-md-3">
            <label>Start Time</label>
            <input type="time" name="interview_start_time" class="form-control">
            <strong class="error" id="interview_start_time-error"></strong>
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <span class="time-schud">to</span>
        </div>
        <div class="col-md-3">
            <label>End Time</label>
            <input type="time" name="interview_end_time" class="form-control">
            <strong class="error" id="interview_end_time-error"></strong>
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
                <label>Use Third-party Video Conference Service</label>
                <input type="type" name="video_link" class="form-control" placeholder="Video Meeting Link">
                <strong class="error" id="video_link-error"></strong>
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="form-group">
                <label>Interviewer's Phone Number</label>
                <input type="type" name="phone" class="form-control" placeholder="Phone Number">
                <strong class="error" id="phone-error"></strong>
            </div>
        </div>
        <input type="hidden" id="interview_type" name="interview_type" value="Video">
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" rows="3" class="form-control" placeholder="Message"></textarea>
            <strong class="error" id="message-error"></strong>
        </div>
        {{-- <div class="form-group">
                <label>Add Additianal Employers</label>
                <input type="type" name="" class="form-control"
                    placeholder="Enter one pr more emails separated by a comma">
            </div> --}}
        <div class="form-group">
            <label>Attech File</label>
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
