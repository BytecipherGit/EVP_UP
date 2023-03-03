@extends('company/layouts.app') 
@section('content')
@section('title','EVP - Employee Notification')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-lg-12">
            <h1>All Notification</h1>
            <p>Here’s your report overview by today</p>
          </div>
        </div>
      </div><!--- Main Heading -----> 

      <!--- Notification Start -----> 
      <div class="notifica-page">
        <h1>
          <input type="checkbox" id="customcheck-all" name="customcheck-all"> 
          All Selected 
          <span class="ml-auto">
            <input type="search" name="" placeholder="Search..." class="form-control input-search-box">
          </span>
        </h1>

        <h2>Today</h2>
        <ul class="listing-notifica">
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck" name="customcheck1">                  
              </div>
              <div class="noti-80">
                
                <h4>juhi Thakur <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 19:54</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="{{ asset('assets') }}/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>  
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck1" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>juhi Thakur <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 18:26</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="{{ asset('assets') }}/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck2" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>juhi Thakur <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 16:05</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck3" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>juhi Thakur <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 15:25</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck4" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>Amit Sarma <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 13:28</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo" ><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck5" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>Shivani Gupta <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 13:28</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck6" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>Ashok Singh <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 12:41</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>
          </li>
        </ul>

        <h2>Yesterday</h2>
        <ul class="listing-notifica">
          <li>            
            <a href="#">
              <div class="check-box-part">
                  <input type="checkbox" id="customcheck7" name="customcheck">                  
              </div>
              <div class="noti-80">
                <h4>Bhanu Singh <span> has assigned leave policy Casual Leave to you</span></h4>
                <h6>6th Dec 2020, 13:28</h6>
              </div>
              <div class="noti-20">
                <p><button data-toggle="modal" data-target="#deletebtninfo"><img src="assets/admin/images/delete.png"></button></p>
              </div>
            </a>            
          </li>
        </ul>
      </div>
      <!--- Notification Close ----->     

    </div>
    <!--- Main Container Close ----->
  <!--- Wapper Close -----> 

  <!-- The Modal Delete INFO -->
  <div class="modal fade custu-no-select" id="deletebtninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="assets/admin/images/deactivate-popup-icon.png" class="img-size-wth">
          <h1 class="h1-delete">Are you sure?</h1>
          <p>Are you Realy want to Delete this account.</p>
          <a href="#" data-dismiss="modal" class="cancel-btn">Delete</a>
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

    @endsection
