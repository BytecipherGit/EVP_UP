@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Employee')

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">

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
            <div class="col-md-4">
                <h1>All Employees</h1>
            </div>
            <div class="col-md-8">
                <div class="main-right-button-box backhover">
                    <a href="/current-employee" class="emp button_background_color"><span class="button_text_color">Current Employees</span></a>
                    <a href="/post-employee" class="emp button_background_color"><span class="button_text_color">Old Employees</span></a>
                    <a href="employee_info" class="emp button_background_color"><img src="{{ asset('assets') }}/admin/images/button-plus.png"><span class="button_text_color">Add New</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->



    <div class="employee-view-page">
        <div class="table-responsive">
            <div class="table-effect-box">

                {{-- <button><span data-toggle="modal" data-target="#bulkeditbtn"><img src="assets/admin/images/bulk-icon.png"></span> <a data-toggle="modal" data-target="#btninfo">Bulk Edit</a></button> --}}
                {{-- <button><span><a href="https://mail.google.com/mail/u/0/" target="_black"><img src="assets/admin/images/email-icon.png"></a></span> <a data-toggle="modal" data-target="#btninfo">Mail</a></button> --}}
                <span class="ml-auto d-flex">
                    <button><span class="bg-red"><img src="assets/admin/images/import.png" data-toggle="modal"
                                data-target="#btninfo"></span> <a data-toggle="modal"
                            data-target="#btninfo">Import</a></button>
                    <button><span class="button_background_color"><img
                                src="{{ asset('assets') }}/admin/images/export.png" data-href="/export-csv"
                                onclick="exportTasks (event.target);"></span><a data-href="/export-csv" id="export"
                            onclick="exportTasks (event.target);">Export</a></button>
                </span>
                {{-- <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a> --}}
                {{-- <span><a href="{{ url('/') }}/export/xlsx" class="btn btn-success">Export to .xlsx</a></span>
              <span><a href="{{ url('/') }}/export/xls" class="btn btn-primary">Export to .xls</a></span> --}}
                {{-- </button> --}}


            </div>

            <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
                <thead class="primary_color">
                    <tr>
                        <th class="secondary_color">Employee Code</th>
                        <th class="secondary_color">Employee Name</th>
                        {{-- <th>Employee Designation</th> --}}
                        <th class="secondary_color">Employee Email</th>
                        {{-- <th>Reporting Manager</th> --}}
                        <th class="secondary_color">Employee Status</th>

                        <th class="secondary_color">Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($employeeDetails as $emp)
                        <tr>
                            <td>#{{ $emp->empCode }}</td>
                            <td>{{ $emp->first_name . ' ' . $emp->last_name }}</td>
                            {{-- <td>{{$emp->designation }}</td> --}}
                            <td>{{ $emp->email }}</td>
                            {{-- <td>{{$emp->mang_name }}</td> --}}

                            @if ($emp->status == 1 )
                                <td style="color:#5BD94E"><b>Active</b></td>
                                <td class="d-flex"><a href="employee_info/{{ $emp->employee_id }}"
                                        class="edit-btn fa fa-edit" title="Edit"></a>
                                    {{-- <a href="employee-exit/{{ $emp->employee_id }}" title="Exit Employee" class="edit-btn fa fa-user-times" title="Exit"></a></td> --}}
                            @elseif($emp->status == 2)
                               <td style="color:#ac2029"><b>Invite Employee</b></td>
                                <td class="d-flex"></td>
                            @else    
                                <td style="color:#ac2029"><b>Exit</b></td>
                                <td class="d-flex">
                                    {{-- <a href="edit-employee/{{ $emp->employee_id }}" class="edit-btn fa fa-edit" title="Edit"></a> --}}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{-- <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth"> --}}
                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="upload-file" class="exportlab">Import Employee Records</label>
                        <input type="file" name="upload-file" class="form-control export">
                    </div>
                    <input class="btn-primary-custexport button_background_color " type="submit" value="Import"
                        name="submit">
                    <button type="button" class="btn-secondary-custexport" data-dismiss="modal">Cancel</button>
                </form>
                <a href="/downloadcsv" class="sample btn btn-primary downLinkCus">Download sample file here <img src="assets/admin/images/import.png" class="pl-3"></a>
            </div>
        </div>
    </div>
</div>



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
    $(function() {
        //toggle classes on li element
        $('li.skils-id-1-1').on('click', function() {
            $('li.skils-id-1-1').toggleClass('clicked');
        });
        $('li.skils-id-1-2').on('click', function() {
            $('li.skils-id-1-2').toggleClass('clicked');
        });
        $('li.skils-id-1-3').on('click', function() {
            $('li.skils-id-1-3').toggleClass('clicked');
        });
        $('li.skils-id-1-4').on('click', function() {
            $('li.skils-id-1-4').toggleClass('clicked');
        });
        $('li.skils-id-1-5').on('click', function() {
            $('li.skils-id-1-5').toggleClass('clicked');
        });
        $('li.skils-id-1-6').on('click', function() {
            $('li.skils-id-1-6').toggleClass('clicked');
        });
        $('li.skils-id-1-7').on('click', function() {
            $('li.skils-id-1-7').toggleClass('clicked');
        });
        $('li.skils-id-1-8').on('click', function() {
            $('li.skils-id-1-8').toggleClass('clicked');
        });
        $('li.skils-id-1-9').on('click', function() {
            $('li.skils-id-1-9').toggleClass('clicked');
        });

    });
</script>
<script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script>
<script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>

<script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {

        setTimeout(function(){
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
    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>
@endsection
