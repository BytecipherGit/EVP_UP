
@extends('company/layouts.app')
@section('content')
@section('title','EVP - Invite Employee')


<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">

    <!--- Main Container Start ----->
    <div class="main-container">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
          @endif
      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Invite Employees</h1>
            <p>Here’s your report overview by today</p>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
                <button type="button" name="bulk_mail" id="bulk_mail"
                class="btn btn-info btn-md addinci_btn disabled-btn">Invite</button>
              {{-- <a href="" name="bulk_mail" id="bulk_mail" class="disabled-btn" >Invite</a> --}}
              <a href="add-invite-employee"><img src="assets/admin/images/button-plus.png">Add New</a>              
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
              <button><span ><img src="assets/admin/images/export.png"></span><a data-href="/export-csv-invite" id="export" onclick ="exportTasks (event.target);">Export</a></button>
              {{-- <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a> --}}
              </button>
            </span>
          </div>        
          {{-- <table class="table table-striped invite-table-cust" style="width:100%"> --}}
            <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
            <thead>
              <tr>
                <th><input type="checkbox" id="selectAll" name="users_id"></th>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Employee Email</th>
                <th>Contact Number</th>
                <th>Action</th>                
              </tr>
            </thead>
            <tbody>    
              @foreach($empinvite as $invite)         
              <tr>
                <td><input type="checkbox" name="users_id[]" class="users_checkbox" value="{{$invite->id}}" /></td>
                <td>#00{{$invite->id}}</td>
                <td>{{$invite->first_name}} {{$invite->last_name}}</td>
                <td>{{$invite->email}}</td> 
                <td>{{$invite->phone}}</td>
                {{-- <td><button class="pushme with-color active-btn-bg">Joined</button></td> --}}
                <td class="d-flex">
                  {{-- <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img src="assets/admin/images/bell-icon.png"></span>  --}}
                  <a href="edit-invite-employee/{{$invite->id}}" class="view-btn">Edit</a> 
                  <a href="" class="edit-btn" data-toggle="modal" data-target="#deletebtninfo{{$invite->id}}">Delete</a></td>
            
              </tr> 
              @endforeach                 
            </tbody>
          </table>
         
        </div>
      </div><!--- Employeer View Page ----->

    </div> <!--- Main Container Close ----->


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
                  <label>Selected Optional Fields <span class="ml-auto"></span></label>
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
    
          <a href="/download_invitecsv" class="sample">Download Sample File </a>
          <img src="assets/admin/images/info.png" class="img-size-wth">
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



  <!-- The Modal Remaider Notification -->
  <div class="modal fade custu-no-select" id="remaiderbtninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="remainder-body">
            <h1>Send reminder to complete registration.</h1>
            <p>Your invitation or last reminder was sent 4 days ago</p>
            <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn-primary-cust">Send remainder</button>
          </div>
        </div>
      </div>
    </div>
  </div> 

    <!-- The Modal Delete INFO -->
    @foreach($empinvite as $invite)  
    <div class="modal fade custu-no-select" id="deletebtninfo{{$invite->id}}" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <img src="{{ asset('assets') }}/admin/images/deactivate-popup-icon.png" class="img-size-wth">
            <h1 class="h1-delete">Are you sure?</h1>
            <p>Are you Really want to Delete this account.</p>
            <a href="delete-invite/{{$invite->id}}">Delete</a>
          </div>
        </div>
      </div>
    </div> 
  @endforeach

   

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
    <script>
      $(document).ready(function(){
          
          $(".with-color").click(function () {    
             if($(this).hasClass("dective-btn-bg"))
             {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
             }
             else{
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
             }
          });

          $(".pushme").click(function(){
          $(this).text(function(i, v){
             return v === 'Joined' ? 'Dropped' : 'Joined'
          });
          });

          $(".with-color-bg").click(function () {    
             if($(this).hasClass("dective-btn-bg"))
             {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
             }
             else{
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
             }
          });

          $(".pushme-Acp").click(function(){
          $(this).text(function(i, v){
             return v === 'Accepted' ? 'Declied' : 'Accepted'
          });
          });
      });
    </script>
    <script>
      function exportTasks(_this) {
         let _url = $(_this).data('href');
         window.location.href = _url;
      }
    </script>

    <script>
   
            $(document).on('click', '#bulk_mail', function() {
                var id = [];
                if (confirm("Are you sure you want to Update this data?")) {
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                      // alert(id.length);
                        $.ajax({
                            url: "{{ route('invite-email') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                id: id
                            }, 
                            success: function(data) {
                                console.log(data);
                                // alert(data);
                                window.location.assign('invite-email');
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        alert("Please select atleast one checkbox");
                    }
                }
            });

        $("#selectAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
   
@endsection