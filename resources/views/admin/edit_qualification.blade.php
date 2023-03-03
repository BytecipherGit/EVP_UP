@extends('admin/layouts.emp_editapp')
@section('edit')
@section('title','EVP - Onboarding-Employee')

<div class="tab-pane" id="tabs-3" role="tabpanel">
    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              <div class="row">
                <div class="col-xl-12">
                  <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                </div>
                <p class="no-data-clg">No Data Available</p>  

                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Degree</th>
                            <th>School/College/Institute</th>                                    
                            <th>Subject</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Verification</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>                                    
                            <td>B.E</td> 
                            <td>New Science College Indore</td> 
                            <td>Mechanical</td>
                            <td>July / 2013</td>  
                            <td>July / 2017</td>  
                            <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                            <td>
                              <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                              <a href="{{ asset('assets') }}/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                              <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </td>
                          </tr>
                          <tr>                                    
                            <td>12th</td> 
                            <td>CBSC</td> 
                            <td>Mathematics</td>
                            <td>July / 2012</td>  
                            <td>March / 2013</td>  
                            <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                            <td>
                              <a class="docu-down" data-toggle="modal" data-target="#qualificationinfo"><img src="{{ asset('assets') }}/admin/images/no-data.png"></a>
                              <a href="{{ asset('assets') }}/admin/images/job-offer-letter.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                              <button type="button" class="border-none" data-toggle="modal" data-target="#qualificationEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </td>
                          </tr>
                        </tbody>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="add-btn-part">
                      <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
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

@endsection