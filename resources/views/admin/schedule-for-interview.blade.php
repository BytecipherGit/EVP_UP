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
                    {{-- <a href="#" data-toggle="modal" data-target="#interviewModel" class="mr-2">Interview</a> --}}
                    <a style="text-decoration:none" href="#" id="scheduleInterview" class="mr-2">Interview</a>
                    <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a>
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            <div class="table-effect-box">
                {{-- <div class="table-search-box">
                    <input type="search" name="" placeholder="Search Candidate"
                        class="form-control input-search-box">
                </div> --}}
                {{-- <span class="ml-auto d-flex">
                    <div class="select-bx">
                        <h2>
                            <div class="selectBox selectBox-boder">
                                <div class="selectBox__value">Stage...</div>
                                <div class="dropdown-menu" id="style-5">
                                    <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invited For
                                        Interview</a>
                                    <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Interviewed</a>
                                    <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invitation To
                                        Complete Machine Task</a>
                                    <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Machine Task
                                        Completed </a>
                                    <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Feedback & Hr
                                        Policies Shared</a>
                                    <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Offer Sent </a>
                                    <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Offer Decline </a>
                                    <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Withdrew
                                    </a>
                                    <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate
                                        Unresponsive </a>
                                    <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Rejected </a>
                                    <a class="dropdown-item"><span class="spn-cricle hrd_bg"></span>Hired </a>
                                </div>
                            </div>
                        </h2>
                    </div>
                    <div class="select-bx selectBox-statu-boder">
                        <h2>
                            <div class="selectBox">
                                <div class="selectBox__value">Status</div>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item">Accepted</a>
                                    <a class="dropdown-item ">Declied</a>
                                    <a class="dropdown-item ">Joined</a>
                                </div>
                            </div>
                        </h2>
                    </div>
                    <div class="select-bx">
                        <h2><span>Show</span>
                            <div class="selectBox">
                                <div class="selectBox__value">10</div>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item active">10</a>
                                    <a class="dropdown-item ">25</a>
                                    <a class="dropdown-item ">50</a>
                                    <a class="dropdown-item ">100</a>
                                </div>
                            </div>
                        </h2>
                    </div>
                </span> --}}
            </div>
            <table id="example" class="table-bordered table">
                <thead>
                    <tr>
                        <th>EVP Id</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Candidate Rating</th>
                        <th>Offer Status</th>
                        <th>Hiring Stage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interviewEmployees as $employee)
                        <tr>
                            <td>#{{ $employee->empCode }}</td>
                            <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                            <td>{{ $employee->designation }}</td>
                            <td>
                                {{ ($employee->rating) ? $employee->rating : '-' }}
                                {{-- <fieldset class="rating ">
                            <input type="radio" id="textiles-star51" name="textiles-rating1" value="5">
                            <label class="full" for="textiles-star51"></label>
                            <input type="radio" id="textiles-star4half1" name="textiles-rating1"
                                value="4 and a half">
                            <label class="half" for="textiles-star4half1"></label>

                            <input type="radio" id="textiles-star41" name="textiles-rating1" value="4"
                                checked="">
                            <label class="full" for="textiles-star41"></label>
                            <input type="radio" id="textiles-star3half1" name="textiles-rating1"
                                value="3 and a half">
                            <label class="half" for="textiles-star3half1"></label>

                            <input type="radio" id="textiles-star31" name="textiles-rating1" value="3">
                            <label class="full" for="textiles-star31"></label>
                            <input type="radio" id="textiles-star2half1" name="textiles-rating1"
                                value="2 and a half">
                            <label class="half" for="textiles-star2half1"></label>

                            <input type="radio" id="textiles-star21" name="textiles-rating1" value="2">
                            <label class="full" for="textiles-star21"></label>
                            <input type="radio" id="textiles-star1half1" name="textiles-rating"
                                value="1 and a half">
                            <label class="half" for="textiles-star1half1"></label>

                            <input type="radio" id="textiles-star11" name="textiles-rating1" value="1">
                            <label class="full" for="textiles-star11"></label>
                            <input type="radio" id="textiles-starhalf1" name="textiles-rating1"
                                value="half">
                            <label class="half" for="textiles-starhalf1"></label>
                        </fieldset> --}}
                            </td>
                            <td><span class="tb-accept"></span> {{ $employee->offer_status }}</td>
                            <td>
                                {{ $employee->interview_status }}
                                {{-- <div class="selectBox">
                            <div class="selectBox__value">Select Stage</div>
                            <div class="dropdown-menu" id="style-5">
                                <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invited For
                                    Interview</a>
                                <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Interviewed</a>
                                <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invitation To
                                    Complete Machine Task</a>
                                <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Machine Task
                                    Completed </a>
                                <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Feedback & Hr
                                    Policies Shared</a>
                                <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Offer Sent </a>
                                <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Offer Decline </a>
                                <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Withdrew
                                </a>
                                <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate
                                    Unresponsive </a>
                                <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Rejected </a>
                                <a class="dropdown-item"><span class="spn-cricle hrd_bg"></span>Hired </a>
                            </div>
                        </div> --}}
                            </td>
                            <td>
                                <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img
                                        src="assets/admin/images/bell-icon.png" width="30px;" height="30px"></span>
                                <a href="#" class="edit-btn" data-toggle="modal"
                                    data-target="#deletebtninfo">Delete</a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{-- <div class="pagination-main d-flex">
                <h2>Showing 1 to 7 of 20 entries</h2>
                <div class="pagination ml-auto">
                    <ul>
                        <!--pages or li are comes from javascript -->
                    </ul>
                </div>
            </div> --}}
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
            <div class="modal-content" style="width:559px !important">
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
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="scheduleInterviewSubmit" class="btn-primary-cust">Schedule</button>
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
{{-- <script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script> --}}
<script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>

<script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>

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
                        if (data.errors.designation) {
                            $('#designation-error').html(data.errors.designation[0]);
                        }
                        if (data.errors.interview_date) {
                            $('#interview_date-error').html(data.errors.interview_date[0]);
                        }
                        if (data.errors.interview_start_time) {
                            $('#interview_start_time-error').html(data.errors
                                .interview_start_time[0]);
                        }
                        if (data.errors.interview_end_time) {
                            $('#interview_end_time-error').html(data.errors
                                .interview_end_time[0]);
                        }
                        if (data.errors.video_link) {
                            $('#video_link-error').html(data.errors.video_link[0]);
                        }
                        if (data.errors.phone) {
                            $('#phone-error').html(data.errors.phone[0]);
                        }
                        if (data.errors.message) {
                            $('#message-error').html(data.errors.message[0]);
                        }
                        if (data.errors.attachment) {
                            $('#attachment-error').html(data.errors.attachment[0]);
                        }
                        // $('#loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('#first_name-error').html('');
                            $('#last_name-error').html('');
                            $('#designation-error').html('');
                            $('#interview_date-error').html('');

                            $('#interview_start_time-error').html('');
                            $('#interview_end_time-error').html('');
                            $('#video_link-error').html('');
                            $('#phone-error').html('');
                            $('#message-error').html('');
                            $('#attachment-error').html('');

                            $('#schedule_interview_form')[0].reset();
                            $('#interviewModel').modal('hide');
                            location.reload();
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
