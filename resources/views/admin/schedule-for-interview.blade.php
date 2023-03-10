@extends('company/layouts.app') 
@section('content')
@section('title','EVP - Schedule For Interview')

    <!--- Main Container Start ----->
    <div class="main-container">
      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Schedule for Interview</h1>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
              <a href="#" data-toggle="modal" data-target="#interviewModel" class="mr-2">Interview</a>
              <a href="#" data-toggle="modal" data-target="#rejectbtninfo">Reject</a>                
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-view-page">
        <div class="table-responsive-bg">
          <div class="table-effect-box">
            <div class="table-search-box">
              <input type="search" name="" placeholder="Search Candidate" class="form-control input-search-box">
            </div>
            <span class="ml-auto d-flex">              
              <div class="select-bx">
                <h2>
                  <div class="selectBox selectBox-boder">
                    <div class="selectBox__value">Stage...</div>
                    <div class="dropdown-menu" id="style-5">
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invited For Interview</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Interviewed</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invitation To Complete Machine Task</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Machine Task Completed </a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Feedback & Hr Policies Shared</a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Offer Sent </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Offer Decline </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Withdrew </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Unresponsive </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Rejected </a>
                      <a class="dropdown-item"><span class="spn-cricle hrd_bg"></span>Hired </a>
                    </div>
                  </div>
                </h2>
              </div>
              <div class="select-bx selectBox-statu-boder">
                <h2>
                  <div class="selectBox">
                    <div class="selectBox__value">Status</div>
                    <div class="dropdown-menu">
                      <a class="dropdown-item">Accepted</a>
                      <a class="dropdown-item ">Declied</a>
                      <a class="dropdown-item ">Joined</a>
                    </div>
                  </div>
                </h2>
              </div>
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
          <table class="table table-striped invite-table-cust schedule-tbl" style="width:100%">
            <thead>
              <tr>
                <th>EVP Id</th>
                <th>Name</th>                
                <th>Designation</th>
                <th>Candidate Rating</th>
                <th>Offer Status</th>
                <th>Hiring Stage</th>
                <th>Action</th>               
              </tr>
            </thead>
            <tbody>             
              <tr>
                <td>#000101</td>
                <td>Vijay Patil</td>
                <td>Senior</td>
                <td>
                  <fieldset class="rating ">
                    <input type="radio" id="textiles-star51" name="textiles-rating1" value="5">
                    <label class="full" for="textiles-star51"></label>
                    <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half">
                    <label class="half" for="textiles-star4half1"></label>

                    <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked="">
                    <label class="full" for="textiles-star41"></label>
                    <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half">
                    <label class="half" for="textiles-star3half1"></label>

                    <input type="radio" id="textiles-star31" name="textiles-rating1" value="3">
                    <label class="full" for="textiles-star31"></label>
                    <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half">
                    <label class="half" for="textiles-star2half1"></label>

                    <input type="radio" id="textiles-star21" name="textiles-rating1" value="2">
                    <label class="full" for="textiles-star21"></label>
                    <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half">
                    <label class="half" for="textiles-star1half1"></label>

                    <input type="radio" id="textiles-star11" name="textiles-rating1" value="1">
                    <label class="full" for="textiles-star11"></label>
                    <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half">
                    <label class="half" for="textiles-starhalf1"></label>
                  </fieldset>
                </td>
                <td><span class="tb-accept"></span> Accepted</td>                
                <td>
                  <div class="selectBox">
                    <div class="selectBox__value">Select Stage</div>
                    <div class="dropdown-menu" id="style-5">
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invited For Interview</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Interviewed</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invitation To Complete Machine Task</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Machine Task Completed </a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Feedback & Hr Policies Shared</a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Offer Sent </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Offer Decline </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Withdrew </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Unresponsive </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Rejected </a>
                      <a class="dropdown-item"><span class="spn-cricle hrd_bg"></span>Hired </a>
                    </div>
                  </div>
                </td> 
                <td class="d-flex">
                  <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img src="assets/admin/images/bell-icon.png"></span> 
                  <a href="#" class="edit-btn" data-toggle="modal" data-target="#deletebtninfo">Delete</a>
                </td>  
              </tr> 
              <tr>
                <td>#000102</td>
                <td>Shivani Gupta</td>
                <td>Junior</td>
                <td>
                  <fieldset class="rating">
                    <input type="radio" id="textiles-star5" name="textiles-rating" value="5">
                    <label class="full" for="textiles-star5"></label>
                    <input type="radio" id="textiles-star4half" name="textiles-rating" value="4 and a half">
                    <label class="half" for="textiles-star4half"></label>

                    <input type="radio" id="textiles-star4" name="textiles-rating" value="4">
                    <label class="full" for="textiles-star4"></label>
                    <input type="radio" id="textiles-star3half" name="textiles-rating" value="3 and a half">
                    <label class="half" for="textiles-star3half"></label>

                    <input type="radio" id="textiles-star3" name="textiles-rating" value="3" checked="">
                    <label class="full" for="textiles-star3"></label>
                    <input type="radio" id="textiles-star2half" name="textiles-rating" value="2 and a half">
                    <label class="half" for="textiles-star2half"></label>

                    <input type="radio" id="textiles-star2" name="textiles-rating" value="2">
                    <label class="full" for="textiles-star2"></label>
                    <input type="radio" id="textiles-star1half" name="textiles-rating" value="1 and a half">
                    <label class="half" for="textiles-star1half"></label>

                    <input type="radio" id="textiles-star1" name="textiles-rating" value="1">
                    <label class="full" for="textiles-star1"></label>
                    <input type="radio" id="textiles-starhalf" name="textiles-rating" value="half">
                    <label class="half" for="textiles-starhalf"></label>
                  </fieldset>
                </td>
                <td><span class="tb-decline"></span> Declied</td>
                <td>
                  <div class="selectBox">
                    <div class="selectBox__value">Select Stage</div>
                    <div class="dropdown-menu" id="style-5">
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invited For Interview</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Interviewed</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Invitation To Complete Machine Task</a>
                      <a class="dropdown-item"><span class="spn-cricle ioi_bg"></span>Machine Task Completed </a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Feedback & Hr Policies Shared</a>
                      <a class="dropdown-item"><span class="spn-cricle ifd_bg"></span>Offer Sent </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Offer Decline </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Withdrew </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Candidate Unresponsive </a>
                      <a class="dropdown-item"><span class="spn-cricle ifi_bg"></span>Rejected </a>
                      <a class="dropdown-item"><span class="spn-cricle hrd_bg"></span>Hired </a>
                    </div>
                  </div>
                </td>  
                <td class="d-flex">
                  <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img src="assets/admin/images/bell-icon.png"></span> 
                  <!-- <a href="invite-view-employee.html" class="view-btn">View</a> --> 
                  <a href="#" class="edit-btn" data-toggle="modal" data-target="#deletebtninfo">Delete</a>
                </td>
              </tr>                             
            </tbody>
          </table>
          <div class="pagination-main d-flex">
            <h2>Showing 1 to 7 of 20 entries</h2>
            <div class="pagination ml-auto">
              <ul> <!--pages or li are comes from javascript --> </ul>
            </div>
            </div>
        </div>
      </div><!--- Employeer View Page ----->

    </div> <!--- Main Container Close ----->

  <!-- The Modal Delete INFO -->
  <div class="modal fade custu-no-select" id="deletebtninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="assets/admin/images/deactivate-popup-icon.png" class="img-size-wth">
          <h1 class="h1-delete">Are you sure?</h1>
          <p>Are you Really want to Delete this account.</p>
          <a href="#" data-dismiss="modal" class="cancel-btn">Delete</a>
        </div>
      </div>
    </div>
  </div> 

  <!-- The Modal Remaider Notification -->
  <div class="modal fade schedu-modal" id="remaiderbtninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <h1 class="schedhead">Send reminder to complete registration.</h1>
            <p class="sheddpare">Your invitation or last reminder was sent 4 days ago</p>
            <div class="bottom-part">
              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn-primary-cust">Send remainder</button>
            </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- The Modal Remaider Notification -->
  <div class="modal fade schedu-modal" id="rejectbtninfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h1 class="schedhead">Reject Candidate</h1>
          <p class="sheddpare">Do you want to sent a rejection email to this candidate?</p>
          <div class="bottom-part">
            <button type="button" class="btn-secondary-cust" data-dismiss="modal">No</button>
            <a href="rejected-email" class="link-href" target="_black"><button type="button" class="btn-primary-cust">Yes</button></a>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- The Modal Interview  -->
  <div class="modal fade custu-modal-popup" id="interviewModel" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Interview</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-5">
                    <label>Date</label>
                    <input type="date" name="" class="form-control" value="Date">
                  </div>
                  <div class="col-md-3">
                    <label>Start Time</label>
                    <input type="time" name="" class="form-control" value="04:00 AM">
                  </div>
                  <div class="col-md-1">
                    <label>&nbsp;</label>
                    <span class="time-schud">to</span>
                  </div>
                  <div class="col-md-3">
                    <label>End Time</label>
                    <input type="time" name="" class="form-control" value="End">
                  </div>
                </div>                
              </div>

              <div class="schudinter-tab">
                <h1 class="schudh1">Interview Type</h1>
                <ul class="nav nav-tabs" role="tablist">                  
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><img src="assets/admin/images/video-call.png"> Video</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"><img src="assets/admin/images/phone-call.png">Phone</a>
                  </li>
                </ul> 
                <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                    <div class="form-group">
                      <label>Use Third-party Video Conference Service</label>
                      <input type="type" name="" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Message</label>
                      <textarea rows="3" class="form-control" placeholder="Include any additional information for the candudate hare. Instructions upon arrival, infomation to have ready, etc."></textarea>
                    </div>
                    <div class="form-group">
                      <label>Add Additianal Employers</label>
                      <input type="type" name="" class="form-control" placeholder="Enter one pr more emails separated by a comma">
                    </div>
                    <div class="form-group">
                      <label>Attech File</label>
                      <div class="upload-img-file">
                        <div class="circle">
                          <img class="profile-pic" id="profile-pic9" src="assets/admin/images/file-icon-img.png">
                        </div>
                        <div class="p-image ml-auto">
                          <span class="upload-button" id="upload-button9">Attech</span>
                          <input class="file-upload" id="file-upload9" type="file" accept="image/*">
                        </div>
                      </div>
                    </div> 

                    <div class="modal-footer">
                      <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn-primary-cust"><a href="interview-video-call" target="_black">Send Video Invitation</a></button>
                    </div>                   
                    
                  </div>
                  <div class="tab-pane" id="tabs-2" role="tabpanel">
                    <div class="form-group">
                      <label>Interviewer's Phone Number</label>
                      <input type="type" name="" class="form-control" placeholder="">
                    </div> 
                    <div class="form-group">
                      <label>Message</label>
                      <textarea rows="3" class="form-control" placeholder="Include any additional information for the candudate hare. Instructions upon arrival, infomation to have ready, etc."></textarea>
                    </div>
                    <div class="form-group">
                      <label>Add Additianal Employers</label>
                      <input type="type" name="" class="form-control" placeholder="Enter one pr more emails separated by a comma">
                    </div>
                    <div class="form-group">
                      <label>Attech File</label>
                      <div class="upload-img-file">
                        <div class="circle">
                          <img class="profile-pic" id="profile-pic10" src="assets/admin/images/file-icon-img.png">
                        </div>
                        <div class="p-image ml-auto">
                          <span class="upload-button" id="upload-button10">Attech</span>
                          <input class="file-upload" id="file-upload10" type="file" accept="image/*">
                        </div>
                      </div>
                    </div> 

                    <div class="modal-footer">
                      <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn-primary-cust"><a href="interview-phone-call" target="_black">Send Phone Invitation</a></button>
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
      window.jQuery || document.write('<script src="../../assets/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="assets/admin/js/bootstrap.min.js"></script> 
    <script src="assets/admin/js/pagination-script.js"></script>     
    <script src="assets/admin/js/file-upload.js"></script>

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
      $(document).ready(function(){
          $(".with-color-bg").click(function () {    
             if($(this).hasClass("dective-btn-bg"))
             {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
             }
             else{
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
             }
          });

          $(".pushme-Acp").click(function(){
          $(this).text(function(i, v){
             return v === 'Accepted' ? 'Declied' : 'Accepted'
          });
          });
      });
    </script>
@endsection