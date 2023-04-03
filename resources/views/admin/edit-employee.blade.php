@extends('company/layouts.app')
@section('content')
@section('title', 'EVP - Edit-Employee')

<style>
    .error {
        color: red !important;
        font-weight: 400;
    }
  </style>
<!--- Main Container Start ----->
<div class="main-container">

    <div class="main-heading">
        <div class="row">
            <div class="col-md-12">
                <h1>Onboarding</h1>
                <p></p>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-tab-bar">
        <ul class="nav nav-tabs table-responsive-width" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Qualification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Work History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-controls="tab">Identity</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Official Use</a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="" id="edit_basic" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- <input type="hidden" name="id" value="{{ $basic->id }}"> --}}

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="profile-add-img">
                                        <div class="circle">
                                            <img class="profile-pic" id="profile-pic" name="profile"
                                                @if ($basic->profile !== null) value="/image/{{ old('profile', $basic->profile) }}" src="/image/{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/logo.png" @endif
                                                required>
                                        </div>
                                        <div class="p-image ml-auto">
                                            <span class="upload-button" id="upload-button"><img
                                                    src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                                            <input class="file-upload" name="profile" id="file-upload" type="file"
                                                accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="first_name">First Name<span
                                                        style="color:red">*</span></label>
                                                <input type="text" name="first_name"
                                                    @if ($basic) value="{{ old('first_name', $basic->first_name) }}" @endif
                                                    class="form-control" placeholder="Enter Your First Name">
                                                {{-- @error('first_name')
                                                    <span class="text-danger pass">{{ $message }}</span>
                                                @enderror --}}
                                                <strong class="error" id="first_name-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" name="middle_name"
                                                    @if ($basic) value="{{ old('middle_name', $basic->middle_name) }}" @endif
                                                    class="form-control" placeholder="Enter Your Middle Name">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last Name<span style="color:red">*</span></label>
                                                <input type="text" name="last_name"
                                                    @if ($basic) value="{{ old('last_name', $basic->last_name) }}" @endif
                                                    class="form-control" placeholder="Enter Your Last Name">
                                                    <strong class="error" id="last_name-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Official Email Id<span
                                                        style="color:red">*</span></label>
                                                <input type="text" name="email"
                                                    @if ($basic) value="{{ old('email', $basic->email) }}" @endif
                                                    class="form-control" placeholder="Enter Your Email">
                                                    <strong class="error" id="email-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone Number<span
                                                        style="color:red">*</span></label>
                                                <input type="text" name="phone"
                                                    @if ($basic) value="{{ old('phone', $basic->phone) }}" @endif
                                                    class="form-control" placeholder="Enter Your Number">
                                                    <strong class="error" id="phone-error"></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 mt-3">
                                    <h2>Personal</h2>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth<span style="color:red">*</span></label>
                                        <input type="date" name="dob" class="form-control"
                                            @if ($basic) value="{{ old('dob', $basic->dob) }}" @endif
                                            placeholder="DOB">
                                            <strong class="error" id="dob-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Select Blood Group<span style="color:red">*</span></label>

                                        <select class="form-control" name="blood_group" id="blood_group"
                                            @if ($basic) value="{{ old('blood_group', $basic->blood_group) }}" @endif
                                            >
                                            <option
                                                @if ($basic) value="{{ old('blood_group', $basic->blood_group) }}" @endif>
                                                @if ($basic)
                                                    {{ old('dob', $basic->blood_group) }}
                                                @endif
                                            </option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                        <strong class="error" id="blood_group-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Select Gender<span style="color:red">*</span></label>

                                        {{-- <div class="selectBox__value">Select Gender</div> --}}

                                        <select class="form-control" name="gender"
                                            @if ($basic) value="{{ old('gender', $basic->gender) }}" @endif
                                            id="gender">
                                            <option
                                                @if ($basic) value="{{ old('gender', $basic->gender) }}" @endif>
                                                @if ($basic)
                                                    {{ old('gender', $basic->gender) }}
                                                @endif
                                            </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <strong class="error" id="gender-error"></strong>

                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Marital Status<span style="color:red">*</span></label>

                                        <select class="form-control" name="marital_status"
                                            @if ($basic) value="{{ old('marital_status', $basic->marital_status) }}" @endif
                                            id="marital_status">
                                            <option
                                                @if ($basic) value="{{ old('marital_status', $basic->marital_status) }}" @endif>
                                                @if ($basic)
                                                    {{ old('marital_status', $basic->marital_status) }}
                                                @endif
                                            </option>
                                            <option value="Married">Married</option>
                                            <option value="Single">Single</option>
                                        </select>
                                        <strong class="error" id="marital_status-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="current_address">Current Address<span
                                                style="color:red">*</span></label>
                                        <textarea rows="3" name="current_address" placeholder="Address" class="form-control"
                                            @if ($basic) value="{{ old('current_address', $basic->current_address) }}" @endif>
                                            @if ($basic)
                                            {{ old('current_address', $basic->current_address) }}
                                            @endif
                                            </textarea>
                                            <strong class="error" id="current_address-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_address">Permanent Address</label>
                                        <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control"
                                            @if ($basic) value="{{ old('permanent_address', $basic->permanent_address) }}" @endif
                                            >
                                            @if ($basic)
                                            {{ old('permanent_address', $basic->permanent_address) }}
                                            @endif
                                          </textarea>
                                          <strong class="error" id="permanent_address-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-12 mt-3">
                                    <h2>Emergency Contact<span style="color:red">*</span></h2>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="emg_name">Name<span style="color:red">*</span></label>
                                        <input type="text" name="emg_name"
                                            @if ($basic) value="{{ old('emg_name', $basic->emg_name) }}" @endif
                                            class="form-control" placeholder="Enter Name">
                                            <strong class="error" id="emg_name-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="emg_relationship">Relationship<span
                                                style="color:red">*</span></label>
                                        <input type="text" name="emg_relationship"
                                            @if ($basic) value="{{ old('emg_relationship', $basic->emg_relationship) }}" @endif
                                            class="form-control" placeholder="Enter Relation">
                                            <strong class="error" id="emg_relationship-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="emg_phone">Phone Number<span style="color:red">*</span></label>
                                        <input type="text" name="emg_phone"
                                            @if ($basic) value="{{ old('emg_phone', $basic->emg_phone) }}" @endif
                                            class="form-control" placeholder="Number">
                                            <strong class="error" id="emg_phone-error"></strong>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="emg_address">Address<span style="color:red">*</span></label>
                                        <textarea rows="3" name="emg_address" class="form-control"
                                            @if ($basic) value="{{ old('emg_address', $basic->emg_address) }}" @endif>
                                            @if ($basic)
                                            {{ old('emg_address', $basic->emg_address) }}
                                            @endif
                                        </textarea>
                                        <strong class="error" id="emg_address-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="add-btn-part">
                                {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                                <button type="submit" name="basic-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="tab-pane" id="tabs-2" role="tabpanel">

                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                  <h2>Identity Details</h2>
                              </div>
                              @if ($identity)
                                        <div class="col-xl-12">
                                            <div class="eml-per-main">
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
                                                            @foreach($ident_item as $item)
                                                            <tr>
                                                                <td>{{ $item['id_type'] }}</td>
                                                                <td>{{ $item['id_number'] }}</td>
                                                                @if($item['verification_type'] == 'Verified')
                                                                <td><span class="verified-clr"><i
                                                                     class="fa fa-check"></i>{{ $item['verification_type'] }}</span>
                                                                </td>
                                                                @else
                                                                 <td><span class="not-verified-clr"><i
                                                                    class="fa fa-times"></i>{{ $item['verification_type'] }}</span>
                                                                 </td>
                                                                 @endif
                                                                <td>
                                                                    <span class="d-flex tbl-iconBx">
                                                                        <a href="#" target="_black"
                                                                            class="docu-down" data-toggle="modal"
                                                                            data-target="#exampleModaldocument{{$item['id']}}"><img
                                                                                src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                        <a href="/image/{{ $item['document'] }}"
                                                                            target="_black" class="docu-download"><img
                                                                                src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                                                        <button type="button" class="border-none"
                                                                            data-toggle="modal"
                                                                            data-target="#identityEdit{{$item['id']}}"><img
                                                                                src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                          </table>
                                                   

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <p class="no-data-clg">No Data Available</p>
                                          
                                       @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{-- <div class="add-btn-part">
                              <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                          
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal"
                                                    data-target="#qualificationAdd">
                                                    {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                </span></h2>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="eml-per-main">
                                                <div class="table-responsive">
                                                 
                                                    @if ($qualification)
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
                                                            @foreach($qual_item as $item)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $item['degree'] }}</td>
                                                                    <td>{{ $item['inst_name'] }}</td>
                                                                    <td>{{ $item['subject'] }}</td>
                                                                    <td>{{ $item['duration_from'] }}</td>
                                                                    <td>{{ $item['duration_to'] }}</td>
                                                                    @if($item['verification_type'] == 'Verified')
                                                                    <td><span class="verified-clr"><i
                                                                                class="fa fa-check"></i>
                                                                            {{ $item['verification_type'] }}</span>
                                                                    </td>
                                                                    @else
                                                                    <td><span class="not-verified-clr"><i
                                                                            class="fa fa-times"></i>
                                                                        {{ $item['verification_type'] }}</span>
                                                                    </td>
                                                                    @endif
                                                                    <td>
                                                                      
                                                                        <a href="#" target="_black"
                                                                            class="docu-down" data-toggle="modal"
                                                                            data-target="#qualificationdocument{{$item['id']}}"><img
                                                                                src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                        <a href="/image/{{ $qualification->document }}"
                                                                            target="_black" class="docu-download"><img
                                                                                src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                                                        <button type="button" class="border-none"
                                                                            data-toggle="modal"
                                                                            data-target="#qualificationEdit{{$item['id']}}"><img
                                                                                src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                            @endforeach
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                        @else
                                                        <p class="no-data-clg">No Data Available</p>
                                                       
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{-- <div class="add-btn-part">
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-4" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($workhistory)
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h2>Work History <span class="ml-auto on-head-right"
                                                        data-toggle="modal" data-target="#workHistorybtn">
                                                        {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                    </span></h2>
                                            </div>
                                            {{-- <p class="no-data-clg">No Data Available</p>   --}}

                                            <div class="col-xl-12">
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                              
                                                                <tr>
                                                                    <th>Company Name</th>
                                                                    <th>From</th>
                                                                    <th>To</th>
                                                                    <th>Designation</th>
                                                                    <th>Offer Letter</th>
                                                                    <th>Experience</th>
                                                                    <th>Salary Slips</th>
                                                                    <th>Verification</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach($work_item as $item)
                                                            <tr>
                                                                <td>{{ $item['com_name'] }}</td>
                                                                <td>{{ $item['work_duration_from'] }}</td>
                                                                <td>{{ $item['work_duration_to'] }}</td>
                                                                <td>{{ $item['designation'] }}</td>
                                                                <td><a href="#" target="_black"
                                                                        class="docu-down" data-toggle="modal"
                                                                        data-target="#workofferdocument{{$item['id']}}"><img
                                                                            src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                </td>
                                                                <td><a href="#" target="_black"
                                                                        class="docu-down" data-toggle="modal"
                                                                        data-target="#workexpdocument{{$item['id']}}"><img
                                                                            src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                </td>
                                                                <td><a href="#"
                                                                        target="_black" class="docu-download"><img
                                                                            src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a>
                                                                </td>
                                                                @if($item['verification_type'] == 'Verified')
                                                                <td><span class="verified-clr"><i
                                                                            class="fa fa-check"></i>
                                                                        {{ $item['verification_type'] }}</span>
                                                                </td>
                                                                @else
                                                                <td><span class="not-verified-clr"><i
                                                                    class="fa fa-times"></i>
                                                                {{ $item['verification_type'] }}</span>
                                                                </td>
                                                                @endif
                                                                <td><button type="button" class="border-none"
                                                                        data-toggle="modal"
                                                                        data-target="#workHistoryedit{{$item['id']}}"><img
                                                                            src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{-- <div class="add-btn-part">
                              <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
                            </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <p>No data Available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-5" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($skills)
                                    <form>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="col-xl-12">
                                                    <h2>Skills <span class="ml-auto on-head-right" data-toggle="modal"
                                                            data-target="#skillsAdd{{ $skills->id }}">
                                                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                        </span></h2>
                                                </div>
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Skill Name</th>
                                                                    <th>Competency Levels</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($skill_item as $item)
                                                                
                                                            <tr>
                                                                <td>{{ $item['skill'] }}</td>
                                                                <td>{{ $item['skill_type'] }}</td>
                                                              
                                                                <td><button type="button" class="border-none"
                                                                        data-toggle="modal"
                                                                        data-target="#skillsAdd{{ $item['id'] }}"><img
                                                                            src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="col-xl-12">
                                                    <h2>known Language <span class="ml-auto on-head-right"
                                                            data-toggle="modal" data-target="#skillsLanguageAdd">
                                                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                        </span></h2>
                                                </div>
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Konwn language</th>
                                                                    <th>Competency Levels</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($lang_item as $item)
                                                                
                                                           
                                                            <tr>
                                                                <td>{{ $item['lang'] }}</td>
                                                                <td>{{ $item['lang_type'] }}</td>
                                                                <td><button type="button" class="border-none"
                                                                        data-toggle="modal"
                                                                        data-target="#langskillsAdd{{$item['id']}}"><img
                                                                            src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="add-btn-part">
                                                        <button type="button" class="btn-secondary-cust"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn-primary-cust"
                                                            data-dismiss="modal">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </form>
                                @else
                                    <p>No Data Available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-6" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">

                                <form method="post" id="edit_official" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Official Info</h2>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Employee ID<span style="color:red">*</span></label>
                                                <input type="text"
                                                    @if ($official) value="#00{{ old('emp_id', $official->emp_id) }}" @endif
                                                    name="emp_id" class="form-control" placeholder="Id Number"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Date of Joining<span style="color:red">*</span></label>
                                                <input type="date"
                                                    @if ($official) value="{{ old('doj', $official->doj) }}" @endif
                                                    name="doj" class="form-control" placeholder="Date">
                                                    <strong class="error" id="doj-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Probation Period<span style="color:red">*</span></label>
                                                <input type="text"
                                                    @if ($official) value="{{ old('prob_period', $official->prob_period) }}" @endif
                                                    name="prob_period" class="form-control" placeholder="In Day">
                                                    <strong class="error" id="prob_period-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Employee Type<span style="color:red">*</span></label>
                                                <select class="form-control" name="emp_type" id="emp_type" required>
                                                    <option name="emp_type"
                                                        @if ($official) value="{{ old('emp_type', $official->emp_type) }}" @endif>
                                                        @if ($official)
                                                            {{ old('emp_type', $official->emp_type) }}
                                                        @endif
                                                    </option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Trainee">Trainee</option>
                                                    <option value="Freelancer">Freelancer</option>
                                                </select>
                                                <strong class="error" id="emp_type-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Work Location<span style="color:red">*</span></label>
                                                <select class="form-control" name="work_location" id="work_location"
                                                    required>
                                                    <option name="work_location"
                                                        @if ($official) value="{{ old('work_location', $official->work_location) }}" @endif>
                                                        @if ($official)
                                                            {{ old('work_location', $official->work_location) }}
                                                        @endif
                                                    </option>
                                                    <option value="Bhopal, MP">Bhopal, MP</option>
                                                    <option value="Indore, MP">Indore, MP</option>
                                                    <option value="Pune, MH">Pune, MH</option>-

                                                </select>
                                                <strong class="error" id="work_location-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Employee Status<span style="color:red">*</span></label>
                                                <select name="emp_status" class="form-control" id="emp_status">
                                                    <option name="emp_status"
                                                        @if ($official) value="{{ old('emp_status', $official->emp_status) }}" @endif>
                                                        @if ($official)
                                                            {{ old('emp_status', $official->emp_status) }}
                                                        @endif
                                                    </option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <strong class="error" id="emp_status-error"></strong>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 mt-3">
                                            <h2>Salary Info</h2>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Salary<span style="color:red">*</span></label>
                                                <input type="text"
                                                    @if ($official) value="{{ old('salart_info', $official->salart_info) }}" @endif
                                                    name="salart_info" class="form-control" placeholder="In Hand">
                                                    <strong class="error" id="salart_info-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>LPA<span style="color:red">*</span></label>
                                                <input type="text"
                                                    @if ($official) value="{{ old('lpa', $official->lpa) }}" @endif
                                                    name="lpa" class="form-control" placeholder="Enter LPA">
                                                    <strong class="error" id="lpa-error"></strong>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="row salary-bg-on">
                                                <div class="col-xl-12">
                                                    <h6 class="d-flex">Appraisal <span class="ml-auto on-head-right"
                                                            data-toggle="modal" data-target="#salaryaddbtn">
                                                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                        </span></h6>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>From<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('app_from', $official->app_from) }}" @endif
                                                            name="app_from" class="form-control"
                                                            placeholder="10,000">
                                                            <strong class="error" id="app_from-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>To<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('app_to', $official->app_to) }}" @endif
                                                            name="app_to" class="form-control" placeholder="To">
                                                            <strong class="error" id="app_to-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Last Desig.<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('last_app_desig', $official->last_app_desig) }}" @endif
                                                            name="last_app_desig" class="form-control"
                                                            placeholder="Last Desig.">
                                                            <strong class="error" id="last_app_desig-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Current Desig.<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('current_app_desig', $official->current_app_desig) }}" @endif
                                                            name="current_app_desig" class="form-control"
                                                            placeholder="Current Desig.">
                                                            <strong class="error" id="current_app_desig-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Date<span style="color:red">*</span></label>
                                                        <input type="date"
                                                            @if ($official) value="{{ old('app_date', $official->app_date) }}" @endif
                                                            name="app_date" class="form-control" placeholder="Date">
                                                            <strong class="error" id="app_date-error"></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 ">
                                            <div class="row salary-bg-on">
                                                <div class="col-xl-12">
                                                    <h6 class="d-flex"> Promotion <span class="ml-auto on-head-right"
                                                            data-toggle="modal" data-target="#salaryaddbtn">
                                                            {{-- <img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> --}}
                                                        </span></h6>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>From<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('pro_from', $official->pro_from) }}" @endif
                                                            name="pro_from" class="form-control"
                                                            placeholder="10,000">
                                                            <strong class="error" id="pro_from-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>To<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('pro_to', $official->pro_to) }}" @endif
                                                            name="pro_to" class="form-control" placeholder="To">
                                                            <strong class="error" id="pro_to-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Last Desig.<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('last_pro_desig', $official->last_pro_desig) }}" @endif
                                                            name="last_pro_desig" class="form-control"
                                                            placeholder="Last Desig.">
                                                            <strong class="error" id="last_pro_desig-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Current Desig.<span style="color:red">*</span></label>
                                                        <input type="text"
                                                            @if ($official) value="{{ old('current_pro_desig', $official->current_pro_desig) }}" @endif
                                                            name="current_pro_desig" class="form-control"
                                                            placeholder="Current Desig.">
                                                            <strong class="error" id="current_pro_desig-error"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-4 col-md-12">
                                                    <div class="form-group">
                                                        <label>Date<span style="color:red">*</span></label>
                                                        <input type="date"
                                                            @if ($official) value="{{ old('pro_date', $official->pro_date) }}" @endif
                                                            name="pro_date" class="form-control" placeholder="Date">
                                                            <strong class="error" id="pro_date-error"></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-xl-12 mt-3"><h2>Reporting Manager</h2></div> -->


                                        <div class="col-xl-12">
                                            <div class="form-group repo-mange-box mt-3">
                                                <h2>Reporting Manager</h2>
                                                <div class="row customer_recordsoff">
                                                    <div class="col-xl-3 col-lg-5 col-md-10">
                                                        <div class="form-group">
                                                            <label>Name<span style="color:red">*</span></label>
                                                            <input type="text"
                                                                @if ($official) value="{{ old('mang_name', $official->mang_name) }}" @endif
                                                                name="mang_name" class="form-control"
                                                                placeholder="Name">
                                                                <strong class="error" id="mang_name-error"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-5 col-md-10">
                                                        <div class="form-group">
                                                            <label>Type<span style="color:red">*</span></label>
                                                            {{-- <div class="selectBox active form-control">
                                    <div class="selectBox__value">Type</div>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item active">Type</a>
                                      <a class="dropdown-item">Primary</a>
                                      <a class="dropdown-item">Secondary</a>
                                    </div>
                                  </div> --}}
                                                            <select name="mang_type" class="form-control"
                                                                id="mang_type">
                                                                <option name="mang_type"
                                                                    @if ($official) value="{{ old('mang_type', $official->mang_type) }}" @endif>
                                                                    @if ($official)
                                                                        {{ old('mang_type', $official->mang_type) }}
                                                                    @endif
                                                                </option>
                                                                <option value="Primary">Primary</option>
                                                                <option value="Secondary">Secondary</option>
                                                            </select>
                                                            <strong class="error" id="mang_type-error"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-5 col-md-10">
                                                        <div class="form-group">
                                                            <label>Department<span style="color:red">*</span></label>
                                                            <input type="text"
                                                                @if ($official) value="{{ old('mang_dept', $official->mang_dept) }}" @endif
                                                                name="mang_dept" class="form-control"
                                                                placeholder="Department">
                                                                <strong class="error" id="mang_dept-error"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-5 col-md-10">
                                                        <div class="form-group">
                                                            <label>Designation<span style="color:red">*</span></label>
                                                            <input type="text"
                                                                @if ($official) value="{{ old('mang_desig', $official->mang_desig) }}" @endif
                                                                name="mang_desig" class="form-control"
                                                                placeholder="Designation">
                                                                <strong class="error" id="mang_desig-error"></strong>
                                                        </div>
                                                    </div>
                                                    {{-- <a class="add-plus extra-fields-customeroff"><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                                                </div>
                                                <div class="customer_records_dynamicoff"></div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="add-btn-part">
                                                    {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                                    <button type="submit" name="official-edit"
                                                        class="btn-primary-cust">Save Changes</button>
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
        </div>
    </div>

</div>
<!--- Main Container Close ----->


<!-- The Modal Skills Add -->
@foreach($skill_item as $item)
<div class="modal fade custu-modal-popup" id="skillsAdd{{$item['id']}}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Skills</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" id="edit_skill" enctype="multipart/form-data">
                        @csrf
                       
                        <input type="hidden" name="id" value="{{$item['id']}}">
                        <div class="form-group inputtag-custom">
                            <label>Edit Skill<span style="color:red">*</span></label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                   
                                    <input type="text" class="form-control input-search-box typeahead"
                                    @if ($item) value="{{ old('skill', $item['skill']) }}" @endif 
                                        name="skill" data-provide="typeahead" placeholder="Language">
                                        <strong class="error" id="skill-error"></strong>
                                        
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                     
                                        <span><input type="radio" id="customRadioInline4" name="skill_type"
                                                value="Beginner"  <?php  if ($item['skill_type'] == 'Beginner') { ?> checked <?php } ?> 
                                                class="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>

                                        <span><input type="radio" id="customRadioInline5" name="skill_type"
                                                value="Intermediate" <?php if ($item['skill_type'] == 'Intermediate') { ?> checked <?php } ?> 
                                                class="">
                                            <label class="" for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" id="customRadioInline6" name="skill_type"
                                                value="Expert" <?php if ($item['skill_type'] == 'Expert') { ?> checked <?php } ?> 
                                                class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                        
                                    </h6>
                                </div>
                                {{-- <a class="add-plus extra-fields-customer" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a> --}}
                            </div>
                            <div class="customer_records_dynamic"></div>
                            <div class="modal-footer">
                                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                                <button type="submit" name="skill-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>
                        </div>
                        
                </div>
            </form>
            </div>
           
        </div>
    </div>
 </div>
 @endforeach

<!-- The Modal language Skills Add -->
@foreach($lang_item as $item)
<div class="modal fade custu-modal-popup" id="langskillsAdd{{$item['id']}}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Language Skill</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" id="edit_lang" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$item['id']}}">
                        <div class="form-group inputtag-custom">
                            <label>Edit Language<span style="color:red">*</span></label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" class="form-control input-search-box typeahead"
                                        @if ($item) value="{{ old('lang', $item['lang']) }}" @endif
                                        name="lang" data-provide="typeahead" placeholder="Language">
                                        <strong class="error" id="lang-error"></strong>
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" id="customRadioInline4" name="lang_type"
                                                value="Beginner" <?php if ($item['lang_type'] == 'Beginner') { ?> checked <?php } ?>
                                                class="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>

                                        <span><input type="radio" id="customRadioInline5" name="lang_type"
                                                class="" value="Intermediate" <?php if ($item['lang_type'] == 'Intermediate') { ?> checked
                                                <?php } ?>>
                                            <label class="" for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" id="customRadioInline6" name="lang_type"
                                                value="Expert" <?php if ($item['lang_type'] == 'Expert') { ?> checked <?php } ?>
                                                class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                                <a class="add-plus extra-fields-customer">
                                    {{-- <span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span> --}}
                                </a>
                            </div>
                            <div class="customer_records_dynamic"></div>
                            <div class="modal-footer">
                                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                                <button type="submit" name="skilllang-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>
                        </div>
                        
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- The Modal Identity Add -->
<div class="modal fade custu-modal-popup" id="identityAdd" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Identity</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Id Type<span style="color:red">*</span></label>
                                    <div class="selectBox active form-control">
                                        <div class="selectBox__value">Id Type</div>
                                        <div class="dropdown-menu" id="style-5">
                                            <a class="dropdown-item active">Id Type</a>
                                            <a class="dropdown-item">Pan Card</a>
                                            <a class="dropdown-item">Aadhar Card</a>
                                            <a class="dropdown-item">voter Id</a>
                                        </div>
                                    </div>
                                    <strong class="error" id="lang-error"></strong>
                                </div>
                                <div class="col-md-6">
                                    <label>Id Number<span style="color:red">*</span></label>
                                    <input type="text" name="" class="form-control" placeholder="Number">
                                    <strong class="error" id="lang-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Upload Document</label>
                                    <div class="upload-img-file">
                                        <div class="circle">
                                            <img class="profile-pic" id="profile-pic1"
                                                src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                                        </div>
                                        <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                        <div class="p-image ml-auto">
                                            <span class="upload-button" id="upload-button1">Choose File</span>
                                            <input class="file-upload" id="file-upload1" type="file"
                                                accept="image/jpg,image/png,image/pdf">
                                        </div>
                                    </div>
                                    {{-- <strong class="error" id="lang-error"></strong> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Verification<span style="color:red">*</span></label>
                                    <div class="selectBox active form-control">
                                        <div class="selectBox__value">Verification Type</div>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item active">Verification Type</a>
                                            <a class="dropdown-item">Verified</a>
                                            <a class="dropdown-item">Not Verified</a>
                                        </div>
                                    </div>
                                    <strong class="error" id="lang-error"></strong>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Identity Edit -->
@foreach($ident_item as $item)
<div class="modal fade custu-modal-popup" id="identityEdit{{$item['id']}}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Identity</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                   
                        <form method="post" id="edit_identity" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value={{$item['id']}}>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Id Type<span style="color:red">*</span></label>
                                        <select class="form-control" name="id_type" id="id_type">
                                            <option
                                                @if ($item) value="{{ old('id_type', $item['id_type']) }}" @endif>
                                                @if ($item)
                                                    {{ old('id_type', $item['id_type']) }}
                                                @endif
                                            </option>
                                            <option value="Pan Card">Pan Card</option>
                                            <option value="Aadhar Card">Aadhar Card</option>
                                            <option value="Voter Id">Voter Id</option>
                                        </select>
                                        <strong class="error" id="id_type-error"></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Id Number<span style="color:red">*</span></label>
                                        <input type="text" name="id_number"
                                            @if ($item) value="{{ old('id_number', $item['id_number']) }}" @endif
                                            class="form-control">
                                            <strong class="error" id="id_number-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Upload Document</label>
                                        <div class="upload-img-file">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic2" name="document"
                                                    @if ($item['document'] !== null) value="/image/{{ old('document', $item['document']) }}" src="/image/{{ $item['document'] }}" @else src="{{ asset('assets') }}/admin/images/pan-card.png" @endif>
                                            </div>
                                            <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                            {{-- <div class="p-image ml-auto">
                                                <span class="upload-button" id="upload-button2">Choose File</span>
                                                <input class="file-upload" name="document" id="file-upload2"
                                                    type="file" accept="image/*">
                                                    <strong class="error" id="document-error"></strong>
                                            </div> --}}
                                                 <div class="upload-img-file">
                                                <input type="file" id="document" name="document" class="form-control" accept="image/jpg,image/doc,image/pdf"/>
                                                {{-- <strong class="error" id="document-error"></strong> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Verification<span style="color:red">*</span></label>
                                        <select class="form-control" name="verification_type" id="verification_type">
                                            <option
                                                @if ($item) value="{{ old('verification_type', $item['verification_type']) }}" @endif>
                                                @if ($item)
                                                    {{ old('verification_type', $item['verification_type']) }}
                                                @endif
                                            </option>
                                            <option value="Verified">Verified</option>
                                            <option value="Not Verified">Not Verified</option>
                                        </select>
                                        <strong class="error" id="verification_type-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                                <button type="submit" name="identity-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>
                      </div>
                  </div>
                 </form>
               
        </div>
    </div>
</div>
@endforeach


<!-- The Modal Qualification Add -->

<div class="modal fade custu-modal-popup" id="qualificationAdd{{$item['id']}}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Qualification</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>School/College/Institute<span style="color:red">*</span></label>
                                    <input type="text" name="inst_name" class="form-control"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Degree<span style="color:red">*</span></label>
                                    <input type="text" name="degree"
                                        @if ($item) value="{{ old('degree', $item->degree) }}" @endif
                                        class="form-control" placeholder="Ex. Bachelor's">
                                </div>
                                <div class="col-md-6">
                                    <label>Subject<span style="color:red">*</span></label>
                                    <input type="text" name="subject"
                                        @if ($item) value="{{ old('subject', $item->subject) }}" @endif
                                        class="form-control" placeholder="Ex. CS">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>From<span style="color:red">*</span></label>
                                    <input type="date" name="duration_from" class="form-control"
                                        @if ($item) value="{{ old('duration_from', $item->duration_from) }}" @endif
                                        placeholder="From">
                                </div>
                                <div class="col-md-6">
                                    <label>To<span style="color:red">*</span></label>
                                    <input type="date" name="duration_to" class="form-control"
                                        @if ($item) value="{{ old('duration_to', $item->duration_to) }}" @endif
                                        placeholder="To">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Upload Document</label>
                                    <div class="upload-img-file">
                                        <div class="circle">
                                            <img class="profile-pic" id="profile-pic3"
                                                src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                                        </div>
                                        <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                        <div class="p-image ml-auto">
                                            <span class="upload-button" id="upload-button3">Choose File</span>
                                            <input class="file-upload" name="document" id="file-upload3"
                                                type="file" accept="image/jpg,image/doc,image/pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Verification<span style="color:red">*</span></label>
                                    <select class="form-control" name="verification_type" id="verification_type">
                                        <option
                                            @if ($item) value="{{ old('verification_type', $item->verification_type) }}" @endif>
                                            @if ($item)
                                                {{ old('verification_type', $item->verification_type) }}
                                            @endif
                                        </option>
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
                <button type="submit" class="btn-primary-cust">Save</button>
            </div>
        </div>
    </form>
    </div>
</div>


<!-- The Modal Qualification Edit -->
@foreach($qual_item as $item)
<div class="modal fade custu-modal-popup" id="qualificationEdit{{$item['id']}}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Qualification</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
        
                <div class="modal-body">
                    <div class="comman-body">
                        <form method="post" id="edit_qualification"enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$item['id']}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>School/College/Institute<span style="color:red">*</span></label>
                                        <input type="text" name="inst_name"
                                            @if ($item) value="{{ old('inst_name', $item['inst_name']) }}" @endif
                                            class="form-control" placeholder="Enter Name">
                                            <strong class="error" id="inst_name-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Degree<span style="color:red">*</span></label>
                                        <input type="text" name="degree"
                                            @if ($item) value="{{ old('degree', $item['degree']) }}" @endif
                                            class="form-control" placeholder="Ex. Bachelor's">
                                            <strong class="error" id="degree-error"></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Field Of study<span style="color:red">*</span></label>
                                        <input type="text" name="subject"
                                            @if ($item) value="{{ old('subject', $item['subject']) }}" @endif
                                            class="form-control" placeholder="Ex. CS">
                                            <strong class="error" id="subject-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>From<span style="color:red">*</span></label>
                                        <input type="date" name="duration_from" class="form-control"
                                            @if ($item) value="{{ old('duration_from', $item['duration_from']) }}" @endif
                                            placeholder="From">
                                            <strong class="error" id="duration_from-error"></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <label>To<span style="color:red">*</span></label>
                                        <input type="date" name="duration_to" class="form-control"
                                            @if ($item) value="{{ old('duration_to', $item['duration_to']) }}" @endif
                                            placeholder="From">
                                            <strong class="error" id="duration_to-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Upload Document</label>
                                        <div class="upload-img-file">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic4" name="document"
                                                    @if ($item['document'] !== null) value="/image/{{ old('document', $item['document']) }}" src="/image/{{ $item['document'] }}" @else src="{{ asset('assets') }}/admin/images/file-icon-img.png" @endif />
                                            </div>
                                            <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                            <div class="upload-img-file">
                                                <input type="file" id="document" name="document" class="form-control" accept="image/jpg,image/doc,image/pdf"/>
                                                {{-- <strong class="error" id="document-error"></strong> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Verification<span style="color:red">*</span></label>
                                        <select class="form-control" name="verification_type" id="verification_type">
                                            <option @if ($item) value="{{ old('verification_type', $item['verification_type']) }}" @endif>
                                                @if ($item)
                                                    {{ old('verification_type', $item['verification_type']) }}
                                                @endif
                                            </option>
                                            <option value="Verified">Verified</option>
                                            <option value="Not Verified">Not Verified</option>
                                        </select>
                                        <strong class="error" id="verification_type-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                                <button type="submit" name="qualification-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>
                    </div>
                </div>
            </form>
          
        </div>
    </div>
</div>

@endforeach

<!-- The Modal Docum INFO-->
@foreach($qual_item as $item)
<div class="modal fade custu-modal-popup" id="qualificationdocument{{$item['id']}}" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            @if($item['document'] == Null)
            <div class="modal-body">
              <p>Document not uploaded..</p>
            </div>
            @else
            <div class="modal-body">
              <div class="document-body">
                  <img src="/image/{{ $item['document'] }}">
              </div>
              <a href="/download_qualification_doc/{{ $item['id'] }}" target="_black">Download</a>
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

@foreach($work_item as $item)
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

@foreach($work_item as $item)
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
<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="qualificationinfo" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
                <h1>No Data Available</h1>
                <p>Upload your document file</p>
                <a data-dismiss="modal" data-toggle="modal" data-target="#qualificationEdit">Ok</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Docum INFO-->
@foreach($ident_item as $item)
<div class="modal fade custu-modal-popup" id="exampleModaldocument{{$item['id']}}" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Pan Card</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            @if($item['document'] == Null)
            <div class="modal-body">
              <p>Document not uploaded..</p>
            </div>
            @else
            <div class="modal-body">
              <div class="document-body">
                  <img src="/image/{{ $item['document'] }}">
              </div>
              <a href="/download_identity_doc/{{ $item['id'] }}" target="_black">Download</a>
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
<div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
                <h1>No Data Available</h1>
                <p>Upload your document file</p>
                <a data-dismiss="modal" data-toggle="modal" data-target="#identityEdit">Ok</a>
            </div>
        </div>
    </div>
</div>
<!-- The Modal Work Work HistoryBasic Edit -->
@foreach($work_item as $item)
<div class="modal fade custu-modal-popup" id="workHistoryedit{{$item['id']}}" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Work History</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            @if ($workhistory)
                <div class="modal-body">
                    <div class="comman-body">
                        <form method="post" id="edit_workhistory" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$item['id']}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Company Name<span style="color:red">*</span></label>
                                        <input type="text" name="com_name"
                                            @if ($item) value="{{ old('com_name', $item['com_name']) }}" @endif
                                            class="form-control" value="ByteCipher">
                                            <strong class="error" id="com_name-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Form<span style="color:red">*</span></label>
                                        <input type="date" name="work_duration_from"
                                            @if ($item) value="{{ old('work_duration_from', $item['work_duration_from']) }}" @endif
                                            class="form-control" value="2018">
                                            <strong class="error" id="work_duration_from-error"></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <label>To<span style="color:red">*</span></label>
                                        <input type="date" name="work_duration_to"
                                            @if ($item) value="{{ old('work_duration_to', $item['work_duration_to']) }}" @endif
                                            class="form-control" value="2020">
                                            <strong class="error" id="work_duration_to-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Designation<span style="color:red">*</span></label>
                                        <input type="text" name="designation"
                                            @if ($item) value="{{ old('designation', $item['designation']) }}" @endif
                                            class="form-control" value="React Native Developer">
                                            <strong class="error" id="designation-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Offer Letter</label>
                                        <div class="upload-img-file">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic8"
                                                    @if ($item['offer_letter'] !== null) value="/image/{{ old('document', $item['offer_letter']) }}" src="/image/{{ $item['offer_letter'] }}" @else src="{{ asset('assets') }}/admin/images/job-offer-letter.png" @endif>
                                            </div>
                                            <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                            <div class="upload-img-file">
                                                <input type="file" id="offer_letter" name="offer_letter" class="form-control" accept="image/jpg,image/doc,image/pdf"//>
                                                {{-- <strong class="error" id="offer_letter-error"></strong> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Experience Letter</label>
                                        <div class="upload-img-file">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic9"
                                                    @if ($item['exp_letter'] !== null) value="/image/{{ old('exp_letter', $item['exp_letter']) }}" src="/image/{{ $item['exp_letter'] }}" @else src="{{ asset('assets') }}/admin/images/job-offer-letter.png" @endif>
                                            </div>
                                            <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                            <div class="upload-img-file">
                                                <input type="file" id="exp_letter" name="exp_letter" class="form-control" accept="image/jpg,image/doc,image/pdf"//>
                                                <strong class="error" id="exp_letter-error"></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Salary Slips</label>
                                        <div class="upload-img-file">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic10"
                                                    @if ($item['salary_slip'] !== null) value="/image/{{ old('salary_slip', $item['salary_slip']) }}" src="/image/{{ $item['salary_slip'] }}" @else src="{{ asset('assets') }}/admin/images/pdf-icon.png" @endif>
                                            </div>
                                            <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                            <div class="upload-img-file">
                                                <input type="file" id="salary_slip" name="salary_slip" class="form-control"/>
                                                <strong class="error" id="salary_slip-error"></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Verification<span style="color:red">*</span></label>
                                        <select class="form-control" name="verification_type"
                                            id="verification_type">
                                            <option
                                                @if ($item) value="{{ old('verification_type', $item['verification_type']) }}" @endif>
                                                @if ($item)
                                                    {{ old('verification_type', $item['verification_type']) }}
                                                @endif
                                            </option>
                                            <option value="Verified">Verified</option>
                                            <option value="Not Verified">Not Verified</option>
                                        </select>
                                        <strong class="error" id="verification_type-error"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                {{-- <button type="Submit" name="identity-edit" class="btn-primary-cust" data-dismiss="modal">Save Changes</button> --}}
                                <button type="submit" name="workhistory-edit" class="btn-primary-cust">Save
                                    Changes</button>
                            </div>
                    </div>
                </form>
                </div>
           
            @else
                <p>No Data Available</p>
            @endif
        </div>
    </div>
</div>

@endforeach


<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="workhisinfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth">
                <h1>No Data Available</h1>
                <p>Upload your document file</p>
                <a data-dismiss="modal" data-toggle="modal" data-target="#workHistoryedit">Ok</a>
            </div>
        </div>
    </div>
</div>


 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script>
        window.jQuery || document.write('<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
      </script> --}}
      <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
      <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
     <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script>
     
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

    $input.change(function() {
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
    $input.change(function() {
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
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
        );
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
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
        );
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
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
        );
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

<script>
    $(document).ready(function() {

        $("#edit_qualification").validate({
         rules: {
           inst_name: "required",
           degree: "required",
           subject: "required",
           duration_from: "required",
           duration_to: "required",
           verification_type: "required",
        //    document: "required",
         },

         messages: {
           inst_name: "Institute name is required",
           degree: "Degree is required",
           subject: "Subject is required",
           duration_from: "Duration date is required",
           duration_to: "Duration to is required",
           verification_type: "Verification type is required",
        //    document: "Document is required",
         }
      });

      $("#edit_basic").validate({
         rules: {
           first_name: "required",
           last_name: "required",
           email: "required",
           blood_group: "required",
           gender: "required",
           dob: "required",
           phone: "required",           
           emg_phone: "required",
           permanent_address: "required",
           current_address: "required",
           marital_status: "required",
           emg_name: "required",
           emg_relationship: "required",
           emg_address: "required",
         },

         messages: {
           first_name: "First name is required",
           last_name: "Last name is required",
           email: "Email is required",
           blood_group: "Blood group is required",
           gender: "Gender to is required",
           dob: "Date of birth is required",
           phone: "Phone number is required",
           emg_phone: "Emergency phone number is required",
           permanent_address: "Permanent address is required",
           current_address: "Current address is required",
           marital_status: "Marital status is required",
           emg_name: "Emergency name is required",
           emg_relationship: "Emergency relationship is required",
           emg_address: "Emergency address is required",
         }
      });

      $("#edit_official").validate({
         rules: {
           doj: "required",
           prob_period: "required",
           emp_type: "required",
           work_location: "required",
           emp_status: "required",
           salary: "required",
           lpa: "required",
           app_from: "required",
           app_to: "required",
           pro_to: "required",
           last_app_desig: "required",
           current_pro_desig: "required",
           pro_date: "required",
           pro_from:"required",
           mang_name: "required",
           mang_type: "required",
           mang_dept: "required",
           mang_desig: "required",
           current_app_desig: "required",
           app_date:"required",
           last_pro_desig: "required",
         },

         messages: {
           doj: "Date of joining is required",
           prob_period: "Probation period is required",
           emp_type: "Employee type is required",
           work_location: "Work location is required",
           emp_status: "Employee status to is required",
           salary: "Salary is required",
           lpa: "LPA is required",
           app_from: "Appraisal from is required",
           app_to: "Appraisal to is required",
           pro_to: "Promotion to is required",
           pro_from:"Promotion from is required",
           last_app_desig: "Last appraisal designationis required",
           last_pro_desig: "Last promotion designation is required",
           current_pro_desig: "Current promotion designation is required",
           pro_date: "Promotion date is required",
           mang_name: "Manager name is required",
           mang_type: "Manager type is required",
           mang_dept: "Manager department is required",
           mang_desig: "Manager designation is required",
           current_app_desig: "Current apprasial designation is required",
           app_date: "Apprasial date is required",
         }
      });

      $("#edit_workhistory").validate({
         rules: {
           com_name: "required",
           designation: "required",
           work_duration_to: "required",
           work_duration_from: "required",
        //    offer_letter: "required",
           verification_type: "required",
        //    exp_letter: "required",
        //    salary_slip: "required",

         },

         messages: {
           com_name: "Company name is required",
           designation: "Designation is required",
           work_duration_to: "Work duration is required",
           work_duration_from: "Work duration From is required",
        //    offer_letter: "Offer letter to is required",
           verification_type: "Verification type is required",
        //    exp_letter: "Experience letter is required",
        //    salary_slip: "Salary slip is required",
         }
      });

      $("#edit_identity").validate({
         rules: {
           id_type: "required",
           id_number: "required",
        //    document: "required",
           verification_type: "required",
         },
       
         messages: {
           id_type: "ID type is required",
           id_number: "ID number is required",
        //    document: "Work documentation is required",
           verification_type: "Verification type is required",
           
         }
      });


      $("#edit_skill").validate({
         rules: {
           skill: "required",
    
         },
        
         messages: {
           skill: "Skill is required",
      
          
         }
      });

      $("#edit_lang").validate({
         rules: {
          
           lang: "required",
         },
        
         messages: {
          
           lang: "Known language is required",
          
         }
      });

   });
</script> 

@endsection