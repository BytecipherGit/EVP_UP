<!DOCTYPE html>
<html lang="en">

<head>
  <title>EVP - Dashboard</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/superadmin/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/superadmin/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/superadmin/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/superadmin/css/header-css.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/superadmin/css/main-container.css">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/superadmin/js/jquery.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">
  

  
</head>

<body>
  
  <!--- Header Start ----->
  <header> 
    <div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark">
      <a class="navbar-brand" href=""><img src="{{ asset('assets') }}/superadmin/images/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">          
          <li class="nav-item dropdown">
            {{-- <a class="nav-link dropdown-toggle dropdown-toggle1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset('assets') }}/superadmin/images/notifications-icon.png">
            </a>  --}}
            <div class="dropdown-menu dropdown-notifications" aria-labelledby="navbarDropdownMenuLink">
              <h2>Recent <span>Notifications</span></h2>
              <div class="dropdown-noti" id="style-5">
                <h4>Today</h4>

                <a class="dropdown-item" href="#">
                  <div class="noti-box-80">
                    <h3>juhi Thakur </h3>
                    <p>has assigned leave policy Casual Leave to you</span></p>
                  </div> 
                  <div class="noti-box-20">                  
                    <p>16:35</p>
                  </div> 
                </a>                

                <h4>Yesterday</h4>
                <a class="dropdown-item" href="#">
                  <div class="noti-box-80">
                    <h3>Priya Varma </h3>
                    <p>has assigned leave policy Casual Leave to you</span></p>
                  </div> 
                  <div class="noti-box-20">                  
                    <p>10:35</p>
                  </div> 
                </a>

                <h4>10-10-2021</h4>
                <a class="dropdown-item" href="#">
                  <div class="noti-box-80">
                    <h3>juhi Thakur </h3>
                    <p>has assigned leave policy Casual Leave to you</span></p>
                  </div> 
                  <div class="noti-box-20">                  
                    <p>16:35</p>
                  </div> 
                </a>
                
              </div>
              <div class="all-noti-btn"><a href="#">See All Notifications</a></div>
            </div>           
          </li>         

          <li class="nav-item dropdown">
            <a class="nav-link profile-droup dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset('assets') }}/superadmin/images/marvin-kinney-profile.png"> 
              <span>
                John Smith              
              </span>
              <img src="{{ asset('assets') }}/superadmin/images/droup-down-gray.png" class="right-doun">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              {{-- <a class="dropdown-item" href="#">
                Profile
              </a> --}}
              <a class="dropdown-item" href="{{ route('change.password') }}">
                Change Password
              </a>
              <hr>
              <a class="dropdown-item dropdown-item-no" href="{{ route('logout') }}">               
                Sign out
                <img src="{{ asset('assets') }}/superadmin/images/logout-icon.png" class="ml-auto">
              </a>

            </div>
          </li>    
        </ul>  
   
      </div>
    </nav> 
    </div>          
  </header>
  <!--- Header Close ----->
  
  <!--- Wapper Start ----->
  <div class="wapper">
    <!--- Site Bar Menu Start ----->
    <div class="side">
      <div class="toggle-wrap">
        <span class="toggle-bar"></span> 
      </div>
      <aside>
        <li @if (Request::segment(2) == '') class="active" @endif>
          <a href="{{ route('superadmin')}}">
            <img src="{{ asset('assets') }}/superadmin/images/overview-icon.png">
            Overview
          </a>
        </li>  

        <div id="accordion">
          <div class="card">
            <div class="card-header" id="heading-1">
              <h5 class="mb-0">
                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1" class="">
                  Users
                </a>
              </h5>
            </div>
            <div id="collapse-1" class="collapse show" data-parent="#accordion" aria-labelledby="heading-1" style="">
              <div class="card-body">

                <div id="accordion-1">
                  <ul>                    
                    <li @if (Request::segment(2) == 'organization') class="active" @endif>
                      <a href="{{ route('organization')}}">
                        <img src="{{ asset('assets') }}/superadmin/images/invite-icon.png"> 
                        Organization
                      </a>
                    </li>   
                    {{-- <li>
                      <a href="/individual-user">
                        <img src="{{ asset('assets') }}/superadmin/images/invite-icon.png"> 
                        Individual
                      </a>
                    </li> --}}
                  </ul>                  
                </div>      
              
              </div>
            </div>
          </div>
        </div> 
        {{-- <hr> --}}

         {{-- <li>
          <a href="#">
            <img src="{{ asset('assets') }}/superadmin/images/setting-icon.png">
            Settings
          </a>
        </li> --}}

      </aside>
    </div>
    <!--- Site Bar Menu Close ----->
      @yield('content')

  </div>
  <!--- Wapper Close -----> 
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../../{{ asset('assets') }}/superadmin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/sweetalert.min.js"></script>
    <script src="{{ asset('assets') }}/superadmin/js/bootstrap.min.js"></script>  
    <script src="{{ asset('assets') }}/datatable/js/jquery-3.5.1.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>
    
    <script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>
    
    @yield('pagescript')

</body>
</html>

