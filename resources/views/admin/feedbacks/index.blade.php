@extends('company/layouts.app')
@section('content')
@section('title', 'EVP - Feedbacks')
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
                <h1>Feedbacks</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a style="text-decoration:none" href="#" id="createFeedback" class="mr-2"><img src="{{ asset('assets') }}/admin/images/button-plus.png">Feedback</a>
                    {{-- <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <table class="table table-bordered feedback_datatable">
                        <thead>
                            <tr>
                                <th>Title</th>
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

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="feedbackModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="feedback_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Create Feedback</h2>
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
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Feedback
                        successfully created.</div>
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
        var table = $('.feedback_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('feedback.index') }}",
            columns: [{
                    data: 'title',
                    name: 'title'
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

        $("#feedback_form").validate({
            rules: {
                title: "required",
            },
            messages: {
                title: "Title is required",
            }
        });

        $("#createFeedback").click(function() {
            getFeedbackCreateFrom();
        });

        $(document).on('click', '.updateFeedback', function() {
            if ($(this).attr('data-id') != '') {
                getFeedbackCreateFrom($(this).attr('data-id'));
            }
        });

        function getFeedbackCreateFrom(id = '') {
            let getFormUrl = '{{ url('feedback/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create Feedback");
                } else {
                    $('#Heading').text("Update Feedback");
                }
                $('#feedbackModel').find('.modal-body').html(data);
                $('#feedbackModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
        $('#feedback_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('feedback/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('feedback/update') }}';
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
                        $('#loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('#loadingImg').hide();
                            $('#title-error').html('');
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

        $(document).on('click', '.deleteFeedback', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this feedbacks!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var feedbackId = $(this).data('id');
                        if (feedbackId != '') {
                            var url = '{{ url('feedback/destroy') }}';
                            var my_data = {
                                feedbackId: feedbackId
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
                                        swal("Feedback successfully deleted.", {
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
                        swal("Your feedback is safe!");
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    }
                });
        });
    });
</script>

@stop
