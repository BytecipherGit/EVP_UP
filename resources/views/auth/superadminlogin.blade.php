 @extends('superadmin/layouts.login')
 @section('content')
 @section('title','SuperAdmin Login')

 <style>
    .error{
     color: red;
        font-size: 12px;
        display: block;
        margin: 5px 0;
        display: flex;
    }
</style>
<!-- Login Main Container -->
<div class="col-lg-6 align-self-center pad-0 form-section">
           @if(session()->has('message'))
              <div class="alert alert-success">
            {{ session()->get('message') }}
            </div>
            @endif
          <div class="cover-box-txt">  
        
           <form method="POST" action="{{ route('login') }}">
              @csrf
              <img src="assets/superadmin/images/logo.png"class="login-logo">
              <h1>Log in to your account</h1>  
              
              <div class="form-group">                
                <div class="effect-box">
                  {{-- <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="User Email Id"> --}}
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  <span><i class="fa fa-user-o"></i></span>
                  <x-input-error :messages="$errors->get('email')" class="error" />
                </div>
               
                
              </div>
              <div class="form-group">                
                <div class="effect-box">
                  {{-- <input type="password" name="password" class="form-control" placeholder="Password"> --}}
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Your Password" name="password" required autocomplete="current-password">
                  <span style="opacity: 1;"><i class="fa fa-lock"></i></span>
                  <x-input-error :messages="$errors->get('password')" class="error" />
                </div>                 
              </div>
              <div class="form-group">
                <div class="forg-box">
                  {{-- <input type="checkbox" id="customRadioInline4" name="customRadioInline" value="1">  --}}
                  <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
                  <label for="remember_me">Remember me</label>
                  <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
              </div>              
              <div class="form-group">
                <button type="submit">Log In</a></button>
              </div>
              <div class="foot-bottom">
                <p>© 2022 ByteCipher Pvt. Ltd.</p>
              </div>

            </form>
          </div>
        </div>  
        @endsection
