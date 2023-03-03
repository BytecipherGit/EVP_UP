@extends('admin/layouts.emp_editapp')
@section('edit')
@section('title','EVP - Onboarding-Employee')

<div class="tab-pane" id="tabs-5" role="tabpanel">
    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              @csrf
              <div class="form-group inputtag-custom">
                <h2>Skills</h2>

                <label>Add Your Skill</label>
                <div class="row customer_records">
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <input type="text" class="form-control input-search-box typeahead" data-provide="typeahead" placeholder="Add Skill">
                  </div>
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <h6>
                      <span><input type="radio" id="customRadioInline1" name="customRadioInline1" class="">
                      <label class="" for="customRadioInline1">Beginner</label></span>
                      
                      <span><input type="radio" id="customRadioInline2" name="customRadioInline1" class="" checked="">
                      <label class="" for="customRadioInline2">Intermediate</label></span>
                      <span><input type="radio" id="customRadioInline3" name="customRadioInline1" class="" >
                      <label class="" for="customRadioInline3">Expert</label></span>
                    </h6>  
                  </div>
                  <a class="add-plus extra-fields-customer" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a>
                </div>
                <div class="customer_records_dynamic"></div>
              </div>

              <div class="form-group inputtag-custom mt-3 mb-5">
                <h2>known Language</h2>

                <label>Add Language</label>
                <div class="row customer_records1">
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <input type="text" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language">
                  </div>
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <h6>
                      <span><input type="radio" id="customRadioInline4" name="customRadioInlineL" class="">
                      <label class="" for="customRadioInline4">Beginner</label></span>
                      
                      <span><input type="radio" id="customRadioInline5" name="customRadioInlineL" class="" checked="">
                      <label class="" for="customRadioInline5">Intermediate</label></span>
                      <span><input type="radio" id="customRadioInline6" name="customRadioInlineL" class="" >
                      <label class="" for="customRadioInline6">Expert</label></span>
                    </h6>  
                  </div>
                  <a class="add-plus extra-fields-customer1" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a>
                </div>
                <div class="customer_records_dynamic1"></div>
              </div>

              <div class="col-md-12 ">
                <div class="form-group">
                  <div class="add-btn-part">
                    <button type="button" class="btn-secondary-cust">Back</button>
                    <button type="button" class="btn-primary-cust">Next</button>
                  </div>
                </div>
              </div>
              
            </form>
          </div>
        </div>                
      </div>
    </div>
  </div>
@endsection