@extends('superadmin/layouts.app')
@section('content')
@section('title', 'EVP - Organization')

<div class="wapper">
    <!--- Main Container Start ----->
    <div class="main-container">
        <div id="successMessage">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="main-heading">
            <div class="row">
                <div class="col-md-8">
                    <h1>Organization</h1>
                </div>
                <div class="col-md-4">
                    <div class="main-right-button-box">
                        <a href="add_company" class="emp"><img src="{{ asset('assets') }}/admin/images/button-plus.png"><span class="button_text_color">Add New</span></a>
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
                        <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
                            <thead class="primary_color">
                                <tr>
                                    <th>Organization Id</th>
                                    <th>Registration Date</th>
                                    <th>Organization Name</th>
                                    <th>Admin Name</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($getCompany as $company)
                                    <tr>
                                        <td>#{{ $company->id }}</td>
                                        <td>{{ $company->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $company->org_name }}</td>
                                        <td>{{ $company->name }}</td>
                                        @if ($company->status == 1)
                                            <td style="color:#5BD94E"><b>Verified</b></td>
                                            {{-- <td><button class="pushme active-btn-bg">Verified</button></td> --}}
                                            <td class="d-flex">
                                                <a href="organization_details/{{ $company->id }}" class="edit-btn fa fa-eye" title="View"></a>
                                                <a href="update_organization/{{ $company->id }}" class="edit-btn fa fa-edit" title="Edit"></a>
                                                <a href="#" class="edit-btn deleteCompany fa fa-trash" data-id="{{ $company->id }}" title="Delete"></a>
                                            </td>
                                        @else
                                            <td style="color:#ac2029"><b>Pending</b></td>
                                            <td class="d-flex">
                                                <a href="organization_details/{{ $company->id }}" class="edit-btn fa fa-eye" title="View"></a>
                                                <a href="update_organization/{{ $company->id }}" class="edit-btn fa fa-edit" title="Edit"></a>
                                                <a href="#" class="edit-btn deleteCompany fa fa-trash" data-id="{{ $company->id }}" title="Delete"></a>
                                            </td>
                                        @endif
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
</div>


@endsection
@section('pagescript')
<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/superadmin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/superadmin/js/bootstrap.min.js"></script>
{{-- {{-- <script src="{{ asset('assets') }}/superadmin/js/pagination-script.js"></script> --}}

<script>
    $(document).ready(function() {

        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 2000);

        var table = $('#example').DataTable({
            responsive: true,
            pagination: false
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>

<script>
    $(document).on('click', '.deleteCompany', function() {
        swal({
                title: "Are you sure?",
                text: "You want to delete this company!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    // Handle the change event
                    var companyId = $(this).data('id');
                    if (companyId != '') {
                        var url = '{{ url('company/destroy') }}';
                        var my_data = {
                            companyId: companyId
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
                                    swal("Position successfully deleted.", {
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
                    swal("Your company is safe!");
                    setInterval(function() {
                        location.reload();
                    }, 2000);
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
@stop
