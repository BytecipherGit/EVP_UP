@extends('admin/layouts.emp_app')
@section('emp_identity')
@section('title','EVP - Onboarding-Employee')


  <!-- The Modal Work Work HistoryBasic-->
  <div class="modal fade custu-modal-popup" id="workHistorybtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Work History</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="post">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Company Name</label>
                    <input type="text" name="com_name" class="form-control" placeholder="ByteCipher" required>
                  </div>
                </div>                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>From</label>
                    <input type="date" name="duretion_from" class="form-control" placeholder="From">
                  </div>
                  <div class="col-md-6">
                    <label>To</label>
                    <input type="date" name="duretion_to" class="form-control" placeholder="To">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" placeholder="React Native Developer" required>
                  </div>                  
                </div>
              </div>  

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Offer Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic5" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button5">Choose File</span>
                        <input class="file-upload" name="offer_letter" id="file-upload5" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Experience Letter</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic6" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button6">Choose File</span>
                        <input class="file-upload" name="exp_letter" id="file-upload6" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Salary Slips</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic7" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>pdf</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button7">Choose File</span>
                        <input class="file-upload" name="salary_slip" id="file-upload7" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <select class="form-control" name="verification_type" id="verification_type">
                      <option value="">Verification Type</option>
                      <option value="Verified">Verified</option>
                      <option value="Not Verified">Not Verified</option>
                    </select>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="cancel" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="workhistory" class="btn-primary-cust">Save</button>
        </div>
      </div>
    </div>
  </div> 
</form>

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