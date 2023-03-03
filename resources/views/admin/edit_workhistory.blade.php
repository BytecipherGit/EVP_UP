@extends('admin/layouts.emp_editapp')
@section('edit')
@section('title','EVP - Onboarding-Employee')

<div class="tab-pane" id="tabs-4" role="tabpanel">
    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              @csrf
              <div class="row">
                <div class="col-xl-12">
                  <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#workHistorybtn"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                </div>
                <p class="no-data-clg">No Data Available</p>  

                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Company Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Designation</th>
                            <th>Offer Letter</th>
                            <th>Experience</th>
                            <th>Salary Slips</th>
                            <th>Verification</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                          <tr>
                            <td>ByteCipher</td>
                            <td>14-01-2018</td>  
                            <td>Present</td> 
                            <td>React Native Developer</td>  
                            <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a></td>
                            <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a></td>
                            <td><a href="{{ asset('assets') }}/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a></td>
                            <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                            <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                          </tr>
                          <tr>      
                            <td>ByteCipher</td>
                            <td>14-01-2018</td>  
                            <td>20-10-2029</td>
                            <td>React Native Developer</td> 
                            <td><a class="docu-down" data-toggle="modal" data-target="#workhisinfo"><img src="{{ asset('assets') }}/admin/images/no-data.png"></a></td>
                            <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a></td>
                            <td><a href="{{ asset('assets') }}/admin/images/sample-pdf.pdf" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a></td>
                            <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                            <td><button type="button" class="border-none" data-toggle="modal" data-target="#workHistoryedit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                          </tr>
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