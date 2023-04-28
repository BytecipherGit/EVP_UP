  @extends('company/layouts.app')
  @section('content')
  @section('title','EVP - Admin Login')

    <!--- Main Container Start ----->
    <div class="main-container">

        <div class="main-heading">        
          <div class="row">
            <div class="col-lg-12">
              <h1>Overview</h1>
              <p></p>
            </div>          
          </div>
        </div><!--- Main Heading ----->
  
        <!--- Status Heading Start ----->
        <div class="ser-part">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>All Employees <span></span></h2>
                  <div class="img-bg ml-auto">
                    {{-- <img src="{{ asset('assets') }}/admin/images/employees-view.png"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="180" height="181" viewBox="0 0 180 181" fill="none">
                      <circle cx="82.5" cy="48.5" r="43.5" stroke="black" stroke-width="10" class="iconstroke"/>
                        <path d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5" stroke="black" stroke-width="10" class="iconstroke"/>
                        <path d="M173.653 143.791C132.167 85.2593 85.9363 118.521 66.9371 143.732C66.3759 144.476 66.4564 145.524 67.0779 146.219C112.706 197.241 156.458 168.183 173.638 146.129C174.166 145.451 174.15 144.492 173.653 143.791Z" stroke="black" stroke-width="10" class="iconstroke"/>
                      <circle cx="120" cy="143" r="15" fill="black" class="iconFill" />
                    </svg>
                  </div>
                </div>
                <h6>
                  <div class="bg-section">
                    {{$allemployee}}<?xml version="1.0" encoding="UTF-8"?>
                    <!-- Generator: Adobe Illustrator 25.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="30" height="15">
                    <g>
                      <path d="M490.667,234.667H277.333V21.333C277.333,9.551,267.782,0,256,0c-11.782,0-21.333,9.551-21.333,21.333v213.333H21.333   C9.551,234.667,0,244.218,0,256c0,11.782,9.551,21.333,21.333,21.333h213.333v213.333c0,11.782,9.551,21.333,21.333,21.333   c11.782,0,21.333-9.551,21.333-21.333V277.333h213.333c11.782,0,21.333-9.551,21.333-21.333   C512,244.218,502.449,234.667,490.667,234.667z" class="iconFill"/>
                    </g>
                    </svg>

                  </div>  
                  <a href="/employee" class="link_color">View</a>              
                </h6>
              </div>
            </div> 
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>Current Employees<span></span></h2>
                  <div class="img-bg ml-auto">
                    {{-- <img src="{{ asset('assets') }}/admin/images/current-user.png"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="170" height="181" viewBox="0 0 170 181" fill="none">
                      <circle cx="82.75" cy="49" r="43.5" stroke="black" stroke-width="10"  class="iconstroke"/>
                      <path d="M63.75 109C48.4309 111.096 16.2307 118.965 6.18521 133.965C5.52888 134.945 5.25 136.118 5.25 137.298V176H111.75" stroke="black" stroke-width="10" class="iconstroke"/>
                      <path d="M106.25 109C121.569 111.096 153.769 118.965 163.815 133.965C164.471 134.945 164.75 136.118 164.75 137.298V176H106.25" stroke="black" stroke-width="10" class="iconstroke"/>
                    </svg>
                  </div>  
                </div>
                <h6>
                  <div class="bg-section">
                    {{$current}}<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="30" height="15">
                      <g>
                        <path d="M490.667,234.667H277.333V21.333C277.333,9.551,267.782,0,256,0c-11.782,0-21.333,9.551-21.333,21.333v213.333H21.333   C9.551,234.667,0,244.218,0,256c0,11.782,9.551,21.333,21.333,21.333h213.333v213.333c0,11.782,9.551,21.333,21.333,21.333   c11.782,0,21.333-9.551,21.333-21.333V277.333h213.333c11.782,0,21.333-9.551,21.333-21.333   C512,244.218,502.449,234.667,490.667,234.667z" class="iconFill"/>
                      </g>
                      </svg>
                  </div>  
                  <a href="/current-employee" class="link_color">View</a>              
                </h6>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="ser-box">
                <div class="head-sec">
                  <h2>Invite Employees <span></span></h2>
                  <div class="img-bg ml-auto">
                    {{-- <img src="{{ asset('assets') }}/admin/images/invite-icon.png"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="147" height="181" viewBox="0 0 147 181" fill="none">
                      <circle cx="82.5" cy="48.5" r="43.5" stroke="black" stroke-width="10" class="iconstroke" />
                      <path d="M63.5 108.5C48.1809 110.596 15.9807 118.465 5.93521 133.465C5.27888 134.445 5 135.618 5 136.798V175.5H63.5" stroke="black"  class="iconstroke" stroke-width="10"/>
                      <line x1="116" y1="110" x2="116" y2="174" stroke="black" class="iconstroke" stroke-width="10"/>
                      <line x1="83" y1="143" x2="147" y2="143" stroke="black" class="iconstroke" stroke-width="10"/>
                    </svg>
                  </div>  
                </div>
                <h6>
                  <div class="bg-section">
                    {{$empinvite}}<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="30" height="15">
                      <g>
                        <path d="M490.667,234.667H277.333V21.333C277.333,9.551,267.782,0,256,0c-11.782,0-21.333,9.551-21.333,21.333v213.333H21.333   C9.551,234.667,0,244.218,0,256c0,11.782,9.551,21.333,21.333,21.333h213.333v213.333c0,11.782,9.551,21.333,21.333,21.333   c11.782,0,21.333-9.551,21.333-21.333V277.333h213.333c11.782,0,21.333-9.551,21.333-21.333   C512,244.218,502.449,234.667,490.667,234.667z" class="iconFill"/>
                      </g>
                      </svg>
                  </div>  
                  <a href="/invite-employee" class="link_color">View</a>              
                </h6>
  
              </div>
            </div>
          </div>
        </div>
        <!--- Status Heading End ----->
  @endsection