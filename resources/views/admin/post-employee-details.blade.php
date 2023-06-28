@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Post-Employee-Details')

<!--- Main Container Start ----->
<div class="main-container">

    <div class="main-heading">
        <div class="row">
            <div class="col-md-8">
                <h1>Old Employee Details</h1>
                <p></p>
            </div>
            <div class="col-lg-4">
                <div class="main-right-button-box">
                    <a href="/post-employee" class="button_background_color"><img
                            src="{{ asset('assets') }}/admin/images/back-icon.png"><span class="button_text_color">
                            Back</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-profile">
        <div class="heading-pro">
            <div class="pro-img">
                <div class="circle">
                    <img class="profile-pic"
                        @if ($employeeDetails->profile !== null) value="{{ old('profile', $employeeDetails->profile) }}" src="{{ $employeeDetails->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif>

                </div>
            </div>
            <h2>
                {{ $employeeDetails->first_name . ' ' . $employeeDetails->last_name }}
                <span>Code - #{{ $employeeDetails->empCode }}</span>
                <span>Designation - {{ $employeeDetails->designation }}</span>
            </h2>
        </div>
    </div>

    <div class="employee-tab-bar">
        <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><span
                        class="secondary_color">Basic Info</span></a>
            </li>
            {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
          </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"><span
                        class="secondary_color">Qualification</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab"><span class="secondary_color">Work
                        History</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab"><span
                        class="secondary_color">Feedback</span></a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="eml-persnal">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="eml-per-main">
                                <input type="hidden" name="id" value="{{ $employeeDetails->id }}">
                                <h2>PERSONAL INFO </h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Name</h4>
                                        <p>{{ $employeeDetails->first_name . ' ' . $employeeDetails->last_name }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Date of Birth</h4>
                                        <p>{{ $employeeDetails->dob }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Gender</h4>
                                        <p>{{ $employeeDetails->gender }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Blood Group</h4>
                                        <p>{{ $employeeDetails->blood_group }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Marital Status</h4>
                                        <p>{{ $employeeDetails->marital_status }}</p>
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
                                        <p>{{ $employeeDetails->email }}</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <h4>Personal Email ID</h4>
                                        <p>{{ $employeeDetails->email }}</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <h4>Current Address</h4>
                                        <p>{{ $employeeDetails->current_address }}</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <h4>Permanent Address</h4>
                                        <p>{{ $employeeDetails->permanent_address }}</p>
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
                                            <td>{{ $employeeDetails->emg_name }}</td>
                                            <td>{{ $employeeDetails->emg_relationship }}</td>
                                            <td>{{ $employeeDetails->emg_phone }}</td>
                                            <td>{{ $employeeDetails->emg_address }}</td>
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
            {{-- <div class="tab-pane" id="tabs-2" role="tabpanel">
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
                          @foreach ($identity as $iden)
                            <tr>
                              <td>{{$iden['id_type']}}</td>
                              <td>{{$iden['id_number']}}</td>
                              @if ($iden['verification_type'] == 'Verified')
                              <td><span class="verified-clr"><i class="fa fa-check"></i> {{$iden['verification_type']}}</span></td>
                              @else
                              <td><span class="not-verified-clr"><i class="fa fa-times"></i> {{$iden['verification_type']}}</span></td>
                              @endif
                              <td>
                                <span class="d-flex tbl-iconBx">
                                  <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument{{$iden['id']}}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                  <a href="{{ $iden['document'] }}" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
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
          </div> --}}
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
                                        @if ($qualifications)
                                            @foreach ($qualifications as $qualification)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $qualification['degree'] }}</td>
                                                        <td>{{ $qualification['inst_name'] }}</td>
                                                        <td>{{ $qualification['subject'] }}</td>
                                                        <td>{{ $qualification['duration_from'] }}</td>
                                                        <td>{{ $qualification['duration_to'] }}</td>

                                                        @if ($qualification['verification_type'] == 'Verified')
                                                            <td><span class="verified-clr"><i class="fa fa-check"></i>
                                                                    Verified</span></td>
                                                        @else
                                                            <td><span class="not-verified-clr"><i
                                                                        class="fa fa-times"></i> Not Verified</span>
                                                            </td>
                                                        @endif

                                                        <td>
                                                            <a href="#" target="_black" class="docu-down"
                                                                data-toggle="modal"
                                                                data-target="#qualificationdocument{{ $qualification['id'] }}"><img
                                                                    src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                            <a href="{{ $qualification['document'] }}" target="_black"
                                                                class="docu-download"><img
                                                                    src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        @endif
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
                                        <p>{{ $employeeDetails->empCode }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Date of Joining</h4>
                                        <p>{{ $employeeDetails->date_of_joining }}</p>
                                    </div>
                                    {{-- <div class="col-lg-4 col-md-6">
                        <h4>Probation Period</h4>
                        <p>{{$employeeDetails->prob_period}}</p>
                      </div> --}}
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Employee Type</h4>
                                        <p>{{ $employeeDetails->emp_type }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Work Location</h4>
                                        <p>{{ $employeeDetails->work_location }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Employee Status</h4>
                                        <p>{{ $employeeDetails->emp_status == '0' ? 'Inactive' : 'Active' }}</p>
                                    </div>
                                    {{-- <div class="col-lg-4 col-md-6">
                        <h4>Work Experience</h4>
                        <p>3 Year</p>
                      </div>  --}}
                                    <div class="col-lg-4 col-md-6">
                                        <h4>Date of Exit</h4>
                                        <p>{{ $employeeDetails->end_date }}</p>
                                    </div>
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
                                        @foreach ($workdetails as $work)
                                            <tr>
                                                <td>{{ $work['com_name'] }}</td>
                                                <td>{{ $work['work_duration_from'] }}</td>
                                                <td>{{ $work['work_duration_to'] }}</td>
                                                <td>{{ $work['designation'] }}</td>
                                                <td><a href="#" target="_black" class="docu-down"
                                                        data-toggle="modal"
                                                        data-target="#workofferdocument{{ $work['id'] }}"><img
                                                            src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                </td>
                                                <td><a href="#" target="_black" class="docu-down"
                                                        data-toggle="modal"
                                                        data-target="#workexpdocument{{ $work['id'] }}"><img
                                                            src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                </td>
                                                <td><a href="{{ $work['salary_slip'] }}" target="_black"
                                                        class="docu-download"><img
                                                            src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a>
                                                </td>
                                                @if ($work['verification_type'] == 'Verified')
                                                    <td><span class="verified-clr"><i class="fa fa-check"></i>
                                                            Verified</span></td>
                                                @else
                                                    <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not
                                                            Verified</span></td>
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
                                        <p>{{ $employeeDetails->decipline }}</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4>Reason for leaving</h4>
                                        <p>{{ $employeeDetails->reason_of_exit }}</p>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <h4>Rating</h4>
                                        <div class="rating-box-pm">
                                            <fieldset class="rating">
                                                <input type="radio" name="textiles-rating" value="5"
                                                    <?php  if ($employeeDetails->rating == '5') { ?> checked <?php } ?> />
                                                <label class="full"></label>
                                                <input type="radio" name="textiles-rating"
                                                    value="4.5"<?php  if ($employeeDetails->rating == '4.5') { ?> checked <?php } ?>>
                                                <label class="half"></label>

                                                <input type="radio" name="textiles-rating" value="4"
                                                    <?php  if ($employeeDetails->rating == '4') { ?> checked <?php } ?> />
                                                <label class="full"></label>
                                                <input type="radio" name="textiles-rating" value="3.5"
                                                    <?php  if ($employeeDetails->rating == '3.5') { ?> checked <?php } ?> />
                                                <label class="half"></label>

                                                <input type="radio" name="textiles-rating" value="3"
                                                    <?php  if ($employeeDetails->rating == '3') { ?> checked <?php } ?> />
                                                <label class="full"></label>
                                                <input type="radio" name="textiles-rating" value="2.5"
                                                    <?php  if ($employeeDetails->rating == '2.5') { ?> checked <?php } ?> />
                                                <label class="half"></label>

                                                <input type="radio" name="textiles-rating" value="2"
                                                    <?php  if ($employeeDetails->rating == '2') { ?> checked <?php } ?> />
                                                <label class="full"></label>
                                                <input type="radio" name="textiles-rating" value="1.5"
                                                    <?php  if ($employeeDetails->rating == '1.5') { ?> checked <?php } ?> />
                                                <label class="half"></label>

                                                <input type="radio" name="textiles-rating" value="1"
                                                    <?php  if ($employeeDetails->rating== '1') { ?> checked <?php } ?> />
                                                <label class="full"></label>
                                                <input type="radio" name="textiles-rating" value="0.5"
                                                    <?php  if ($employeeDetails->rating == '0.5') { ?> checked <?php } ?> />
                                                <label class="half"></label>
                                            </fieldset>
                                            <span class="ml-3">({{ $employeeDetails->rating }})</span>

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

{{-- @foreach ($identity as $iden)
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
        @if ($iden['document'] == null)
        <div class="modal-body">
          <p>Document not uploaded..</p>
        </div>
        @else
        <div class="modal-body">
          <div class="document-body">
              <img src="{{ $iden['document'] }}">
          </div>
          <a href="/download_identity_doc/{{ $iden['id'] }}" target="_black">Download</a>
       </div>
       @endif
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
@endforeach --}}
<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="workhisinfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

@foreach ($workdetails as $item)
    <div class="modal fade custu-modal-popup" id="workofferdocument{{ $item['id'] }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                @if ($item['offer_letter'] == null)
                    <div class="modal-body">
                        <p>Document not uploaded..</p>
                    </div>
                @else
                    <div class="modal-body">
                        <div class="document-body">
                            <img src="{{ $item['offer_letter'] }}">
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

@foreach ($workdetails as $item)
    <div class="modal fade custu-modal-popup" id="workexpdocument{{ $item['id'] }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                @if ($item['exp_letter'] == null)
                    <div class="modal-body">
                        <p>Document not uploaded..</p>
                    </div>
                @else
                    <div class="modal-body">
                        <div class="document-body">
                            <img src="{{ $item['exp_letter'] }}">
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
@foreach ($qualifications as $quali)
    <div class="modal fade custu-modal-popup" id="qualificationdocument{{ $quali['id'] }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                @if ($quali['document'] == null)
                    <div class="modal-body">
                        <p>Document not uploaded..</p>
                    </div>
                @else
                    <div class="modal-body">
                        <div class="document-body">
                            <img src="{{ $quali['document'] }}">
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
@endsection

@section('pagescript')
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write(
        '<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>

@stop
