@extends('company/layouts.app') 
@section('content')
@section('title','EVP - Invite View Employee')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Employee Details</h1>
            <p>Here’s your report overview by today</p>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
              <a href="/invite-employee"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
            </div>
          </div>  
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
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
                            <input type="text" name="first_name" @if ($invite) value="{{ old('first_name', $invite->first_name) }}" @endif class="form-control" placeholder="Enter Your First Name" required>
                            @error('first_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" @if ($invite) value="{{ old('middle_name', $invite->middle_name) }}" @endif class="form-control" placeholder="Enter Your Middle Name" >
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="last_name">*Last Name</label>
                            <input type="text" name="last_name" @if ($invite) value="{{ old('last_name', $invite->last_name) }}" @endif class="form-control" placeholder="Enter Your Last Name" required>
                            @error('last_name')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="email">*Official Email Id</label>
                            <input type="text" name="email" @if ($invite) value="{{ old('email', $invite->email) }}" @endif class="form-control" placeholder="Enter Your Email" required>
                            @error('email')
                            <span class="text-danger pass">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" @if ($invite) value="{{ old('phone', $invite->phone) }}" @endif class="form-control" placeholder="Enter Your Number" required>
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
                        <button type="submit" class="btn-primary-cust">Save Changes</button>
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
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="assets/admin/js/bootstrap.min.js"></script> 
    <script src="assets/admin/js/file-upload.js"></script>    
    <script src="assets/admin/js/typeahead.min.js"></script>

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
      
        // Initializes  input( name of states)
        // with a typeahead
        var $input = $(".typeahead");
        $input.typeahead({
            source: [
                "Css",
                "Css3",
                "Java",
                "Figma",
                "Html",
                "Html5",
                "Laravel",
                "Php",
                "ios",
                "React Js",
                "React Native",
            ],
            autoSelect: true,
        });
  
        $input.change(function () {
            var current = $input.typeahead("getActive");
            matches = [];
  
            if (current) {
  
                // Some item from your input matches
                // with entered data
                if (current.name == $input.val()) {
                    matches.push(current.name);
                }
            }
        });
    </script>

    <script>
      
        var $input = $(".typeahead1");
        $input.typeahead({
            source: [
                "Bhojpuri",
                "Bengali",
                "English",
                "French",
                "Gujarati",
                "Hindi",
                "Russian",
                "Spanish",
                "Tamil",
            ],
            autoSelect: true,
        });
  
        $input.change(function () {
            var current = $input.typeahead("getActive");
            matches = [];
  
            if (current) {
  
                // Some item from your input matches
                // with entered data
                if (current.name == $input.val()) {
                    matches.push(current.name);
                }
            }
        });
    </script>

    <script>
      $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamic > .single').attr("class", "row");

        $('.customer_records_dynamic input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>


    <script>
      $('.extra-fields-customer1').click(function() {
        $('.customer_records1').clone().appendTo('.customer_records_dynamic1');
        $('.customer_records_dynamic1 .customer_records1').addClass('single remove');
        $('.single .extra-fields-customer1').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamic1 > .single').attr("class", "row");

        $('.customer_records_dynamic1 input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>


    <script>
      $('.extra-fields-customeroff').click(function() {
        $('.customer_recordsoff').clone().appendTo('.customer_records_dynamicoff');
        $('.customer_records_dynamicoff .customer_recordsoff').addClass('single remove');
        $('.single .extra-fields-customeroff').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/admin/images/minus-icon.png"></span></a>');
        $('.customer_records_dynamicoff > .single').attr("class", "row");

        $('.customer_records_dynamicoff input').each(function() {
          var count = 0;
          var fieldname = $(this).attr("name");
          $(this).attr('name', fieldname + count);
          count++;
        });

      });

      $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
      });
    </script>

@endsection