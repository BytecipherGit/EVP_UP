<style>
    .error {
        color: red;
        font-weight: 400;
    }

    .ui-front {
        z-index: 9999 !important;
    }

    .validation {
        color: red;
        font-size: 12px;
        display: block;
        margin: 5px 0;
        display: flex;
    }
</style>

<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $interview ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $interview ? $interview->id : '' }}" />
{{-- <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Filer By</label>
            <select class="form-control" id="filter_by" name="filter_by">
                <option value=""> Select Options </option>
                <option value="name"> Name </option>
                <option value="email"> Email </option>
                <option value="mobile"> Mobile </option>
                <option value="empcode"> Employee Code </option>
                <option value="aadhar"> Aadhaar Number </option>
                <option value="pan"> Pan Number </option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Search Employee</label>
            <input type="type" name="search_employee" id="search_employee"  class="form-control"
            placeholder="Search employee">
        </div>
    </div>
</div> --}}
<div class="form-group">
    <label>First Name<span style="color:red">*</span></label>
    <input type="type" name="first_name" id="first_name" class="form-control" value="{{$interview->first_name}}" placeholder="First Name">
    <strong class="error" id="first_name-error"></strong>
</div>
<div class="form-group">
    <label>Last Name<span style="color:red">*</span></label>
    <input type="type" name="last_name" id="last_name" class="form-control" value="{{$interview->last_name}}" placeholder="Last Name">
    <strong class="error" id="last_name-error"></strong>
</div>
<div class="form-group">
    <label>Email<span style="color:red">*</span></label>
    <input type="email" name="email" id="email" class="form-control" value="{{$interview->email}}" placeholder="Email">
    @error('email')
        <p class="validation">{{ $message }}</p>
    @enderror
    <strong class="error" id="email-error"></strong>
</div>
<div class="form-group">
    <label>Phone Number</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{$interview->phone}}" placeholder="Enter phone number">
</div>
@error('phone')
    <span class="validation">{{ $message }}</span>
@enderror
<div class="form-group">
    <label>Document Type</label>
    <select name="document_type" class="form-control" value="{{$interview->document_type}}" id="document_type">
        <option value="Pan Card">Pan Card</option>
        <option value="Aadhar Card">Aadhar Card</option>
        <option value="Passport">Passport</option>
    </select>
</div>
<div class="form-group">
    <label>Document Number</label>
    <input type="text" name="document_number"  value="{{$interview->document_number}}" id="document_number" class="form-control"
        placeholder="Enter document number">

</div>
@error('document_number')
    <span class="validation">{{ $message }}</span>
@enderror
<div class="form-group">
    <label>Upload ID Proof Document
        <h6>Only .jpeg, .pdf, .docs, or .doc files allowed and max upload file size is (10MB)</h6>
    </label>
    <div class="upload-img-file">
        <input type="file" id="document_id" name="document_id" value="{{$interview->document_id}}" class="form-control">
    </div>
    @error('document_id')
        <span class="validation">{{ $message }}</span>
    @enderror
</div>
<div class="form-group" id="uploadedDocument">
</div>
<div class="form-group">
    <label>Position<span style="color:red">*</span></label>
    {{-- <input type="type" name="position" class="form-control" placeholder="Position"> --}}
    @if ($positions)
        <select id="position" name="position" class="form-control">
            @foreach ($positions as $position)
                @if ($position->status == '1')
                    <option value="{{ $position->title }}">{{ $position->title }}</option>
                @endif
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
                {{-- <img src="{{ asset('assets') }}/admin/images/video-call.png">  --}}
                Video</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypePhone" data-toggle="tab" data-id="Telephonic" href="#tabs-2"
                role="tab">
                {{-- <img src="{{ asset('assets') }}/admin/images/phone-call.png"> --}}
                Phone</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypeOffice" data-toggle="tab" data-id="At Office" href="#tabs-3"
                role="tab"><img src="">Office</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkSchedule" id="InterviewTypeHome" data-toggle="tab" data-id="At Home" href="#tabs-4"
                role="tab"><img src="">Home</a>
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
                <label>Interviewer Phone Number</label>
                <input type="type" name="phone" class="form-control" placeholder="Phone Number">
                {{-- <strong class="error" id="phone-error"></strong> --}}
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel"></div>
        <div class="tab-pane" id="tabs-4" role="tabpanel"></div>

        <input type="hidden" id="interview_type" name="interview_type" value="Video">

        <div class="form-group">
            <label>Attech Resume
                <h6>Only .jpeg, .pdf, .docs, or .doc files allowed and max upload file size is (10MB)</h6>
            </label>
            <div class="upload-img-file">
                <input type="file" id="attachment" name="attachment" class="form-control">
                {{-- <strong class="error" id="attachment-error"></strong> --}}
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
            <strong class="error" id="interviewer_id-error"></strong>
        </div>
        <div class="form-group">
            <label>Interview Instruction</label>
            <textarea name="interview_instruction" rows="3" class="form-control" placeholder="Interview Instruction"></textarea>
            {{-- <strong class="error" id="interview_instruction-error"></strong> --}}
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
    var path = "{{ route('getEmployeeDetailsForScheduleInterview') }}";
    $("#search_employee").autocomplete({
        source: function(request, response) {
            console.log();
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term,
                    filterby: $('#filter_by :selected').val()
                },
                success: function(data) {
                    if ($.isEmptyObject(data)) {
                        $("#uploadedDocument").html('');
                        $('#employee_id').val('');
                        $('#first_name').val('');
                        $('#last_name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#document_number').val('');
                        // $('#document_type option[value='']').attr('selected','');
                    } else {
                        response(data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $('#search_employee').val(ui.item.label);
            if (ui.item.id != '') {
                $("#uploadedDocument").append(
                    `<button class="btn btn-primary" onClick="javascript:window.open('${ui.item.document_id}', '_blank');">Uploaded Document</button>`
                );
                $('#employee_id').val(ui.item.id);
                $('#first_name').val(ui.item.first_name);
                $('#last_name').val(ui.item.last_name);
                $('#email').val(ui.item.email);
                $('#phone').val(ui.item.phone);
                $('#document_number').val(ui.item.document_number);
                $('#document_type option[value=' + ui.item.document_type + ']').attr('selected',
                    'selected');

            }

            return false;
        }
    });
</script>

<script>
    $('#interviewIds').select2({
        placeholder: "Please Select Interviewer"
    });
    
    $("#filter_by").on("change", function() {
        var option = this.value;
        switch (option) { 
            case 'name': 
                $("#search_employee").attr("placeholder", "Enter Employee Name");
                break;
            case 'email': 
                $("#search_employee").attr("placeholder", "Enter Employee Email Id");
                break;
            case 'mobile': 
                $("#search_employee").attr("placeholder", "Enter Employee Mobile");
                break;
            case 'empcode': 
                $("#search_employee").attr("placeholder", "Enter Employee Code");
                break;		
            case 'aadhar': 
                $("#search_employee").attr("placeholder", "Enter Employee Adhaar Number");
                break;
            case 'pan': 
                $("#search_employee").attr("placeholder", "Enter Employee PAN Number");
                break;
            default:
                alert('No one filter by options is selected. Please select atleast one option.');
        }
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
