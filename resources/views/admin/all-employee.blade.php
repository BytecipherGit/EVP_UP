 @extends('company/layouts.app')
 @section('content')
 @section('title','EVP - New Admin')
<style>
 .disabled{
  pointer-events: none;
}
.verified{
  color: #5BD94E;
}
.not-verified{
  color: #ac2029;
}
</style>

 <div class="main-container">
    <div class="main-heading">        
      <div class="row">
        <div class="col-md-4">
          <h1>All Employees</h1>
          <p>Here’s your report overview by today</p>
        </div>
        <div class="col-md-8">
          <div class="main-right-button-box"> 
             <a href="/current-employee" class="emp">Current Employee</a>
             <a href="/post-employee" class="emp">Past Employee</a>     
             <a href="/add-employee" class="emp"><img src="assets/admin/images/button-plus.png">Add New</a>                     
            </div>
        </div>
      </div>
    </div><!--- Main Heading ----->

    <div class="employee-view-page">
      <div class="table-responsive">
        <div class="table-effect-box">
          <div class="table-search-box">
            <input type="search" name="" placeholder="Search..." class="form-control input-search-box">
          </div>
          {{-- <button><span data-toggle="modal" data-target="#bulkeditbtn"><img src="assets/admin/images/bulk-icon.png"></span> <a data-toggle="modal" data-target="#btninfo">Bulk Edit</a></button> --}}
          {{-- <button><span><a href="https://mail.google.com/mail/u/0/" target="_black"><img src="assets/admin/images/email-icon.png"></a></span> <a data-toggle="modal" data-target="#btninfo">Mail</a></button> --}}
          <span class="ml-auto d-flex">
            <button><span class="bg-red"><img src="assets/admin/images/import.png"></span> <a data-toggle="modal" data-target="#btninfo">Import</a></button>
            <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a>
            </button>
            <div class="select-bx">
              <h2><span>Show</span>
                <div class="selectBox">
                  <div class="selectBox__value">10</div>
                  <div class="dropdown-menu">
                    <a class="dropdown-item active">10</a>
                    <a class="dropdown-item ">25</a>
                    <a class="dropdown-item ">50</a>
                    <a class="dropdown-item ">100</a>
                  </div>
                </div>
              </h2>
            </div>
          </span>
        </div>        
        <table class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th><input type="checkbox" id="customcheck" name="customcheck"></th>
              <th>Employee Code</th>
              <th>Employee Name</th>
              <th>Employee Designation</th>
              <th>Employee Department</th>
              <th>Reporting Manager</th>
              <th>Employee Status</th>
              <th>Action</th>
            </tr>
          </thead>
          @foreach($allemp as $emp)
          <tbody>             
            <tr>
              <td><input type="checkbox" id="customcheck1" name="customcheck1"></td>
              <td>#00{{ $emp->employee_id }}</td>
              <td>{{ $emp->first_name .' '. $emp->last_name }}</td>
              <td>{{$emp->mang_desig }}</td>
              <td>{{$emp->mang_dept }}</td>
              <td>{{$emp->mang_name }}</td>
              @if($emp->status == 1)
              <td style="color:#5BD94E">Available Employee</td>
              <td class="d-flex"><a href="edit-employee/{{ $emp->employee_id }}" class="view-btn">View</a><a href="employee-exit/{{ $emp->employee_id }}" title="Exit Employee" class="edit-btn">Exit</a></td>
              @else
              <td style="color:#ac2029">Exit Employee</td>
              <td class="d-flex disabled"><a href="edit-employee/{{ $emp->employee_id }}" class="view-btn">View</a><a href="employee-exit/{{ $emp->employee_id }}" title="Employee Already Exit" class="edit-btn disabled">Exit</a></td>
              @endif
            </tr> 
                             
          </tbody>
          @endforeach
        </table>
        <div class="pagination-main d-flex">
          <h2>Showing 1 to 7 of 20 entries</h2>
          <div class="pagination ml-auto">
            <ul> <!--pages or li are comes from javascript --> </ul>
          </div>
        </div>
      </div>
    </div><!--- Employeer View Page ----->

  </div>
 <!-- The Modal Export Edit -->
 <div class="modal fade custu-modal-popup" id="exporteditbtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Export Edit</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
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
            <img src="assets/admin/images/close-btn-icon.png">
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
          <img src="assets/admin/images/info.png" class="img-size-wth">
          <h1>No Employees Selected</h1>
          <p>Please select at least one employee</p>
          <a data-dismiss="modal">Ok</a>
        </div>
      </div>
    </div>
  </div>  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="assets/admin/js/bootstrap.min.js"></script> 
      <script src="assets/admin/js/pagination-script.js"></script>
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
 @endsection