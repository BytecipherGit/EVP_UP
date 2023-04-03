@extends('company/layouts.app')
@section('content')
@section('title', 'EVP - Schedule For Interview')
<style>
    .disabled {
        pointer-events: none;
    }

    .verified {
        color: #5BD94E;
    }

    .not-verified {
        color: #ac2029;
    }

    label.error {
        color: #dc3545 !important;
        font-size: 14px;
    }
    .fa{
        font-size: 17px;
    }
</style>

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">



<!--- Main Container Start ----->
<div class="main-container">
    <div class="main-heading">
        <div class="row">
            <div class="col-md-8">
                <h1>Schedule for Interview</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a style="text-decoration:none" href="#" id="scheduleInterview" class="mr-2"><img
                            src="{{ asset('assets') }}/admin/images/button-plus.png">Interview</a>
                    {{-- <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            <div class="row">
                <div class="col-xs-4">
                    {{-- <label>Filter By Hiring Status</label>
                    @if ($hiringStages)
                        <select class="form-control" id="hStatus" name="hStatus">
                            @foreach ($hiringStages as $hiringStage)
                                <option class="dropdown-item" value="{{ $hiringStage->id }}"
                                    @if ($hiringStage->id == Request::get('hiringStatusId')) selected @endif>{{ $hiringStage->title }}
                                </option>
                            @endforeach
                        </select>
                    @endif --}}
                </div>
                <div class="col-xs-4">

                </div>
                {{-- <div class="col-xs-4">
                    <label>Filter By Employee Interview Response</label>
                    @if ($employeeInterviewStatuses)
                        <select class="form-control" id="eStatus" name="eStatus">
                            @foreach ($employeeInterviewStatuses as $employeeInterviewStatuse)
                                <option class="dropdown-item" value="{{ $employeeInterviewStatuse->id }}"
                                    @if ($employeeInterviewStatuse->id == Request::get('employeeStatusId')) selected="selected" @endif>
                                    {{ $employeeInterviewStatuse->title }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div> --}}
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <table id="example" class="table-bordered table">
                        <thead>
                            <tr>
                                <th>EVP Id</th>
                                <th>Name</th>
                                {{-- <th>Email</th> --}}
                                <th>Position</th>
                                <th>Employee Interview Response</th>
                                <th>Interview Type</th>
                                {{-- <th>Hiring Status</th> --}}
                                {{-- <th>Employee Status</th> --}}
                                {{-- <th>Employee Comment</th> --}}
                                <th>Send Remider</th>
                                <th width="250px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviewEmployees as $employee)
                                <tr>
                                    <td># {{ $employee->empCode }}</td>
                                    <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                                    {{-- <td>{{ $employee->email }}</td> --}}
                                    <td>{{ $employee->position }}</td>
                                    <td><span class="tb-accept"></span>
                                        @if ($employee->lastInterviewEmployeeRounds)
                                            {{ $employee->lastInterviewEmployeeRounds->employeeInterviewStatus->title }}
                                        @endif
                                    </td>
                                    <td><span class="tb-accept"></span>
                                        @if ($employee->lastInterviewEmployeeRounds)
                                            {{ $employee->lastInterviewEmployeeRounds->employeeInterviewProcess->title }}
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <select style="width: 150px;" class="form-control" name="hiring_stage"
                                            id="hiring_stage">
                                            @foreach ($hiringStages as $hiringStage)
                                                <option value="{{ $hiringStage->id }}"
                                                    @if ($hiringStage->id === $employee->interview_status) selected="selected" @endif
                                                    data-id="{{ $employee->id }}">{{ $hiringStage->title }}</option>
                                            @endforeach
                                        </select>
                                    </td> --}}
                                    {{-- <td>
                                        @foreach ($employeeInterviewStatuses as $employeeInterviewStatus)
                                            @if ($employeeInterviewStatus->id === $employee->employee_interview_status)
                                                <strong
                                                    style="color: #007bff">{{ $employeeInterviewStatus->title }}</strong>
                                            @endif
                                        @endforeach
                                    </td> --}}
                                    {{-- <td>{{ ($employee->interviewee_comment) ? $employee->interviewee_comment : '' }}</td> --}}
                                    <td>
                                        <span class="notifi-td" id="reminder_interview"
                                            data-id="{{ $employee->id }}"><img src="assets/admin/images/bell-icon.png"
                                                width="30px;" height="30px"></span>
                                    </td>
                                    <td>
                                        {{-- <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img
                                                src="assets/admin/images/bell-icon.png" width="30px;"
                                                height="30px"></span> --}}
                                        <a href="{{route('interview.round.details')}}/{{ $employee->id }}" class="edit-btn fa fa-eye"
                                        data-id="{{ $employee->id }}" data-title="Details"></a>
                                        <a href="#" class="edit-btn fa fa-arrow-circle-right" id="updateInterview"
                                            data-id="{{ $employee->id }}" data-title="Next Round"></a>
                                        <a href="#" class="edit-btn fa fa-trash " id="delete_interview"
                                            data-id="{{ $employee->id }}" data-title="Delete"></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--- Employeer View Page ----->

</div>
<!--- Main Container Close ----->

<!-- The Modal Delete INFO -->
<div class="modal fade custu-no-select" id="deletebtninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="assets/admin/images/deactivate-popup-icon.png" class="img-size-wth">
                <h1 class="h1-delete">Are you sure?</h1>
                <p>Are you Really want to Delete this account.</p>
                <a href="#" data-dismiss="modal" class="cancel-btn">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Remaider Notification -->
<div class="modal fade schedu-modal" id="scheduleInterviewModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="schedhead">Send reminder to complete registration.</h1>
                <p class="sheddpare">Your invitation or last reminder was sent 4 days ago</p>
                <div class="bottom-part">
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-primary-cust">Send remainder</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Remaider Notification -->
<div class="modal fade schedu-modal" id="rejectbtninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="schedhead">Reject Candidate</h1>
                <p class="sheddpare">Do you want to sent a rejection email to this candidate?</p>
                <div class="bottom-part">
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">No</button>
                    <a href="rejected-email" class="link-href" target="_black"><button type="button"
                            class="btn-primary-cust">Yes</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="interviewModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="schedule_interview_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Schedule Interview</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Schedule
                        interview successfully done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="scheduleInterviewSubmit" class="btn-primary-cust">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="updateInterviewModel" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="next_round_of_interview_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Schedule Next Round Of Interview</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Next interview
                        round successfully done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="nextRoundOfInterviewSubmit" class="btn-primary-cust">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('pagescript')
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true,
            pagination: false
        });
        new $.fn.dataTable.FixedHeader(table);
    });
</script>




<script>
    $(".selectBox").on("click", function(e) {
        $(this).toggleClass("show");
        var dropdownItem = e.target;
        var container = $(this).find(".selectBox__value");
        container.text(dropdownItem.text);
        $(dropdownItem)
            .addClass("active")
            .siblings()
            .removeClass("active");
    });
</script>


<script>
    $(document).ready(function() {
        $(".with-color-bg").click(function() {
            if ($(this).hasClass("dective-btn-bg")) {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
            } else {
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
            }
        });

        $(".pushme-Acp").click(function() {
            $(this).text(function(i, v) {
                return v === 'Accepted' ? 'Declied' : 'Accepted'
            });
        });

        $("#schedule_interview_form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email: "required",
                position: "required",
                interview_process: "required",
                interviewer_id: "required",
                interview_date: "required",
                interview_start_time: "required",
                duration: "required",
                interview_instruction: "required",
                attachment: "required",
            },
            messages: {
                first_name: "First name is required",
                last_name: "Last name is required",
                email: "Email is required",
                position: "Position number is required",
                interview_process: "required",
                interviewer_id: "required",
                interview_date: "Interview date is required",
                interview_start_time: "Interview start time is required",
                duration: "Interview end time is required",
                interview_instruction: "Message is required",
                attachment: "Attachment is required",
            }
        });

        $("#scheduleInterview").click(function() {
            getScheduleInterviewForm();
        });

        function getScheduleInterviewForm(id = '') {
            let getFormUrl = '{{ url('schedule-interview/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Schedule Interivew");
                } else {
                    $('#Heading').text("Update Schedule Interivew");
                }
                $('#interviewModel').find('.modal-body').html(data);
                $('#interviewModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
        $('#schedule_interview_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('schedule-interview/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('schedule-interview/update') }}';
                successMsg = "Successfully Updated";
            }
            $('.loadingImg').show();
            var formData = new FormData(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errors) {
                        if (data.errors.first_name) {
                            $('#first_name-error').html(data.errors.first_name[0]);
                        }
                        if (data.errors.last_name) {
                            $('#last_name-error').html(data.errors.last_name[0]);
                        }
                        if (data.errors.email) {
                            $('#email-error').html(data.errors.email[0]);
                        }
                        if (data.errors.position) {
                            $('#position-error').html(data.errors.position[0]);
                        }
                        if (data.errors.interview_process) {
                            $('#interview_process-error').html(data.errors
                                .interview_process[0]);
                        }
                        if (data.errors.interviewer_id) {
                            $('#interviewer_id-error').html(data.errors.interviewer_id[0]);
                        }
                        if (data.errors.interview_date) {
                            $('#interview_date-error').html(data.errors.interview_date[0]);
                        }
                        if (data.errors.interview_start_time) {
                            $('#interview_start_time-error').html(data.errors
                                .interview_start_time[0]);
                        }
                        if (data.errors.duration) {
                            $('#duration-error').html(data.errors
                                .duration[0]);
                        }
                        if (data.errors.video_link) {
                            $('#video_link-error').html(data.errors.video_link[0]);
                        }
                        if (data.errors.phone) {
                            $('#phone-error').html(data.errors.phone[0]);
                        }
                        if (data.errors.interview_instruction) {
                            $('#interview_instruction-error').html(data.errors
                                .interview_instruction[0]);
                        }
                        if (data.errors.attachment) {
                            $('#attachment-error').html(data.errors.attachment[0]);
                        }
                        $('.loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('.loadingImg').hide();
                            $('#first_name-error').html('');
                            $('#last_name-error').html('');
                            $('#email-error').html('');
                            $('#position-error').html('');
                            $('#interview_date-error').html('');
                            $('#interview_start_time-error').html('');
                            $('#duration-error').html('');
                            $('#video_link-error').html('');
                            $('#phone-error').html('');
                            $('#interview_instruction-error').html('');
                            $('#attachment-error').html('');
                            // $('#schedule_interview_form')[0].reset();
                            // $('#interviewModel').modal('hide');
                            $('#success').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);

                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });
        $(document).on('change', '#hiring_stage', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to change the status of this interview!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var stageId = $(this).val();
                        var interviewId = $('option:selected', this).data('id');
                        if (stageId != '' && interviewId != '') {
                            var url = '{{ url('schedule-interview/changeHiringStage') }}';
                            var my_data = {
                                stageId: stageId,
                                interviewId: interviewId
                            };
                            $.ajax({
                                url: url,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: my_data,
                                success: function(data) {
                                    if (data.success) {
                                        swal("Interview status has been updated.", {
                                            icon: "success",
                                        });
                                        location.reload();
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        swal("Your data is safe!");
                        location.reload();
                    }
                });
        });
        $(document).on('click', '#delete_interview', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this interview!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var interviewId = $(this).data('id');
                        if (interviewId != '') {
                            var url = '{{ url('schedule-interview/deleteInterview') }}';
                            var my_data = {
                                interviewId: interviewId
                            };
                            $.ajax({
                                url: url,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: my_data,
                                success: function(data) {
                                    if (data.success) {
                                        swal("Interview successfully deleted.", {
                                            icon: "success",
                                        });
                                        location.reload();
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        swal("Your data is safe!");
                        location.reload();
                    }
                });
        });
        $(document).on('change', '#hStatus', function() {
            // Handle the change event
            var hiringStatusId = $(this).val();
            if (hiringStatusId != '') {
                /*var employeeStatusId = $('#eStatus').val();
                if(employeeStatusId != ''){
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId+'&employeeStatusId='+employeeStatusId;
                    window.location.href = url;
                } else {
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId;
                    window.location.href = url;
                }*/
                var url = '{{ url('schedule-interview?hiringStatusId=') }}' + hiringStatusId;
                window.location.href = url;
            }
        });

        $(document).on('change', '#eStatus', function() {
            // Handle the change event
            var employeeStatusId = $(this).val();
            if (employeeStatusId != '') {
                /*var hiringStatusId = $('#hStatus').val();
                if(hiringStatusId != ''){
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId+'&employeeStatusId='+employeeStatusId;
                    window.location.href = url;
                } else {
                    var url = '{{ url('schedule-interview?employeeStatusId=') }}'+employeeStatusId;
                    window.location.href = url;
                }*/
                var url = '{{ url('schedule-interview?employeeStatusId=') }}' + employeeStatusId;
                window.location.href = url;
            }
        });

        $(document).on('click', '#reminder_interview', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to send remider to employee for this interview!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var interviewId = $(this).data('id');
                        if (interviewId != '') {
                            var url = '{{ url('schedule-interview/sendReminderForInterview') }}';
                            var my_data = {
                                interviewId: interviewId
                            };
                            $.ajax({
                                url: url,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: my_data,
                                success: function(data) {
                                    if (data.success) {
                                        swal("Interview reminder successfully sent.", {
                                            icon: "success",
                                        });
                                        location.reload();
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        swal("Interview reminder not sent!");
                        location.reload();
                    }
                });
        });

        $(document).on('click', '#updateInterview', function() {
            // getScheduleInterviewForm();
            var interviewId = $(this).data('id');
            if (interviewId != '') {
                getNextRoundOfInterviewForm(interviewId);
            }
        })

        function getNextRoundOfInterviewForm(id = '') {
            let getFormUrl = '{{ url('next_round_of_interview/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create next round of interivew");
                } else {
                    $('#Heading').text("Update next round of interview");
                }
                $('#updateInterviewModel').find('.modal-body').html(data);
                $('#updateInterviewModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

        $("#next_round_of_interview_form").validate({
            rules: {
                interview_process: "required",
                interviewer_id: "required",
                interview_date: "required",
                interview_start_time: "required",
                duration: "required",
                interview_instruction: "required",
            },
            messages: {
                interview_process: "required",
                interviewer_id: "required",
                interview_date: "Interview date is required",
                interview_start_time: "Interview start time is required",
                duration: "Interview end time is required",
                interview_instruction: "Message is required",
            }
        });

        // $('#next_round_of_interview_form').on('submit', function(event) {
        $(document).on('submit', '#next_round_of_interview_form', function(event) {
            event.preventDefault();
            var url = '{{ url('next_round_of_interview/submit') }}';
            var successMsg = "Next round of interview successfully created";
            $('.loadingImg').show();
            var formData = new FormData(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errors) {
                        if (data.errors.interview_process) {
                            $('#interview_process-error').html(data.errors
                                .interview_process[0]);
                        }
                        if (data.errors.interviewer_id) {
                            $('#interviewer_id-error').html(data.errors.interviewer_id[0]);
                        }
                        if (data.errors.interview_date) {
                            $('#interview_date-error').html(data.errors.interview_date[0]);
                        }
                        if (data.errors.interview_start_time) {
                            $('#interview_start_time-error').html(data.errors
                                .interview_start_time[0]);
                        }
                        if (data.errors.duration) {
                            $('#duration-error').html(data.errors
                                .duration[0]);
                        }
                        if (data.errors.video_link) {
                            $('#video_link-error').html(data.errors.video_link[0]);
                        }
                        if (data.errors.phone) {
                            $('#phone-error').html(data.errors.phone[0]);
                        }
                        if (data.errors.interview_instruction) {
                            $('#interview_instruction-error').html(data.errors
                                .interview_instruction[0]);
                        }
                        $('.loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('.loadingImg').hide();
                            $('#interview_date-error').html('');
                            $('#interview_start_time-error').html('');
                            $('#duration-error').html('');
                            $('#video_link-error').html('');
                            $('#phone-error').html('');
                            $('#interview_instruction-error').html('');
                            // $('#schedule_interview_form')[0].reset();
                            // $('#interviewModel').modal('hide');
                            $('#success').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);

                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>

@stop
