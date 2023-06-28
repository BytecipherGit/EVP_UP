@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Onboarding-Employee')
<style>
    .doc{
    margin-top: 38px !important;
    }
</style>

<!--- Main Container Start ----->
<div class="main-container">
    <div class="main-heading">
        <div class="row">
            <div class="col-md-12">
                <h1>Onboarding</h1>
                <div class="main-right-button-box backhover">
                    <a href="/employee" class="button_background_color"><img src="{{ asset('assets') }}/admin/images/back-icon.png" class="back"><span class="button_text_color">Back</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-tab-bar">

        <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">

            <li class="nav-item">
                <a @if ($basic) class="nav-link secondary_color" @else class="nav-link active secondary_color" @endif
                    data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ session('tabs-3_active') ? 'active' : '' }} secondary_color" data-toggle="tab"
                    href="#tabs-3" role="tab">Qualification</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ session('tabs-4_active') ? 'active' : '' }} secondary_color" data-toggle="tab"
                    href="#tabs-4" role="tab">Work History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ session('tabs-5_active') ? 'active' : '' }} secondary_color" data-toggle="tab"
                    href="#tabs-5" role="tab">Skills</a>
            </li>
            {{-- <li class="nav-item">
            <a class="nav-link {{ session('tabs-2_active') ? 'active': '' }}"  data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
          </li>                                                                          --}}
            {{-- <li class="nav-item"> 
            <a class="nav-link {{ session('tabs-6_active') ? 'active': '' }}"  data-toggle="tab" href="#tabs-6" role="tab">Official Use</a>
          </li>   --}}
            <li class="nav-item">
                <a class="nav-link {{ session('tabs-2_active') ? 'active' : '' }} secondary_color" data-toggle="tab"
                    href="#tabs-2" role="tab">Official Use</a>
            </li>

        </ul>

        <div class="tab-content">
            @if (!$basic)
                <div id="tabs-1"
                    @if ($basic) class="tab-pane" @else class="tab-pane active" @endif>
                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form action="" method="post" id="add_basicinfo" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="profile-add-img">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic" name="profile"
                                                    src="{{ asset('assets') }}/admin/images/user-img.png">
                                            </div>
                                            <div class="p-image ml-auto">
                                                <span class="upload-button" for="file-upload" id="upload-button"><img
                                                        src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                                                <input class="file-upload" name="profile" id="file-upload"
                                                    type="file" accept="image/*" />
                                                <strong class="error" id="id_type-error"></strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="first_name">First Name<span
                                                            style="color:red">*</span></label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        value="{{ old('first_name') }}"
                                                        placeholder="Enter Your First Name">
                                                    @error('first_name')
                                                        <span class="validation">{{ $message }}</span>
                                                    @enderror
                                                    <strong class="error" id="first_name-error"></strong>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="middle_name">Middle Name</label>
                                                    <input type="text" name="middle_name" class="form-control"
                                                        value="{{ old('middle_name') }}"
                                                        placeholder="Enter Your Middle Name">

                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name<span
                                                            style="color:red">*</span></label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="{{ old('last_name') }}"
                                                        placeholder="Enter Your Last Name">
                                                    @error('last_name')
                                                        <span class="validation">{{ $message }}</span>
                                                    @enderror
                                                    <strong class="error" id="last_name-error"></strong>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Official Email Id<span
                                                            style="color:red">*</span></label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ old('email') }}" placeholder="Enter Your Email">
                                                    @error('email')
                                                        <span class="validation">{{ $message }}</span>
                                                    @enderror
                                                    <strong class="error" id="email-error"></strong>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number<span
                                                            style="color:red">*</span></label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ old('phone') }}" placeholder="Enter Your Number">
                                                    @error('phone')
                                                        <span class="validation">{{ $message }}</span>
                                                    @enderror
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
                                            <label for="dob">Date Of Birth<span
                                                    style="color:red">*</span></label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ old('dob') }}" placeholder="DOB">
                                            @error('dob')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="dob-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Select Blood Group<span style="color:red">*</span></label>

                                            <select class="form-control" name="blood_group" id="blood_group">
                                                <option value="{{ old('blood_group') }}">Select Group
                                                    {{ old('blood_group') }}</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                            </select>
                                            @error('blood_group')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="blood_group-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Select Gender<span style="color:red">*</span></label>

                                            {{-- <div class="selectBox__value">Select Gender</div> --}}

                                            <select class="form-control" name="gender" id="gender">
                                                <option value="{{ old('gender') }}">Select Gender {{ old('gender') }}
                                                </option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            @error('gender')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="gender-error"></strong>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Marital Status<span style="color:red">*</span></label>

                                            <select class="form-control" name="marital_status" id="marital_status">
                                                <option value="{{ old('marital_status') }}">Select Status
                                                    {{ old('marital_status') }}</option>
                                                <option value="Married">Married</option>
                                                <option value="Single">Single</option>
                                            </select>
                                            @error('marital_status')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="marital_status-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Type<span style="color:red">*</span></label>
                                            <select name="document_type" class="form-control" id="document_type">
                                                <option value="">Select document type</option>
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Aadhar Card">Aadhar Card</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                            <strong class="error" id="document_type-error"></strong>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Number<span style="color:red">*</span></label>
                                            <input type="text" name="document_number" class="form-control"
                                                placeholder="Enter document number">
                                            <strong class="error" id="document_number-error"></strong>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Id<span style="color:red">*</span></label>
                                            <input type="file" id="document_id" name="document_id"
                                                class="form-control">
                                            <strong class="error" id="document_id-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="exitonboard doc"> <input type="checkbox" name="verification_type" class="checkboxexitform">Document Verification</label>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>3rd Party Verification Document</label>
                                            <input type="file" id="third_party_document" name="third_party_document" class="form-control">
                        
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            {{-- <label class="docVerification"> 3rd party verification
                                          <input type="checkbox" name="status" class="checkboxexitform"/></label> --}}
                                          <label class="exitonboard doc"> <input type="checkbox" name="third_party_verification" class="checkboxexitform"> 3rd Party Verification </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="current_address">Current Address<span
                                                    style="color:red">*</span></label>
                                            <textarea rows="3" name="current_address" placeholder="Address" class="form-control">{{ old('current_address') }}</textarea>
                                            @error('current_address')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="current_address-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_address">Permanent Address<span
                                                    style="color:red">*</span></label>
                                            <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control">{{ old('permanent_address') }}</textarea>
                                            @error('current_address')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="permanent_address-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 mt-3">
                                        <h2>Emergency Contact</h2>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="emg_name">Name<span style="color:red">*</span></label>
                                            <input type="text" name="emg_name" class="form-control"
                                                value="{{ old('emg_name') }}" placeholder="Enter Name">
                                            @error('emg_name')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="emg_name-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="emg_relationship">Relationship<span
                                                    style="color:red">*</span></label>
                                            <input type="text" name="emg_relationship" class="form-control"
                                                value="{{ old('emg_relationship') }}" placeholder="Enter Relation">
                                            @error('emg_relationship')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="emg_relationship-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="emg_phone">Phone Number<span
                                                    style="color:red">*</span></label>
                                            <input type="text" name="emg_phone" class="form-control"
                                                value="{{ old('emg_phone') }}" placeholder="Number">
                                            @error('emg_phone')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="emg_phone-error"></strong>
                                        </div>
                                    </div>


                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="emg_address">Address<span style="color:red">*</span></label>
                                            <textarea rows="3" name="emg_address" class="form-control" value="{{ old('emg_address') }}"
                                                placeholder="Enter Address"></textarea>
                                            @error('emg_address')
                                                <span class="validation">{{ $message }}</span>
                                            @enderror
                                            <strong class="error" id="emg_address-error"></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-btn-part">
                                    {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                                    <button type="submit" name="basic"
                                        class="btn-primary-cust button_background_color"><span
                                            class="button_text_color">Next</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             @else
                <div class="tab-pane" id="tabs-1" role="tabpanel">
                    {{-- <div id="tabs-1"  class="tab-pane {{ !session('tabs-6_active') ? 'active': '' }} "> --}}
                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form action="" method="post" id="add_basicinfo" enctype="multipart/form-data">
                                @csrf

                                {{-- <input type="hidden" name="id" value="{{ $basic->id }}"> --}}

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="profile-add-img">
                                            <div class="circle">
                                                <img class="profile-pic" id="profile-pic" name="profile"
                                                    @if ($basic->profile !== null) value="{{ old('profile', $basic->profile) }}" src="{{ $basic->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif
                                                    required>
                                            </div>
                                            <div class="p-image ml-auto">
                                                <span class="upload-button" id="upload-button"><img
                                                        src="{{ asset('assets') }}/admin/images/edit-icon.png"></span>
                                                <input class="file-upload" name="profile" id="file-upload"
                                                    type="file" accept="image/*" />
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
                                                    @error('first_name')
                                                        <span class="validation">{{ $message }}</span>
                                                    @enderror
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
                                                    <label for="last_name">Last Name<span
                                                            style="color:red">*</span></label>
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
                                            <label for="dob">Date Of Birth<span
                                                    style="color:red">*</span></label>
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
                                                @if ($basic) value="{{ old('blood_group', $basic->blood_group) }}" @endif>
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
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Type<span style="color:red">*</span></label>
                                            <select name="document_type" class="form-control" id="document_type">
                                                <option
                                                    @if ($basic) value="{{ old('document_type', $basic->document_type) }}" @endif>
                                                    @if ($basic)
                                                        {{ old('document_type', $basic->document_type) }}
                                                    @endif
                                                </option>
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Aadhar Card">Aadhar Card</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                            <strong class="error" id="document_type-error"></strong>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Number<span style="color:red">*</span></label>
                                            <input type="text" name="document_number"
                                                @if ($basic) value="{{ old('document_number', $basic->document_number) }}" @endif
                                                class="form-control" placeholder="Enter document number">
                                            <strong class="error" id="document_number-error"></strong>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Document Id<span style="color:red">*</span></label>
                                            <input type="file" id="document_id"
                                                @if ($basic) value="{{ old('document_id', $basic->document_id) }}" @endif
                                                name="document_id" class="form-control">
                                            <strong class="error" id="document_id-error"></strong>
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
                                            <label for="permanent_address">Permanent Address<span
                                                    style="color:red">*</span></label>
                                            <textarea rows="3" name="permanent_address" placeholder="Address" class="form-control"
                                                @if ($basic) value="{{ old('permanent_address', $basic->permanent_address) }}" @endif>
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
                                            <label for="emg_name">Name</label>
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
                                            <label for="emg_phone">Phone Number<span
                                                    style="color:red">*</span></label>
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
                                    <button type="submit" name="basic-edit"
                                        class="btn-primary-cust button_background_color"><span
                                            class="button_text_color">Next</span></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="tab-pane {{ session('tabs-6_active') ? 'active' : '' }}" id="tabs-6" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Uploaded Documents <span class="ml-auto on-head-right"
                                                    data-toggle="modal" data-target="#identityAdd"><img
                                                        src="{{ asset('assets') }}/admin/images/button-plus-clr.png">
                                                    <small>Add</small></span></h2>
                                        </div>
                                        {{-- <p class="no-data-clg">No Data Available</p>   --}}
                                        @if ($ident)

                                            <div class="col-xl-12">
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Type</th>
                                                                    <th>Id</th>
                                                                    <th>Verification</th>
                                                                    <th>Documents</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($identity as $ident)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $ident['id_type'] }}</td>
                                                                        <td>{{ $ident['id_number'] }}</td>
                                                                        @if ($ident['verification_type'] == 'Verified')
                                                                            <td><span class="verified-clr"><i
                                                                                        class="fa fa-check"></i>{{ $ident['verification_type'] }}</span>
                                                                            </td>
                                                                        @else
                                                                            <td><span class="not-verified-clr"><i
                                                                                        class="fa fa-times"></i>{{ $ident['verification_type'] }}</span>
                                                                            </td>
                                                                        @endif
                                                                        <td>
                                                                            <span class="d-flex tbl-iconBx">
                                                                                <a href="#" target="_black"
                                                                                    class="docu-down"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModaldocument{{ $ident['id'] }}"><img
                                                                                        src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                                <a href="/image/{{ $ident['document'] }}"
                                                                                    target="_black"
                                                                                    class="docu-download"><img
                                                                                        src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                                                                {{-- <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit{{$item['id']}}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button> --}}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
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
                                                <div class="add-btn-part">
                                                    {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                                    {{-- <button type="button" class="btn-primary-cust button_background_color" data-dismiss="modal">Save</button> --}}
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
            <div id="tabs-3" class="tab-pane {{ session('tabs-3_active') ? 'active' : '' }} ">
                {{-- <div id="tab1" class="tab {{ !session('tab2_active') ? 'active', null }} ">  --}}
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal"
                                                    data-target="#qualificationAdd"><img
                                                        src="{{ asset('assets') }}/admin/images/button-plus-clr.png">
                                                    <small>Add</small></span></h2>
                                        </div>
                                        {{-- <p class="no-data-clg">No Data Available</p>   --}}
                                        @if ($quali)

                                            <div class="col-xl-12">
                                                <div class="eml-per-main">
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
                                                                    <th>Documents</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($qual_item as $item)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $item['degree'] }}</td>
                                                                        <td>{{ $item['inst_name'] }}</td>
                                                                        <td>{{ $item['subject'] }}</td>
                                                                        <td>{{ $item['duration_from'] }}</td>
                                                                        <td>{{ $item['duration_to'] }}</td>
                                                                        @if ($item['verification_type'] == 'Verified')
                                                                            <td><span class="verified-clr"><i
                                                                                        class="fa fa-check"></i>{{ $item['verification_type'] }}</span>
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
                                                                                data-target="#qualificationdocument{{ $item['id'] }}"><img
                                                                                    src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                            <a href="/image/{{ $item['document'] }}"
                                                                                target="_black"
                                                                                class="docu-download"><img
                                                                                    src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                                                            {{-- <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit{{$item['id']}}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button> --}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
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
                                                <div class="add-btn-part">
                                                    {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                                    {{-- <button type="button" class="btn-primary-cust button_background_color" data-dismiss="modal">Save</button> --}}
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
            {{-- <div @if ($quali && !$workhistory) class="tab-pane active" @else class="tab-pane" @endif id="tabs-4" role="tabpanel"> --}}
            <div id="tabs-4" class="tab-pane  {{ session('tabs-4_active') ? 'active' : '' }}">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal"
                                                    data-target="#workHistorybtn"><img
                                                        src="{{ asset('assets') }}/admin/images/button-plus-clr.png">
                                                    <small>Add</small></span></h2>
                                        </div>

                                        @if ($workh)
                                            @foreach ($workhistory as $work)
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
                                                                        {{-- <th>Action</th> --}}
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $work['com_name'] }}</td>
                                                                        <td>{{ $work['work_duration_from'] }}</td>
                                                                        <td>{{ $work['work_duration_to'] }}</td>
                                                                        <td>{{ $work['designation'] }}</td>
                                                                        <td><a href="#" target="_black"
                                                                                class="docu-down" data-toggle="modal"
                                                                                data-target="#workofferdocument{{ $work['id'] }}"><img
                                                                                    src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                        </td>
                                                                        <td><a href="#" target="_black"
                                                                                class="docu-down" data-toggle="modal"
                                                                                data-target="#workexpdocument{{ $work['id'] }}"><img
                                                                                    src="{{ asset('assets') }}/admin/images/document.png"></a>
                                                                        </td>
                                                                        <td><a href="#" target="_black"
                                                                                class="docu-download"><img
                                                                                    src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a>
                                                                        </td>
                                                                        @if ($work['verification_type'] == 'Verified')
                                                                            <td><span class="verified-clr"><i
                                                                                        class="fa fa-check"></i>
                                                                                    {{ $work['verification_type'] }}</span>
                                                                            </td>
                                                                        @else
                                                                            <td><span class="not-verified-clr"><i
                                                                                        class="fa fa-times"></i>{{ $work['verification_type'] }}</span>
                                                                            </td>
                                                                        @endif
                                                                        {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="assets/admin/images/edit-icon.png"></button></td> --}}
                                                                    </tr>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="no-data-clg">No Data Available</p>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="add-btn-part">
                                                    {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                                    {{-- <button type="button" class="btn-primary-cust button_background_color" data-dismiss="modal">Save</button> --}}
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
            @if (!$skills)
                <div class="tab-pane" id="tabs-5" role="tabpanel">

                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" id="add_skills" enctype="multipart/form-data">
                                        @csrf

                                        <table class="table table-bordered" id="dynamicAddRemove">
                                            <tr>
                                                <th>Add Skills<span style="color:red">*</span></th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="skill[]" placeholder="Enter subject"
                                                        class="form-control" required />
                                                    <strong class="error" id="skill-error"></strong>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span><input type="radio" id="customRadioInline1"
                                                                name="skill_type[]" class="" value="Beginner"
                                                                checked=""> <label class=""
                                                                for="customRadioInline1">Beginner</label></span>
                                                        <span><input type="radio" id="customRadioInline2"
                                                                name="skill_type[]" class=""
                                                                value="Intermediate"> <label class=""
                                                                for="customRadioInline2">Intermediate</label></span>
                                                        <span><input type="radio" id="customRadioInline3"
                                                                name="skill_type[]" class="" value="Expert">
                                                            <label class=""
                                                                for="customRadioInline3">Expert</label></span>
                                                    </h6>
                                                </td>
                                                <td><a name="add" id="dynamic-ar"
                                                        class="add-plus extra-fields-customer"><span
                                                            class="button_background_color"><img
                                                                src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
                                                </td>
                                            </tr>
                                        </table>




                                        <h2>Known Language</h2>
                                        <table class="table table-bordered" id="dynamicAddRemove1">
                                            <tr>
                                                <th>Add Languages<span style="color:red">*</span></th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="lang[]" placeholder="Enter subject"
                                                        class="form-control" required />
                                                    <strong class="error" id="lang-error"></strong>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span><input type="radio" id="customRadioInline4"
                                                                name="lang_type[]" class="" value="Beginner"
                                                                checked=""> <label class=""
                                                                for="customRadioInline4">Beginner</label></span>
                                                        <span><input type="radio" id="customRadioInline5"
                                                                name="lang_type[]" class=""
                                                                value="Intermediate"> <label class=""
                                                                for="customRadioInline5">Intermediate</label></span>
                                                        <span><input type="radio" id="customRadioInline6"
                                                                name="lang_type[]" class="" value="Expert">
                                                            <label class=""
                                                                for="customRadioInline6">Expert</label></span>
                                                    </h6>
                                                </td>
                                                <td><a name="add" id="dynamic-ar1"
                                                        class="add-plus extra-fields-customer"><span
                                                            class="button_background_color"><img
                                                                src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
                                                </td>
                                            </tr>


                                        </table>

                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <div class="add-btn-part">
                                                    {{-- <button type="" class="btn-secondary-cust">Back</button> --}}
                                                    <button type="submit" name="workskill"
                                                        class="btn-primary-cust button_background_color"><span
                                                            class="button_text_color">Next</span></button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="tab-pane {{ session('tabs-5_active') ? 'active' : '' }}" id="tabs-5" role="tabpanel">
                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="col-xl-12">
                                                    <h2>Skills <span class="ml-auto on-head-right" data-toggle="modal"
                                                            data-target="#skillsAdd">
                                                            <img
                                                                src="{{ asset('assets') }}/admin/images/button-plus-clr.png">
                                                            <small>Add</small>
                                                        </span></h2>
                                                </div>
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Skill Name</th>

                                                                    <th>Competency Levels</th>
                                                                    {{-- <th>Action</th> --}}
                                                                </tr>
                                                            </thead>
                                                            @foreach ($skill_item as $item)
                                                                <tr>
                                                                    <td>{{ $item['skill'] }}</td>

                                                                    <td>{{ $item['skill_type'] }}</td>
                                                                    {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#skillsAdd"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td> --}}
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
                                                            <img
                                                                src="{{ asset('assets') }}/admin/images/button-plus-clr.png">
                                                            <small>Add</small>
                                                        </span></h2>
                                                </div>
                                                <div class="eml-per-main">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Skill Name</th>
                                                                    <th>Competency Levels</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($lang_item as $item)
                                                                <tr>
                                                                    <td>{{ $item['lang'] }}</td>
                                                                    <td>{{ $item['lang_type'] }}</td>
                                                                    {{-- <td><button type="button" class="border-none" data-toggle="modal" data-target="#langskillsAdd">
                                      <img src="{{ asset('assets') }}/admin/images/edit-icon.png">
                                      </button
                                      ></td> --}}
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
                                                    <div class="add-btn-part">
                                                        {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                                                        {{-- <button type="button" class="btn-primary-cust button_background_color" data-dismiss="modal">Save</button> --}}
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

            @endif
            <div class="tab-pane {{ session('tabs-2_active') ? 'active' : '' }}" id="tabs-2" role="tabpanel">
                <div class="eml-persnal ">
                    <div class="add-emply-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" id="add_official" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <h2>Official Info</h2>
                                        </div>
                                        {{-- <div class="col-xl-3 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" name="employee_id" class="form-control" @if ($basic) value="#00{{ $basic->id }}" @else value="" @endif placeholder="Id Number" readonly>
                          </div>
                        </div> --}}
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Date of Joining<span style="color:red">*</span></label>
                                                <input type="date" name="date_of_joining" class="form-control"
                                                    placeholder="Date">
                                                @error('date_of_joining')
                                                    <span class="validation">{{ $message }}</span>
                                                @enderror
                                                <strong class="error" id="date_of_joining-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Employee Type<span style="color:red">*</span></label>
                                                <select class="form-control" name="emp_type" id="emp_type">
                                                    <option value="">Select Employee Type</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Trainee">Trainee</option>
                                                    <option value="Freelancer">Freelancer</option>
                                                </select>
                                                @error('emp_type')
                                                    <span class="validation">{{ $message }}</span>
                                                @enderror
                                                <strong class="error" id="emp_type-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Work Location<span style="color:red">*</span></label>
                                                <select class="form-control" name="work_location" id="work_location">
                                                    <option value="">Select Work Location</option>
                                                    <option value="Bhopal, MP">Bhopal, MP</option>
                                                    <option value="Indore, MP">Indore, MP</option>
                                                    <option value="Pune, MH">Pune, MH</option>

                                                </select>
                                                @error('work_location')
                                                    <span class="validation">{{ $message }}</span>
                                                @enderror
                                                <strong class="error" id="work_location-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Employee Status<span style="color:red">*</span></label>
                                                <select class="form-control" name="emp_status" id="emp_status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('emp_status')
                                                    <span class="validation">{{ $message }}</span>
                                                @enderror
                                                <strong class="error" id="emp_status-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-5 col-md-10">
                                            <div class="form-group">
                                                <label>Designation<span style="color:red">*</span></label>
                                                <input type="text" name="designation" class="form-control"
                                                    placeholder="Designation">
                                                <strong class="error" id="designation-error"></strong>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 mt-3">
                                            <h2>Salary Info</h2>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>LPA<span style="color:red">*</span></label>
                                                <input type="text" name="lpa" class="form-control"
                                                    placeholder="Enter LPA">
                                                @error('lpa')
                                                    <span class="validation">{{ $message }}</span>
                                                @enderror
                                                <strong class="error" id="lpa-error"></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="add-btn-part">
                                                    <button type="reset" class="btn-secondary-cust"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="official"
                                                        class="btn-primary-cust button_background_color"><span
                                                            class="button_text_color">Save</span></button>
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

</div>
</form>
<!--- Main Container Close ----->

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
                    <form method="post" id="add_identity" enctype="multipart/form-data" action="">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Id Type<span style="color:red">*</span></label>
                                    <select class="form-control" name="id_type" id="id_type">
                                        <option value="">Select Id </option>
                                        <option value="Pan Card">Pan Card</option>
                                        <option value="Aadhar Card">Aadhar Card</option>
                                        <option value="Voter Id">Voter Id</option>
                                    </select>
                                    @error('id_type')
                                        <span class="validation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="id_type-error"></strong>
                                </div>
                                <div class="col-md-6">
                                    <label>Id Number<span style="color:red">*</span></label>
                                    <input type="text" name="id_number" class="form-control"
                                        placeholder="Number">
                                    @error('id_number')
                                        <span class="validation">{{ $message }}</span>
                                    @enderror
                                    <strong class="error" id="id_number-error"></strong>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Attech File<span style="color:red">*</span></br><b>File type:</b> Only .jpeg, .pdf,
                                .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                            <div class="upload-img-file">
                                <input type="file" id="document" name="document" class="form-control"
                                    accept="image/jpeg,image/doc,image/pdf" />
                                {{-- <strong class="error" id="document-error"></strong> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <label>Verification<span style="color:red">*</span></label>

                                    <select class="form-control" name="verification_type" id="verification_type">
                                        <option value="">Select Type </option>
                                        <option value="Verified">Verified</option>
                                        <option value="Not Verified">Not Verified</option>
                                    </select> --}}
                                    <label class="exitonboard"> <input type="checkbox" name="verification_type" class="checkboxexitform">Document Verification</label>
                                </div>
                                {{-- <strong class="error" id="verification_type-error"></strong> --}}
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                <button type="submit" name="identity" class="btn-primary-cust button_background_color"><span
                        class="button_text_color">Save</span></button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- The Modal Qualification Add -->
<div class="modal fade custu-modal-popup" id="qualificationAdd" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form method="post" id="add_qualification" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>School/College/Institute<span style="color:red">*</span></label>
                                    <input type="text" name="inst_name" value="{{ old('inst_name') }}"
                                        class="form-control" placeholder="Enter Name">
                                    {{-- @error('inst_name')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="inst_name-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Degree<span style="color:red">*</span></label>
                                    <input type="text" name="degree" class="form-control"
                                        value="{{ old('degree') }}" placeholder="Ex. Bachelor's">
                                    {{-- @error('degree')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="degree-error"></strong>
                                </div>
                                <div class="col-md-6">
                                    <label>Subject<span style="color:red">*</span></label>
                                    <input type="text" name="subject" class="form-control"
                                        value="{{ old('subject') }}" placeholder="Ex. CS">
                                    {{-- @error('subject')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="subject-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>From<span style="color:red">*</span></label>
                                    <input type="date" name="duration_from" class="form-control"
                                        value="{{ old('duration_from') }}" placeholder="From">
                                    {{-- @error('duration_from')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="duration_from-error"></strong>
                                </div>
                                <div class="col-md-6">
                                    <label>To<span style="color:red">*</span></label>
                                    <input type="date" name="duration_to" class="form-control"
                                        value="{{ old('duration_to') }}" placeholder="To">
                                    {{-- @error('duration_to')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="duration_to-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Attech File<span style="color:red">*</span></br><b>File type:</b> Only .jpeg, .pdf,
                                .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                            <div class="upload-img-file">
                                <input type="file" id="document" name="document" class="form-control"
                                    accept="image/jpg,image/doc,image/pdf" />
                                {{-- @error('document')
                    <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                <strong class="error" id="document-error"></strong>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <label>Verification<span style="color:red">*</span></label>
                                    <select class="form-control" name="verification_type" id="verification_type">
                                        <option value="{{ old('verification_type') }}">Verification Type
                                            {{ old('verification_type') }}</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Not Verified">Not Verified</option>
                                    </select> --}}
                                    <label class="exitonboard"> <input type="checkbox" name="qualification_verification_type" class="checkboxexitform">Document Verification</label>
                                </div>
                            </div>

                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" name="qulification" class="btn-primary-cust button_background_color"><span
                        class="button_text_color">Save</span></button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- The Modal Docum INFO-->
@foreach ($qual_item as $item)
    <div class="modal fade custu-modal-popup" id="qualificationdocument{{ $item['id'] }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                @if ($item['document'] == null)
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

@foreach ($identity as $item)
    <div class="modal fade custu-modal-popup" id="exampleModaldocument{{ $item['id'] }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Pan Card</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                    </button>
                </div>
                @if ($item['document'] == null)
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


<!-- The Modal Work Work HistoryBasic-->
<div class="modal fade custu-modal-popup" id="workHistorybtn" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Work History</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" id="add_workhistory" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Company Name<span style="color:red">*</span></label>
                                    <input type="text" name="com_name" class="form-control"
                                        placeholder="ByteCipher">
                                    {{-- @error('com_name')
                       <span class="validation">{{ $message }}</span>
                     @enderror  --}}
                                    <strong class="error" id="com_name-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>From<span style="color:red">*</span></label>
                                    <input type="date" name="work_duration_from" class="form-control"
                                        placeholder="From">
                                    {{-- @error('work_duration_from')
                     <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="work_duration_from-error"></strong>
                                </div>

                                <div class="col-md-6">
                                    <label>To<span style="color:red">*</span></label>
                                    <input type="date" name="work_duration_to" class="form-control"
                                        placeholder="To">
                                    {{-- @error('work_duration_to')
                     <span class="validation">{{ $message }}</span>
                     @enderror  --}}
                                    <strong class="error" id="work_duration_to-error"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Designation<span style="color:red">*</span></label>
                                    <input type="text" name="designation" class="form-control"
                                        placeholder="React Native Developer">
                                    {{-- @error('designation')
                      <span class="validation">{{ $message }}</span>
                    @enderror  --}}
                                    <strong class="error" id="designation-error"></strong>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Offer Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                                .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                            <div class="upload-img-file">
                                <input type="file" id="offer_letter" name="offer_letter" class="form-control"
                                    accept="image/jpg,image/doc,image/pdf" />
                                <strong class="error" id="offer_letter-error"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Experience Letter<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                                .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                            <div class="upload-img-file">
                                <input type="file" id="exp_letter" name="exp_letter"
                                    class="form-control"accept="image/jpg,image/doc,image/pdf" />
                                <strong class="error" id="exp_letter-error"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Salary Slips<span style="color:red">*</span></br><b>File type:</b> Only .jpeg,
                                .pdf, .docs, or .doc files allowed. <b>File Size:</b> Max:10MB</p></label>
                            <div class="upload-img-file">
                                <input type="file" id="salary_slip" name="salary_slip" class="form-control"
                                    accept="image/jpg,image/doc,image/pdf" />
                                <strong class="error" id="salary_slip-error"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <label>Verification<span style="color:red">*</span></label>
                                    <select class="form-control" name="verification_type" id="verification_type">
                                        <option value="">Verification Type</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Not Verified">Not Verified</option>
                                    </select> --}}
                                    <label class="exitonboard"> <input type="checkbox" name="verification_type" class="checkboxexitform">Document Verification</label>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" name="workhistory" class="btn-primary-cust button_background_color"><span
                        class="button_text_color">Save</span></button>
            </div>
        </div>
    </div>
</div>
</form>

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


<!-- The Modal Salary Add -->
<div class="modal fade custu-modal-popup" id="salaryaddbtn" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Appraisal</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>From</label>
                                    <input type="text" name="" class="form-control"
                                        placeholder="From">
                                </div>
                                <div class="col-md-6">
                                    <label>To</label>
                                    <input type="text" name="" class="form-control" placeholder="To">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Last Desig.</label>
                                    <input type="text" name="" class="form-control"
                                        placeholder="Last Desig.">
                                </div>
                                <div class="col-md-6">
                                    <label>Current Desig.</label>
                                    <input type="text" name="" class="form-control"
                                        placeholder="Last Desig.">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Date</label>
                                    <input type="date" name="" class="form-control"
                                        placeholder="date">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary-cust button_background_color"><span
                        class="button_text_color">Save</span></button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Skills Add -->
<div class="modal fade custu-modal-popup" id="skillsAdd" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Skills</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <form method="post" action="">
              @csrf
               <div class="modal-body">
                   <div class="comman-body">
                        <div class="form-group inputtag-custom">
                            <label>Add Skill</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="skill"
                                        class="form-control input-search-box typeahead" data-provide="typeahead"
                                        placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" name="skill_type" id="customRadioInline4"
                                                class="" value="Beginner" checked="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>

                                        <span><input type="radio" name="skill_type" id="customRadioInline5"
                                                value="Intermediate" class="">
                                            <label class=""
                                                for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" name="skill_type" id="customRadioInline6"
                                                value="Expert" class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" name="more-skill" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
            </div>
          </form>
        </div>
    </div>
</div>


<!-- The Modal Language Add -->
<div class="modal fade custu-modal-popup" id="skillsLanguageAdd" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add known Language</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form method="post" action="">
                        @csrf
                        <div class="form-group inputtag-custom">
                            <label>Add Language</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="lang"
                                        class="form-control input-search-box typeahead1" data-provide="typeahead"
                                        placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" id="customRadioInline4" name="lang_type"
                                                value="Beginner" class="" checked="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>
                                        <span><input type="radio" id="customRadioInline5" name="lang_type"
                                                value="Intermediate" class="">
                                            <label class=""
                                                for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" id="customRadioInline6" name="lang_type"
                                                value="Expert" class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic1"></div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" name="more-lang" class="btn-primary-cust button_background_color"><span
                        class="button_text_color">Save</span></button>
            </div>
            </form>
        </div>
    </div>
</div>


@foreach ($workhistory as $item)
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

@foreach ($workhistory as $item)
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

@endsection

@section('pagescript')

<!-- Bootstrap core JavaScript
 ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
<!--  <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script> -->

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


<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="skill[' + i +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline1" name="skill_type[' +
            i +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline1">Beginner</label></span> <span><input type="radio" id="customRadioInline2" name="skill_type[' +
            i +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline2">Intermediate</label></span> <span><input type="radio" id="customRadioInline3" name="skill_type[' +
            i +
            ']" class="" value="Expert">  <label class="" for="customRadioInline3">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar1").click(function() {
        ++j;
        $("#dynamicAddRemove1").append('<tr><td><input type="text" name="lang[' + j +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline4" name="lang_type[' +
            j +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline4">Beginner</label></span>  <span><input type="radio" id="customRadioInline5" name="lang_type[' +
            j +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline5">Intermediate</label></span> <span><input type="radio" id="customRadioInline6" name="lang_type[' +
            j +
            ']" class="" value="Expert">  <label class="" for="customRadioInline6">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field1', function() {
        $(this).parents('tr').remove();
    });
</script>

<script>
    $(document).ready(function() {

        $("#add_qualification").validate({
            rules: {
                inst_name: "required",
                degree: "required",
                subject: "required",
                duration_from: "required",
                duration_to: "required",
                verification_type: "required",
                document: {
                    required: true,
                    extension: "pdf|doc|docx",
                }
            },

            messages: {
                inst_name: "Institute name is required",
                degree: "Degree is required",
                subject: "Subject is required",
                duration_from: "Duration date is required",
                duration_to: "Duration to is required",
                verification_type: "Verification type is required",
                document: {
                    required: "Document is required",
                    extension: "extension shuold not wrong",
                },
            }
        });

        $("#add_basicinfo").validate({
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
                document_type: "required",
                document_number: "required",
                document_id: "required",

            },

            messages: {
                firstName: "first name is required",
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
                document_id: "document id is required",
                document_number: "document number is required",
                document_type: "document type is required",

            }
        });

        $("#add_official").validate({
            rules: {
                date_of_joining: "required",
                emp_type: "required",
                work_location: "required",
                emp_status: "required",
                lpa: "required",
                designation: "required",
            },

            messages: {
                date_of_joining: "Date of joining is required",
                emp_type: "Employee type is required",
                work_location: "Work location is required",
                emp_status: "Employee status to is required",
                lpa: "LPA is required",
                designation: "Manager designation is required",

            }
        });

        $("#add_workhistory").validate({
            rules: {
                com_name: "required",
                designation: "required",
                work_duration_to: "required",
                work_duration_from: "required",
                offer_letter: "required",
                verification_type: "required",
                exp_letter: "required",
                salary_slip: "required",
            },

            messages: {
                com_name: "Company name is required",
                designation: "Designation is required",
                work_duration_to: "Work duration is required",
                work_duration_from: "Work duration From is required",
                offer_letter: "Offer letter to is required",
                verification_type: "Verification type is required",
                exp_letter: "Experience letter is required",
                salary_slip: "Salary slip is required",
            }
        });

        $("#add_identity").validate({
            rules: {
                id_type: "required",
                id_number: "required",
                document: {
                    required: true,
                    extension: 'jpeg,pdf,doc,docx',
                    uploadFile: true,
                },
                verification_type: "required",
            },

            messages: {
                id_type: "ID type is required",
                id_number: "ID number is required",
                document: {
                    required: "Document is required",
                    extension: "File should be .jpeg, .pdf, .doc and .docx"
                },
                verification_type: "Verification type is required",

            }
        });


        $("#add_skills").validate({
            rules: {
                skill: "required",
                lang: "required",
            },

            messages: {
                skill: "Skill is required",
                lang: "Known language is required",

            }
        });

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


@stop
