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
                <h1>Employee interview rounds details</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a href="/schedule-interview"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
              </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            <div class="row">    
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <table id="example" class="table-bordered table">
                        <thead>
                            <tr>
                                <th>Round</th>
                                <th>Interview Type</th>
                                <th>Interview Date</th>
                                <th>Interview Time</th>
                                <th>Duration</th>
                                {{-- <th>Description</th> --}}
                                <th>Status</th>
                                <th width="250px">Feedback Details</th>
                            </tr>
                        </thead>
                        @if ($interviewEmpoloyeeRounds)
                        @php $counter = 1 @endphp
                            @foreach ($interviewEmpoloyeeRounds as $interviewEmpoloyeeRound)
                                <tr>
                                    <th scope="row">{{ $counter }}</th>
                                    <td>{{ $interviewEmpoloyeeRound->title}}</td>
                                    <td>{{ $interviewEmpoloyeeRound->interview_date}}</td>
                                    <td>{{ $interviewEmpoloyeeRound->interview_start_time}}</td>
                                    <td>{{ $interviewEmpoloyeeRound->duration}}</td>
                                   <td>
                                    <select style="width: 150px;" class="form-control" name="interviewer_status"
                                        id="interviewer_status">
                                            <option value="Qualified"
                                                @if ($interviewEmpoloyeeRound->interviewer_status == 'Qualified') selected="selected" @endif
                                                data-id="{{ $interviewEmpoloyeeRound->id}}">Qualified</option>
                                            <option value="Not Qualified"
                                                @if ($interviewEmpoloyeeRound->interviewer_status == 'Not Qualified') selected="selected" @endif
                                               data-id="{{ $interviewEmpoloyeeRound->id }}">Not Qualified</option>
                                            <option value="Not Appeared"
                                                 @if ($interviewEmpoloyeeRound->interviewer_status == 'Not Appeared') selected="selected" @endif
                                                data-id="{{ $interviewEmpoloyeeRound->id }}">Not Appeared</option>

                                    </select>
                                </td> 
                                    <td>
                                        <a href="#" class="edit-btn" id="viewInterview"
                                        data-id="{{ $interviewEmpoloyeeRound->id }}" data-title="Details">Feedback</a>
                                    </td>
                                </tr>
                                @php $counter++ @endphp
                            @endforeach    
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--- Employeer View Page ----->

</div>
<!--- Main Container Close ----->

<div class="modal fade custu-modal-popup" id="viewInterviewModel" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update_interview_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Employee interview feedback details</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <div id="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Next interview
                        round successfully done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="nextRoundOfInterviewSubmit" class="btn-primary-cust">Submit</button> --}}
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
        $(document).on('change', '#interviewer_status', function() {
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
                        var status = $(this).val();
                        var interviewId = $('option:selected', this).data('id');
                        if (status != '' && interviewId != '') {
                            var url = '{{ url('schedule-interview/changeInterviewerStatus') }}';
                            var my_data = {
                                status: status,
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

        $(document).on('click', '#viewInterview', function() {
            // getScheduleInterviewForm();
            var interviewId = $(this).data('id');
            if (interviewId != '') {
                getInterviewDetailsForm(interviewId);
            }
        });

        function getInterviewDetailsForm(id = '') {
            let getFormUrl = '{{ url('get_interview_details/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Employee feedback details");
                } else {
                    $('#Heading').text("Employee feedback details");
                }
                $('#viewInterviewModel').find('.modal-body').html(data);
                $('#viewInterviewModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    });
</script>

@stop
