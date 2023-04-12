@extends('company/layouts.app')
@section('content')
@section('title','EVP - Admin Search')

  <!--- Main Container Start ----->
  <div class="main-container">

    <div class="seachMain">
      <h1>Search Talent Here</h1>
      <div class="search-bg-round">
        <div class="row">
          <div class="col-lg-4">
              <div class="form-group" style="margin-top: 16px;">
                  <select class="form-control" id="filter_by" name="filter_by">
                      <option value=""> Select Options </option>
                      <option value="name"> Name </option>
                      <option value="email"> Email </option>
                      <option value="mobile"> Mobile </option>
                      <option value="empcode"> Employee Code </option>
                      <option value="aadhar"> Aadhaar Number </option>
                      <option value="pan"> Pan Number </option>
                  </select>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group" style="margin-top: 16px;">
                  <input type="text" id="search" placeholder="Search for candidate by name, email, mobile, empcode, document no." name="search" class="form-control input-search-box" autocomplete="off">
              </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <button type="button" class="search-btnkey" onclick="searchEmployee()">Search</button>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" >
          <h4 id="search_msg" style="display:none; color:red">
            Please select filter options before search.......
          </h4>
        </div>
      </div>

        {{-- <div class="row">
           <div class="col-lg-4 col-md-12 p-0">
            <div class="selectBox active">
              <div class="selectBox__value">Search type</div>
              <div class="dropdown-menu" id="style-5">
                <a class="dropdown-item active">Search type</a>  
                <a class="dropdown-item">EVP Id</a>
                <a class="dropdown-item">Pan Card</a>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8">
            <input type="text" id="search" placeholder="Search for candidate by name, email, mobile, empcode, document no." name="search" class="form-control input-search-box" autocomplete="off">
          </div>
          <div class="col-lg-3 col-md-4">
            <button type="submit" class="search-btnkey">Search</button>
          </div>
        </div> --}}
      </div>
    </div>
    <div id="myDIVsearch"></div>
  </div>
  <!--- Main Container Close ----->

  @endsection
  @section('pagescript')

<script>
  function searchEmployee(){
    var filterby = $('#filter_by :selected').val();
    var filter = $('#search').val();
    if(filterby != '' && filter != ''){
          $.ajax({
              type : 'get',
              url  : "{{ route('search-global') }}",
              data: {
                    search: filter,
                    filterby: filterby
                },
              // data : {'search':$value},
              success:function(data){
                  if (data.success) {
                      $('#myDIVsearch').html(data.value);
                  }
              }
          });
    } else {
      $('#search_msg').css("display", "block");
    }

  }
//   $('#search').on('change',function(){
//     $value = $(this).val();
//     $.ajax({
//         type : 'get',
//         url  : "{{ route('search-global') }}",
//         data : {'search':$value},
//         success:function(data){
//             if (data.success) {
//                 $('#myDIVsearch').html(data.value);
//             }
//         }
//     });
// })
</script>
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

  <script type="text/javascript">
    function myFunction1() {
      var x = document.getElementById("myDIVsearch");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>

  <script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("myDIV");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>
  
@stop