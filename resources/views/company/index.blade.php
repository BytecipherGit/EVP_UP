  @extends('company/layouts.app')
  @section('content')
  @section('title','EVP - Admin Login')

    <!--- Main Container Start ----->
    <div class="main-container">

        <div class="main-heading">        
          <div class="row">
            <div class="col-lg-12">
              <h1>Overview</h1>
              <p>Here’s your report overview by today</p>
            </div>          
          </div>
        </div><!--- Main Heading ----->
  
        <!--- Status Heading Start ----->
        <div class="ser-part">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>All Employee <span>Lorem Ipsum</span></h2>
                  <div class="img-bg ml-auto">
                    <img src="assets/admin/images/employees-view.png">
                  </div>
                </div>
                <h6>
                  <div class="bg-section">
                    {{$allemployee}}<img src="assets/admin/images/button-plus-clr.png"> 
                  </div>  
                  <a href="/employee">View</a>              
                </h6>
              </div>
            </div> 
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>Current Employee<span>Lorem Ipsum</span></h2>
                  <div class="img-bg ml-auto">
                    <img src="assets/admin/images/current-user.png">
                  </div>  
                </div>
                <h6>
                  <div class="bg-section">
                    {{$current}} <img src="assets/admin/images/button-plus-clr.png"> 
                  </div>  
                  <a href="/current-employee">View</a>              
                </h6>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>Invite Employee <span>Lorem Ipsum</span></h2>
                  <div class="img-bg ml-auto">
                    <img src="assets/admin/images/invite-icon.png">
                  </div>  
                </div>
                <h6>
                  <div class="bg-section">
                    {{$empinvite}} <img src="assets/admin/images/button-plus-clr.png"> 
                  </div>  
                  <a href="/invite-employee">View</a>              
                </h6>
  
              </div>
            </div>
          </div>
        </div>
        <!--- Status Heading End ----->
  @endsection