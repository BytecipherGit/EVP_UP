<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Verification - Basic Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/company/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/my-css.css">
  {{-- <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/header-css.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/individual-info.css">  
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/jquery-ui.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/select2.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/company/js/jquery.min.js"></script>
</head>

<body>

<header>
  <div class="container-fluid">
    <div class="navigation-wrap start-header start-style">
      <nav class="navbar navbar-expand-md navbar-light">
        
          <a class="navbar-brand" href="{{ route('employee_login.dashboard')}}"><img src="{{ asset('assets') }}/company/images/logo.png" alt=""></a>  
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto py-4 py-md-0">
              <li class="nav-item">
                <a class="nav-link" href="/logout">logout</a>
              </li>              
            </ul>
          </div>     --}}
  <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link profile-droup dropdown-toggle indHoverRemove" href="#"
                id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img src="{{ asset('assets') }}/admin/images/marvin-kinney-profile.png">
                <span class="secondary_color">
                   {{ Auth::guard('employee')->user()->emg_name }}
                </span>
                {{-- <img src="{{ asset('assets') }}/admin/images/white-down.png" class="right-doun"> --}}
                <?xml version="1.0" encoding="UTF-8"?>
                <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode"
                    data-name="Isolation Mode" viewBox="0 0 24 24" width="45" height="14"
                    class="right-doun secondary_color">
                    <path
                        d="M0,8.057l9.52,9.507a3.507,3.507,0,0,0,4.948,0L24,8.046,21.879,5.929l-9.531,9.517a.5.5,0,0,1-.707,0L2.121,5.94Z"
                        fill="" class="iconFill" />
                </svg>

            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/employee_login/dashboard">
                    Profile
                </a>

                <a class="dropdown-item" href="/employee_login/change_password">
                    Change Password
                </a>
                <hr>
                {{-- <a class="dropdown-item dropdown-item-no" href="{{ route('logout') }}">     --}}


                <a class="dropdown-item d-flex" href="{{ route('employee.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign out
                    <img src="{{ asset('assets') }}/admin/images/logout-icon.png" class="ml-auto">
                </a>
                <form id='logout-form' action="{{ route('employee.logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</div>
        </nav>
    </div>     
  </div>
</header>

@yield('content')

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets') }}/admin/js/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    <script src="{{ asset('assets') }}/admin/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/select2.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/sweetalert.min.js"></script>
    <script src="{{ asset('assets') }}/admin/js/jquery.validate.min.js"></script>


    @yield('pagescript')
    
 </body>
</html>

