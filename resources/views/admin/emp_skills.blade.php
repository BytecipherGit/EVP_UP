@extends('admin/layouts.emp_app')
@section('emp_identity')
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
                    <input type="text" class="form-control input-search-box typeahead" name="skill" placeholder="Add Skill">
                  </div>
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <h6>
                    <input type="radio" id="customRadioInline1" name="skill_type" class=""  value="Beginner" checked="">Beginner</span>
                      
                    <input type="radio" id="customRadioInline2" name="skill_type" class="" value="Intermediate">Intermediate</span>
                      <input type="radio" id="customRadioInline3" name="skill_type" class="" value="Expert">Expert</span>
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
                    <input type="text" name="lang" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language">
                  </div>
                  <div class="col-xl-5 col-lg-10 col-md-10">
                    <h6>
                      <input type="radio" id="customRadioInline4" name="lang_type" class="" value="Beginner" checked="">
                    Beginner</span>
                      
                   <input type="radio" id="customRadioInline5" name="lang_type" class="" value="Intermediate" >
                      Intermediate</span>
                  <input type="radio" id="customRadioInline6" name="lang_type" value="Expert"  class="" >
                    Expert</span>
                    </h6>  
                  </div>
                  <a class="add-plus extra-fields-customer1" ><span><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span></a>
                </div>
                <div class="customer_records_dynamic1"></div>
              </div>

              <div class="col-md-12 ">
                <div class="form-group">
                  <div class="add-btn-part">
                    <button type="" class="btn-secondary-cust">Back</button>
                    <button type="submit" name="workskill" class="btn-primary-cust">Next</button>
                  </div>
                </div>
              </div>
              
          
          </div>
        </div>                
      </div>
    </div>
  </div>
</form>

@endsection