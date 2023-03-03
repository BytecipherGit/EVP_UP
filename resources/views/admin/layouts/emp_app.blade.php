@extends('company/layouts.app')
@section('content')
@section('title','EVP - Onboarding-Employee')

 <!--- Main Container Start ----->
 <div class="main-container">

    <div class="main-heading">        
      <div class="row">
        <div class="col-md-12">
          <h1>Onboarding</h1>
          <p>Here’s your report overview by today</p>
        </div>
      </div>
    </div><!--- Main Heading ----->

    <div class="employee-tab-bar"> 
      <ul class="nav nav-tabs table-responsive-width" role="tablist">
 
       
      
        <li class="nav nav-item ">
        
          <a class="nav nav-link" data-toggle="" href="add-employee" role="tab">Basic Info</a>
        </li>
      
        <li class="nav nav-item">
          <a class="nav nav-link" data-toggle="" href="emp_identity" role="tab">Identity</a>
        </li>
        <li class="nav nav-item">
          <a class="nav nav-link" data-toggle="" href="emp_qualification" role="tab">Qualification</a>
        </li>          
        <li class="nav nav-item">
          <a class="nav nav-link" data-toggle="" href="emp_workhistory" role="tab">Work History</a>
        </li>
        <li class="nav nav-item">
          <a class="nav nav-link" data-toggle="" href="emp_skills" role="tab">Skills</a>
        </li>
        <li class="nav nav-item">
          <a class="nav nav-link " data-toggle="" href="emp_official" role="tab">Official Use</a>
        </li>  

      </ul> 
   
  
  <!--- Main Container Close ----->

  {{-- Identity Field --}}
  @yield('emp_identity')
  {{-- @yield('emp_quali') --}}

   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
      <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
     <!--  <script src="assets/admin/js/typeahead.min.js"></script> -->
  
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

        {{-- <script>
        $(document).ready(function () {
          $('.nav li a').click(function(e) {

              $('.nav li.active').removeClass('active');

              var $parent = $(this).parent();
              $parent.addClass('active');
              e.preventDefault();
          });
        });
        </script> --}}

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