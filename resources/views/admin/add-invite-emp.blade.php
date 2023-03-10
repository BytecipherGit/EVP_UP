@extends('company/layouts.app')
@section('content')
@section('title','EVP - Onboarding-Employee')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-12">
            <h1>Add Employee</h1>
            <p>Here’s your report overview by today</p>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 

        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active"  data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li> 
        </ul> 
    
        <div class="tab-content">
        
          <div  class="tab-pane active" id="tabs-1" role="tabpanel">

            <div class="eml-persnal ">
              <div class="add-emply-details">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="" method="post">
                  @csrf 
                  <div class="row">                     
                    <div class="col-lg-12">                    
                      <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="first_name">*First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter Your First Name" required>
                            @error('first_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" placeholder="Enter Your Middle Name" >
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="last_name">*Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Your Last Name" required>
                            @error('last_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="email">*Official Email Id</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Your Email" required>
                            @error('email')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Your Number" required>
                            @error('phone')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>  
                               
                      <div class="add-btn-part">
                        {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                        <button type="submit" class="btn-primary-cust">Save</button>
                      </div>
                                                   
                    </form>      
              </div>
            </div>
          </div>
        
        </div>
    </div>
</div>

   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
    <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
   <!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->

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
@endsection