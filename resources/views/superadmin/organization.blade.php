@extends('superadmin/layouts.app')
@section('content')
@section('title','EVP - Organization')
 
 <!--- Main Container Start ----->
 <div class="main-container">
      <div class="main-heading">        
        <div class="row">
          <div class="col-md-12">
            <h1>Organization</h1>
          </div>
          <div class="col-md-0">
            
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-view-page">
        <div class="table-responsive">
          <div class="table-effect-box">
            <div class="table-search-box">
              <input type="search" id="search" name="" placeholder="Search..." class="form-control input-search-box">
            </div>
            <span class="ms-auto d-flex cutom-filter">
              <div class="select-bx">
                <h2><span><img src="{{ asset('assets') }}/superassets/images/filter-icon.png"></span>
                  <div class="selectBox">
                    <div class="selectBox__value">All Status</div>
                    <div class="dropdown-menu">
                      <a class="dropdown-item active">All</a>
                      <a class="dropdown-item ">Pending</a>
                      <a class="dropdown-item ">Rejected</a>
                      <a class="dropdown-item ">Verified</a>
                    </div>
                  </div>
                </h2>
              </div>
            </span>           
            <span class="ml-auto d-flex">
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
          <table class="table table-striped invite-table-cust" style="width:100%">
            <thead>
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
              <tr>
                <td>#00</td>
                {{-- <td>{{ $dat->created_at->format('m-d-Y')}}</td> --}}
                <td></td>
                <td></td> 
                <td><button class="pushme pending-btn-bg">Pending</button></td>
                <td class="d-flex">
                  <a href="/organization-details/" class="view-btn">View</a> </td>
              </tr> 
                              
            </tbody>
          </table>
          <div class="pagination-main d-flex">
            <h2>Showing 1 to 7 of 20 entries</h2>
           
            <div class="pagination ml-auto">
             <ul></ul>
              {{-- <ul> <!--pages or li are comes from javascript --> {!! $employees->links() !!}</ul> --}}
            </div>
            </div>
        </div>
      </div><!--- Employeer View Page ----->

    </div> <!--- Main Container Close ----->
  
  <!--- Wapper Close ----->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/superassets/js/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/superassets/js/bootstrap.min.js"></script> 
    <script src="{{ asset('assets') }}/superassets/js/pagination-script.js"></script>

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
    <!-- <script>
      $( document ).ready(function() {
         var table=$('search').Datatable({
          'processing':true,
          'serverSide':true,
          'ajax':"",
          'columns':[
            {
              'data':''
            }
          ]

         })
           console.log( "ready!" );
       }); 
    </script> -->
    @endsection
