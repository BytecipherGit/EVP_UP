
@extends('company/layouts.app')
@section('content')
@section('title','EVP - New Admin')


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
                <button><span class="bg-red"><img src="assets/admin/images/import.png"></span> <a data-toggle="modal" data-target="#btninfo">Import</a></button>
                <button><span ><img src="{{ asset('assets') }}/admin/images/export.png"></span><a data-href="/export-csv" id="export" onclick ="exportTasks (event.target);">Export</a></button>

              {{-- <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a> --}}
                {{-- <span><a href="{{ url('/') }}/export/xlsx" class="btn btn-success">Export to .xlsx</a></span>
              <span><a href="{{ url('/') }}/export/xls" class="btn btn-primary">Export to .xls</a></span> --}}
              {{-- </button> --}}
          
            </span>
          </div>    
          
          <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
         <thead>
        <tr>
            {{-- <th><input type="checkbox" id="selectAll" name="customcheck1"></th> --}}
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
        {{-- <td><input type="checkbox" id="customcheck1" name="customcheck1"></td> --}}
        <td>#00{{ $emp->employee_id }}</td>
        <td>{{ $emp->first_name .' '. $emp->last_name }}</td>
        {{-- <td>{{$emp->designation }}</td> --}}
        <td>{{$emp->email }}</td>
        {{-- <td>{{$emp->mang_name }}</td> --}}
    
        @if($emp->status == 1 || $emp->status == 2)
        <td style="color:#5BD94E"><b>Active</b></td>
        <td class="d-flex"><a href="edit-employee/{{ $emp->employee_id }}" class="edit-btn fa fa-edit" data-title="Edit"></a>
          <a href="employee-exit/{{ $emp->employee_id }}" title="Exit Employee" class="edit-btn fa fa-user-times" data-title="Exit"></a></td>
        @else
        <td style="color:#ac2029"><b>Exit</b></td>
        <td class="d-flex"></td>
        @endif
      </tr> 
      @endforeach          
    </tbody>
    </table>
</div>
</div>
</div>

  <!-- The Modal Export Edit -->
  <div class="modal fade custu-modal-popup" id="exporteditbtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Export Edit</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Selected</label>
                    <input type="text" name="" class="form-control" value="3 Employees">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Selected Fields</label>                    
                    <ul id="skils-id-1">
                      <li class="skils-id-1-1">Employee ID</li>
                      <li class="skils-id-1-2">Employee Name</li>
                      <li class="skils-id-1-3">Department</li>
                      <li class="skils-id-1-4">Designation</li>                      
                      <li class="skils-id-1-5">DOJ</li>
                      <li class="skils-id-1-6">Primary Manager</li>
                      <li class="skils-id-1-7">Secondary Manager</li>
                      <li class="skils-id-1-8">Employee Type</li>
                      <li class="skils-id-1-9">Employee Status</li>
                    </ul>
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="select-option-cust">
                  <label>Selected Optional Fields <span class="ml-auto">Rohit</span></label>
                  <ul>
                    <li>
                      <input type="checkbox" id="customRadioInline1" name="customRadioInline"> 
                      <label for="customRadioInline1"> Work History </label>
                    </li>
                    <li>
                      <input type="checkbox" id="customRadioInline2" name="customRadioInline"> 
                      <label for="customRadioInline2"> DOB </label>                         
                    </li>
                    <li>
                      <input type="checkbox" id="customRadioInline3" name="customRadioInline"> 
                      <label for="customRadioInline3">Gender</label>                          
                    </li>
                    <li>
                      <input type="checkbox" id="customRadioInline4" name="customRadioInline"> 
                      <label for="customRadioInline4">ESI Nubmer</label>
                    </li>
                    <li>
                      <input type="checkbox" id="customRadioInline5" name="customRadioInline"> 
                      <label for="customRadioInline5">Attendance Rules</label>
                  </ul>
                </div>                
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>

   <!-- The Modal Bulk Edit -->
  <div class="modal fade custu-modal-popup" id="bulkeditbtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Bilk Edit</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Selected</label>
                    <input type="text" name="" class="form-control" value="3 Employees">
                  </div>
                  <div class="col-md-6">
                    <label>Effective Date</label>
                    <input type="date" name="" class="form-control" placeholder="Date">
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Department</label>
                    <div class="selectBox active"  class="form-control">
                      <div class="selectBox__value">Select Department</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Select Department</a>
                        <a class="dropdown-item ">Software Developer</a>
                        <a class="dropdown-item">SEO Developer</a>                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Designation</label>
                    <div class="selectBox active"  class="form-control">
                      <div class="selectBox__value">Select Designation</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Select Designation</a>
                        <a class="dropdown-item">Senior</a>
                        <a class="dropdown-item">Junior</a>                        
                      </div>
                    </div>
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Reporting Manager</label>
                    <div class="selectBox active"  class="form-control">
                      <div class="selectBox__value">Select Manager</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Select Manager</a>
                        <a class="dropdown-item">Mayank Palotra</a>
                        <a class="dropdown-item">Mukesh Palotra</a>  
                        <a class="dropdown-item">Priya Thakur</a> 
                        <a class="dropdown-item">Ashok Sharma</a>                       
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Select Location</label>
                    <div class="selectBox active"  class="form-control">
                      <div class="selectBox__value">Select Location</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Select Location</a>
                        <a class="dropdown-item">Indore</a>
                        <a class="dropdown-item">Pune</a>  
                        <a class="dropdown-item">Bhopal</a>                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       
        <div class="modal-body">
        {{-- <a href="Sample Employee.csv" >Download Sample File</a> --}}
        <a href="/downloadcsv" class="sample">Download Sample File </a>
          <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
          <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="upload-file">Import Employee Records</label>
                    <input type="file" name="upload-file" class="form-control">
                    {{-- @error('upload-file')
                    <p class="velidation">{{ $message }}</p>
                @enderror --}}
                </div>
                <input class="btn-primary-cust" type="submit" value="Import" name="submit">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
            </form>
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