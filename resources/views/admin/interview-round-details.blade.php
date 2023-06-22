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
                    <a href="/schedule_interview" class="button_background_color"><img
                            src="{{ asset('assets') }}/admin/images/back-icon.png"><span class="button_text_color">
                            Back</span></a>
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
                        <thead class="primary_color">
                            <tr>
                                <th class="secondary_color">Round</th>
                                <th class="secondary_color">Interview Type</th>
                                <th class="secondary_color">Interview Date</th>
                                <th class="secondary_color">Interview Time</th>
                                <th class="secondary_color">Duration</th>
                                {{-- <th>Description</th> --}}
                                <th class="secondary_color">Status</th>
                                <th width="250px" class="secondary_color">Feedback Details</th>
                            </tr>
                        </thead>
                        @if ($interviewEmpoloyeeRounds)
                            @php $counter = 1 @endphp
                            @foreach ($interviewEmpoloyeeRounds as $interviewEmpoloyeeRound)
                                <input type="hidden" name="id" value="{{ $interviewEmpoloyeeRound->id }}">
                                <tr>
                                    <th scope="row">{{ $counter }}</th>
                                    <td>{{ $interviewEmpoloyeeRound->title }}</td>
                                    <td>{{ $interviewEmpoloyeeRound->interview_date }}</td>
                                    <td>{{ $interviewEmpoloyeeRound->interview_start_time }}</td>
                                    <td>{{ $interviewEmpoloyeeRound->duration }}</td>
                                    <td>
                                        {{-- <select style="width: 150px;" class="form-control" name="interviewer_status" 
                                        id="interviewer_status"> --}}
                                        <select style="width: 150px;" class="form-control interviewer"
                                            name="interviewer_status"
                                            id="interviewer_status{{ $interviewEmpoloyeeRound->id }}"
                                            style="text-decoration:none" href="#">
                                            <option value="Qualified"
                                                @if ($interviewEmpoloyeeRound->interviewer_status == 'Qualified') selected="selected" @endif
                                                data-id="{{ $interviewEmpoloyeeRound->id }}">Qualified</option>
                                            <option value="Not Qualified"
                                                @if ($interviewEmpoloyeeRound->interviewer_status == 'Not Qualified') selected="selected" @endif
                                                data-id="{{ $interviewEmpoloyeeRound->id }}">Not Qualified</option>
                                            <option value="Not Appeared"
                                                @if ($interviewEmpoloyeeRound->interviewer_status == 'Not Appeared') selected="selected" @endif
                                                data-id="{{ $interviewEmpoloyeeRound->id }}">Not Appeared</option>

                                        </select>
                                        {{-- <a href="" class="edit-btn fa fa-trash" data-toggle="modal"
                                    data-target="#deletebtninfo{{ $invite->id }}" title="Delete"></a> --}}
                                    </td>
                                    <td>
                                        <a href="#" class="edit-btn fa fa-comments-o" id="viewInterview"
                                            data-id="{{ $interviewEmpoloyeeRound->id }}" title="Feedback"
                                            style="font-size:18px"></a>
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

<!-- The Modal Interview  -->

<div class="modal fade custu-modal-popup" id="emailtemplate" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="send_email_to_employee" method="post" autocomplete="off" enctype="multipart/form-data">
            {{-- <input type="hidden" id="interview_status" value="{{ $interviewStatus }}"> --}}
            {{-- <input type="hidden" value="{{$interviewEmpoloyee->interviewer_status}}" name="interviewer_status"> --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-titles" id="Heading"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Status update
                        successfully</div>
                    <button type="button" class="btn-secondary-cust" onclick="refreshPage();"data-dismiss="modal">Cancel</button>
                    <button type="submit" id="Submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Submit</span></button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="notAppeared" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add_not_appeared" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-titles" id="Heading">Create not appeared</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="successs">Status update
                        successfully</div>
                    <button type="button" class="btn-secondary-cust" onclick="refreshPage();"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" id="Submit" class="btn-primary-cust button_background_color"><span
                            class="button_text_color">Submit</span></button>
                </div>
            </div>
        </form>
    </div>
</div>



<!--- Main Container Close ----->

<div class="modal fade custu-modal-popup" id="viewFeedbackModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title textColor" id="Heading">Employee interview feedback details</h2>
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
    function refreshPage() {
        window.location.reload();
    }
</script>

<script>
    $(document).on('change', '.interviewer', function() {
        var interviewId = $('option:selected', this).data('id');
        var interviewerstatus = $('#interviewer_status' + interviewId).find(":selected").val();
        getEmployeeTemplateConfirmation(interviewerstatus, interviewId);
    });


    function getEmployeeTemplateConfirmation(interviewerstatus = '', interviewId = '') {
        if (interviewerstatus === 'Not Appeared') {
            let getFormUrl = '{{ url('not_appeared/form') }}';
            if (getFormUrl !== '') {
                getFormUrl = getFormUrl + "?interview_status=" + interviewerstatus + "&interview_id=" + interviewId;
            }

            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",

            }).done(function(data) {
                if (interviewerstatus === '', interviewId === '') {
                    $('#Heading').text("Not appeared");
                } else {
                    $('#Heading').text("Not appeared");
                }
                $('#notAppeared').find('.modal-body').html(data);
                $('#notAppeared').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });

            $('#add_not_appeared').on('submit', function(event) {
                event.preventDefault();
                var isAdd = $('#is_add').val();
                var url = '{{ url('send_not_appeared') }}';
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
                        if (data.success) {
                            $('.loadingImg').hide();
                            $('#successs').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);

                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }

                });

            });

        } else {

            let getFormUrl = '{{ url('email_template/form') }}';
            if (getFormUrl !== '') {
                getFormUrl = getFormUrl + "?interview_status=" + interviewerstatus + "&interview_id=" + interviewId;
            }

            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",

            }).done(function(data, appeared) {
                if (interviewerstatus === '', interviewId === '') {
                    $('#Heading').text("Employee interview status");
                } else {
                    $('#Heading').text("Employee interview final status");
                }
                $('#emailtemplate').find('.modal-body').html(data);
                $('#emailtemplate').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    }
    $('#send_email_to_employee').on('submit', function(event) {
        event.preventDefault();
        var isAdd = $('#is_add').val();
        var url = '{{ url('send_email_template') }}'
        var formData = new FormData(this);
        $('.loadingImg').show();
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
                        if (data.success) {
                            $('.loadingImg').hide();
                            $('#success').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);

                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }

                });

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





        // $(document).on('click', '#send_email_template', function() {
        //     swal({
        //             title: "Are you sure?",
        //             text: "You want to send email for this!",
        //             icon: "warning",
        //             buttons: true,
        //             dangerMode: true, 
        //         })
        //         .then((result) => {
        //             if (result) {
        //                 // Handle the change event
        //                 var status = $(this).val();
        //                 var interviewId = $('option:selected', this).data('id');
        //                 if (status != '' && interviewId != '') {
        //                     var url = '{{ url('send_email_template') }}';
        //                     var my_data = {
        //                         status: status,
        //                         interviewId: interviewId
        //                     };
        //                     $.ajax({
        //                         url: url,
        //                         type: 'POST',
        //                         headers: {
        //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
        //                                 'content')
        //                         },
        //                         data: my_data,
        //                         success: function(data) {
        //                             if (data.success) {
        //                                 swal("Interview status has been updated.", {
        //                                     icon: "success",
        //                                 });
        //                                 location.reload();
        //                             }
        //                         },
        //                         error: function(xhr, textStatus, errorThrown) {
        //                             console.log(xhr.responseText);
        //                         }
        //                     });
        //                 }
        //             } else {
        //                 swal("Your data is safe!");
        //                 location.reload();
        //             }
        //         });
        // });

        $(document).on('click', '#viewInterview', function() {
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
                $('#viewFeedbackModel').find('.modal-body').html(data);
                $('#viewFeedbackModel').modal({
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
