@extends('company.layouts.app') 
@section('content')
@section('title','EVP - Invite View Employee')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Employee Details</h1>
            <p>Here’s your report overview by today</p>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
              <a href="/invite_employee" class="button_background_color"><img src="{{ asset('assets') }}/admin/images/back-icon.png"><span class="button_text_color">Back</span></a>
            </div>
          </div>  
        </div>
      </div><!--- Main Heading ----->

      <div class="employee-tab-bar"> 
        <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">
          <li class="nav-item">
            <a class="nav-link active secondary_color" data-toggle="tab" href="#tabs-1" role="tab">Basic Info</a>
          </li>

        </ul> 
        <div class="tab-content">
        
          <div  class="tab-pane active" id="tabs-1" role="tabpanel">

            <div class="eml-persnal ">
              <div class="add-emply-details">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="" method="post">
                  @csrf 
                  <div class="row">                     
                    <div class="col-lg-12">                    
                      <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="first_name">First Name<span style="color:red">*</span></label>
                            <input type="text" name="first_name" @if ($invite) value="{{ old('first_name', $invite->first_name) }}" @endif class="form-control" placeholder="Enter Your First Name" >
                            @error('first_name')
                            <span class="velidation">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="middle_name">Middle Name<span style="color:red">*</span></label>
                            <input type="text" name="middle_name" @if ($invite) value="{{ old('middle_name', $invite->middle_name) }}" @endif class="form-control" placeholder="Enter Your Middle Name" >
                            @error('middle_name')
                            <span class="velidation">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>  
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="last_name">Last Name<span style="color:red">*</span></label>
                            <input type="text" name="last_name" @if ($invite) value="{{ old('last_name', $invite->last_name) }}" @endif class="form-control" placeholder="Enter Your Last Name" >
                            @error('last_name')
                            <span class="velidation">{{ $message }}</span>
                            @enderror 
                          </div>                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="email">Official Email Id<span style="color:red">*</span></label>
                            <input type="text" name="email" @if ($invite) value="{{ old('email', $invite->email) }}" @endif class="form-control" placeholder="Enter Your Email" >
                            @error('email')
                            <span class="velidation">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label for="phone">Phone Number<span style="color:red">*</span></label>
                            <input type="text" name="phone" @if ($invite) value="{{ old('phone', $invite->phone) }}" @endif class="form-control" placeholder="Enter Your Number" >
                            @error('phone')
                            <span class="velidation">{{ $message }}</span>
                            @enderror 
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>  
                               
                      <div class="add-btn-part">
                        {{-- <button type="button" class="btn-secondary-cust">Back</button> --}}
                        <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
                      </div>
                                                   
                    </form>      
              </div>
            </div>
          </div>
        
        </div>
    </div>
</div>

@endsection