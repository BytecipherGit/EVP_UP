
@extends('company.layouts.app') 
@section('content')
@section('title','EVP - Reset Password')
    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="change-password-page">
        <h2>Change Password</h2>
        <form>
          <div class="row">          
            <div class="col-lg-6 order-lg-1 order-md-2">            
              <p>Passwords must contain:</p>
              <ul>
                <li>At least 8 characters</li>
                {{-- <li>At least 1 upper case letter (A..Z)</li> --}}
                {{-- <li>At least 1 lower case letter (a..Z)</li> --}}
                {{-- <li>At least 1 number (0..9)</li> --}}
              </ul> 
            </div>
            <div class="col-lg-6 order-lg-2 order-md-1">
              <div class="form-group">
                <label>Current Password</label>
                <div class="effect-box">
                  <input type="password" name="" class="form-control" placeholder="Password">
                  <span><i class="fa fa-lock"></i></span>
                  <span class="eye-pst"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <div class="effect-box">
                  <input type="password" name="" class="form-control" placeholder="Password">
                  <span><i class="fa fa-lock"></i></span>
                  <span class="eye-pst"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <div class="effect-box">
                  <input type="password" name="" class="form-control" placeholder="Password">
                  <span><i class="fa fa-lock"></i></span>
                  <span class="eye-pst"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
              </div>              
            </div>
            <div class="col-lg-12 order-lg-3 order-md-3">
              <div class="form-group">
                <button>Update Password</button>
              </div>
            </div>
          </div>
        </form>  
      </div>

      

    </div>
    <!--- Main Container Close ----->
 
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>  

@endsection