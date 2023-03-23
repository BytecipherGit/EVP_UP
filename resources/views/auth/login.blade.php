@extends('company/layouts.appcom')
@section('content')
@section('title','EVP - Company Login')
<style>
  li{
    display:block !important;
  }
</style>

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
          @if(session()->has('message'))
             <div class="alert alert-success">
           {{ session()->get('message') }}
           </div>
           @endif
           
           <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />
           <form method="POST" id="add_admin"  action="{{ route('login') }}" >
              @csrf
            
              <div class="d-flex close-butn">
                <a href="/"><img src="assets/company/images/back-icon.png"></a>
              </div>
              <h1>Welcome to EVP</h1> 
              <h6>Log in to your account</h6> 
              
              <div class="form-group">
                <label>Email Address</label>     
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email Address">
                <x-input-error :messages="$errors->get('email')" class="error" style="margin-left:-37px;"/>
                  {{-- @error('email')
                  <span class="text-danger pass">{{ $message }}</span>
                  @enderror  --}}
                  <strong class="error" id="email-error"></strong>
              </div> 
              <div class="form-group">
                <label>Password</label>     
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                {{-- @error('password')
                <span class="text-danger pass">{{ $message }}</span>
                @enderror  --}}
                <strong class="error" id="password-error"></strong>
              </div>  
              <div class="form-group">
                <div class="forg-box">
                  <label for="remember" class="inline-flex items-center">
                    <input id="remember" type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> </label>
                    <label for="remember_me">Remember me</label>
                
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">Forgot Password?</a>
                  @endif
                </div>
              </div>
             
              <div class="form-group">
                <button type="submit">Log in</a></button>
              </div>
              <div class="form-group">
                <p>Don’t have any account?,  <a href="register">Register</a></p>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>  
  </div> 

  <script>
      window.jQuery || document.write('<script src="../../assets/company/js/jquery.min.js"><\/script>')
    </script>
    <script src="assets/company/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {

      $("#add_admin").validate({
       rules: {
         email: "required",
         password: "required",
       },

       messages: {
         email: "Email id is required",
         password: "Password is required",
       
        }
     });
  });
  </script>

@endsection

