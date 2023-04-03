@extends('company/layouts.app') 
@section('content')
@section('title','EVP - Settings')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-lg-12">
            <h1>Settings</h1>
          </div>
        </div>
      </div><!--- Main Heading ----->  

      <div class="setting-pages">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="applicants-Tab1-tab" data-toggle="tab" href="#applicants-Tab1" role="tab" aria-controls="applicants-Tab1" aria-selected="true">
                  <div class="img-box-iocn">
                    <img src="{{ asset('assets') }}/admin/images/company-icon.png">
                  </div>  
                  <h2>Company Profile <span>Set up your Company Information</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab2-tab" data-toggle="tab" href="#applicants-Tab2" role="tab" aria-controls="applicants-Tab2" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <img src="{{ asset('assets') }}/admin/images/location-icon.png">
                  </div>
                  <h2>Address <span>Set up your Address method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab3-tab" data-toggle="tab" href="#applicants-Tab3" role="tab" aria-controls="applicants-Tab3" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <img src="{{ asset('assets') }}/admin/images/department-icon.png">
                  </div>
                  <h2>Department <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab4-tab" data-toggle="tab" href="#applicants-Tab4" role="tab" aria-controls="applicants-Tab4" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <img src="{{ asset('assets') }}/admin/images/designation-icon.png">
                  </div>
                  <h2>Designation <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab5-tab" data-toggle="tab" href="#applicants-Tab5" role="tab" aria-controls="applicants-Tab5" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <img src="{{ asset('assets') }}/admin/images/policy-icon.png">
                  </div>
                  <h2>Policies <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab6-tab" data-toggle="tab" href="#applicants-Tab6" role="tab" aria-controls="applicants-Tab6" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <img src="{{ asset('assets') }}/admin/images/my-plan-icon.png">
                  </div>
                  <h2>My Plan <span>Set up your Plan method</span></h2>
                </a>
              </li>
            </ul>
          </div>

          <div class="col-lg-9 col-md-8">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="applicants-Tab1" role="tabpanel" aria-labelledby="applicants-Tab1-tab">
                <div class="tab-content-details">
                  <h2>Company Profile</h2>
                  <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if (session()->has('succ'))
                    <div class="alert alert-success">
                        {{ session()->get('succ') }}
                    </div>
                    @endif
                    @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                    @endif
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Registered Company Name</label>
                          <input id="com_name" type="text" class="form-control" placeholder="Company Name" name="org_name" @if ($profile) value="{{ old('org_name',$profile->org_name)}}" @endif required autocomplete="org_name" autofocus>
                          {{-- <input type="text" name="com_name" placeholder="Company Name" value="{{ old('com_name') }}" class="form-control"> --}}
                        </div>
                        <div class="col-xl-6 input-mt-from">
                          <label>Brand Name</label>
                          <input type="text" name="brand_name" placeholder="Brand Name"  @if ($profile) value="{{old('brand_name',$profile->brand_name)}}" @endif class="form-control">
                        </div>  
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Website</label>
                          <div class="input_field">
                            <span>http://</span>
                            <input type="text" name="org_web" placeholder="Website"  @if ($profile) value="{{old('org_web',$profile->org_web)}}" @endif class="form-control">
                          </div>
                        </div> 
                        <div class="col-xl-6 input-mt-from">
                          <label>Domain Name</label>
                          <input type="text" name="domain_name" placeholder="Domain Name" @if ($profile) value="{{old('domain_name',$profile->domain_name)}}" @endif class="form-control">
                        </div>                         
                      </div>
                    </div> 
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Industry</label>
                        
                            <select name="industry" class="form-control">
                              <option  @if($profile->industry ) value="{{ old('industry', $profile->industry) }}" @endif>@if($profile->industry) {{ old('industry', $profile->industry) }} @else Select Industry @endif</option>
                              <option value="IT Company">IT Company</option>
                              <option value="Non it Company">Non IT Company</option>
                             
                            {{-- </div> --}}
                          </select>
                          {{-- </div> --}}
                         </div>

                        <div class="col-xl-6 input-mt-from">
                          <label>Phone Number</label>
                          <input type="text" name="phone_number"  placeholder="Phone Number" @if ($profile) value="{{old('phone_number',$profile->phone_number)}}" @endif class="form-control">
                        </div>  
                      </div>
                    </div>                    
                </div>  
                <div class="tab-content-details">
                  <h2>Company Identity</h2>     
                    <div class="form-group">                      
                      <label>Company Logo</label>
                      <h6>OnePercentPeople displays your company’s logo in your careers page, in emails to candidates as well as some job boards.</h6>

                      <div class="company-pro">
                        <div class="circle">
                         <img class="profile-pic" id="profile-pic" name="company_logo" @if ($profile->company_logo!== Null) value="/image/{{ old('company_logo', $profile->company_logo) }}" src="/image/{{ $profile->company_logo }}" @else src="assets/admin/images/logo.png" @endif >
                       </div>
                       {{-- <p>You can drag or drop <span>your file logo here.</span> </p> --}}
                       <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                       <div class="p-image ml-auto">
                         <span class="upload-button" id="upload-button">Choose File</span>
                          <input class="file-upload"  name="company_logo" id="file-upload" type="file" accept="image/jpg,image/doc,image/pdf"/>
                       </div>
                      </div>

                      {{-- <h6>Only .jpg, .gif, or .png files allowed, no size limit</h6> --}}
                    </div>
                    <div class="form-group">                      
                      <label>Company Description</label>
                      <h6 class="clg-font">This will be used on some job boards and on welcome pages for things like video interviews and assessments.</h6>
                      <textarea class="form-control" placeholder="Enter Description" name="description" rows="5" required>@if ($profile) {{old('description',$profile->description)}} @endif</textarea>
                 
                      @error('description')
                      <p class="velidation">{{ $description }}</p>
                  @enderror
                    </div>
                 
                </div>  
                <div class="tab-button-bx">
                   {{-- <button type="button" class="btn-secondary-cust" href="{{ route('settings') }}">Cancel</button>  --}}
                   <button type="submit" name="profile" class="btn-primary-cust">Save Changes</button>
                </div>           
              </div>
            </form>
              <div class="tab-pane fade" id="applicants-Tab2" role="tabpanel" aria-labelledby="applicants-Tab2-tab">
                <div class="tab-content-details">
                  <h2>Address</h2>
                  <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
                    @csrf
                 
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-12">
                          <label>Registered Office<span style="color:red">*</span></label>
                          <textarea class="form-control" name="address" @if ($profile->address) value="{{old('address',$profile->address)}}" @endif rows="2" placeholder="Add Registered Office Address" required>@if ($profile->address) {{old('address',$profile->address)}}@endif</textarea>
                       
                        </div>  
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-12">
                          <label>Corporate Office</label>
                          <textarea class="form-control" name="cor_office_address" @if ($profile->cor_office_address) value="{{old('cor_office_address',$profile->cor_office_address)}}" @endif rows="2" placeholder="Add Corporate Office Address">@if ($profile->cor_office_address) {{old('cor_office_address',$profile->cor_office_address)}} @endif</textarea>
                        </div>  
                      </div>
                    </div>
                  </div>
                   <div class="tab-button-bx">
                   {{-- <button class="btn-secondary-cust">Cancel</button>  --}}
                   <button type="submit" name="add_address" class="btn-primary-cust">Change Save</button>
                 </div> 
                </div>   
            </form>
              <div class="tab-pane fade" id="applicants-Tab3" role="tabpanel" aria-labelledby="applicants-Tab3-tab">
                <div class="tab-content-details">
                  <h2>Department <button class="ml-auto" data-toggle="modal" data-target="#departIdBtn"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></h2>
      
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Sub Department</th>
                          <th>Employees</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      @foreach($department as $dept)
                      <input type="hidden" name="id" value="{{ $dept['id'] }}">
                      <tbody>
                       
                        <tr>
                          <td>{{ $dept->department }}</td>
                          <td>{{ $dept->sub_department }}</td>
                          <td>---</td>
                          <td>
                            <span class="d-flex">
                              <button class="border-none" data-toggle="modal" data-target="#departEditBtn{{ $dept['id'] }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </span>
                          </td>
                        </tr>
                       
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
                {{-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> 
                   <button class="btn-primary-cust">Change Save</button>
                </div>  --}}

              </div> 

              <div class="tab-pane fade" id="applicants-Tab4" role="tabpanel" aria-labelledby="applicants-Tab4-tab">
                <div class="tab-content-details">
                  <h2>Designation <button class="ml-auto" data-toggle="modal" data-target="#DesignationIdBtn"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></h2>
                 
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Designation</th>
                          <th>Employees</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      @foreach($designat as $desig)
                      <input type="hidden" name="id" value="{{ $desig['id'] }}">
                      <tbody>
                        <tr>
                          <td>{{$desig->designation_name}}</td>
                          <td>--</td>
                          <td>
                            <span class="d-flex">
                              <button class="border-none" data-toggle="modal" data-target="#DesignationEditBtn{{ $desig['id'] }}" ><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </span>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
                {{-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> 
                   <button class="btn-primary-cust">Change Save</button>
                </div>  --}}

              </div> 

              <div class="tab-pane fade" id="applicants-Tab5" role="tabpanel" aria-labelledby="applicants-Tab5-tab">
                <div class="tab-content-details">
                  <h2>Policies </h2>
                  <div class="setting-polici-box">
                    <h3>What is Lorem Ipsum?</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<p>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <ul>
                      <li>Contrary to popular belief, Lorem Ipsum is not simply random text.</li>
                      <li>It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. </li>
                      <li>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. </li>
                      <li>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. </li>
                      <li>This book is a treatise on the theory of ethics, very popular during the Renaissance. </li>
                      <li>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</li>
                    </ul>
                    <h3>Where can I get some?</h3>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                  </div>

                </div>
                <!-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> <button class="btn-primary-cust">Save</button>
                </div>  -->

              </div> 

              <div class="tab-pane fade" id="applicants-Tab6" role="tabpanel" aria-labelledby="applicants-Tab6-tab">
                <div class="tab-content-details">
                  <h2>My Plan</h2>
                  <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Plan Name</label>
                          <input type="text" name="plan_name" placeholder="Plan" @if ($plans) value="{{old('plan_name',$plans->plan_name)}}" @endif class="form-control">
                          {{-- <input type="text" name="plan" @if ($plans) value="{{ old('plan'), $plans->plan }}" @endif class="form-control"> --}}
                        </div> 
                        <div class="col-xl-6 input-mt-from">
                          <label>Authority</label>
                          {{-- <div class="selectBox active"> --}}
                            <select name="authority" @if ($plans) value="{{ old('authority', $plans->authority) }}" @endif class="form-control" required>
                              <option @if ($plans) value="{{ old('authority', $plans->authority) }}" @else value="" @endif>@if ($plans) {{ old('authority', $plans->authority) }} @else Select Authority @endif</option>
                              <option value="01">01</option>
                              <option value="02">02</option>
                              <option value="03">03</option>
                              <option value="04">04</option>
                              <option value="05">05</option>

                            </select>
                        {{-- </div>  --}}
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-12">
                          <label>Change My Plan</label>
                          <select name="plan_type" @if ($plans) value="{{ old('plan_type' , $plans->plan_type) }}" @endif class="form-control" required>
                            <option @if ($plans) value="{{ old('plan_type' , $plans->plan_type) }}" @else value="" @endif>@if ($plans) {{ old('plan_type', $plans->plan_type) }} @else Select Type @endif</option>
                              <option value="Gold">Gold 01</option>
                              <option value="Silver">Silver 02</option>
                              <option value="Bronze">Bronze 03</option>
                        
                          </select>
                        </div> 
                      </div>
                    </div>
           
                </div>   
                <div class="tab-button-bx">
                   {{-- <button class="btn-secondary-cust">Cancel</button>  --}}
                   <button type="submit" name="plan" class="btn-primary-cust">Save Changes</button>
                </div>   
              </form>        
              </div>         
            </div>
          </div>
        </div>
      </div>  

    </div><!--- Main Container Close ----->
 
  <!-- The Modal Add New Department -->
  <div class="modal fade custu-modal-popup" id="departIdBtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add New Department</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Department Name</label>
                    <input type="text" name="department" class="form-control" placeholder="Department Name">
                  </div>
                  <div class="col-md-6">
                    <label>Sub Department Name</label>
                    <input type="text" name="sub_department" class="form-control" placeholder="Sub Department Name">
                  </div>
                </div>                
              </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="dept" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div>   
</form>
  <!-- The Modal Reporting Manager-->
  @foreach($department as $dept)
  <div class="modal fade custu-modal-popup" id="departEditBtn{{ $dept['id'] }}" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Department</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $dept['id'] }}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Department Name</label>
                    <input type="text" name="department" value="{{ old('department' , $dept->department) }}" class="form-control" placeholder="Department Name">
                  </div>
                  <div class="col-md-6">
                    <label>Sub Department Name</label>
                    <input type="text" name="sub_department" value="{{ old('sub_department' , $dept->sub_department) }}" class="form-control" placeholder="Sub Department Name">
                  </div>
                </div>                
              </div>
           
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
          <button type="submit" name="department_edit" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
  <!-- The Modal Add Designation Department -->
  <div class="modal fade custu-modal-popup" id="DesignationIdBtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add New Designation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation Title</label>
                    <input type="text" name="designation_name" class="form-control" placeholder="Title">
                  </div>
                </div>                
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="designation" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
  <!-- The Modal Reporting Manager-->
@foreach($designat as $desig)
  <div class="modal fade custu-modal-popup" id="DesignationEditBtn{{$desig['id']}}" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Designation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $desig['id'] }}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Designation</label>
                    <input type="text" name="designation_name" class="form-control" value="{{ old('designation_name', $desig->designation_name) }}" required>
                  </div>
                  {{-- <div class="col-md-6">@if ($profile) value="{{old('phone',$profile->phone)}}" @endif class="form-control" required
                    <label>Employee</label>
                    <input type="text" name="" class="form-control" value="05">
                  </div> --}}
                </div>                
              </div>
           
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="desig_edit" class="btn-primary-cust">Save Changes</button>
        </div>
      </div>
    </div>
  </div> 
</form> 
@endforeach
@endsection
@section('pagescript')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 

    <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>

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

@stop