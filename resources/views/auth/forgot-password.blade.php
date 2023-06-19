
@extends('superadmin.layouts.login')
@section('content')
@section('title','EVP - Forgot Password')

<!-- Main Container -->
<div class="col-md-6 align-self-center pad-0 form-section">
    <div class="cover-box-txt">  
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <input type="hidden" name="token" value="">
        <img src="{{ asset('assets') }}/company/images/logo.png"class="login-logo">
        <h1>Recover Your Password</h1>  
        
        <div class="form-group">       
          <div class="effect-box">
            {{-- <input type="text" name="email" class="form-control" placeholder="Email Address"> --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" autocomplete="email" autofocus>
            <span><i class="fa fa-envelope-o"></i></span>
          </div>
          @error('email')
          <span class="text-danger pass">{{ $message }}</span>
          @enderror 
        </div>              
        <div class="form-group">
          <button type="submit"> Send Me Email</button>
        </div>
        <div class="form-group">
          <h6>© 2022 ByteCipher Pvt. Ltd.</h6>
        </div>

      </form>
    </div>
  </div>   
  @endsection