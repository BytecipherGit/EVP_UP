@extends('company/layouts.app')
@section('content')
@section('title','EVP - Admin Search')

  <!--- Main Container Start ----->
  <div class="main-container">

    <div class="seachMain">
      <h1>Search Talent</h1>
      <div class="search-bg-round">
        <div class="row">
          <div class="col-lg-4">
              <div class="form-group" style="margin-top: 16px;">
                  <select class="form-control" id="filter_by" name="filter_by" style="height: 48px;">
                      <option value=""> Select filter options </option>
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
                  <input type="text" id="search" placeholder="Search talent by name, email, mobile, empcode, document no." name="search" class="form-control input-search-box" autocomplete="off">
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
      </div>
    </div>
    <div id="myDIVsearch"></div>
  </div>
  <!--- Main Container Close ----->

  @endsection
  @section('pagescript')

<script>

$("#filter_by").on("change", function() {
        var option = this.value;
        switch (option) { 
            case 'name': 
                $("#search").attr("placeholder", "Search by name");
                break;
            case 'email': 
                $("#search").attr("placeholder", "Search by email");
                break;
            case 'mobile': 
                $("#search").attr("placeholder", "Search by mobile");
                break;
            case 'empcode': 
                $("#search").attr("placeholder", "Search by employee code");
                break;		
            case 'aadhar': 
                $("#search").attr("placeholder", "Search by adhaar number");
                break;
            case 'pan': 
                $("#search").attr("placeholder", "Search by pan number");
                break;
            default:
                alert('No one filter by options is selected. Please select atleast one option.');
        }
    });

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