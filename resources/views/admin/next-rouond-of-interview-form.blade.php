<style>
    .error {
        color: red;
        font-weight: 400;
    }
    .ui-front {
        z-index: 9999 !important;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $interview ? '' : 1 }}" />
<input type="hidden" id="interview_id" name="interview_id" value="{{ $interview ? $interview->id : '' }}" />
<div class="form-group">
    <div class="form-group">
        <label>First Name<span style="color:red">*</span></label>
        <input type="type" disabled name="first_name" class="form-control" placeholder="First Name" value="{{ $interview->first_name}}">
        <strong class="error" id="first_name-error"></strong>
    </div>
    <div class="form-group">
        <label>Last Name<span style="color:red">*</span></label>
        <input type="type" disabled name="last_name" class="form-control" placeholder="Last Name" value="{{ $interview->last_name}}">
        <strong class="error" id="last_name-error"></strong>
    </div>
    <div class="form-group">
        <label>Email<span style="color:red">*</span></label>
        <input type="email" disabled name="email" class="form-control" placeholder="Email" value="{{ $interview->email}}">
        <strong class="error" id="email-error"></strong>
    </div>
    <div class="form-group">
        <label>Position<span style="color:red">*</span></label>
        <input type="type" disabled name="position" class="form-control" placeholder="Position" value="{{ $interview->position}}">
        <strong class="error" id="position-error"></strong>
    </div>

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
            <label>Date</label>
            <input type="date" name="interview_date" class="form-control">
            {{-- <strong class="error" id="interview_date-error"></strong> --}}
        </div>
        <div class="col-md-3">
            <label>Start Time</label>
            <input type="time" name="interview_start_time" class="form-control">
            {{-- <strong class="error" id="interview_start_time-error"></strong> --}}
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <span class="time-schud">And</span>
        </div>
        <div class="col-md-3">
            <label>Duration</label>
            <select class="form-control" id="duration" name="duration">
                <option value="30M">30M</option>
                <option value="1H">1H</option>
                <option value="2H">2H</option>
            </select>
            {{-- <strong class="error" id="duration-error"></strong> --}}
        </div>
    </div>
</div>

<div class="schudinter-tab">
    <h1 class="schudh1">Interview Type</h1>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-linkSchedule active" id="InterviewTypeVideo" data-id="Video" data-toggle="tab" href="#tabs-1"
                role="tab">
                {{-- <img src="assets/admin/images/video-call.png"> --}}
                 Video</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypePhone" data-toggle="tab" data-id="Telephonic" href="#tabs-2"
                role="tab">
                {{-- <img src="assets/admin/images/phone-call.png"> --}}
                Phone</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypeOffice" data-toggle="tab" data-id="At Office" href="#tabs-3"
                role="tab">At Office</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypeHome" data-toggle="tab" data-id="At Home" href="#tabs-4"
                role="tab">At Home</a>
        </li>
    </ul> 
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="form-group">
                <label>Use Third-party Video Conference Service</label>
                <input type="type" name="video_link" class="form-control" placeholder="Video Meeting Link">
                {{-- <strong class="error" id="video_link-error"></strong> --}}
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="form-group">
                <label>Interviewer's Phone Number</label>
                <input type="type" name="phone" class="form-control" placeholder="Phone Number">
                {{-- <strong class="error" id="phone-error"></strong> --}}
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel"></div>
        <div class="tab-pane" id="tabs-4" role="tabpanel"></div>

        <input type="hidden" id="interview_type" name="interview_type" value="Video">
        <div class="form-group">
            {{-- <label>Interviewer name<span style="color:red">*</span></label>
            <input class="typeahead form-control" id="search" type="text">
            <input type="hidden" id="interviewer_id" name="interviewer_id"> --}}
            <label>Interviewer name<span style="color:red">*</span></label>
            <select class="form-control" id="interviewIds" select2 select2-hidden-accessible multiple="multiple"
                name="interviewer_id[]">
                @foreach ($cmpEmployees as $emp)
                    <option value="{{ $emp->id }}">
                        {{ $emp->first_name . ' ' . $emp->middle_name . ' ' . $emp->last_name }}</option>
                @endforeach
            </select>
            <strong class="error" id="interviewer_id-error"></strong>
        </div>
        <div class="form-group">
            <label>Interview Instruction</label>
            <textarea name="interview_instruction" rows="3" class="form-control" placeholder="Interview Instruction"></textarea>
            {{-- <strong class="error" id="interview_instruction-error"></strong> --}}
        </div>
    </div>
</div>

<script type="text/javascript">
    var path = "{{ route('employeeNameAutocomplete') }}";
  
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           $('#interviewer_id').val(ui.item.id);
           console.log(ui.item); 
           return false;
        }
      });
  
</script> 
<script>
    $('#interviewIds').select2({
        placeholder: "Please Select Interviewer"
    });
    
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
    $("#InterviewTypeOffice").on("click", function() {
        var dataId = $(this).attr("data-id");
        $('#interview_type').val(dataId);
    });
    $("#InterviewTypeHome").on("click", function() {
        var dataId = $(this).attr("data-id");
        $('#interview_type').val(dataId);
    });
</script>
