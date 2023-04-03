@extends('company/layouts.app')
@section('content')
@section('title','EVP - Admin Search')

  <!--- Main Container Start ----->
  <div class="main-container">

    <div class="seachMain">
      <h1>1,000 Candidate Search</h1>
      <div class="search-bg-round">
        <div class="row">
          <div class="col-lg-4 col-md-12 p-0">
            <div class="selectBox active">
              <div class="selectBox__value">Search type</div>
              <div class="dropdown-menu" id="style-5">
                <a class="dropdown-item active">Search type</a>  
                <a class="dropdown-item">EVP Id</a>
                <a class="dropdown-item">Pan Card</a>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-8">
            <input type="search" name="" placeholder="Search for Candidate..." class="form-control input-search-box">
          </div>
          <div class="col-lg-3 col-md-4">
            <button type="button" class="search-btnkey" onclick="myFunction1()">Saerch</button>
          </div>
        </div>
      </div>
    </div>

    

    <div id="myDIVsearch" style="display: none;">
      <div class="main-heading">        
        <div class="row">
          <div class="col-lg-12">
            <h1>Candidate Detials</h1>
            <p>Here’s your report overview by today</p>
          </div>
        </div>
      </div><!--- Main Heading ----->

    <div class="search-hist-page">
      <div class="search-hist-pro">
        <div class="pro-img">
          <div class="circle">
             <img class="profile-pic" src="assets/admin/images/vijay-patil.png">
          </div>                
        </div>
        <h2>
          Vijay Patil <b>(2 offer)</b>
          <span>React native developer at ByteCipher Private Limited.</span>   
          <small>Mandu, India</small> 
          <small>4.5 <span>reviews</span></small> 
          <span class="d-flex">
            <a href="#" onclick="myFunction()" class="full-bg">View Full Profile</a> 
            <a href="#" class="only-border-btn">Add Candidate</a>
          </span>     
        </h2>
      </div>  
    </div>


    <div id="myDIV" style="display: none;">
      
      <div class="serch-main-box">
        <h2 class="">Basic Info</h2>
        <div class=" pt-1">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Contact</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="search-tab-part">
                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                keffiyeh dream catcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                qui.</p>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="search-tab-part">                  
                <h1>Contact Info </h1>
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <div class="d-flex mt-3">
                      <div class="icon-part">
                        <i class="fa fa-phone"></i>
                      </div>
                      <div class="coneant">
                        <h4>Phone</h4>
                        <p>+91 987 654 3210 <span>(mobile)</span></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="d-flex mt-3">
                      <div class="icon-part">
                        <i class="fa fa-envelope-o"></i>
                      </div>
                      <div class="coneant">
                        <h4>Email</h4>
                        <p>vijaysing@gmail.com</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="d-flex mt-3">
                      <div class="icon-part">
                        <i class="fa fa-birthday-cake"></i>
                      </div>
                      <div class="coneant">
                        <h4>Birthday</h4>
                        <p>July 11</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="d-flex mt-3">
                      <div class="icon-part">
                        <i class="fa fa-users"></i>
                      </div>
                      <div class="coneant">
                        <h4>Join </h4>
                        <p>June 15, 2020</p>
                      </div>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
          </div>

        </div>       
      </div>
      
      <div class="serch-main-box">
        <h2 class="">Experience</h2>
        <div class="d-flex pt-3">
          <div class="searc-icon-bx">
            <img src="assets/admin/images/bytecipher.png">
          </div>
          <div class="searc-icon-bx-text">
            <h2>React Native Developer</h2>
            <h4>ByteCipher Private Limited · Full-time</h4>
            <p class="pt-2"><span>Dec 2019 - Present · 2 yrs 3 mos</span></p>
            <p><span>Indore, Madhya Pradesh, India</span></p>
            <p class="pt-2">"Raw denim you probably haven't heard of them jean shorts Austin."</p>
            <fieldset class="rating">
              <input type="radio" id="textiles-star51" name="textiles-rating1" value="5" />
              <label class = "full" for="textiles-star51"></label>
              <input type="radio" id="textiles-star4half1" name="textiles-rating1" value="4 and a half"  />
              <label class="half" for="textiles-star4half1"></label>

              <input type="radio" id="textiles-star41" name="textiles-rating1" value="4" checked=""/>
              <label class = "full" for="textiles-star41" ></label>
              <input type="radio" id="textiles-star3half1" name="textiles-rating1" value="3 and a half" />
              <label class="half" for="textiles-star3half1"></label>

              <input type="radio" id="textiles-star31" name="textiles-rating1" value="3" />
              <label class = "full" for="textiles-star31"></label>
              <input type="radio" id="textiles-star2half1" name="textiles-rating1" value="2 and a half" />
              <label class="half" for="textiles-star2half1" ></label>

              <input type="radio" id="textiles-star21" name="textiles-rating1" value="2" />
              <label class = "full" for="textiles-star21"></label>
              <input type="radio" id="textiles-star1half1" name="textiles-rating" value="1 and a half" />
              <label class="half" for="textiles-star1half1" ></label>

              <input type="radio" id="textiles-star11" name="textiles-rating1" value="1" />
              <label class = "full" for="textiles-star11"></label>
              <input type="radio" id="textiles-starhalf1" name="textiles-rating1" value="half" />
              <label class="half" for="textiles-starhalf1"></label>

            </fieldset>
          </div>
          <img src="assets/admin/images/verified-icon.png" class="verified-img">        
        </div>  
        <hr> 
        <div class="d-flex pt-3">
          <div class="searc-icon-bx">
            <img src="assets/admin/images/bytecipher.png">
          </div>
          <div class="searc-icon-bx-text">
            <h2>React Native Developer</h2>
            <h4>ByteCipher Private Limited · Full-time</h4>
            <p class="pt-2"><span>Dec 2019 - Present · 2 yrs 3 mos</span></p>
            <p><span>Indore, Madhya Pradesh, India</span></p>
            <p class="pt-2">"Raw denim you probably haven't heard of them jean shorts Austin."</p>
            <fieldset class="rating">
              <input type="radio" id="textiles-star5" name="textiles-rating" value="5" />
              <label class = "full" for="textiles-star5"></label>
              <input type="radio" id="textiles-star4half" name="textiles-rating" value="4 and a half" checked="" />
              <label class="half" for="textiles-star4half"></label>

              <input type="radio" id="textiles-star4" name="textiles-rating" value="4" />
              <label class = "full" for="textiles-star4" ></label>
              <input type="radio" id="textiles-star3half" name="textiles-rating" value="3 and a half" />
              <label class="half" for="textiles-star3half"></label>

              <input type="radio" id="textiles-star3" name="textiles-rating" value="3" />
              <label class = "full" for="textiles-star3"></label>
              <input type="radio" id="textiles-star2half" name="textiles-rating" value="2 and a half" />
              <label class="half" for="textiles-star2half" ></label>

              <input type="radio" id="textiles-star2" name="textiles-rating" value="2" />
              <label class = "full" for="textiles-star2"></label>
              <input type="radio" id="textiles-star1half" name="textiles-rating" value="1 and a half" />
              <label class="half" for="textiles-star1half" ></label>

              <input type="radio" id="textiles-star1" name="textiles-rating" value="1" />
              <label class = "full" for="textiles-star1"></label>
              <input type="radio" id="textiles-starhalf" name="textiles-rating" value="half" />
              <label class="half" for="textiles-starhalf"></label>

            </fieldset>

          </div>
          <img src="assets/admin/images/verified-icon.png" class="verified-img">
        </div>       
      </div>

      <div class="serch-main-box">
        <h2 class="">Education</h2>
        <div class="d-flex pt-3">
          <div class="searc-icon-bx">
            <img src="assets/admin/images/Sage_University_logo.png">
          </div>
          <div class="searc-icon-bx-text">
            <h2>Truba College of Engineering Technology, Indore Bypass Road, Kailod Kartal, Indore-452020</h2>
            <h4>Bachelor of Engineering - BE, Electronics and TeleCommunications Engineering</h4>
            <p class="pt-2"><span>2016 - 2020</span></p>
          </div>
          <img src="assets/admin/images/verified-icon.png" class="verified-img">
        </div>        
      </div>
      
    </div>
  </div>

  </div>
  <!--- Main Container Close ----->
  @endsection
  @section('pagescript')
  <script>
    $(".selectBox").on("click", function(e) {
      $(this).toggleClass("show");
      var dropdownItem = e.target;
      var container = $(this).find(".selectBox__value");
      container.text(dropdownItem.text);
      $(dropdownItem)
        .addClass("active")
        .siblings()
        .removeClass("active");
    });
  </script> 

  <script type="text/javascript">
    function myFunction1() {
      var x = document.getElementById("myDIVsearch");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>

  <script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("myDIV");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>
  
@stop