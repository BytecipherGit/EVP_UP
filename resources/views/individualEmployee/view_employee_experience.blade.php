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
                        <th>Action</th>
                    </tr>
                </thead>
             
                 <tbody>
                   @foreach($workExperiences as $workhistory)
                    <tr>
                        <td>{{ $workhistory->com_name }}</td>
                        <td>{{ $workhistory->work_duration_from }}</td>
                        <td>{{ $workhistory->work_duration_to }}</td>
                        <td>{{ $workhistory->designation }}</td>
                        <td><a href="#" target="_black" class="docu-down" data-toggle="modal"data-target="#workofferdocument{{ $workhistory->id }}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                        </td>
                        <td><a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#workexpdocument{{ $workhistory->id }}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                        </td>
                        <td><a href="{{ $workhistory->salary_slip }}" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/pdf-icon.png"></a>
                        </td>
                        <td><button type="button" class="border-none" data-toggle="modal" data-target="#edit_workhistory{{ $workhistory->id }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>
</div>

<!-- The Modal Workhistory Add -->
@foreach ($workExperiences as $workhistory)

<div class="modal fade custu-modal-popup" id="edit_workhistory{{ $workhistory->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLabel">Add Workhistory</h2>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
      </button>
  </div>
  <div class="modal-body"> 
      <div class="comman-body">
          @include('individualEmployee.edit_employee_experience')         
      </div>
  </div>
</div>
</div>
</div>
@endforeach

@foreach ($workExperiences as $workhistory)
<div class="modal fade custu-modal-popup" id="workofferdocument{{ $workhistory->id }}" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
      </div>
      @if ($workhistory->offer_letter == null)
          <div class="modal-body">
              <p>Document not uploaded..</p>
          </div>
      @else
          <div class="modal-body">
              <div class="document-body">
                  <img src="{{ $workhistory->offer_letter }}">
              </div>
              <div class="main-right-button-box backhover">
                  <a href="/download_offerletter/{{ $workhistory->id }}" class="emp button_background_color" target="_black"><span class="button_text_color">Download</span></a>
              </div> 
          </div>
      @endif
      <div class="modal-footer">
      </div>
  </div>
</div>
</div>
@endforeach

@foreach ($workExperiences as $workhistory)
<div class="modal fade custu-modal-popup" id="workexpdocument{{ $workhistory->id }}" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Document View</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
      </div>
      @if ($workhistory->exp_letter == null)
          <div class="modal-body">
              <p>Document not uploaded..</p>
          </div>
      @else
          <div class="modal-body">
              <div class="document-body">
                  <img src="{{ $workhistory->exp_letter }}">
              </div>
              <div class="main-right-button-box backhover">
                  <a href="/download_expletter/{{ $workhistory->id }}" class="emp button_background_color" target="_black"><span class="button_text_color">Download</span></a>
              </div> 
          </div>
      @endif
      <div class="modal-footer">
      </div>
  </div>
</div>
</div>
@endforeach