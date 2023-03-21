@extends('company/layouts.app')
@section('content')
@section('title','EVP - Post-Employee-Details')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Alumni Employee Details</h1>
            <p></p>
          </div>
          <div class="col-lg-4">
            <div class="main-right-button-box">
              <a href="/post-employee"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-profile">
        <div class="heading-pro">
          <div class="pro-img">
            <div class="circle">
               <img class="profile-pic" @if ($basic->profile!== Null) value="/image/{{ old('profile', $basic->profile) }}" src="/image/{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif >

             </div>             
          </div>
          <h2>
            {{$basic->first_name}} {{$basic->last_name}}
            <span>Code - <small>#BCS{{$workhistory->emp_id}}</small></span>   
            <span>Designation - <small>{{$workhistory->designation}}</small></span>          
          </h2>
        </div>   
      </div>

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Qualification</a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Work History</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Feedback</a>
          </li> 

        </ul> 
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-6">
                  <div class="eml-per-main">
                    <h2>PERSONAL INFO </h2>
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <h4>Name</h4>
                        <p>{{$basic->first_name}} {{$basic->last_name}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Date of Birth</h4>
                        <p>{{$basic->dob}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Gender</h4>
                        <p>{{$basic->gender}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Blood Group</h4>
                        <p>{{$basic->blood_group}}</p>
                      </div>
                       <div class="col-lg-4 col-md-6">
                        <h4>Marital Status</h4>
                        <p>{{$basic->marital_status}}</p>
                      </div>                      
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="eml-per-main">
                    <h2>CONTACT INFO</h2>
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <h4>Official Email ID</h4>
                        <p>{{$basic->email}}</p>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <h4>Personal Email ID</h4>
                        <p>{{$basic->email}}</p>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <h4>Current Address</h4>
                        <p>{{$basic->current_address}}</p>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <h4>Permanent Address</h4>
                        <p>{{$basic->permanent_address}}</p>
                      </div> 
                    </div>
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>EMERGENCY CONTACT</h2>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Relationship </th>
                            <th>Phone Number</th>
                            <th>Address</th>
                          </tr>
                        </thead>
                          <tr>
                            <td>{{$basic->emg_name}}</td>
                            <td>{{$basic->emg_relationship}}</td>
                            <td>{{$basic->emg_phone}}</td>
                            <td>{{$basic->emg_address}}</td>
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
          <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>Identity</h2>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Id</th>
                            <th>Verification</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                          @foreach($identity as $iden)
                            <tr>
                              <td>{{$iden['id_type']}}</td>
                              <td>{{$iden['id_number']}}</td>
                              @if($iden['verification_type'] == 'Verified')
                              <td><span class="verified-clr"><i class="fa fa-check"></i> {{$iden['verification_type']}}</span></td>
                              @else
                              <td><span class="not-verified-clr"><i class="fa fa-times"></i> {{$iden['verification_type']}}</span></td>
                              @endif
                              <td>
                                <span class="d-flex tbl-iconBx">
                                  <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument{{$iden['id']}}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                  <a href="/image/{{ $iden['document'] }}" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                </span>
                              </td>
                            </tr>
                           @endforeach
                          <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>Qualification</h2>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Degree</th>
                            <th>School/College/Institute</th>                                    
                            <th>Subject</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Verification</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        @foreach($qualification as $quali)
                        <tbody>
                          <tr>                                    
                            <td>{{$quali['degree']}}</td> 
                            <td>{{$quali['inst_name']}}</td> 
                            <td>{{$quali['subject']}}</td>
                            <td>{{$quali['duretion_from']}}</td>  
                            <td>{{$quali['duretion_to']}}</td>  

                            @if($quali['verification_type'] == 'Verified')
                            <td><span class="verified-clr"><i class="fa fa-check"></i> {{$quali['verification_type']}}</span></td>
                            @else
                            <td><span class="not-verified-clr"><i class="fa fa-times"></i> {{$quali['verification_type']}}</span></td>
                            @endif
        
                            <td>
                              <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument{{$quali['id']}}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                              <a href="/image/{{ $quali['document'] }}" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="tab-pane" id="tabs-4" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>WORK INFO</h2>
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <h4>Employee ID</h4>
                        <p>BEC/{{$workhistory->emp_id}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Date of Joining</h4>
                        <p>{{$official->doj}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Probation Period</h4>
                        <p>{{$official->prob_period}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Employee Type</h4>
                        <p>{{$official->emp_type}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Work Location</h4>
                        <p>{{$official->work_location}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Employee Status</h4>
                        <p>{{$official->emp_status}}</p>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <h4>Work Experience</h4>
                        <p>3 Year</p>
                      </div> 
                      <div class="col-lg-4 col-md-6">
                        <h4>Date of Exit</h4>
                        <p>{{$exitemp->do_exit}}</p>
                      </div>                     
                    </div>
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>REPORTING MANAGER</h2>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Department</th>
                            <th>Designation</th>
                          </tr>
                        </thead>
                          <tr>
                            <td>{{$official->mang_name}}</td>
                            <td>{{$official->mang_type}}</td>  
                            <td>{{$official->mang_dept}}</td>
                            <td>{{$official->mang_desig}}</td>
                          </tr>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>WORK HISTORY </h2>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Company Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Designation</th>
                            <th>Offer Letter </th>
                            <th>Experience</th>
                            <th>Salary Slips</th>
                            <th>VERIFICATION</th>
                          </tr>
                        </thead>
                        @foreach($workdetails as $work)
                          <tr>
                            <td>{{$work['com_name']}}</td>
                            <td>{{$work['duration_from']}}</td>  
                            <td>{{$work['duration_to']}}</td>
                            <td>{{$work['designation']}}r</td>  
                            <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#workofferdocument{{$work['id']}}"><img src="{{ asset('assets') }}/admin/images/document.png"></a> </td>
                            <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#workexpdocument{{$work['id']}}"><img  src="{{ asset('assets') }}/admin/images/document.png"></a>
                            </td>
                             <td><a href="#" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a> </td>
                            @if($work['verification_type'] == 'Verified')
                            <td><span class="verified-clr"><i class="fa fa-check"></i> {{$work['verification_type']}}</span></td>
                            @else
                            <td><span class="not-verified-clr"><i class="fa fa-times"></i> {{$work['verification_type']}}</span></td>
                            @endif
                       
                          </tr>
                         @endforeach
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-5" role="tabpanel">
            <div class="eml-persnal">
              <div class="row">
                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <h2>EMPLOYEE FEEDBACK</h2>
                    <div class="row">
                      <div class="col-lg-12">
                        <h4>Decipline</h4>
                        <p>{{$exitemp->decipline}}</p>
                      </div>
                      <div class="col-lg-12">
                        <h4>Reason for leaving</h4>
                        <p>{{$exitemp->reason}}</p>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <h4>Rating</h4>
                        <div class="rating-box-pm">
                          <fieldset class="rating">
                            <input type="radio" id="textiles-star5" name="textiles-rating" value="5" />
                            <label class = "full" for="textiles-star5"></label>
                            <input type="radio" id="textiles-star4half" name="textiles-rating" value="4 and a half" / checked="">
                            <label class="half" for="textiles-star4half"></label>

                            <input type="radio" id="textiles-star4" name="textiles-rating" value="4" / >
                            <label class = "full" for="textiles-star4" ></label>
                            <input type="radio" id="textiles-star3half" name="textiles-rating" value="3 and a half" />
                            <label class="half" for="textiles-star3half"></label>

                            <input type="radio" id="textiles-star3" name="textiles-rating" value="3" />
                            <label class = "full" for="textiles-star3"></label>
                            <input type="radio" id="textiles-star2half" name="textiles-rating" value="2 and a half" />
                            <label class="half" for="textiles-star2half" ></label>

                            <input type="radio" id="textiles-star2" name="textiles-rating" value="2" />
                            <label class = "full" for="textiles-star2"></label>
                            <input type="radio" id="textiles-star1half" name="textiles-rating" value="1 and a half" />
                            <label class="half" for="textiles-star1half" ></label>

                            <input type="radio" id="textiles-star1" name="textiles-rating" value="1" />
                            <label class = "full" for="textiles-star1"></label>
                            <input type="radio" id="textiles-starhalf" name="textiles-rating" value="half" />
                            <label class="half" for="textiles-starhalf"></label>
                          </fieldset>
                          <span class="ml-3">(4.5)</span>
                        </div>
                      </div>                     
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

  @foreach($identity as $iden)
  <!-- The Modal Docum INFO-->
  <div class="modal fade custu-modal-popup" id="exampleModaldocument{{$iden['id']}}" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Pan Card</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        @if($iden['document'] == Null)
        <div class="modal-body">
          <p>Document not uploaded..</p>
        </div>
        @else
        <div class="modal-body">
          <div class="document-body">
              <img src="/image/{{ $iden['document'] }}">
          </div>
          <a href="/download_identity_doc/{{ $iden['id'] }}" target="_black">Download</a>
       </div>
       @endif
        <div class="modal-footer">
          <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary">Save Changes</button> -->
        </div>
      </div>
    </div>
  </div>
@endforeach
  <!-- The Modal No INFO -->
  <div class="modal fade custu-no-select" id="workhisinfo" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
          <h1>No Data Available</h1>
          <p>Upload your document file</p>
          <a data-dismiss="modal" data-toggle="modal">Ok</a>
        </div>
      </div>
    </div>
  </div> 

  @foreach($workdetails as $item)
  <div class="modal fade custu-modal-popup" id="workofferdocument{{$item['id']}}" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                  </button>
              </div>
              @if($item['offer_letter'] == Null)
              <div class="modal-body">
              <p>Document not uploaded..</p>
              </div>
              @else
              <div class="modal-body">
                  <div class="document-body">
                      <img src="/image/{{ $item['offer_letter'] }}">
                  </div>
                  <a href="/download_offerletter_doc/{{ $item['id'] }}" target="_black">Download</a>  
              </div>
              @endif
              <div class="modal-footer">
                  <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn-primary">Save Changes</button> -->
              </div>
          </div>
      </div>
  </div>
  @endforeach
  
  @foreach($workdetails as $item)
  <div class="modal fade custu-modal-popup" id="workexpdocument{{$item['id']}}" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                  </button>
              </div>
              @if($item['exp_letter'] == Null)
              <div class="modal-body">
                <p>Document not uploaded..</p>
              </div>
              @else
              <div class="modal-body">
                  <div class="document-body">
                      <img src="/image/{{ $item['exp_letter'] }}">
                  </div>
                  <a href="/download_expletter_doc/{{ $item['id'] }}" target="_black">Download</a>
              </div>
              @endif
              <div class="modal-footer">
                  <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn-primary">Save Changes</button> -->
              </div>
          </div>
      </div>
  </div>
  @endforeach

  <!-- The Modal Docum INFO-->
  @foreach($qualification as $quali)
  <div class="modal fade custu-modal-popup" id="qualificationdocument{{$quali['id']}}" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        @if($quali['document'] == Null)
        <div class="modal-body">
          <p>Document not uploaded..</p>
        </div>
        @else
        <div class="modal-body">
          <div class="document-body">
              <img src="/image/{{ $quali['document'] }}">
          </div>
          <a href="/download_qualification_doc/{{ $quali['id'] }}" target="_black">Download</a>
      </div>
      @endif
        <div class="modal-footer">
          <!-- <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary">Save Changes</button> -->
        </div>
      </div>
    </div>
  </div>   
  @endforeach

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>  

    @endsection