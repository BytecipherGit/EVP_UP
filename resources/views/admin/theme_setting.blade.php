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

    .dropdown-menu {
    position: absolute !important;
    top: auto;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: auto !important;
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
                <h1>Theme Settings</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    {{-- <a style="text-decoration:none" href="#" id="createProcess" class="mr-2"><img src="{{ asset('assets') }}/admin/images/button-plus.png">Interview Process</a> --}}
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
                    <table class="table table-bordered theme_setting_datatable">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
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
<div class="modal fade custu-modal-popup" id="interviewModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="theme_setting_logo_form" action="{{ url('theme_setting/update') }}" method="post" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Update company logo</h2>
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
        var table = $('.theme_setting_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('theme.setting.index') }}",
            columns: [{
                    data: 'key',
                    name: 'key'
                },
                {
                    data: "value",
                    render: function(data, type, row) {
                        if (row['key'] == 'logo') {
                            return '<img src="' + data + '" width="50"/>';
                        } else {
                            return data;
                        }
                    }
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
        $("#theme_setting_logo_form").validate({
            rules: {
                logo: {
                    required: true,
                    extension: 'png|jpeg|jpg' // add allowed extensions here
                }
            },
            messages: {
                logo: {
                    required: 'Please select a file',
                    extension: 'Please select a file with a valid extension (png, jpg, jpeg)'
                }
            },
            submitHandler: function(form) {
                // submit the form if validation passes
                form.submit();
            }
        });

        $("#createProcess").click(function() {
            getInterviewProcessCreateForm();
        });

        $(document).on('click', '.updateThemeSetting', function() {
            if ($(this).attr('data-id') != '') {
                getInterviewProcessCreateForm($(this).attr('data-id'));
            }
        });

        function getInterviewProcessCreateForm(id = '') {
            let getFormUrl = '{{ url('theme_setting/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Create Logo");
                } else {
                    $('#Heading').text("Organisation theme setting");
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
    });
</script>

@stop