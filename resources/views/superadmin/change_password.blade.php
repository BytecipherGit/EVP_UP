 @extends('superadmin.layouts.app')
 @section('content')
 @section('title', 'EVP - Change Password')

 <style>
     .pass {
         position: static !important;
         font-size: 14px !important;
     }
 </style>
 <!--- Main Container Start ----->
 <div class="main-container">

     <div class="change-password-page">
         <h2>Change Password</h2>
         <form action="{{ URL::to('admin/change_password') }}" method="post" role="form" enctype="multipart/form-data">

             @if (Session::has('success'))
                 <div class="alert alert-success">{!! Session::get('success') !!}</div>
             @endif
             @if (Session::has('failure'))
                 <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
             @endif
             {{ csrf_field() }}
             <div class="row">
                 {{-- <div class="col-lg-6 order-lg-1 order-md-2">             --}}
                 {{-- <p>Passwords must contain:</p> --}}
                 {{-- <ul> --}}
                 {{-- <li>At least 6 characters</li> --}}
                 {{-- <li>At least 1 upper case letter (A..Z)</li> --}}
                 {{-- <li>At least 1 lower case letter (a..Z)</li> --}}
                 {{-- <li>At least 1 number (0..9)</li> --}}
                 {{-- </ul>  --}}
                 {{-- </div> --}}
                 <div class="col-lg-6 order-lg-2 order-md-1">
                     <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                         <label for="password">Old Password</label>

                         <div class="effect-box">
                             <input id="password" type="password" class="form-control" placeholder="Old password"
                                 name="old">
                             {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                             @if ($errors->has('old'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('old') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                         <label for="password">Password</label>

                         <div class="effect-box">
                             <input id="password" type="password" class="form-control" placeholder="New password"
                                 name="password">
                             {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                             @if ($errors->has('password'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                         <label for="password-confirm">Confirm Password</label>

                         <div class="effect-box">
                             <input id="password-confirm" type="password" class="form-control"
                                 placeholder="Confirm password" name="password_confirmation">
                             {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                             @if ($errors->has('password_confirmation'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('password_confirmation') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-12 order-lg-3 order-md-3">
                     <div class="form-group">
                         <button type="submit" class="button_background_color">
                             <p class="button_text_color">Update Password</p>
                         </button>
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
