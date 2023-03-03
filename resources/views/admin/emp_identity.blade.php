@extends('admin/layouts.emp_app')
@section('emp_identity')
@section('title','EVP - Onboarding-Employee')

 <!-- The Modal Identity Add -->
 <div class="modal fade custu-modal-popup" id="identityAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Identity</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="post" action="">
              @csrf
              @foreach($employe as $emp)
              @endforeach
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <select class="form-control" name="id_type" id="id_type">
                      <option value="">Select Id </option>
                      <option value="Pan Card">Pan Card</option>
                      <option value="Aadhar Card">Aadhar Card</option>
                      <option value="Voter Id">Voter Id</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="id_number" class="form-control" placeholder="Number">
                  </div>
                </div>                
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      {{-- <div class="circle">
                        <img class="profile-pic" id="profile-pic" src="assets/admin/images/file-icon-img.png">
                      </div> --}}
                      {{-- <div class="p-image ml-auto"> --}}
                        <input type="file" name="document" id="file-upload" class="myfrm form-control" required>
                     {{-- </div> --}}

                  

                     
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
               
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option value="">Select Type </option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
               
                  </div>
                </div>
              </div>
         
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
          {{-- <button type="submit" name="identity" class="btn-primary-cust" >Save</button> --}}
          <button type="submit" name="identity" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="tab-pane" id="emp_identity/tabs-2" role="tabpanel">
    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              @csrf
              <div class="row">
                <div class="col-xl-12">
                  <h2>Uploaded Documents <span class="ml-auto on-head-right" data-toggle="modal" data-target="#identityAdd"><img src="assets/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                </div>
                <p class="no-data-clg">No Data Available</p>  

              

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="add-btn-part">
                      {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                      {{-- <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button> --}}
                    </div>
                  </div>
                </div>
              </div>
            </form>
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