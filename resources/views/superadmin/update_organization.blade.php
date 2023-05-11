@extends('superadmin.layouts.app')
@section('content')
@section('title','EVP - Add Company')
  
<style>
      li {
            display:block !important;
            color: red;
            font-size: 12px;

        }
        .passwordError{
            margin-left: -37px;
        }
</style>
   <!--- Main Container Start ----->
    <div class="main-container">

        <div class="main-heading">        
          <div class="row">
            <div class="col-md-8">
              <h1>Add Company</h1>
              <p></p>
            </div>
            <div class="col-md-4">
                <div class="main-right-button-box">
                    <a href="{{ route('organization') }}"><img src="{{ asset('assets') }}/superadmin/images/back-icon.png"> Back</a>
                  </div>
            </div>
          </div>
        </div><!--- Main Heading ----->
  
        <div class="employee-tab-bar"> 
  
          <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">
            <li class="nav-item">
              <a class="nav-link active"  data-toggle="tab" href="#tabs-1" role="tab">Basic Infomation</a>
            </li> 
          </ul> 
      
          <div class="tab-content">
          
            <div  class="tab-pane active" id="tabs-1" role="tabpanel">
            <input type="hidden" id="id" name="id" value="{{ $companyData ? $companyData->id : '' }}" />
              <div class="eml-persnal ">
                <div class="add-emply-details">
                  @if (session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
                  @endif
                  <form action="" method="post" id="registration">
                    @csrf 
                    <div class="row" id="registration">
                        <div class="col-xl-12 mt-3">
                            <h2>Organization Details</h2>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="org_name">Orgnization name<span style="color:red">*</span></label>
                                <input type="text" name="org_name" class="form-control" value="{{ $companyData ? $companyData->org_name : '' }}" placeholder="Orgnization name">
                                <strong class="error" id="org_name-error"></strong>
                            </div>
                        </div>
                   
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Website<span style="color:red">*</span></label>
                                <input type="text" name="org_web" class="form-control" value="{{ $companyData ? $companyData->org_web : '' }}" placeholder="Enter website">
                                <strong class="error" id="org_web-error"></strong>
                            </div>
                        </div>
                
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Email Id<span style="color:red">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $companyData ? $companyData->email : '' }}" placeholder="Enter email">
                                <strong class="error" id="email-error"></strong>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="country">Country <strong style="color:red">*</strong></label>
                                    <select id="country-dropdown" name="country" class="form-control dropdownReg">
                                        <option value="{{ $address ? $address->countryId : '' }}">{{ $address ? $address->countryName : '' }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ $companyData->country == $country->id ? 'selected' : '' }}> {{ $country->name }} </option>
                                        @endforeach
                                    </select>
                                    <strong class="error" id="country-error"></strong>
                            </div>
                        </div>
                
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="state">State <strong style="color:red">*</strong></label>
                                    <div class="form-group mb-3">
                                        <select id="state-dropdown" name="state" value="{{ old('state') }}" class="form-control dropdownReg">
                                        <option value="{{ $address ? $address->stateId : '' }}">{{ $address ? $address->stateName : '' }}</option>  
                                    </select>
                                        <strong class="error" id="state-error"></strong>
                                    </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="city">City <strong style="color:red">*</strong></label>
                                    <div class="form-group">
                                        <select id="city-dropdown" name="city" class="form-control dropdownReg">
                                        <option value="{{ $address ? $address->cityId : '' }}">{{ $address ? $address->cityName : '' }}</option>
                                        </select>
                                        <strong class="error" id="city-error"></strong>
                                    </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Pin Code <strong style="color:red">*</strong> </label>
                                <input type="text" id="pin" name="pin" class="form-control" value="{{ $companyData ? $companyData->pin : '' }}" placeholder="Enter Your pin" autofocus autocomplete="pin">
                                <strong class="error" id="pin-error"></strong>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Registered Address <strong style="color:red">*</strong> </label>
                                <textarea class="form-control" id="address" name="address" value="{{ $companyData ? $companyData->address : '' }}" placeholder="Enter Your Address" rows="2" autofocus autocomplete="address" >{{ $companyData ? $companyData->address : '' }}</textarea>
                                <strong class="error" id="address-error"></strong>
                            </div>
                        </div>

                        <div class="col-xl-12 mt-3">
                            <h2>Admin Details</h2>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Name <strong style="color:red">*</strong> </label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $companyData ? $companyData->name : '' }}" placeholder="Enter Your name" autofocus autocomplete="name" >
                                <strong class="error" id="name-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Designation <strong style="color:red">*</strong> </label>
                                <input type="text" id="designation" name="designation" class="form-control" value="{{ $companyData ? $companyData->designation : '' }}" placeholder="Designation" autofocus autocomplete="designation">
                                <strong class="error" id="designation-error"></strong>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Department <strong style="color:red">*</strong></label>
                                <input type="text" id="department" name="department" class="form-control" value="{{ $companyData ? $companyData->department : '' }}" placeholder="Department" autofocus autocomplete="department">
                                <strong class="error" id="department-error"></strong>
                            </div>
                        </div>

                        <div class="add-btn-part col-md-12">
                            {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                            <button type="submit" class="btn-primary-cust">Save</button>
                        </div>
                       
                    </div>
                </form>
             </div>
          
          </div>
      </div>
  </div>
  @endsection

  @section('pagescript')
     
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script>
        window.jQuery || document.write('<script src="../../{{ asset('assets') }}/company/js/jquery.min.js"><\script>')
    </script>
    <script src="/{{ asset('assets') }}/company/js/bootstrap.min.js"></script>
  
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

<script src="{{ asset('assets') }}/admin/js/jquery.validate.min.js"></script>
<script>
  $(document).ready(function() {

     $("#registration").validate({
            rules: {
            name: "required",
            email: "required",
            password: "required",
            org_name: "required",
            org_web: "required",
            designation: "required",
            department: "required",
            address: "required",
            country: "required",
            city: "required",
            state: "required",
            pin: "required",
            },

            messages: {
            name: "Name is required",
            email: "Email is required",
            password: "Password is required",
            org_name: "Organization name is required",
            org_web: "Organization website is required",
            designation: "Designation is required",
            department: "Department name is required",
            address: "Company address is required",
            country: "Country name is required",
            city: "City is required",
            state: "State is required",
            pin: "Pin is required",
            
            }
        });
        });

 </script>

      @stop