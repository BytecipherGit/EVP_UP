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
    {{-- <input type="type" name="position" class="form-control" placeholder="Position"> --}}
    @if ($positions)
        <select id="position" name="position" class="form-control">
            @foreach ($positions as $position)
                <option value="{{ $position->title }}">{{ $position->title }}</option>
            @endforeach
        </select>
    @endif
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
                role="tab">
                {{-- <img src="{{ asset('assets') }}/admin/images/video-call.png">  --}}
                Video</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="InterviewTypePhone" data-toggle="tab" data-id="Telephonic" href="#tabs-2"
                role="tab">
                {{-- <img src="{{ asset('assets') }}/admin/images/phone-call.png"> --}}
                Phone</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="InterviewTypeOffice" data-toggle="tab" data-id="At Office" href="#tabs-3"
                role="tab"><img src="">Office</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="InterviewTypeHome" data-toggle="tab" data-id="At Home" href="#tabs-4"
                role="tab"><img src="">Home</a>
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
                <label>Interviewer Phone Number<span style="color:red">*</span></label>
                <input type="type" name="phone" class="form-control" placeholder="Phone Number">
                <strong class="error" id="phone-error"></strong>
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel"></div>
        <div class="tab-pane" id="tabs-4" role="tabpanel"></div>

        <input type="hidden" id="interview_type" name="interview_type" value="Video">

        <div class="form-group">
            <label>Attech Resume<span style="color:red">*</span>
                <h6>Only .jpeg, .pdf, .docs, or .doc files allowed and max upload file size is (10MB)</h6>
            </label>
            <div class="upload-img-file">
                <input type="file" id="attachment" name="attachment" class="form-control">
                <strong class="error" id="attachment-error"></strong>
            </div>
        </div>

        <div class="form-group">
            <label>Interviewer name<span style="color:red">*</span></label>
            <select class="form-control" id="interviewIds" select2 select2-hidden-accessible multiple="multiple"
                name="interviewer_id[]">
                @foreach ($cmpEmployees as $emp)
                    <option value="{{ $emp->id }}">
                        {{ $emp->first_name . ' ' . $emp->middle_name . ' ' . $emp->last_name }}</option>
                @endforeach
            </select>

            {{-- <select id="tags" select2 select2-hidden-accessible multiple="multiple" style="width: 300px">
                <option value="1" selected="true">Apple1</option>
                <option value="2">Bat</option>
                <option value="Cat">Cat</option>
                <option value="Dog" selected>Dog1</option>
                <option value="Elephant">Elephant</option>
                <option value="View/Exposure" >View/Exposure</option>
                <option value="View / Exposure">View / Exposure</option>
                <option value="Dummy - Data" selected>Dummy - Data</option>
                <option value="Dummy-Data">Dummy-Data</option>
                <option value="Dummy:Data">Dummy:Data</option>
                <option value="Dummy(Data)">Dummy(Data)</option>    
            </select> --}}
            {{-- <input class="typeahead form-control" id="search" type="text">
            <input type="hidden" id="interviewer_id" name="interviewer_id"> --}}
            <strong class="error" id="interviewer_id-error"></strong>
        </div>
        {{-- <div class="form-group">
            <label>Interviewer name<span style="color:red">*</span></label>
            <input class="typeahead form-control" id="search" name="interviewer_id" type="text">
        </div> --}}
        <div class="form-group">
            <label>Interview Instruction<span style="color:red">*</span></label>
            <textarea name="interview_instruction" rows="3" class="form-control" placeholder="Interview Instruction"></textarea>
            <strong class="error" id="interview_instruction-error"></strong>
        </div>
        <div class="form-group">
            <label>Attech Interview Instruction/Test File
                <h6>Only .pdf, .docs, or .doc files allowed and max upload file size is (10MB)</h6>
            </label>
            <div class="upload-img-file">
                <input type="file" id="instruction" name="instruction" class="form-control">
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var path = "{{ route('employeeNameAutocomplete') }}";

    $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
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
