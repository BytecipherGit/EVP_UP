<input type="hidden" id="employee_id" name="employee_id" value="{{ $qualificationExist ? $qualificationExist->employee_id : '' }}" />
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
                    @foreach ($qualificationViewExist as $qualifictaions)
                        <tr>
                            <td>{{ $qualifictaions->degree }}</td>
                            <td>{{ $qualifictaions->inst_name }}</td>
                            <td>{{ $qualifictaions->subject }}</td>
                            <td>{{ $qualifictaions->duration_from }}</td>
                            <td>{{ $qualifictaions->duration_to }}</td>

                            @if ($qualifictaions->qualification_verification_type == 1)
                                <td><span class="verified-clr"><i class="fa fa-check"></i>Verified</span></td>
                            @else
                                <td><span class="not-verified-clr"><i class="fa fa-times"></i>Not Verified</span></td>
                            @endif
                            <td>
                                <a href="#" target="_black" class="docu-down" data-toggle="modal" data-target="#qualificationdocument{{ $qualifictaions->id }}"><img src="{{ asset('assets') }}/admin/images/document.png"></a>
                                <a href="/image/{{ $qualifictaions->document }}" target="_black" class="docu-download"><img src="{{ asset('assets') }}/admin/images/download-icon.png"></a>
                                {{-- <span class="ml-auto on-head-right" data-toggle="modal" data-target="#edit_qualification{{ $qualifictaions->id }}" href="#" id="qualification_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span> --}}

                             <button type="button" class="border-none" data-toggle="modal" data-target="#edit_qualification{{ $qualifictaions->id }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- The Modal Qualification Add -->
@foreach ($qualificationViewExist as $qualification)

<div class="modal fade custu-modal-popup" id="edit_qualification{{ $qualification->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Qualification</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    @include('employees.edit_qualification')         
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
