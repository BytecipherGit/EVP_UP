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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/fixedheader.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/datatable/css/jquery-ui.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/bootstrap-colorpicker.min.css" rel="stylesheet">

   
    <style>
        .loadingImg {
            display: none;
            content: url('{{ asset('ajaxLoading.gif') }}') !important;
        }
          
        .fa {
            font-size: 18px;
        }

        .colorpicker-alpha.colorpicker-visible,
        .colorpicker-hue.colorpicker-visible,
        .colorpicker-saturation.colorpicker-visible,
        .colorpicker-selectors.colorpicker-visible,
        .colorpicker.colorpicker-visible {
            display: block;
            z-index: 99999 !important;
            position: absolute;
            top: 0;
            left: 50%;
        }

        .primary_color {
            background: <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .secondary_color {
            color: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .button_text_color {
            color: <?php if (!empty(session('button_text_color'))) {echo session('button_text_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .button_background_color {
            background: <?php if (!empty(session('button_background_color'))) {echo session('button_background_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .link_color {
            color: <?php if (!empty(session('link_color'))) {echo session('link_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside .active svg .iconFill {
            fill: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside .active svg .iconstroke {
            stroke: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside li a:hover svg .iconFill {
            fill: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside li a:hover svg .iconstroke {
            stroke: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }
        
        .ser-part .ser-box .head-sec .img-bg svg .iconstroke {
            stroke: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .setting-pages .tab-content-details h2 { 
            color: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;    
        }

        .setting-pages .nav-tabs .nav-item.show .nav-link img h2, .setting-pages .nav-tabs .nav-link.active h2{
         color:  <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
          }

        .ser-part .ser-box .head-sec .img-bg svg .iconFill {
            fill: <?php if (!empty(session('primary_color'))) {
                echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .ser-part .ser-box:hover .head-sec .img-bg{
            background: <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }
        /* .colorBox {
            background: 
        } */
        .schudinter-tab .nav-tabs .nav-item.show .nav-linkSchedule, .nav-tabs .nav-linkSchedule.active {
            color: <?php if (!empty(session('button_text_color'))) {echo session('button_text_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            background: <?php if (!empty(session('button_background_color'))) {echo session('button_background_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            border-color: #dee2e6 #dee2e6 #fff;
            border-radius: 0;
        }

        aside .active a{
            color: <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;

            background: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            
        }

        aside li:hover {
          background: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?> !important;

            border-radius: 8px;
         }
            .schudinter-tab a:hover{
                /* background-color: #5533FF !important;
                color: #fff; */
                color: <?php if (!empty(session('button_text_color'))) {echo session('button_text_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            background: <?php if (!empty(session('button_background_color'))) {echo session('button_background_color');
            } else {
                echo '#5533ff';
            } ?> !important;

            }
           aside li a {
            color: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?>;
        }

        .serch-main-box .nav-tabs .nav-item.show .nav-link, .serch-main-box .nav-tabs .nav-link.active {
            color: <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;

            border-bottom: 2px solid <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;;
         }

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: <?php if (!empty(session('button_text_color'))) {echo session('button_text_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            cursor: default;
            background: <?php if (!empty(session('button_background_color'))) {echo session('button_background_color');
            } else {
                echo '#5533ff';
            } ?> !important;
            border-color: <?php if (!empty(session('button_background_color'))) {echo session('button_background_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .seachMain{
            background: <?php if (!empty(session('primary_color'))) {echo session('primary_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside li a svg .iconFill {
            fill: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        aside li a svg .iconstroke {
            stroke: <?php if (!empty(session('secondry_color'))) {echo session('secondry_color');
            } else {
                echo '#5533ff';
            } ?> !important;
        }

        .ser-part .ser-box .head-sec .img-bg svg{
            width:24px;
            height:24px
        }

        aside li a svg {
            margin-right: 15px;
            width: 24px;
            height: 24px;
        }

    </style>


</head>

<body>

    <!--- Header Start ----->
    <header class="primary_color">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-dark">
                <a class="navbar-brand" href="admin-index">
                    @if (session('logo'))
                        <img src="{{ session('logo') }}">
                </a>
            @else
                <img src="{{ asset('assets') }}/admin/images/logo.png"></a>
                @endif

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
                                {{-- <img src="{{ asset('assets') }}/admin/images/notifications-icon.png"> --}}
                                <?xml version="1.0" encoding="UTF-8"?>
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="19" height="25">
                                    <path d="M4.068,18H19.724a3,3,0,0,0,2.821-4.021L19.693,6.094A8.323,8.323,0,0,0,11.675,0h0A8.321,8.321,0,0,0,3.552,6.516l-2.35,7.6A3,3,0,0,0,4.068,18Z" fill="white" class="iconFill"/><path d="M7.1,20a5,5,0,0,0,9.8,0Z" fill="white" class="iconFill"/></svg>

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
                                <div class="all-noti-btn"><a href="/notification" class="button_background_color"><span class="button_text_color">See All Notifications</span></a></div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link profile-droup dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets') }}/admin/images/marvin-kinney-profile.png">
                                <span class="secondary_color">
                                    {{ Auth::user()->name }}
                                </span>
                                {{-- <img src="{{ asset('assets') }}/admin/images/white-down.png" class="right-doun"> --}}
                                <?xml version="1.0" encoding="UTF-8"?>
                                <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode" viewBox="0 0 24 24" width="45" height="14"  class="right-doun secondary_color">
                                    <path d="M0,8.057l9.52,9.507a3.507,3.507,0,0,0,4.948,0L24,8.046,21.879,5.929l-9.531,9.517a.5.5,0,0,1-.707,0L2.121,5.94Z" fill="white" class="iconFill"/></svg>

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


                                <a class="dropdown-item d-flex" href="{{ route('logout') }}"
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
            <aside id="style-5" class="primary_color">

                <li @if (Request::segment(1) == 'search') class="active" @endif >
                    <a href="/search">
                        <?xml version="1.0" encoding="UTF-8"?>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
                            <path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z" fill="white" class="iconFill"/></svg>
                        
                        Search
                    </a>
                </li>

                <li @if (Request::segment(1) == 'admin') class="active" @endif>
                    <a href="/admin">
                        {{-- <img src="{{ asset('assets') }}/admin/images/overview-icon.png"> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                            fill="none">
                            <mask id="mask0_0_9188" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                x="0" y="0" width="21" height="20">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.5 20H12.5C11.9477 20 11.5 19.5523 11.5 19V12C11.5 11.4477 11.9477 11 12.5 11H19.5C20.0523 11 20.5 11.4477 20.5 12V19C20.5 19.5523 20.0523 20 19.5 20ZM12.5 12V19H19.5V12H12.5ZM8.5 20H1.5C0.947715 20 0.5 19.5523 0.5 19V12C0.5 11.4477 0.947715 11 1.5 11H8.5C9.05228 11 9.5 11.4477 9.5 12V19C9.5 19.5523 9.05228 20 8.5 20ZM1.5 12V19H8.5V12H1.5ZM19.5 9H12.5C11.9477 9 11.5 8.55228 11.5 8V1C11.5 0.447715 11.9477 0 12.5 0H19.5C20.0523 0 20.5 0.447715 20.5 1V8C20.5 8.55228 20.0523 9 19.5 9ZM12.5 1V8H19.5V1H12.5ZM8.5 9H1.5C0.947715 9 0.5 8.55228 0.5 8V1C0.5 0.447715 0.947715 0 1.5 0H8.5C9.05228 0 9.5 0.447715 9.5 1V8C9.5 8.55228 9.05228 9 8.5 9ZM1.5 1V8H8.5V1H1.5Z"
                                    fill="white" />
                            </mask>
                            <g mask="url(#mask0_0_9188)">
                                <rect x="-1.5" y="-2" width="24" height="24" fill="black"
                                    class="iconFill" />
                            </g>
                        </svg>
                        Overview
                    </a>
                </li>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-1">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true"
                                    aria-controls="collapse-1" class="secondary_color">
                                    Employees 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="9" viewBox="0 0 17 9" fill="none">
                                        <path d="M8.54692 9C8.23185 9.00055 7.91977 8.93882 7.62863 8.81837C7.33749 8.69792 7.07303 8.52112 6.85044 8.29813L0.5 1.94649L2.19649 0.25L8.54692 6.60044L14.8974 0.25L16.5938 1.94649L10.2434 8.29692C10.0209 8.52013 9.7565 8.69716 9.46535 8.81781C9.17421 8.93847 8.86208 9.00039 8.54692 9Z"  fill="white" class="iconFill"/>
                                        </svg>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-1" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-1" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li @if (Request::segment(1) == 'employee') class="active" @endif>
                                            <a href="/employee">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="180" height="181"
                                                    viewBox="0 0 180 181" fill="none">
                                                    <circle cx="82.5" cy="48.5" r="43.5"
                                                        stroke="black" stroke-width="10" class="iconstroke" />
                                                    <path
                                                        d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5"
                                                        stroke="black" stroke-width="10" class="iconstroke" />
                                                    <path
                                                        d="M173.653 143.791C132.167 85.2593 85.9363 118.521 66.9371 143.732C66.3759 144.476 66.4564 145.524 67.0779 146.219C112.706 197.241 156.458 168.183 173.638 146.129C174.166 145.451 174.15 144.492 173.653 143.791Z"
                                                        stroke="black" stroke-width="10" class="iconstroke" />
                                                    <circle cx="120" cy="143" r="15"
                                                        fill="black" class="iconFill" />
                                                </svg>
                                                All Employees
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <li @if (Request::segment(1) == 'invite_employee') class="active" @endif>
                    <a href="/invite_employee">
                        <svg xmlns="http://www.w3.org/2000/svg" width="147" height="181" viewBox="0 0 147 181" fill="none">
                                                <circle cx="82.5" cy="48.5" r="43.5" stroke="black" stroke-width="10" class="iconstroke" />
                                                <path d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5" stroke="black"  class="iconstroke" stroke-width="10"/>
                                                <line x1="116" y1="110" x2="116" y2="174" stroke="black" class="iconstroke" stroke-width="10"/>
                                                <line x1="83" y1="143" x2="147" y2="143" stroke="black" class="iconstroke" stroke-width="10"/>
                                                </svg>
                        Invite Employees
                    </a>
                </li>

                <li @if (Request::segment(1) == 'schedule_interview') class="active" @endif>
                    <a href="/schedule_interview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="180" height="192" viewBox="0 0 180 192" fill="none">
                        <path d="M67.4768 75.3138H58.0923C58.126 72.0848 58.4119 69.4443 58.95 67.3925C59.5219 65.3071 60.4469 63.4066 61.725 61.6912C63.0032 59.9758 64.7018 58.0249 66.8209 55.8385C68.3681 54.2576 69.7809 52.7777 71.059 51.3986C72.3708 49.9859 73.4304 48.4722 74.2376 46.8577C75.0449 45.2095 75.4485 43.2418 75.4485 40.9546C75.4485 38.6337 75.0281 36.6323 74.1872 34.9505C73.3799 33.2687 72.169 31.9737 70.5545 31.0656C68.9736 30.1574 67.0059 29.7033 64.6514 29.7033C62.7005 29.7033 60.8505 30.0565 59.1014 30.7628C57.3523 31.4692 55.9396 32.5624 54.8633 34.0424C53.7869 35.4887 53.2319 37.3892 53.1983 39.7437H43.8643C43.9315 35.9428 44.8734 32.6801 46.6897 29.9556C48.5397 27.2311 51.0288 25.1456 54.1569 23.6993C57.2851 22.2529 60.7832 21.5297 64.6514 21.5297C68.9231 21.5297 72.5558 22.3034 75.5494 23.8506C78.5767 25.3979 80.8808 27.6179 82.4617 30.5106C84.0426 33.3696 84.833 36.7669 84.833 40.7023C84.833 43.7295 84.2107 46.5213 82.9662 49.0777C81.7553 51.6004 80.1912 53.9717 78.274 56.1917C76.3567 58.4117 74.3217 60.5308 72.169 62.5489C70.319 64.2644 69.0745 66.1984 68.4354 68.3512C67.7963 70.5039 67.4768 72.8247 67.4768 75.3138ZM57.6887 91.3078C57.6887 89.7941 58.1596 88.516 59.1014 87.4733C60.0432 86.4305 61.4055 85.9092 63.1882 85.9092C65.0045 85.9092 66.3836 86.4305 67.3254 87.4733C68.2672 88.516 68.7381 89.7941 68.7381 91.3078C68.7381 92.7541 68.2672 93.9987 67.3254 95.0414C66.3836 96.0841 65.0045 96.6054 63.1882 96.6054C61.4055 96.6054 60.0432 96.0841 59.1014 95.0414C58.1596 93.9987 57.6887 92.7541 57.6887 91.3078Z" fill="black" class="iconFill"/>
                        <path d="M5 105V76.5V10C5 8.89543 5.89543 8 7 8H123C124.105 8 125 8.89543 125 10V109.5C125 110.605 124.105 111.5 123 111.5H69.6776C69.2381 111.5 68.8109 111.645 68.4619 111.912L31.7156 140.039C30.3997 141.046 28.5 140.108 28.5 138.451V109C28.5 107.895 27.6046 107 26.5 107H7C5.89543 107 5 106.105 5 105Z" stroke="black" class="iconstroke" stroke-width="10"/>
                        <path d="M124.5 54H173C174.105 54 175 54.8954 175 56V122.5V151C175 152.105 174.105 153 173 153H153.5C152.395 153 151.5 153.895 151.5 155V184.45C151.5 186.108 149.6 187.046 148.284 186.039L111.538 157.912C111.189 157.645 110.762 157.5 110.322 157.5H57C55.8954 157.5 55 156.605 55 155.5V120" stroke="black" class="iconstroke" stroke-width="10"/>
                        <circle cx="88.3875" cy="133.387" r="8.3875" fill="black"class="iconFill" />
                        <circle cx="117.161" cy="133.387" r="8.3875" fill="black" class="iconFill" />
                        <circle cx="145.934" cy="133.387" r="8.3875" fill="black" class="iconFill" />
                        </svg>
                        Schedule for Interview
                    </a>
                </li>

                {{-- <hr> --}}

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-2">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true"
                                    aria-controls="collapse-2" class="secondary_color">
                                    Settings <svg xmlns="http://www.w3.org/2000/svg" width="17" height="9" viewBox="0 0 17 9" fill="none">
                                        <path d="M8.54692 9C8.23185 9.00055 7.91977 8.93882 7.62863 8.81837C7.33749 8.69792 7.07303 8.52112 6.85044 8.29813L0.5 1.94649L2.19649 0.25L8.54692 6.60044L14.8974 0.25L16.5938 1.94649L10.2434 8.29692C10.0209 8.52013 9.7565 8.69716 9.46535 8.81781C9.17421 8.93847 8.86208 9.00039 8.54692 9Z"  fill="white" class="iconFill" />
                                        </svg>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-2" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-2" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li @if (Request::segment(1) == 'theme_setting') class="active" @endif>
                                            <a href="/theme_setting">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.58 21C9.58 22.6569 10.9231 24 12.58 24C13.376 24.0005 14.1396 23.6847 14.7026 23.122C15.2657 22.5594 15.582 21.796 15.582 21V20.827C15.5835 20.5695 15.738 20.3376 15.975 20.237C16.0612 20.1984 16.1545 20.1783 16.249 20.178C16.4185 20.1776 16.5813 20.244 16.702 20.363L16.754 20.415C17.3156 20.9796 18.0797 21.2961 18.876 21.294C20.5329 21.294 21.876 19.9509 21.876 18.294C21.878 17.4972 21.5611 16.7327 20.996 16.171L20.937 16.112C20.76 15.9198 20.7124 15.6416 20.8154 15.4015C20.9184 15.1615 21.1528 15.0042 21.414 15H21.5C23.1569 15 24.5 13.6569 24.5 12C24.5 10.3431 23.1569 9 21.5 9H21.33C21.1165 8.99859 20.9174 8.89196 20.798 8.715C20.7838 8.64625 20.7624 8.5792 20.734 8.515C20.626 8.27231 20.6776 7.98824 20.864 7.799L20.916 7.747C21.479 7.18434 21.7954 6.42098 21.7954 5.625C21.7954 4.82902 21.479 4.06566 20.916 3.503C20.3524 2.94202 19.5902 2.62613 18.795 2.624C17.9982 2.62202 17.2337 2.9389 16.672 3.504L16.613 3.563C16.4934 3.67782 16.3338 3.74165 16.168 3.741C15.8047 3.73948 15.5087 3.44916 15.5 3.086V3C15.5 1.34315 14.1569 0 12.5 0C10.8431 0 9.5 1.34315 9.5 3V3.17C9.49827 3.38314 9.39167 3.58175 9.215 3.701C9.14638 3.71565 9.07938 3.73709 9.015 3.765C8.77224 3.87242 8.48851 3.82091 8.299 3.635L8.247 3.583C7.07505 2.41022 5.17428 2.40955 4.0015 3.5815C2.82872 4.75345 2.82805 6.65422 4 7.827L4.064 7.891C4.24417 8.08098 4.29231 8.36072 4.186 8.6C4.08912 8.89459 3.80997 9.09032 3.5 9.081C1.84315 9.081 0.5 10.4241 0.5 12.081C0.5 13.7379 1.84315 15.081 3.5 15.081H3.666C3.9236 15.0829 4.15563 15.2372 4.257 15.474C4.36818 15.7192 4.31822 16.0075 4.131 16.201L4.079 16.253C3.51442 16.8146 3.19791 17.5787 3.2 18.375C3.20389 19.1708 3.52155 19.933 4.084 20.496C4.64666 21.059 5.41002 21.3754 6.206 21.3754C7.00198 21.3754 7.76534 21.059 8.328 20.496L8.387 20.437C8.50674 20.3224 8.66623 20.2586 8.832 20.259C8.92295 20.259 9.01288 20.2781 9.096 20.315C9.39141 20.4107 9.58846 20.6896 9.58 21ZM9.843 18.462C9.528 18.323 9.1873 18.2518 8.843 18.253C8.14793 18.2571 7.48155 18.5306 6.984 19.016L6.916 19.083C6.66323 19.3359 6.29473 19.4348 5.94929 19.3424C5.60385 19.25 5.33396 18.9803 5.24129 18.6349C5.14861 18.2895 5.24723 17.9209 5.5 17.668L5.558 17.607C6.30615 16.8437 6.52546 15.7071 6.11498 14.7202C5.70451 13.7334 4.74378 13.0875 3.675 13.08H3.5C2.94772 13.08 2.5 12.6323 2.5 12.08C2.5 11.5277 2.94772 11.08 3.5 11.08H3.59C4.68551 11.064 5.65831 10.3757 6.038 9.348C6.45144 8.36919 6.23302 7.23762 5.485 6.483L5.417 6.415C5.22922 6.22743 5.12371 5.97291 5.12371 5.7075C5.12371 5.44209 5.22922 5.18757 5.417 5C5.60313 4.80898 5.85829 4.70086 6.125 4.7C6.3912 4.70191 6.64566 4.80988 6.832 5L6.892 5.058C7.61236 5.76824 8.67404 6.0068 9.629 5.673C9.72035 5.66134 9.80957 5.63676 9.894 5.6C10.8653 5.18455 11.4965 4.23138 11.5 3.175V3C11.5 2.44772 11.9477 2 12.5 2C13.0523 2 13.5 2.44772 13.5 3V3.09C13.503 4.1472 14.1337 5.10162 15.105 5.519C15.4381 5.66665 15.7986 5.74263 16.163 5.742C16.8571 5.74326 17.5238 5.47133 18.019 4.985L18.086 4.917C18.3718 4.62881 18.8035 4.54198 19.1786 4.69726C19.5536 4.85253 19.7975 5.2191 19.796 5.625C19.7951 5.89002 19.6898 6.14401 19.503 6.332L19.443 6.392C18.7304 7.11105 18.4915 8.1742 18.828 9.129C18.8397 9.22022 18.8639 9.3094 18.9 9.394C19.316 10.3652 20.2694 10.9964 21.326 11H21.5C22.0523 11 22.5 11.4477 22.5 12C22.5 12.5523 22.0523 13 21.5 13H21.41C20.3429 13.0072 19.383 13.6505 18.9708 14.6348C18.5586 15.6192 18.7735 16.7545 19.517 17.52L19.584 17.587C19.7721 17.7746 19.8778 18.0293 19.8778 18.295C19.8778 18.5607 19.7721 18.8154 19.584 19.003C19.3964 19.1911 19.1417 19.2968 18.876 19.2968C18.6103 19.2968 18.3556 19.1911 18.168 19.003L18.107 18.943C17.3444 18.1929 16.2067 17.9723 15.219 18.3831C14.2313 18.794 13.5857 19.7563 13.58 20.826V21C13.58 21.5523 13.1323 22 12.58 22C12.0277 22 11.58 21.5523 11.58 21V20.91C11.5635 19.8131 10.8729 18.8398 9.843 18.462Z" fill="black"/>
                                                <mask id="mask0_0_8149" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="25" height="24">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.58 24C10.9231 24 9.58 22.6569 9.58 21C9.58846 20.6896 9.39141 20.4107 9.096 20.315C9.01256 20.278 8.92228 20.2589 8.831 20.259C8.66521 20.2585 8.50568 20.3223 8.386 20.437L8.327 20.496C7.76434 21.059 7.00098 21.3754 6.205 21.3754C5.40902 21.3754 4.64566 21.059 4.083 20.496C3.52092 19.9328 3.20363 19.1707 3.2 18.375C3.19791 17.5787 3.51442 16.8146 4.079 16.253L4.131 16.201C4.31848 16.0076 4.36847 15.7192 4.257 15.474C4.15563 15.2372 3.9236 15.0829 3.666 15.081H3.5C1.84315 15.081 0.5 13.7379 0.5 12.081C0.5 10.4241 1.84315 9.081 3.5 9.081C3.80997 9.09032 4.08912 8.89459 4.186 8.6C4.29231 8.36072 4.24417 8.08098 4.064 7.891L4 7.827C2.82805 6.65422 2.82872 4.75345 4.0015 3.5815C5.17428 2.40955 7.07505 2.41022 8.247 3.583L8.299 3.635C8.42021 3.75383 8.58326 3.82027 8.753 3.82C8.84331 3.82006 8.93261 3.80097 9.015 3.764C9.07937 3.73606 9.14637 3.71462 9.215 3.7C9.39151 3.58107 9.49811 3.38283 9.5 3.17V3C9.5 1.34315 10.8431 0 12.5 0C14.1569 0 15.5 1.34315 15.5 3V3.086C15.5087 3.44916 15.8047 3.73948 16.168 3.741C16.3338 3.74186 16.4935 3.678 16.613 3.563L16.672 3.504C17.2337 2.9389 17.9982 2.62202 18.795 2.624C19.5902 2.62613 20.3524 2.94202 20.916 3.503C21.479 4.06566 21.7954 4.82902 21.7954 5.625C21.7954 6.42098 21.479 7.18434 20.916 7.747L20.864 7.799C20.6776 7.98824 20.626 8.27231 20.734 8.515C20.7623 8.57924 20.7837 8.64627 20.798 8.715C20.9173 8.89209 21.1165 8.99877 21.33 9H21.5C23.1569 9 24.5 10.3431 24.5 12C24.5 13.6569 23.1569 15 21.5 15H21.414C21.1528 15.0042 20.9184 15.1615 20.8154 15.4015C20.7124 15.6416 20.76 15.9198 20.937 16.112L20.996 16.171C21.5611 16.7327 21.878 17.4972 21.876 18.294C21.876 19.9509 20.5329 21.294 18.876 21.294C18.0797 21.2961 17.3156 20.9796 16.754 20.415L16.702 20.363C16.5811 20.2445 16.4183 20.1784 16.249 20.179C16.1546 20.1794 16.0612 20.1995 15.975 20.238C15.738 20.3386 15.5835 20.5705 15.582 20.828V21C15.582 21.796 15.2657 22.5594 14.7026 23.122C14.1396 23.6847 13.376 24.0005 12.58 24ZM8.843 18.253C9.1873 18.2518 9.52801 18.323 9.843 18.462C10.8729 18.8398 11.5635 19.8131 11.58 20.91V21C11.58 21.5523 12.0277 22 12.58 22C13.1323 22 13.58 21.5523 13.58 21V20.826C13.5866 19.7568 14.2323 18.7952 15.2196 18.3846C16.2069 17.9739 17.344 18.1938 18.107 18.943L18.168 19.003C18.3556 19.1911 18.6103 19.2968 18.876 19.2968C19.1417 19.2968 19.3964 19.1911 19.584 19.003C19.7721 18.8154 19.8778 18.5607 19.8778 18.295C19.8778 18.0293 19.7721 17.7746 19.584 17.587L19.517 17.52C18.7735 16.7545 18.5586 15.6192 18.9708 14.6348C19.383 13.6505 20.3429 13.0072 21.41 13H21.5C22.0523 13 22.5 12.5523 22.5 12C22.5 11.4477 22.0523 11 21.5 11H21.326C20.2694 10.9964 19.316 10.3652 18.9 9.394C18.8639 9.3094 18.8397 9.22022 18.828 9.129C18.4915 8.1742 18.7304 7.11105 19.443 6.392L19.503 6.332C19.6898 6.14401 19.7951 5.89002 19.796 5.625C19.7975 5.2191 19.5536 4.85253 19.1786 4.69726C18.8035 4.54198 18.3718 4.62881 18.086 4.917L18.019 4.985C17.5238 5.47133 16.8571 5.74326 16.163 5.742C15.799 5.74231 15.4389 5.66635 15.106 5.519C14.1343 5.10193 13.5032 4.14744 13.5 3.09V3C13.5 2.44772 13.0523 2 12.5 2C11.9477 2 11.5 2.44772 11.5 3V3.175C11.4965 4.23138 10.8653 5.18455 9.894 5.6C9.80965 5.63698 9.72039 5.66157 9.629 5.673C8.67403 6.00655 7.61248 5.76802 6.892 5.058L6.832 5C6.64566 4.80988 6.3912 4.70191 6.125 4.7C5.85829 4.70086 5.60313 4.80898 5.417 5C5.22922 5.18757 5.12371 5.44209 5.12371 5.7075C5.12371 5.97291 5.22922 6.22743 5.417 6.415L5.485 6.483C6.23302 7.23762 6.45144 8.36919 6.038 9.348C5.65854 10.3759 4.6856 11.0643 3.59 11.08H3.5C2.94772 11.08 2.5 11.5277 2.5 12.08C2.5 12.6323 2.94772 13.08 3.5 13.08H3.675C4.74378 13.0875 5.70451 13.7334 6.11498 14.7202C6.52546 15.7071 6.30615 16.8437 5.558 17.607L5.5 17.668C5.24723 17.9209 5.14861 18.2895 5.24129 18.6349C5.33396 18.9803 5.60385 19.25 5.94929 19.3424C6.29473 19.4348 6.66323 19.3359 6.916 19.083L6.984 19.016C7.48161 18.5307 8.14795 18.2572 8.843 18.253ZM12.5 16C10.2909 16 8.5 14.2091 8.5 12C8.5 9.79086 10.2909 8 12.5 8C14.7091 8 16.5 9.79086 16.5 12C16.5 13.0609 16.0786 14.0783 15.3284 14.8284C14.5783 15.5786 13.5609 16 12.5 16ZM12.5 10C11.3954 10 10.5 10.8954 10.5 12C10.5 13.1046 11.3954 14 12.5 14C13.6046 14 14.5 13.1046 14.5 12C14.5 10.8954 13.6046 10 12.5 10Z" fill="white"  />
                                                </mask>
                                                <g mask="url(#mask0_0_8149)">
                                                <rect x="0.5" width="24" height="24" fill="black" class="iconFill" />
                                                </g>
                                                </svg>
                                                Theme Setting
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'interview_process') class="active" @endif>
                                            <a href="/interview_process">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <g clip-path="url(#clip0_724_15296)">
                                                <path d="M19 4.87891H17.899C17.434 2.59991 15.414 0.878906 13 0.878906H5C2.243 0.878906 0 3.12191 0 5.87891V18.7329C0 19.5269 0.435 20.2529 1.134 20.6269C1.452 20.7979 1.801 20.8819 2.149 20.8819C2.565 20.8819 2.98 20.7609 3.339 20.5219L6.289 18.5549C6.98 20.4899 8.83 21.8789 11 21.8789H16.697L20.661 24.5229C21.02 24.7619 21.435 24.8829 21.851 24.8829C22.199 24.8829 22.547 24.7979 22.866 24.6269C23.565 24.2519 24 23.5259 24 22.7329V9.87891C24 7.12191 21.757 4.87891 19 4.87891ZM2.23 18.8579C2.211 18.8699 2.156 18.9059 2.078 18.8649C1.999 18.8229 1.999 18.7559 1.999 18.7339V5.87891C1.999 4.22491 3.345 2.87891 4.999 2.87891H12.999C14.653 2.87891 15.999 4.22491 15.999 5.87891V12.8789C15.999 14.5329 14.653 15.8789 12.999 15.8789H6.999C6.693 15.8789 6.458 16.0379 6.434 16.0539L2.23 18.8579ZM22 22.7339C22 22.7549 22 22.8229 21.922 22.8649C21.842 22.9079 21.788 22.8709 21.77 22.8579L17.555 20.0469C17.391 19.9379 17.198 19.8789 17 19.8789H11C9.696 19.8789 8.585 19.0429 8.172 17.8789H13C15.757 17.8789 18 15.6359 18 12.8789V6.87891H19C20.654 6.87891 22 8.22491 22 9.87891V22.7339ZM6 7.87891C6 6.98991 6.391 6.15191 7.072 5.57991C7.753 5.00791 8.649 4.76591 9.535 4.92691C10.744 5.13791 11.739 6.13191 11.952 7.34391C12.175 8.61591 11.57 9.88691 10.446 10.5079C9.999 10.7539 9.999 10.8259 9.999 10.8789C9.999 11.4319 9.551 11.8789 8.999 11.8789C8.447 11.8789 7.999 11.4319 7.999 10.8789C7.999 9.57091 9.037 8.99991 9.48 8.75591C9.77 8.59691 10.075 8.22091 9.982 7.68991C9.913 7.29791 9.58 6.96491 9.189 6.89691C8.883 6.84091 8.587 6.91891 8.357 7.11291C8.129 7.30291 7.999 7.58291 7.999 7.87991C7.999 8.43291 7.551 8.87991 6.999 8.87991C6.447 8.87991 5.999 8.43291 5.999 7.87991L6 7.87891ZM10 13.8789C10 14.4309 9.552 14.8789 9 14.8789C8.448 14.8789 8 14.4309 8 13.8789C8 13.3269 8.448 12.8789 9 12.8789C9.552 12.8789 10 13.3269 10 13.8789Z" fill="black" class="iconFill"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_724_15296">
                                                <rect width="24" height="24" fill="white" transform="translate(0 0.879883)"/>
                                                </clipPath>
                                                </defs>
                                                </svg>
                                                Interview Process
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'exit_employee_process') class="active" @endif>
                                            <a href="/exit_employee_process">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="180" height="181" viewBox="0 0 180 181" fill="none">
                                                <circle cx="82.5" cy="48.5" r="43.5" stroke="black" stroke-width="10" class="iconstroke" />
                                                <path d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5"stroke="black" stroke-width="10" class="iconstroke" />
                                                <path d="M173.653 143.791C132.167 85.2593 85.9363 118.521 66.9371 143.732C66.3759 144.476 66.4564 145.524 67.0779 146.219C112.706 197.241 156.458 168.183 173.638 146.129C174.166 145.451 174.15 144.492 173.653 143.791Z" stroke="black" stroke-width="10" class="iconstroke" />
                                                <circle cx="120" cy="143" r="15" fill="black" class="iconFill" />
                                                
                                            </svg>
                                                Exit Employees Process
                                            </a>
                                        </li>

                                        <li @if (Request::segment(1) == 'offer_send_details') class="active" @endif>
                                            <a href="/offer_send_details">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="147" height="181" viewBox="0 0 147 181" fill="none">
                                                    <circle cx="82.5" cy="48.5" r="43.5" stroke="black" stroke-width="10" class="iconstroke" />
                                                    <path d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5" stroke="black"  class="iconstroke" stroke-width="10"/>
                                                    <line x1="116" y1="110" x2="116" y2="174" stroke="black" class="iconstroke" stroke-width="10"/>
                                                    <line x1="83" y1="143" x2="147" y2="143" stroke="black" class="iconstroke" stroke-width="10"/>
                                                    </svg>
                                                Offer Send
                                            </a>
                                        </li>

                                        <li @if (Request::segment(1) == 'onboarding_process') class="active" @endif>
                                            <a href="/onboarding_process">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
                                                <path d="M23.001 13.1524H22.334C22.084 13.1524 21.836 13.1714 21.589 13.2094L14.543 7.92537L16.231 6.30937C16.63 5.92737 16.644 5.29337 16.262 4.89537C15.879 4.49637 15.245 4.48337 14.848 4.86437L10.675 8.85937C10.467 9.06737 10.184 9.17437 9.887 9.14937C9.589 9.12537 9.327 8.97437 9.148 8.72437C8.874 8.34437 8.958 7.74937 9.316 7.39037L14.019 2.96137C14.91 2.12437 16.303 1.91937 17.393 2.46637L19.709 3.62437C20.399 3.96937 21.173 4.15137 21.944 4.15137H23C23.553 4.15137 24 3.70437 24 3.15137C24 2.59837 23.553 2.15137 23 2.15137H21.944C21.481 2.15137 21.016 2.04237 20.602 1.83537L18.288 0.677367C16.464 -0.235633 14.135 0.103367 12.647 1.50537L12.029 2.08737L11.329 1.44937C10.41 0.612367 9.22 0.151367 7.939 0.151367C7.168 0.151367 6.399 0.333367 5.712 0.676367L3.398 1.83437C2.983 2.04137 2.518 2.15037 2.055 2.15037H1.001C0.448 2.15037 0.001 2.59737 0.001 3.15037C0.001 3.70337 0.448 4.15037 1.001 4.15037H2.057C2.828 4.15037 3.602 3.96737 4.293 3.62337L6.609 2.46537C7.631 1.95137 9.067 2.09037 9.983 2.92737L10.57 3.46237L7.924 5.95437C6.851 7.02637 6.68 8.72137 7.526 9.89237C8.046 10.6154 9.079 11.1514 9.97 11.1514C10.763 11.1514 11.524 10.8394 12.074 10.2884L13.08 9.32537L19.426 14.0844C19.395 14.1064 13.228 18.7304 13.228 18.7304C12.505 19.2924 11.496 19.2924 10.758 18.7194L4.667 14.1514C3.808 13.5064 2.742 13.1514 1.667 13.1514H1C0.447 13.1514 0 13.5984 0 14.1514C0 14.7044 0.447 15.1514 1 15.1514H1.667C2.312 15.1514 2.951 15.3644 3.467 15.7514L9.544 20.3094C10.269 20.8734 11.138 21.1554 12.005 21.1554C12.867 21.1554 13.728 20.8764 14.442 20.3204L20.535 15.7524C21.05 15.3654 21.689 15.1524 22.334 15.1524H23.001C23.554 15.1524 24.001 14.7054 24.001 14.1524C24.001 13.5994 23.554 13.1524 23.001 13.1524Z" fill="black" class="iconFill" />
                                                </svg>
                                                Onboarding Process
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'position') class="active" @endif>
                                            <a href="/position">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <g clip-path="url(#clip0_724_15300)">
                                                <path d="M19 4H17.9C17.6679 2.87141 17.0538 1.85735 16.1613 1.12872C15.2687 0.40009 14.1522 0.00145452 13 0L11 0C9.8478 0.00145452 8.73132 0.40009 7.83875 1.12872C6.94618 1.85735 6.3321 2.87141 6.1 4H5C3.67441 4.00159 2.40356 4.52888 1.46622 5.46622C0.528882 6.40356 0.00158786 7.67441 0 9L0 19C0.00158786 20.3256 0.528882 21.5964 1.46622 22.5338C2.40356 23.4711 3.67441 23.9984 5 24H19C20.3256 23.9984 21.5964 23.4711 22.5338 22.5338C23.4711 21.5964 23.9984 20.3256 24 19V9C23.9984 7.67441 23.4711 6.40356 22.5338 5.46622C21.5964 4.52888 20.3256 4.00159 19 4ZM11 2H13C13.6183 2.00256 14.2206 2.19608 14.7247 2.55409C15.2288 2.91209 15.6099 3.41709 15.816 4H8.184C8.39008 3.41709 8.77123 2.91209 9.2753 2.55409C9.77937 2.19608 10.3817 2.00256 11 2ZM5 6H19C19.7956 6 20.5587 6.31607 21.1213 6.87868C21.6839 7.44129 22 8.20435 22 9V12H2V9C2 8.20435 2.31607 7.44129 2.87868 6.87868C3.44129 6.31607 4.20435 6 5 6ZM19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V14H11V15C11 15.2652 11.1054 15.5196 11.2929 15.7071C11.4804 15.8946 11.7348 16 12 16C12.2652 16 12.5196 15.8946 12.7071 15.7071C12.8946 15.5196 13 15.2652 13 15V14H22V19C22 19.7956 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7956 22 19 22Z" fill="black" class="iconFill"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_724_15300">
                                                <rect width="24" height="24" fill="black" class="iconFill"/>
                                                </clipPath>
                                                </defs>
                                                </svg>
                                                Open Job Positions
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'feedback') class="active" @endif>
                                            <a href="/feedback">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25" fill="none">
                                                <path d="M13.937 8.73929C14.084 9.56463 13.9694 10.4153 13.6092 11.1723C13.249 11.9293 12.6612 12.5548 11.928 12.9613C11.6548 13.1678 11.4301 13.4317 11.2697 13.7344C11.1094 14.0371 11.0173 14.3712 11 14.7133V15.4563H9V14.7133C9.01878 14.0145 9.20719 13.3308 9.54899 12.7211C9.89078 12.1114 10.3757 11.5939 10.962 11.2133C11.3324 11.0105 11.6291 10.6957 11.8096 10.314C11.9902 9.9323 12.0453 9.50323 11.967 9.08829C11.89 8.69258 11.6965 8.32888 11.4115 8.04382C11.1264 7.75876 10.7627 7.56532 10.367 7.48829C10.0781 7.43436 9.78084 7.44477 9.49641 7.51877C9.21198 7.59277 8.94735 7.72855 8.72136 7.91645C8.49536 8.10435 8.31356 8.33974 8.18888 8.60589C8.0642 8.87204 7.99971 9.16239 8 9.45629H6C5.99943 8.87211 6.12711 8.29493 6.37403 7.7655C6.62095 7.23607 6.98108 6.7673 7.429 6.39229C7.96538 5.94179 8.61065 5.64003 9.30027 5.51722C9.98988 5.3944 10.6997 5.45483 11.3586 5.69246C12.0175 5.93009 12.6025 6.33659 13.055 6.87129C13.5075 7.40599 13.8116 8.05014 13.937 8.73929ZM20 5.92329V12.4473C20 19.8843 12.953 23.2963 10.793 24.1643L9.958 24.5003L9.158 24.1003C7.005 23.0233 1.16502e-07 19.0103 1.16502e-07 12.4473V5.92329C-0.000175523 5.29371 0.19825 4.68012 0.567033 4.16986C0.935816 3.65959 1.45616 3.27866 2.054 3.08129L10 0.446289L17.946 3.08129C18.5438 3.27866 19.0642 3.65959 19.433 4.16986C19.8018 4.68012 20.0002 5.29371 20 5.92329ZM18 5.92329C17.999 5.71418 17.9325 5.51064 17.8098 5.34131C17.6871 5.17198 17.5144 5.04537 17.316 4.97929L10 2.55629L2.684 4.97929C2.4856 5.04537 2.31291 5.17198 2.19022 5.34131C2.06752 5.51064 2.001 5.71418 2 5.92329V12.4473C2 17.8633 8.159 21.3643 10.047 22.3093C11.913 21.5563 18 18.6303 18 12.4473V5.92329ZM9 19.4563H11V17.4563H9V19.4563Z" fill="black" class="iconFill" />
                                                </svg>
                                                Interview Feedback Points
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'company_profile') class="active" @endif>
                                            <a href="/company_profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <g clip-path="url(#clip0_724_15309)">
                                                <path d="M4 13.6084H7V15.6084H4V13.6084ZM9 15.6084H12V13.6084H9V15.6084ZM4 19.6084H7V17.6084H4V19.6084ZM9 19.6084H12V17.6084H9V19.6084ZM4 7.6084H7V5.6084H4V7.6084ZM9 7.6084H12V5.6084H9V7.6084ZM4 11.6084H7V9.6084H4V11.6084ZM9 11.6084H12V9.6084H9V11.6084ZM24 8.6084V24.6084H0V3.6084C0 2.81275 0.31607 2.04969 0.87868 1.48708C1.44129 0.924469 2.20435 0.608398 3 0.608398L13 0.608398C13.7956 0.608398 14.5587 0.924469 15.1213 1.48708C15.6839 2.04969 16 2.81275 16 3.6084V5.6084H21C21.7956 5.6084 22.5587 5.92447 23.1213 6.48708C23.6839 7.04969 24 7.81275 24 8.6084ZM14 3.6084C14 3.34318 13.8946 3.08883 13.7071 2.90129C13.5196 2.71376 13.2652 2.6084 13 2.6084H3C2.73478 2.6084 2.48043 2.71376 2.29289 2.90129C2.10536 3.08883 2 3.34318 2 3.6084V22.6084H14V3.6084ZM22 8.6084C22 8.34318 21.8946 8.08883 21.7071 7.90129C21.5196 7.71376 21.2652 7.6084 21 7.6084H16V22.6084H22V8.6084ZM18 15.6084H20V13.6084H18V15.6084ZM18 19.6084H20V17.6084H18V19.6084ZM18 11.6084H20V9.6084H18V11.6084Z" fill="black" class="iconFill"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_724_15309">
                                                <rect width="24" height="24" fill="black" transform="translate(0 0.608398)" class="iconFill" />
                                                </clipPath>
                                                </defs>
                                                </svg>
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
                                    aria-controls="collapse-3" class="secondary_color">
                                    Interview Email Template
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="9" viewBox="0 0 17 9" fill="none">
                                        <path d="M8.54692 9C8.23185 9.00055 7.91977 8.93882 7.62863 8.81837C7.33749 8.69792 7.07303 8.52112 6.85044 8.29813L0.5 1.94649L2.19649 0.25L8.54692 6.60044L14.8974 0.25L16.5938 1.94649L10.2434 8.29692C10.0209 8.52013 9.7565 8.69716 9.46535 8.81781C9.17421 8.93847 8.86208 9.00039 8.54692 9Z"  fill="white" class="iconFill" />
                                        </svg>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-3" class="collapse show" data-parent="#accordion"
                            aria-labelledby="heading-3" style="">
                            <div class="card-body">

                                <div id="accordion-1">
                                    <ul>
                                        <li @if (Request::segment(1) == 'qualified_email_template') class="active" @endif>
                                            <a href="/qualified_email_template">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 26" fill="none">
                                                    <path d="M10.3978 14.7676C7.71269 15.2151 2.07403 16.6471 1 18.7952V24.8366H10.3978" stroke="black"  class="iconstroke" stroke-width="1.34254"/>
                                                    <circle cx="13.0805" cy="6.04142" r="5.37015" stroke="black" class="iconstroke" stroke-width="1.34254"/>
                                                    <path d="M15.1617 23.6753L15.1619 23.6751L22.0706 16.0942C22.0707 16.0942 22.0707 16.0942 22.0707 16.0942L22.0708 16.0941L15.1617 23.6753ZM15.1617 23.6753C15.1241 23.7168 15.0799 23.7491 15.0319 23.771C14.9839 23.7929 14.9329 23.804 14.8816 23.804C14.8303 23.804 14.7792 23.7929 14.7313 23.771C14.6833 23.7491 14.639 23.7168 14.6014 23.6753L14.6013 23.6752L11.9296 20.7406L15.1617 23.6753Z" fill="black" stroke="black" class="iconstroke iconFill" stroke-width="0.9"/>
                                                    </svg>
                                                For Qualified
                                            </a>
                                        </li>
                                        <li @if (Request::segment(1) == 'not_qualified_template') class="active" @endif>
                                            <a href="/not_qualified_template">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="22" height="26" viewBox="0 0 22 26" fill="none">
                                                    <path d="M10.3978 14.7676C7.71269 15.2151 2.07403 16.6471 1 18.7952V24.8366H10.3978" stroke="black" class="iconstroke" stroke-width="1.34254"/>
                                                    <circle cx="13.0805" cy="6.04142" r="5.37015" stroke="black" class="iconstroke" stroke-width="1.34254"/>
                                                    <path d="M21.8372 17.1628C21.7329 17.0586 21.5914 17 21.4439 17C21.2964 17 21.155 17.0586 21.0507 17.1628L18.5 19.7135L15.9493 17.1628C15.845 17.0586 15.7036 17 15.5561 17C15.4086 17 15.2671 17.0586 15.1628 17.1628C15.0586 17.2671 15 17.4086 15 17.5561C15 17.7036 15.0586 17.845 15.1628 17.9493L17.7135 20.5L15.1628 23.0507C15.0586 23.155 15 23.2964 15 23.4439C15 23.5914 15.0586 23.7329 15.1628 23.8372C15.2671 23.9414 15.4086 24 15.5561 24C15.7036 24 15.845 23.9414 15.9493 23.8372L18.5 21.2865L21.0507 23.8372C21.155 23.9414 21.2964 24 21.4439 24C21.5914 24 21.7329 23.9414 21.8372 23.8372C21.9414 23.7329 22 23.5914 22 23.4439C22 23.2964 21.9414 23.155 21.8372 23.0507L19.2865 20.5L21.8372 17.9493C21.9414 17.845 22 17.7036 22 17.5561C22 17.4086 21.9414 17.2671 21.8372 17.1628Z" fill="black" class="iconFill" />
                                                    </svg>
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
    {{-- <script src="{{ asset('assets') }}/datatable/js/responsive.bootstrap.min.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


    @yield('pagescript')

</body>

</html>
