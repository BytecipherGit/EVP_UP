 
 @extends('company/layouts.app')
 @section('content')
 @section('title','EVP - Company Verification Document')
 
 <style>
  .pass{
    position: static !important;
    font-size: 14px !important;
  }
 </style>
 <!--- Main Container Start ----->
 <div class="main-container">

    <div class="change-password-page">
      <h2>Change Password</h2>
      @if (session()->has('status'))
      <div class="alert alert-success">
          {{ session()->get('status') }}
      </div>
        @endif
      <form method="post" action="{{route('password.change')}}">
        @csrf
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
              <label for="oldPasswordInput">Current Password</label>
              <div class="effect-box">
                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                placeholder="Old Password"/>  <span><i class="fa fa-lock"></i></span>   
                {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                 @error('old_password')
                <span class="text-danger pass">{{ $message }}</span>
                @enderror    
              
              </div>
            </div>

            <div class="form-group">
              <label for="newPasswordInput">New Password</label>
              <div class="effect-box">
                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                placeholder="New Password">  <span><i class="fa fa-lock"></i></span>
                @error('new_password')
                <span class="text-danger pass">{{ $message }}</span>
                @enderror   
              </div>
            </div>

            <div class="form-group">
              <label for="confirmNewPasswordInput">Confirm Password</label>
              <div class="effect-box">
                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                placeholder="Confirm New Password">  <span><i class="fa fa-lock"></i></span>
                @error('new_password')
                <span class="text-danger pass">{{ $message }}</span>
                @enderror   
              </div>
            </div>              
          </div>

          <div class="col-lg-12 order-lg-3 order-md-3">
            <div class="form-group">
              <button type="submit" class="button_background_color">Update Password</button>
            </div>
          </div>
        </div>
      </form>  
    </div>

    

  </div>
  <!--- Main Container Close ----->
  <script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
  @endsection