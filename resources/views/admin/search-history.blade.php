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
<!-- The Modal Interview  -->
<div class="modal fade custu-modal-popup" id="interviewModel" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="schedule_interview_form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="Heading">Schedule Interview</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/admin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="comman-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="loadingImg"></div>
                    <div style="font-size: 16px; display:none;" class="text-success" id="success">Schedule
                        interview successfully done.</div>
                    <div style="font-size: 16px; display:none;" class="text-danger" id="failed">Interview already has been schedule for this employee.</div>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="scheduleInterviewSubmit" class="btn-primary-cust">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
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
    function myFunction(empCode) {    
      var x = document.getElementById(empCode);
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>

  <script>
     function getInterview() {    
            getScheduleInterviewForm();
        };

        function getScheduleInterviewForm(id = '') {
            let getFormUrl = '{{ url('schedule-interview/form') }}';
            if (id !== '') {
                getFormUrl = getFormUrl + "/" + id;
            }
            $.ajax({
                url: getFormUrl,
                type: "get",
                datatype: "html",
            }).done(function(data) {
                if (id === '') {
                    $('#Heading').text("Schedule Interview");
                } else {
                    $('#Heading').text("Update Schedule Interview");
                }
                $('#interviewModel').find('.modal-body').html(data);
                $('#interviewModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
        $('#schedule_interview_form').on('submit', function(event) {
            event.preventDefault();
            var isAdd = $('#is_add').val();
            var url = '{{ url('schedule-interview/submit') }}';

            if (isAdd != 1) {
                var url = '{{ url('schedule-interview/update') }}';
                successMsg = "Successfully Updated";
            }
            $('.loadingImg').show();
            var formData = new FormData(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errors) {
                        if (data.errors.first_name) {
                            $('#first_name-error').html(data.errors.first_name[0]);
                        }
                        if (data.errors.last_name) {
                            $('#last_name-error').html(data.errors.last_name[0]);
                        }
                        if (data.errors.email) {
                            $('#email-error').html(data.errors.email[0]);
                        }
                        if (data.errors.position) {
                            $('#position-error').html(data.errors.position[0]);
                        }
                        if (data.errors.interview_process) {
                            $('#interview_process-error').html(data.errors
                                .interview_process[0]);
                        }
                        if (data.errors.interviewer_id) {
                            $('#interviewer_id-error').html(data.errors.interviewer_id[0]);
                        }
                        // if (data.errors.interview_date) {
                        //     $('#interview_date-error').html(data.errors.interview_date[0]);
                        // }
                        // if (data.errors.interview_start_time) {
                        //     $('#interview_start_time-error').html(data.errors
                        //         .interview_start_time[0]);
                        // }
                        // if (data.errors.duration) {
                        //     $('#duration-error').html(data.errors
                        //         .duration[0]);
                        // }
                        // if (data.errors.video_link) {
                        //     $('#video_link-error').html(data.errors.video_link[0]);
                        // }
                        // if (data.errors.phone) {
                        //     $('#phone-error').html(data.errors.phone[0]);
                        // }
                        // if (data.errors.interview_instruction) {
                        //     $('#interview_instruction-error').html(data.errors
                        //         .interview_instruction[0]);
                        // }
                        // if (data.errors.attachment) {
                        //     $('#attachment-error').html(data.errors.attachment[0]);
                        // }
                        $('.loadingImg').hide();
                    } else {
                        if (data.success != 0) {
                            $('.loadingImg').hide();
                            $('#first_name-error').html('');
                            $('#last_name-error').html('');
                            $('#email-error').html('');
                            $('#position-error').html('');
                            // $('#interview_date-error').html('');
                            // $('#interview_start_time-error').html('');
                            // $('#duration-error').html('');
                            // $('#video_link-error').html('');
                            // $('#phone-error').html('');
                            // $('#interview_instruction-error').html('');
                            // $('#attachment-error').html('');
                            // $('#schedule_interview_form')[0].reset();
                            // $('#interviewModel').modal('hide');
                            $('#success').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);

                        } else {
                            $('#failed').css('display', 'block');
                            setInterval(function() {
                                location.reload();
                            }, 3000);
                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });
  </script>

@stop