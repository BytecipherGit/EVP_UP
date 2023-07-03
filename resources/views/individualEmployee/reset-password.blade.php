@extends('superadmin.layouts.login')
@section('content')
@section('title','Employee Verification - Reset Password')

<style>
  .pass{
    color: red !important;
    font-size: 10px !important;
    top: 60px !important;
    text-align: left !important;
    left: 4px !important;
  }
</style>
<!-- Main Container -->
<div class="col-md-6 align-self-center pad-0 form-section">
          <div class="cover-box-txt"> 
            <form method="POST" action="{{ route('reset.password.post') }}">
                @csrf

                {{-- <input type="hidden" name="email" value="{{ $request->token }}"> --}}
                <input type="hidden" name="token" value="{{ $token }}">

              <img src="{{ asset('assets') }}/company/images/logo.png" class="login-logo">
              <h1>Reset Your Password</h1>  
              
              <div class="form-group">     
                <div class="effect-box">
                    {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                  <span><i class="fa fa-lock"></i></span>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                   @enderror
                </div>
              </div> 
              <div class="form-group">     
                <div class="effect-box">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter New Password" name="password" required autocomplete="new-password">
                    <span><i class="fa fa-lock"></i></span>
                    {{-- @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                
                </div>
              </div> 
              <div class="form-group">          
                <div class="effect-box">
                  {{-- <input type="password" name="" class="form-control" placeholder="Confirm Password"> --}}
                  <input id="password_confirmation" type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required autocomplete="new-password">
                  <span><i class="fa fa-lock"></i></span>
                  @error('password')
                  <span class="invalid-feedback pass" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>             
              <div class="form-group">
                {{-- <button><a href="#" data-toggle="modal" data-target="#reset-password">Submit</a></button> --}}
                <button type="submit" class="btn btn-primary">{{ __('Reset Password') }} 
                  {{-- <a href="#" data-toggle="modal" data-target="#reset-password"></a> --}}
                </button>
              </div>
              <div class="form-group">
                <h6>© {{date('Y')}} EVP</h6>
              </div>

            </form>
          </div>
        </div>  

        <!-- Modal Reviews-->
        <div class="modal fade custom-modal" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="{{ asset('assets') }}/company/images/logo.png">
                <h2>Successful password reset!</h2>
                <p>You can now use your new password to log in to your account</p>
                <a href="/superlogin">Login</a>
                </div>
            </div>
            </div>
        </div>
        @endsection    
