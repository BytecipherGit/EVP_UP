@extends('company/layouts.appcom')
@section('content')
@section('title','EVP - Company Verification Document')

<div class="d-flex main-form-part">
    <div class="container-fluid">
      <div class="row">                
        <div class="col-lg-6 pad-0">
          <div class="main-box-img">
            <img src="assets/company/images/login-bg.jpg">
          </div>
        </div>
        <div class="col-lg-6 form-section">
          {{-- <span class="">Your Documents is Under Verification.</span><br/>
            <span>We Will Verified Soon.</span>
          --}}
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="assets/company/images/email-verify.png">
                <h2>Your Documents is Under Verification.</h2>
                <h3>We Will Verified Soon.</h3>
                <!-- <p>Please check your rigistered email for email verification</p> -->
               
                <a href="{{ route('login') }}">Back to Login</a>
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
<script src="assets/company/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection