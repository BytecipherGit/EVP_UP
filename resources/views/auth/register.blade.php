@extends('company/layouts.appcom')
@section('content')
@section('title', 'Registration')

<style>
    .velidation {
        color: red;
        font-size: 12px;
        display: block;
        margin: 5px 0;
        display: flex;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    

<div class="d-flex main-form-part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 pad-0">
                <div class="main-box-img">
                    <img src="assets/company/images/login-bg.jpg">
                </div>
            </div>
            <div class="col-lg-6 form-section">
                <div class="login-box-txt">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="d-flex close-butn">
                            <a href="login"><img src="assets/company/images/back-icon.png"></a>
                        </div>
                        <h6>Create an Account</h6>

                        <div class="form-group">
                            <label>Organization Name* </label>
                            <input type="text" id="org_name" name="org_name" class="form-control" value="{{ old('org_name') }}"
                                placeholder="Enter Organization Name" required autofocus autocomplete="org_name" >
                            @error('org_name')
                                <p class="velidation">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Admin Name* </label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Enter Your name" required autofocus autocomplete="name" >
                            @error('name')
                                <p class="velidation">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Organization Website* </label>
                            <input type="text" id="org_web" name="org_web" class="form-control" value="{{ old('org_web') }}"
                                placeholder="Enter Company Website" required autofocus autocomplete="org_web">
                            @error('org_web')
                                <p class="velidation">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Organization Admin Email* </label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="Enter Your Email" required autofocus autocomplete="email">
                            @error('email')
                                <p class="velidation">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Password* </label>
                                    <input type="password" id="password" name="password" class="form-control"
                                     placeholder="Enter Your Password"  required autocomplete="new-password" />
                                    @error('password')
                                        <p class="velidation">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        value="{{ old('password_confirmation') }}"
                                        placeholder="Enter Your Confirm Password"  required autocomplete="new-password" >
                                    @error('password')
                                        <p class="velidation">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Admin Designation* </label>
                                    <input type="text" id="designation" name="designation" class="form-control"
                                        value="{{ old('designation') }}" placeholder="Designation" required autofocus autocomplete="designation">
                                    @error('designation')
                                        <p class="velidation">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Admin Department* </label>
                                    <input type="text" id="department" name="department" class="form-control"
                                        value="{{ old('department') }}" placeholder="Department" required autofocus autocomplete="department">
                                    @error('department')
                                        <p class="velidation">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Registered Address* </label>
                            <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Enter Your Address"
                                rows="2" required autofocus autocomplete="address" ></textarea>
                            @error('address')
                                <p class="velidation">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="country">Country*</label>
                                    <div class="">

                                        <select id="country-dropdown" name="country" value="{{ old('country') }}"
                                            class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <p class="velidation">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <div class="">

                                        <div class="form-group mb-3">
                                            <select id="state-dropdown" name="state" value="{{ old('state') }}"
                                                class="form-control">
                                                <option value="">Select State</option>
                                            </select>
                                            @error('state')
                                                <p class="velidation">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <div class="">

                                        <div class="form-group">
                                            <select id="city-dropdown" name="city" value="{{ old('city') }}"
                                                class="form-control">
                                                <option value="">Select City</option>
                                            </select>
                                            @error('city')
                                                <p class="velidation">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Pin Code* </label>
                                    <input type="text" id="pin" name="pin" class="form-control"
                                        value="{{ old('pin') }}" placeholder="Enter Your pin" required autofocus autocomplete="pin">
                                    @error('pin')
                                        <p class="velidation">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- data-toggle="modal" --}}
                        <div class="form-group">
                            <button type="submit" name="button"
                                data-target="#seccess-veri">Sign Up</button>
                        </div>
                        <div class="form-group">
                            <p>Already have an account, <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Email verified-->
<div class="modal fade custom-modal" id="seccess-veri" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="assets/company/images/email-verify.png">
                <h2>Registration completed successfully</h2>
                <!-- <p>Please check your rigistered email for email verification</p> -->
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
</div>

<script>
    //     $(document).ready(function(){
    //         $('.form').on('submit', function(){
    //           <div class="modal fade custom-modal" id="seccess-veri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    //          <div class="modal-dialog" role="document">
    //       <div class="modal-content">
    //         <div class="modal-body">
    //           <img src="assets/images/email-verify.png">
    //           <h2>Registration completed successfully</h2>
    //       <p>Please check your rigistered email for email verification</p> 
    //           <a href="company-login.html">Login</a>
    //         </div>
    //       </div>
    //     </div>
    //   </div>
    // });
    //         });
</script>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write('<script src="../../assets/company/js/jquery.min.js"><\script>')
</script>
<script src="/assets/company/js/bootstrap.min.js"></script>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                        '<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
