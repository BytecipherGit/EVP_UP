@extends('company/layouts.app')
@section('content')
@section('title', 'EVP - Exit employee process')

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">

<!--- Main Container Start ----->
<div class="main-container">
    <div class="main-heading">
        <div class="row">
            <div class="col-md-8">
                <h1>Employee Offer Details</h1>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                      <a href="/admin" class="button_background_color"><img src="{{ asset('assets') }}/admin/images/back-icon.png"><span class="button_text_color">Back</span></a>
                </div>
              </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive-bg">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <table class="table table-bordered employee_offer_send_datatable">
                        <thead class="primary_color">
                            <tr>
                                <th class="secondary_color">S.No.</th>
                                <th class="secondary_color">Name</th>
                                <th class="secondary_color">Email</th>
                                <th class="secondary_color">Phone</th>
                                <th class="secondary_color">Status</th>
                                <th width="100px" class="secondary_color">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                @php $num = 1 @endphp
                                @foreach ($employeeOfferData as $employee) 
                                    <tr>
                                        <td>{{ $num }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                                <select style="width: 150px;" class="form-control" name="status" id="offer_status" style="text-decoration:none" href="#"> 
                                                    <option value="Withdraw" @if ($employee->status == 'Withdraw') selected="selected" @endif data-id="{{ $employee->id }}">Withdraw</option>
                                                    <option value="Accepted" @if ($employee->status == 'Accepted') selected="selected" @endif data-id="{{ $employee->id }}">Accepted</option>
                                                    <option value="Declined" @if ($employee->status == 'Declined') selected="selected" @endif data-id="{{ $employee->id }}">Declined</option>
                                                    <option value="Not Joined" @if ($employee->status == 'Not Joined') selected="selected" @endif data-id="{{ $employee->id }}">Not Joined</option>
                                                    <option value="Joined" @if ($employee->status == 'Joined') selected="selected" @endif data-id="{{ $employee->id }}">Joined</option>
                                               </select>
                                        </td> 
                                        <td>
                                            <a href="#" class="edit-btn fa fa-handshake-o" id="onboarding"
                                                data-id="{{ $employee->employee_id }}" data-title="onboarding"></a>
                                        </td>
                                    </tr>
                                    @php $num++ @endphp
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

<!-- The Modal Onboarding  -->
<div class="modal fade custu-modal-popup" id="onboardingModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="onboarding_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title textColor" id="Heading">Onboarding form</h2>
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
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Onboarding
                        successfully done.</div>
                    <div style="font-size: 16px; display:none;" class="text-danger" id="failed">Onboarding already
                        done.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-cust button_background_color"><span
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
      function refreshPage(){
            window.location.reload();
        } 
</script>


<script>
    $(document).on('change', '#offer_status', function() {
        var offerstatus = $('#offer_status').find(":selected").val();
        getOfferSendStatus(offerstatus);
    });


    function getOfferSendStatus(offerstatus = '') {

        let getFormUrl = '{{ url('email_template/form') }}';
        if (getFormUrl !== '') {
            getFormUrl = getFormUrl + "?status=" + offerstatus;
        }
        $.ajax({
            url: getFormUrl,
            type: "get",
            datatype: "html",
        }).done(function(data) {
            if (offerstatus === '') {
                $('#Heading').text("Employee offer final status");
            } else {
                $('#Heading').text("Employee offer final status");
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

    $('#send_email_to_employee').on('submit', function(event) {
        event.preventDefault();
        var isAdd = $('#is_add').val();
        var url = '{{ url('send_email_template') }}';
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
                    $('#loadingImg').hide();
                    $('#success').css('display', 'block');
                    setInterval(function() {
                        location.reload();
                    }, 2000);

                }

            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }

        });

    });
</script>
  <script>

    $(document).on('click', '#onboarding', function() {
        var employeeId = $(this).data('id');
        if (employeeId != '') {
            getOnboardingForm(employeeId);
        }
    })

    function getOnboardingForm(id = '') {
        let getFormUrl = '{{ url('onboarding/form') }}';
        if (id !== '') {
            getFormUrl = getFormUrl + "/" + id;
        }
        $.ajax({
            url: getFormUrl,
            type: "get",
            datatype: "html",
        }).done(function(data) {
            if (id === '') {
                $('#Heading').text("Create onboarding");
            } else {
                $('#Heading').text("Create onboarding");
            }
            $('#onboardingModel').find('.modal-body').html(data);
            $('#onboardingModel').modal({
                backdrop: 'static',
                keyboard: false
            });
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }

    $(document).on('submit', '#onboarding_form', function(event) {
        event.preventDefault();
        var url = '{{ url('onboarding/submit') }}';
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
                    $('.loadingImg').hide();
                } else {

                    if (data.success) {
                        $('.loadingImg').hide();
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
