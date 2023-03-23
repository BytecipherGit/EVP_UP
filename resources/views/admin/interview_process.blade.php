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
                <h1>Interview Process</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a style="text-decoration:none" href="#" id="createProcess" class="mr-2">Create Process</a>
                    {{-- <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            {{-- <div class="row">
                <div class="col-xs-4">
                    <label>Filter By Hiring Status</label>
                    @if ($hiringStages)
                        <select class="form-control" id="hStatus" name="hStatus">
                            @foreach ($hiringStages as $hiringStage)
                                <option class="dropdown-item" value="{{ $hiringStage->id }}"
                                    @if ($hiringStage->id == Request::get('hiringStatusId')) selected @endif>{{ $hiringStage->title }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-xs-4">

                </div>
                <div class="col-xs-4">
                    <label>Filter By Employee Status</label>
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
                </div>
            </div> --}}
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <table class="table table-bordered interview_process_datatable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Descriptions</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--- Employeer View Page ----->

</div>
<!--- Main Container Close ----->

<!-- The Modal Delete INFO -->
{{-- <div class="modal fade custu-no-select" id="deletebtninfo" role="dialog" aria-labelledby="exampleModalLabel"
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
</div> --}}

<!-- The Modal Remaider Notification -->
{{-- <div class="modal fade schedu-modal" id="scheduleInterviewModel" role="dialog" aria-labelledby="exampleModalLabel"
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
</div> --}}

<!-- The Modal Remaider Notification -->
{{-- <div class="modal fade schedu-modal" id="rejectbtninfo" role="dialog" aria-labelledby="exampleModalLabel"
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
</div> --}}

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="interviewModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="interview_process_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Create Interview Process</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div id="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Interview process
                        successfully done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="interviewProcessSubmit" class="btn-primary-cust">Submit</button>
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
<script type="text/javascript">
    $(function() {
        var table = $('.interview_process_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('interview.process.index') }}",
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'descriptions',
                    name: 'descriptions'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>




<script>
    $(document).ready(function() {

        $("#interview_process_form").validate({
            rules: {
                title: "required",
                descriptions: "required",
            },
            messages: {
                title: "Title is required",
                descriptions: "Descriptios is required",
            }
        });

        $("#createProcess").click(function() {
            getInterviewProcessCreateForm();
        });

        $(document).on('click', '.updateProcess', function() {
            if ($(this).attr('data-id') != '') {
                getInterviewProcessCreateForm($(this).attr('data-id'));
            }
        });

        function getInterviewProcessCreateForm(id = '') {
            let getFormUrl = '{{ url('interview_process/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create Interview Process");
                } else {
                    $('#Heading').text("Update Interview Process");
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
        $('#interview_process_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('interview_process/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('interview_process/update') }}';
                successMsg = "Successfully Updated";
            }
            $('#loadingImg').show();
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
                            $('#title-error').html(data.errors.title[0]);
                        }
                        if (data.errors.descriptions) {
                            $('#descriptions-error').html(data.errors.descriptions[0]);
                        }
                        $('#loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('#loadingImg').hide();
                            $('#title-error').html('');
                            $('#descriptions-error').html('');
                            // $('#interview_process_form')[0].reset();
                            // $('#interviewModel').modal('hide');
                            $('#success').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 2000);

                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.deleteProcess', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this interview process!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var interviewId = $(this).data('id');
                        if (interviewId != '') {
                            var url = '{{ url('interview_process/destroy') }}';
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
                                        swal("Interview process successfully deleted.", {
                                            icon: "success",
                                        });
                                        setInterval(function() {
                                            location.reload();
                                        }, 2000);
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        swal("Your interview process is safe!");
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    }
                });
        });


        /*$(document).on('change', '#hiring_stage', function() {
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
                var employeeStatusId = $('#eStatus').val();
                if(employeeStatusId != ''){
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId+'&employeeStatusId='+employeeStatusId;
                    window.location.href = url;
                } else {
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId;
                    window.location.href = url;
                }
                var url = '{{ url('schedule-interview?hiringStatusId=') }}' + hiringStatusId;
                window.location.href = url;
            }
        });
        $(document).on('change', '#eStatus', function() {
            // Handle the change event
            var employeeStatusId = $(this).val();
            if (employeeStatusId != '') {
                var hiringStatusId = $('#hStatus').val();
                if(hiringStatusId != ''){
                    var url = '{{ url('schedule-interview?hiringStatusId=') }}'+hiringStatusId+'&employeeStatusId='+employeeStatusId;
                    window.location.href = url;
                } else {
                    var url = '{{ url('schedule-interview?employeeStatusId=') }}'+employeeStatusId;
                    window.location.href = url;
                }
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
        });*/

    });
</script>

@stop
