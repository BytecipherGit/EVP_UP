@extends('company/layouts.app')
@section('content')
@section('title','EVP - Post Employees')

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">
    <!--- Main Container Start ----->
    <div class="main-container">
      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Old Employees</h1>
            <p></p>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
                  <a href="/employee"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-view-page">
        <div class="table-responsive">
               
          <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
            <thead>
              <tr>
                {{-- <th><input type="checkbox" id="customcheck" name="customcheck"></th> --}}
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Employee Designation</th>
                <th>Employee Department</th>
                <th>Reporting Manager</th>
              
                <th>Action</th>
              </tr>
            </thead>
        
            <tbody>            
              @foreach($pastemp as $pastemps) 
              <tr>
                {{-- <td><input type="checkbox" id="customcheck1" name="customcheck1"></td> --}}
                <td>#00{{$pastemps->emp_id}}</td>
                <td>{{ $pastemps->first_name . ' ' . $pastemps->last_name }}</td>
                <td>{{$pastemps->mang_desig}}</td>
                <td>{{$pastemps->mang_dept}}</td>
                <td>{{$pastemps->mang_name}}</td>
               
                <td class="d-flex"><a href="/post-employee-details/{{ $pastemps->emp_id }}" class="edit-btn fa fa-eye" data-title="View"></a></td>
              </tr> 
              @endforeach                    
            </tbody>
           
          </table>
      
        </div>
      </div><!--- Employeer View Page ----->

    </div> <!--- Main Container Close ----->
 
  <!--- Wapper Close -----> 
  
  <script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script>
  <script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>
    
  <script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
  <script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>
  
  <script>
      $(document).ready(function() {
        var table = $('#example').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    } );
  </script>

@endsection