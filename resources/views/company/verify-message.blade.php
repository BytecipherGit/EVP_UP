@extends('company/layouts.appcom')
@section('content')
@section('title','EVP - Company Verification Document')

<div class="d-flex main-form-part">
    <div class="container-fluid">
      <div class="row">                
        <div class="col-lg-6 pad-0">
          <div class="main-box-img">
            <img src="{{ asset('assets') }}/company/images/login-bg.jpg">
          </div>
        </div>
     <input type="hidden" name="id" value={{ $user->id }}>
        <div class="col-lg-6 form-section">
          {{-- <span class="">Your Documents is Under Verification.</span><br/>
            <span>We Will Verified Soon.</span>
          --}}
        <div class="modal-dialog" role="document">
          @if(session()->has('message'))
          <div class="alert alert-success">
          {{ session()->get('message') }}
        </div>
        @endif
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('assets') }}/company/images/email-verify.png">
                <h2>Please verify your account</h2></b>
                <h4>We sent an email to</h4>
                <h4>{{$user->email}}</h4>
                <h4>Click the link inside to get started</h4>
                <div class="add-btn-part">
                    <a href="{{route('login')}}"><button class="btn btn-primary">Login</button></a>
                  </div>
              
           
                <!-- <p>Please check your rigistered email for email verification</p> -->
        </div>
    </div>
</div>
        </div>
    </div>  
  </div> 
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write('<script src="../..{{ asset('assets') }}/company/js/jquery.min.js"><\script>')
</script>
<script src="{{ asset('assets') }}/company/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection