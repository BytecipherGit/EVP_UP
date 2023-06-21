<div class="row">
    <div class="col-lg-12">
    <form id="employee_update" action="{{ url('employee_occupation/form') }}" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
     <div class="row">  
          <div class="col-xl-12"><h2>Basic Info</h2></div>
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="form-group">
              <label>Employee ID</label>
              <input type="text" name="employee_id" class="form-control disabled" value=" {{ $employee ? $employee->empCode : '' }}" placeholder="Id Number" readonly>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                  <label>Date of Joining<span style="color:red">*</span></label>
                  <input type="date" name="date_of_joining" value="{{ $employeeInfo ? $employeeInfo->date_of_joining : '' }}" class="form-control" placeholder="Date">
                  <strong class="error" id="date_of_joining-error"></strong>
              </div>
          </div>
          
          <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                  <label>Work Location<span style="color:red">*</span></label>
                  <select class="form-control" name="work_location" id="work_location" aria-placeholder="select Work location">
                      {{-- <option value="">Select work location</option> --}}
                      <option value="Bhopal, MP" @if ($employeeInfo) {{ $employeeInfo->work_location == 'Bhopal, MP' ? 'selected' : '' }} @endif>Bhopal, MP</option>
                      <option value="Indore, MP" @if ($employeeInfo) {{ $employeeInfo->work_location == 'Indore, MP' ? 'selected' : '' }} @endif>Indore, MP</option>
                      <option value="Pune, MH" @if ($employeeInfo) {{ $employeeInfo->work_location == 'Pune, MH' ? 'selected' : '' }} @endif>Pune, MH</option>
                  </select>
                  <strong class="error" id="work_location-error"></strong>
              </div>
          </div>

          {{-- <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group">
                  <label>Employee Status<span style="color:red">*</span></label>
                  <select class="form-control" name="emp_status" id="emp_status">
                      <option value="{{ $employeeInfo ? $employeeInfo->emp_status : ''}}">{{ $employeeInfo ? $employeeInfo->emp_status : 'Select status'}}</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                  </select>
                  <strong class="error" id="emp_status-error"></strong>
              </div>
          </div> --}}
          <div class="col-xl-6 col-lg-5 col-md-10">
              <div class="form-group">
                  <label>Designation<span style="color:red">*</span></label>
                  <input type="text" name="designation" class="form-control"  value="{{ $employeeInfo ? $employeeInfo->designation : '' }}" placeholder="Designation">
                  <strong class="error" id="designation-error"></strong>
              </div>
            </div>
            
          <div class="col-md-12">
              <div class="form-group">
                  <div class="add-btn-part">
                      <button type="reset" class="btn-secondary-cust"data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
                  </div>
              </div>
          </div>
      </div>
      </form>
    </div>
  </div> 