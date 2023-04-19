<!DOCTYPE html>
<html lang="en">

<head>
    <title>ByteCipher - Dashboard</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" href="{{ asset('assets') }}/admin/images/logo-icon.png">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/header-css.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/main-container.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/select2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/jquery-ui.min.css" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/bootstrap-colorpicker.min.css" rel="stylesheet">


    <style>
        .loadingImg {
            display: none;
            content: url('{{ asset('ajaxLoading.gif') }}') !important;
        }

        .fa {
            font-size: 18px;
        }
        .colorpicker-alpha.colorpicker-visible, .colorpicker-hue.colorpicker-visible, .colorpicker-saturation.colorpicker-visible, .colorpicker-selectors.colorpicker-visible, .colorpicker.colorpicker-visible {
    display: block;
    z-index: 99999 !important;
    position: absolute;
    top: 0;
    left: 50%;
}
    </style>


</head>

<body>

    <!--- Header Start ----->
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-dark">
                <a class="navbar-brand" href="admin-index"><img src="{{ asset('assets') }}/admin/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle1" href="#"
                                id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('assets') }}/admin/images/notifications-icon.png">
                            </a>
                            <div class="dropdown-menu dropdown-notifications" aria-labelledby="navbarDropdownMenuLink">
                                <h2>Recent <span>Notifications</span></h2>
                                <div class="dropdown-noti" id="style-5">
                                    <h4>Today</h4>

                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>juhi Thakur </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>16:35</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>Pritesh Gore </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>15:05</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>Prakash Varma </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>10:35</p>
                                        </div>
                                    </a>

                                    <h4>Yesterday</h4>
                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>Priya Varma </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>10:35</p>
                                        </div>
                                    </a>

                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>Nidhi Varma </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>07:02</p>
                                        </div>
                                    </a>

                                    <h4>10-10-2021</h4>
                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>juhi Thakur </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>16:35</p>
                                        </div>
                                    </a>

                                    <h4>09-10-2021</h4>
                                    <a class="dropdown-item" href="/notification">
                                        <div class="noti-box-80">
                                            <h3>Pritesh Gore </h3>
                                            <p>has assigned leave policy Casual Leave to you</span></p>
                                        </div>
                                        <div class="noti-box-20">
                                            <p>15:05</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="all-noti-btn"><a href="/notification">See All Notifications</a></div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link profile-droup dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets') }}/admin/images/marvin-kinney-profile.png">
                                <span>
                                    {{ Auth::user()->name }}
                                </span>
                                <img src="{{ asset('assets') }}/admin/images/droup-down-gray.png" class="right-doun">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/company_profile">
                                    Profile
                                </a>
                                <a class="dropdown-item" href="/change_password">
                                    Change Password
                                </a>
                                <hr>
                                {{-- <a class="dropdown-item dropdown-item-no" href="{{ route('logout') }}">     --}}


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                    <img src="{{ asset('assets') }}/admin/images/logout-icon.png" class="ml-auto">
                                </a>
                                <form id='logout-form' action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>

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

                <li>
                    <a href="/search">
                        <img src="{{ asset('assets') }}/admin/images/search-icon-gray.png">
                        Search
                    </a>
                </li>

                <li class="active">
                    <a href="/admin">
                        <img src="{{ asset('assets') }}/admin/images/overview-icon.png">
                        Overview
                    </a>
                </li>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-1">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true"
                                    aria-controls="collapse-1" class="">
                                    Employees
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-1" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-1" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li>
                                            <a href="/employee">
                                                <img src="{{ asset('assets') }}/admin/images/employees-view.png">
                                                All Employees
                                            </a>
                                        </li>

                                        {{-- <li>
                                                <a href="/current-employee">
                                                    <img src="{{ asset('assets') }}/admin/images/current-user.png">
                                                    Current Employee
                                                </a>
                                                </li>                     --}}
                                        {{-- <li>
                                                <a href="/post-employee">
                                                    <img src="{{ asset('assets') }}/admin/images/employees-icon.png"> Past Employee
                                                </a>
                                           </li> --}}

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <li>
                    <a href="/invite-employee">
                        <img src="{{ asset('assets') }}/admin/images/invite-icon.png">
                        Invite Employees
                    </a>
                </li>

                <li>
                    <a href="/schedule-interview">
                        <img src="{{ asset('assets') }}/admin/images/schedule-icon.png">
                        Schedule for Interview
                    </a>
                </li>

                <hr>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-2">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true"
                                    aria-controls="collapse-2" class="">
                                    Settings
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-2" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-2" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li>
                                            <a href="/theme_setting">
                                                <img src="" class="fa fa-question-circle">
                                                Theme Setting
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/interview_process">
                                                <img src="" class="fa fa-question-circle">
                                                Interview Process
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/exit_employee_process">
                                                <img src="{{ asset('assets') }}/admin/images/employees-view.png">
                                                Exit Employees Process
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/position">
                                                <img src="" class="fa fa-user-plus">
                                                Open Job Positions
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/feedback">
                                                <img src="" class="fa fa-comments">
                                                Interview Feedback Points
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/company_profile">
                                                <img src="{{ asset('assets') }}/admin/images/company-icon.png">
                                                Company Profile
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-3">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="true"
                                    aria-controls="collapse-3" class="">
                                    Interview Email Template
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-3" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-3" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li>
                                            <a href="/qualified-email-template">
                                                <img src="" class="fa fa-user-plus">
                                                For Qualified
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/not-qualified-template">
                                                <img src="" class="fa fa-users">
                                                For Not Qualified
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
        <!--- Site Bar Menu Close ----->

        @yield('content')

    </div>
    <!--- Main Container Close ----->
    </div>
    <!--- Wapper Close ----->


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
    <script src="{{ asset('assets') }}/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    
    
    @yield('pagescript')

</body>

</html>
