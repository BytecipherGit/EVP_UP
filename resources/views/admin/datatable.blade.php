
@extends('company/layouts.app')
@section('content')
@section('title','EVP - New Admin')

<style>
  .filesample{
    display:contents;
  }
  .exportlab {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 15px;
    font-weight: 700;
    font-size: 21px;
    line-height: 30px;
}
input.export {
    padding: 10px 12px;
    height: auto;
}

.custu-no-select a:hover {
    box-shadow: 0px 4px 31px rgba(85, 51, 255, 0);
}

/* .employee-view-page .table thead {
  background: {{ $orangeBackgroud }};
  border-radius: 4px;
} */
</style>
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">

<div class="main-container">
  @if (session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
    @endif
      <div class="main-heading">        
        <div class="row">
          <div class="col-md-4">
            <h1>All Employees</h1>
            <p></p>
          </div>
          <div class="col-md-8">
            <div class="main-right-button-box"> 
               <a href="/current-employee" class="emp">Current Employees</a>
               <a href="/post-employee" class="emp">Old Employees</a>     
               <a href="/add-employee" class="emp"><img src="{{ asset('assets') }}/admin/images/button-plus.png">Add New</a>                     
              </div>
          </div>
        </div>
      </div><!--- Main Heading ----->
   <div class="employee-view-page">
     <div class="table-responsive">
        <div class="table-effect-box">
         
            {{-- <button><span data-toggle="modal" data-target="#bulkeditbtn"><img src="assets/admin/images/bulk-icon.png"></span> <a data-toggle="modal" data-target="#btninfo">Bulk Edit</a></button> --}}
            {{-- <button><span><a href="https://mail.google.com/mail/u/0/" target="_black"><img src="assets/admin/images/email-icon.png"></a></span> <a data-toggle="modal" data-target="#btninfo">Mail</a></button> --}}
              <span class="ml-auto d-flex">
                <button><span class="bg-red"><img src="assets/admin/images/import.png" data-toggle="modal" data-target="#btninfo"></span> <a data-toggle="modal" data-target="#btninfo">Import</a></button>
                <button><span><img src="{{ asset('assets') }}/admin/images/export.png" data-href="/export-csv" onclick ="exportTasks (event.target);"></span><a data-href="/export-csv" id="export" onclick ="exportTasks (event.target);">Export</a></button>
              </span>
              {{-- <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a> --}}
                {{-- <span><a href="{{ url('/') }}/export/xlsx" class="btn btn-success">Export to .xlsx</a></span>
              <span><a href="{{ url('/') }}/export/xls" class="btn btn-primary">Export to .xls</a></span> --}}
              {{-- </button> --}}
          
           
          </div>    
          
          <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
         <thead>
        <tr>
            <th>Employee Code</th>
            <th>Employee Name</th>
            {{-- <th>Employee Designation</th> --}}
            <th>Employee Email</th>
            {{-- <th>Reporting Manager</th> --}}
            <th>Employee Status</th>
       
            <th>Action</th>
           
        </tr>
    </thead>
 
    <tbody>           
        @foreach($allemp as $emp)  
      <tr>
        <td>#{{ $emp->empCode }}</td>
        <td>{{ $emp->first_name .' '. $emp->last_name }}</td>
        {{-- <td>{{$emp->designation }}</td> --}}
        <td>{{$emp->email }}</td>
        {{-- <td>{{$emp->mang_name }}</td> --}}
    
        @if($emp->status == 1 || $emp->status == 2)
        <td style="color:#5BD94E"><b>Active</b></td>
        <td class="d-flex"><a href="edit-employee/{{ $emp->employee_id }}" class="edit-btn fa fa-edit" data-title="Edit"></a>
          {{-- <a href="employee-exit/{{ $emp->employee_id }}" title="Exit Employee" class="edit-btn fa fa-user-times" data-title="Exit"></a></td> --}}
        @else
        <td style="color:#ac2029"><b>Exit</b></td>
        <td class="d-flex"><a href="edit-employee/{{ $emp->employee_id }}" class="edit-btn fa fa-edit" data-title="Edit"></a></td>
        @endif
      </tr> 
      @endforeach          
    </tbody>
    </table>
</div>
</div>
</div>

  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth"> --}}
          <form action="" method="post" enctype="multipart/form-data">
             {{csrf_field()}}
                <div class="form-group">
                    <label for="upload-file" class="exportlab">Import Employee Records</label>
                    <input type="file" name="upload-file" class="form-control export">
                </div>
                <input class="btn-primary-custexport" type="submit" value="Import" name="submit">
                <button type="button" class="btn-secondary-custexport" data-dismiss="modal">Cancel</button>
            </form>
            <a href="/downloadcsv" class="sample btn btn-primary">Download sample file here </a>
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
      $(function () {  
      //toggle classes on li element
        $('li.skils-id-1-1').on('click',function () {
            $('li.skils-id-1-1').toggleClass('clicked');
        });
        $('li.skils-id-1-2').on('click',function () {
            $('li.skils-id-1-2').toggleClass('clicked');
        });
        $('li.skils-id-1-3').on('click',function () {
            $('li.skils-id-1-3').toggleClass('clicked');
        });
        $('li.skils-id-1-4').on('click',function () {
            $('li.skils-id-1-4').toggleClass('clicked');
        });
        $('li.skils-id-1-5').on('click',function () {
            $('li.skils-id-1-5').toggleClass('clicked');
        });
        $('li.skils-id-1-6').on('click',function () {
            $('li.skils-id-1-6').toggleClass('clicked');
        });
        $('li.skils-id-1-7').on('click',function () {
            $('li.skils-id-1-7').toggleClass('clicked');
        });
        $('li.skils-id-1-8').on('click',function () {
            $('li.skils-id-1-8').toggleClass('clicked');
        });
        $('li.skils-id-1-9').on('click',function () {
            $('li.skils-id-1-9').toggleClass('clicked');
        });

      });
    </script>
<script>
    $(document).ready(function() {
      var table = $('#example').DataTable( {
          responsive: true,
          pagination:false
      } );
   
      new $.fn.dataTable.FixedHeader( table );
  } );
</script>

<script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script>
<script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>
  
<script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>

<script>
  function exportTasks(_this) {
     let _url = $(_this).data('href');
     window.location.href = _url;
  }
</script>
@endsection