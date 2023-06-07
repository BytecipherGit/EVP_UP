@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Current-Employee')

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">

<!--- Main Container Start ----->
<div class="main-container">
    <div class="main-heading">
        <div class="row">
            <div class="col-md-8">
                <h1>Current Employees</h1>
                <p></p>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box ">
                    {{-- <a href="add-employee"><img src="assets/admin/images/button-plus.png">Add New</a>  --}}
                    <a href="/employee" class="button_background_color"><img
                            src="{{ asset('assets') }}/admin/images/back-icon.png"><span
                            class="button_text_color">Back</span></a>
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
                {{-- <span class="ml-auto d-flex">
              <button><span class="bg-red"><img src="assets/admin/images/import.png"></span> <a data-toggle="modal" data-target="#btninfo">Import</a></button>
              <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a>
              </button> --}}

                {{-- </span> --}}
            </div>

            <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
                <thead class="primary_color">
                    <tr>
                        {{-- <th><input type="checkbox" id="customcheck" name="customcheck"></th> --}}
                        <th class="secondary_color">Employee Code</th>
                        <th class="secondary_color">Employee Name</th>
                        <th class="secondary_color">Employee Phone</th>
                        <th class="secondary_color">Employee Email</th>
                        {{-- <th>Reporting Manager</th> --}}
                        <th class="secondary_color">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($current as $curremp)
                        <tr>
                            {{-- <td><input type="checkbox" id="customcheck1" name="customcheck1"></td> --}}
                            <td>#{{ $curremp->empCode }}</td>
                            <td>{{ $curremp->first_name . ' ' . $curremp->last_name }}</td>
                            <td>{{ $curremp->phone }}</td>
                            <td>{{ $curremp->email }}</td>
                            {{-- <td>{{ $curremp->mang_name}}</td> --}}
                            <td class="d-flex"><a href="employee_info/{{ $curremp->employee_id }}"
                                    class="edit-btn fa fa-edit" title="Edit"></a>
                                {{-- <a href="employee-exit/{{ $curremp->employee_id }}" class="edit-btn fa fa-user-times" title="Exit"></a></td> --}}
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
    <!--- Employeer View Page ----->

</div>
<!--- Main Container Close ----->

<!--- Wapper Close ----->

<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="assets/admin/images/info.png" class="img-size-wth">
                <h1>No Employees Selected</h1>
                <p>Please select at least one employee</p>
                <a data-dismiss="modal">Ok</a>
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

<script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script>
<script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>

<script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>
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
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endsection
