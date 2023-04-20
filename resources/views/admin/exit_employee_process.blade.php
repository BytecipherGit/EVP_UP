@extends('company/layouts.app')
@section('content')
@section('title', 'EVP - Exit employee process')

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
                <h1>Exit Employee Process</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a style="text-decoration:none" href="#" id="createProcess" class="mr-2"><img src="{{ asset('assets') }}/admin/images/button-plus.png">Exit Employee Process</a>
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
                    <table class="table table-bordered exit_employee_process_datatable">
                        <thead class="primacyBackgrondColor">
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

<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="exitemployeeModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="exit_employee_process_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Create Exit Employee Process</h2>
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
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Exit employee process
                        successfully done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="ProcessSubmit" class="btn-primary-cust">Submit</button>
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
        var table = $('.exit_employee_process_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('exitemployee.process.index') }}",
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

        $("#exit_employee_process_form").validate({
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
            getExitEmployeeProcessCreateForm();
        });

        $(document).on('click', '.updateProcess', function() {
            if ($(this).attr('data-id') != '') {
                getExitEmployeeProcessCreateForm($(this).attr('data-id'));
            }
        });

        function getExitEmployeeProcessCreateForm(id = '') {
            let getFormUrl = '{{ url('exit_employee_process/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create Exit Employee Process");
                } else {
                    $('#Heading').text("Update Exit Employee Process");
                }
                $('#exitemployeeModel').find('.modal-body').html(data);
                $('#exitemployeeModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
        $('#exit_employee_process_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('exit_employee_process/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('exit_employee_process/update') }}';
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
                    text: "You want to delete this exit employee process!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var employeeId = $(this).data('id');
                        if (employeeId != '') {
                            var url = '{{ url('exit_employee_process/destroy') }}';
                            var my_data = {
                                employeeId: employeeId
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
                                        swal("Exit employee process successfully deleted.", {
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
                        swal("Your exit employee process is safe!");
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    }
                });
        });

    });
</script>

@stop
