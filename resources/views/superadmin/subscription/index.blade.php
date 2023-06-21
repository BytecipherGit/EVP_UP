@extends('superadmin.layouts.app')
@section('content')
@section('title', 'EVP - Subscription')

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

    .subscription {
        border-radius: 12px !important;
    }
</style>

<div class="wapper">
    <!--- Main Container Start ----->
    <div class="main-container">
        <div class="main-heading">
            <div class="row">
                <div class="col-md-8">
                    <h1>Subscriptions</h1>
                </div>
                <div class="col-md-4">
                    <div class="main-right-button-box">
                        <a style="text-decoration:none" href="#" id="createSubscription"
                            class="mr-2 button_background_color"><img
                                src="{{ asset('assets') }}/admin/images/button-plus.png"><span
                                class="button_text_color">Subscription</span></a>
                        {{-- <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a> --}}
                    </div>
                </div>
                <div id="showHideAlert" class="col-md-8 alert alert-success" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong><span id="success_msg"></span> </strong>
                </div>
            </div>
        </div>
        <!--- Main Heading ----->

        <div class="employee-view-page">
            <div class="table-responsive-bg">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        <table class="table table-bordered subscription_datatable">
                            <thead class="primary_color">
                                <tr>
                                    <th class="secondary_color">Subscription Type</th>
                                    <th class="secondary_color">Duration</th>
                                    <th class="secondary_color">Price</th>
                                    <th class="secondary_color">Descriptions</th>
                                    <th class="secondary_color">Status</th>
                                    <th class="secondary_color">Action</th>
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
</div>

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="subscriptionModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="subscription_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Create Subscription</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/superadmin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div id="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Subscription
                        successfully created.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="" class="btn-primary-cust button_background_color"><span
                            class="button_text_color">Submit</span></button>
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
        var table = $('.subscription_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('subscription.index') }}",
            columns: [{
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
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
    function update_status(id, status) {
        var statusMsg = (status) ? "deactivate" : "activate";
        if (confirm('Are you sure you want to ' + statusMsg + '?')) {

            $.ajax({
                type: 'post',
                url: "{{ route('update_status') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'id=' + id + '&status=' + status,
                success: function(data) {

                    var status = data.status;
                    var msg = data.msg;
                    $('#success_msg').html(msg);
                    if (status == 'success') {
                        $("#showHideAlert").removeClass('alert-warning');
                        $("#showHideAlert").addClass('alert-success');

                        var page = window.location.hash.substr(1);
                        if (page) {
                            getData(page);
                        } else {
                            location.reload();
                        }
                    }
                    if (status == 'error') {
                        $("#showHideAlert").removeClass('alert-success');
                        $("#showHideAlert").addClass('alert-warning');
                    }
                    $("#showHideAlert").show();

                },
                'error': function(data) {
                    console.log(data);
                }
            });
        }


    }
</script>

<script>
    $(document).ready(function() {

        $("#subscription_form").validate({
            rules: {
                name: "required",
                description: "required",
            },
            messages: {
                name: "Title is required",
                description: "Descriptios is required",
            }
        });

        $("#createSubscription").click(function() {
            getSubscriptionCreateFrom();
        });

        $(document).on('click', '.updateSubscription', function() {
            if ($(this).attr('data-id') != '') {
                getSubscriptionCreateFrom($(this).attr('data-id'));
            }
        });

        function getSubscriptionCreateFrom(id = '') {
            let getFormUrl = '{{ url('admin/subscription/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create Subscription");
                } else {
                    $('#Heading').text("Update Subscription");
                }
                $('#subscriptionModel').find('.modal-body').html(data);
                $('#subscriptionModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
        $('#subscription_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('admin/subscription/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('admin/subscription/update') }}';
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
                        if (data.errors.name) {
                            $('#name-error').html(data.errors.name[0]);
                        }
                        if (data.errors.type) {
                            $('#type-error').html(data.errors.type[0]);
                        }
                        if (data.errors.price) {
                            $('#price-error').html(data.errors.price[0]);
                        }
                        if (data.errors.duration) {
                            $('#duration-error').html(data.errors.duration[0]);
                        }
                        if (data.errors.description) {
                            $('#description-error').html(data.errors.description[0]);
                        }
                        $('#loadingImg').hide();
                    } else {

                        if (data.success) {
                            $('#loadingImg').hide();
                            $('#name-error').html('');
                            $('#type-error').html('');
                            $('#price-error').html('');
                            $('#duration-error').html('');
                            $('#description-error').html('');
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

        $(document).on('click', '.deleteSubscription', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this subscription!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var subscriptionId = $(this).data('id');
                        if (subscriptionId != '') {
                            var url = '{{ url('admin/subscription/destroy') }}';
                            var my_data = {
                                subscriptionId: subscriptionId
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
                                        swal("Subscription successfully deleted.", {
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
                        swal("Your Subscription is safe!");
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    }
                });
        });
    });
</script>

@stop
