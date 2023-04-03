@extends('company/layouts.app')
@section('content')
@section('title','EVP - Employee Exit')

  <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-md-8">
            <h1>Exit Employee</h1>
            <p></p>
          </div>
          <div class="col-md-4">
            <div class="main-right-button-box">
              {{-- <a href="add-employee"><img src="assets/admin/images/button-plus.png">Add New</a>  --}}
                  <a href="/employee"><img src="{{ asset('assets') }}/admin/images/back-icon.png"> Back</a>
            </div>
          </div>
        </div>
      </div><!--- Main Heading ----->
      @if (session()->has('msg'))
      <div class="alert alert-success">
          {{ session()->get('msg') }}
      </div>
        @endif
      <div class="employee-tab-bar">  
        <div class="eml-persnal ">
          <div class="add-emply-details exit-custom-page">
                <div class="row">
                  <div class="col-lg-3">                     
                    <div class="empl-exit-detial">
                      {{-- <img src="{{ asset('assets') }}/admin/images/vijay-patil.png"> --}}
                      <img  @if ($exitemp->profile!== Null) value="/image/{{ old('profile', $exitemp->profile) }}" src="/image/{{ $exitemp->profile }}" @else src="{{ asset('assets') }}/admin/images/user-img.png" @endif >                  
                      <h1>{{$exitemp->first_name .' '. $exitemp->last_name}}</h1>
                      <p>Code - #00{{ $exitemp->id}}</p>
                      <p>Date of joining - {{ $exitemp->doj}}</p>
                    </div>
                  </div>
               
                  <div class="col-lg-9">

                    <form method="post">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Date of Exit<span style="color:red">*</span></label>
                            <input type="date" name="do_exit" class="form-control" placeholder="Date" required>
                          </div>
                        </div>  
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Decipline</label>
                            <textarea rows="3" name="decipline" class="form-control" placeholder="Decipline"></textarea>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Reason for leaving<span style="color:red">*</span></label>
                            <textarea rows="3" name="reason" class="form-control" required placeholder="Reason"></textarea>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label>Rating</label>
                            <fieldset class="rating">
                              <input type="radio" id="textiles-star5" name="rating" value="5" />
                              <label class = "full" for="textiles-star5"></label>
                              <input type="radio" id="textiles-star4half" name="rating" value="4.5" />
                              <label class="half" for="textiles-star4half"></label>

                              <input type="radio" id="textiles-star4" name="rating" value="4" />
                              <label class = "full" for="textiles-star4" ></label>
                              <input type="radio" id="textiles-star3half" name="rating" value="3.5" />
                              <label class="half" for="textiles-star3half"></label>

                              <input type="radio" id="textiles-star3" name="rating" value="3" />
                              <label class = "full" for="textiles-star3"></label>
                              <input type="radio" id="textiles-star2half" name="rating" value="2.5" />
                              <label class="half" for="textiles-star2half" ></label>

                              <input type="radio" id="textiles-star2" name="rating" value="2" />
                              <label class = "full" for="textiles-star2"></label>
                              <input type="radio" id="textiles-star1half" name="textiles-rating" value="1.5" />
                              <label class="half" for="textiles-star1half" ></label>

                              <input type="radio" id="textiles-star1" name="rating" value="1" />
                              <label class = "full" for="textiles-star1"></label>
                              <input type="radio" id="textiles-starhalf" name="textiles-rating" value="0.5" />
                              <label class="half" for="textiles-starhalf"></label>

                            </fieldset>
                            {{-- <span class="theme-tem-active ml-2">(0.0)</span> --}}
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-10">
                                <label>Upload File</label>
                                <div class="upload-img-file">
                                  <div class="circle">
                                   <img class="profile-pic" id="profile-pic1" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                                 </div>
                                 <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                                 <div class="p-image ml-auto">
                                   <span class="upload-button" id="upload-button1">Choose File</span>
                                    <input class="file-upload" name="document" id="file-upload1" type="file" accept="image/jpg,image/doc,image/pdf"/>
                                 </div>
                                </div>                            
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>&nbsp;</label>
                                  {{-- <div class="add-plus mt-custom-plus"><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></div> --}}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>  
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="add-btn-part">
                              {{-- <button type="clear" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
                              <button type="submit" class="btn-primary-cust">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>                
              </div>
        </div>
      </div>

    </div>
    <!--- Main Container Close ----->
    @endsection

    @section('pagescript')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 
    <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>

    @stop