@extends('admin/layouts.emp_editapp')
@section('edit')
@section('title','EVP - Onboarding-Employee')



  <div class="tab-pane" id="" role="tabpanel">

    <div class="eml-persnal ">
      <div class="add-emply-details">                
        <div class="row">
          <div class="col-lg-12">
            <form method="post">
              @csrf
              <div class="row">
                <div class="col-xl-12">
                  <h2>Uploaded Documents <span class="ml-auto on-head-right" data-toggle="modal" data-target="#identityAdd"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                </div>
                <p class="no-data-clg">No Data Available</p>  

                <div class="col-xl-12">
                  <div class="eml-per-main">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Id</th>
                            <th>Verification</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                            <tr>
                              <td>Pan Card</td>
                              <td>AXXX11100X</td>
                              <td><span class="verified-clr"><i class="fa fa-check"></i> Verified</span></td>
                              <td>
                                <span class="d-flex tbl-iconBx">
                                  <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#exampleModaldocument"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                  <a href="{{ asset('assets') }}/admin/images/pan-card.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                  <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>Aadhar Card</td>
                              <td>AXXX1200X</td>
                              <td><span class="not-verified-clr"><i class="fa fa-times"></i> Not Verified</span></td>
                              <td>
                                <span class="d-flex  tbl-iconBx">
                                  <a class="docu-down" data-toggle="modal" data-target="#btninfo"><img src="{{ asset('assets') }}/admin/images/no-data.png"></a>
                                  <a href="{{ asset('assets') }}/admin/images/pan-card.png" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                  <button type="button" class="border-none" data-toggle="modal" data-target="#identityEdit"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                                </span>
                              </td>
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

  <!-- The Modal Identity Add -->
  <div class="modal fade custu-modal-popup" id="identityAdd" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add Identity</h2>
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
                  <div class="col-md-6">
                    <label>Id Type</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Id Type</div>
                      <div class="dropdown-menu" id="style-5">
                        <a class="dropdown-item active">Id Type</a>
                        <a class="dropdown-item">Pan Card</a>
                        <a class="dropdown-item">Aadhar Card</a>
                        <a class="dropdown-item">voter Id</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Id Number</label>
                    <input type="text" name="" class="form-control" placeholder="Number">
                  </div>
                </div>                
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="upload-img-file">
                      <div class="circle">
                        <img class="profile-pic" id="profile-pic1" src="{{ asset('assets') }}/admin/images/file-icon-img.png">
                      </div>
                      <p>You can drag or drop <span>png. jpeg</span> </p>
                      <div class="p-image ml-auto">
                        <span class="upload-button" id="upload-button1">Choose File</span>
                        <input class="file-upload" id="file-upload1" type="file" accept="image/*">
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Verification</label>
                    <div class="selectBox active form-control">
                      <div class="selectBox__value">Verification Type</div>
                      <div class="dropdown-menu">
                        <a class="dropdown-item active">Verification Type</a>
                        <a class="dropdown-item">Verified</a>
                        <a class="dropdown-item">Not Verified</a>                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-primary-cust" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection