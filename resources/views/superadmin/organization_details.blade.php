@extends('superadmin.layouts.app')
@section('content')
@section('title','EVP - Organization Details')
  
  <!--- Wapper Start ----->
  <div class="wapper">
      <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Organization Details</h1>
          </div>
          <div class="col-lg-4">
            <div class="main-right-button-box">
              <a href="{{ route('organization') }}"><img src="{{ asset('assets') }}/superadmin/images/back-icon.png"> Back</a>
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Organization Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Documents</a>
          </li> 
        </ul> 
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>DETAILS</h2>
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <h4>Organization ID</h4>
                        <p>{{ $companyDetails->id }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Organization Name</h4>
                        <p>{{ $companyDetails->org_name }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Admin Name</h4>
                        <p>{{ $companyDetails->name }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Organization Website</h4>
                        <p>{{ $companyDetails->org_web }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Organization Admin Email</h4>
                        <p>{{ $companyDetails->email }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Company Registration No.</h4>
                        <p>12AD1551AAXZ</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Designation</h4>
                        <p>{{ $companyDetails->designation }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Department</h4>
                        <p>{{ $companyDetails->department }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Registered Address</h4>
                        <p>{{ $companyDetails->address }}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Country</h4>
                        <p>{{$address->countryName}}</p>
                      </div> 
                      <div class="col-lg-4 col-md-6">
                        <h4>State</h4>
                        <p>{{$address->stateName}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>City</h4>
                        <p>{{$address->cityName}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Pin Code</h4>
                        <p>{{ $companyDetails->pin }}</p>
                      </div>                     
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>Documents</h2>
                    <div class="table-responsive1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Id</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                            <tr>
                              <td>Pan Card</td>
                              <td>AXXX11100X</td>
                              <td>
                                <div class="table-select-drop">
                                  <div class="selectBox">
                                    <div class="selectBox__value">Pending</div>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item active">Pending</a>
                                      <a class="dropdown-item ">Rejected</a>
                                      <a class="dropdown-item ">Verified</a>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="d-flex">
                                  <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                                  <a href="assets/images/pan-card.png" target="_black" class="docu-download"><i class="fa fa-cloud-download" aria-hidden="true"></i></a> 
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>GST</td>
                              <td>AXXX11100X</td>
                              <td>
                                <div class="table-select-drop">
                                  <div class="selectBox">
                                    <div class="selectBox__value">Pending</div>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item active">Pending</a>
                                      <a class="dropdown-item ">Rejected</a>
                                      <a class="dropdown-item ">Verified</a>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="d-flex">
                                  <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                                  <a href="assets/images/pan-card.png" target="_black" class="docu-download"><i class="fa fa-cloud-download" aria-hidden="true"></i></a> 
                                </span>
                              </td>
                            </tr>                            
                          <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         
      </div>

    </div>
    <!--- Main Container Close ----->
  </div>
  <!--- Wapper Close -----> 


  <!-- The Modal Docum INFO-->
  <div class="modal fade custu-modal-popup" id="update-statu" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Confirm Status</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <p>The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust">Submit</button>
        </div>
      </div>
    </div>
  </div>
  

  
  <!-- The Modal Docum INFO-->
  <div class="modal fade custu-modal-popup" id="exampleModaldocument" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Pan Card</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="document-body">
            <img src="assets/images/pan-card.png">
          </div>
          <a href="assets/images/pan-card.png" target="_black">Download</a>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../../{{ asset('assets') }}/superadmin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/superadmin/js/bootstrap.min.js"></script>  

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

</body>

</html>
@endsection