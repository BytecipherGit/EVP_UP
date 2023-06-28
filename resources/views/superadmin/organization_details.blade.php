@extends('superadmin.layouts.app')
@section('content')
@section('title', 'EVP - Organization Details')

<!--- Wapper Start ----->
<div class="wapper">
    <!--- Main Container Start ----->
    <div class="main-container">

        <div class="main-heading">
            <div class="row">
                <div class="col-md-8">
                    <h1>Organization Details</h1>
                </div>
                <div class="col-lg-4">
                    <div class="main-right-button-box">
                        <a href="{{ route('organization') }}"><img
                                src="{{ asset('assets') }}/superadmin/images/back-icon.png"> Back</a>
                    </div>
                </div>


                <div id="showHideAlert" class="modal fade custu-no-select" role="dialog" style="display:none;">
                    <button type="button" class="close" data-dismiss="dialog" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong><span id="success_msg"></span> </strong>
                </div>

                {{-- <div class="modal fade custu-no-select" id="showHideAlert" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="{{ asset('assets') }}/admin/images/deactivate-popup-icon.png" class="img-size-wth">
                        <h1 class="h1-delete">Are you sure?</h1>
                        <p>You want to change status?</p>
                        <a href="delete-invite/{{ $invite->id }}" class="button_background_color">Delete</a>
                    </div>
                </div>
            </div>
        </div> --}}



            </div>

        </div>
        <!--- Main Heading ----->
        <div id="successMessage"> </div>
        <div class="employee-tab-bar">
            <ul class="nav nav-tabs table-responsive-width" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Organization Details</a>
                    {{-- {{ request('tab') == 'tab1' ? 'active' : '' }}" href="{{ url('/page-url', ['tab' => 'tab1']) }}">Tab 1</a> --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Documents</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1" role="tabpanel">
                    {{-- {{ $activeTab == 'tab1' ? 'active' : '' }}" id="tab1" --}}
                    <div class="eml-persnal">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="eml-per-main">
                                    <h2>DETAILS</h2>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Organization ID</h4>
                                            <p>{{ $companyDetails->id }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Organization Name</h4>
                                            <p>{{ $companyDetails->org_name }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Admin Name</h4>
                                            <p>{{ $companyDetails->name }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Organization Website</h4>
                                            <p>{{ $companyDetails->org_web }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Organization Admin Email</h4>
                                            <p>{{ $companyDetails->email }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Designation</h4>
                                            <p>{{ $companyDetails->designation }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Department</h4>
                                            <p>{{ $companyDetails->department }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Registered Address</h4>
                                            <p>{{ $companyDetails->address }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Country</h4>
                                            <p>{{ $address->countryName }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>State</h4>
                                            <p>{{ $address->stateName }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>City</h4>
                                            <p>{{ $address->cityName }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h4>Pin Code</h4>
                                            <p>{{ $companyDetails->pin }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2" role="tabpanel">
                    <div class="eml-persnal">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="eml-per-main">
                                    <h2>Documents</h2>
                                    @if (!empty($documentExist))
                                        <div class="table-responsive1">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        {{-- <th>Id</th> --}}
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($companyDocuments as $companyDocument)
                                                    <tr>
                                                        <td>{{ $companyDocument->doc_type }}</td>
                                                        {{-- <td>{{ $companyDocument->id }}</td> --}}
                                                        <td>
                                                            @if ($companyDocument->status == 1)
                                                                <span style="cursor:pointer"
                                                                    onClick="update_company_status('{{ $companyDocument->id }}', '{{ $companyDocument->status }}')"
                                                                    class="btn btn-success position">
                                                                    <i
                                                                        style="font-size: 10px;"></i>&nbsp;Verified</span>
                                                            @else
                                                                <span style="cursor:pointer"
                                                                    class="btn btn-danger position"
                                                                    onClick="update_company_status('{{ $companyDocument->id }}', '{{ $companyDocument->status }}')">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="d-flex">
                                                                <a href="#" target="_black" class="docu-down"
                                                                    data-toggle="modal"
                                                                    data-target="#companyDocument{{ $companyDocument->id }}"><i
                                                                        class="fa fa-file-text"
                                                                        aria-hidden="true"></i></a>
                                                                <a href="{{ $companyDocument->document }}"
                                                                    target="_black" class="docu-download"><i
                                                                        class="fa fa-cloud-download"
                                                                        aria-hidden="true"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="col-xl-12">
                                            <p>Documets not uploaded.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--- Main Container Close ----->
</div>
<!--- Wapper Close ----->


<!-- The Modal Docum INFO-->
<div class="modal fade custu-modal-popup" id="update-statu" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Confirm Status</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/superadmin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <p>The passage experienced a surge in popularity during the 1960s when Letraset used it on their
                    dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their
                    software. Today it's seen all around the web; on templates, websites, and stock designs.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary-cust">Submit</button>
            </div>
        </div>
    </div>
</div>



<!-- The Modal Docum INFO-->
@foreach ($companyDocuments as $companyDocument)
    <div class="modal fade custu-modal-popup" id="companyDocument{{ $companyDocument->id }}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">{{ $companyDocument->doc_type }}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets') }}/superadmin/images/close-btn-icon.png">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="document-body">
                        <img src="{{ $companyDocument->document }}">
                    </div>
                    <a href="{{ route('download.document', ['id' => $companyDocument->id]) }}" target="_black">Download</a>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
@section('pagescript')
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/superadmin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/superadmin/js/bootstrap.min.js"></script>

{{-- <script>
      $(document).ready(function() {
          var activeTab = "{{ $activeTab }}";
          $('.nav-tabs a[href="#' + activeTab + '"]').tab('active');
      });
    </script> --}}

<script>
    function update_company_status(id, status) {
        if (confirm('Are you sure you want to change status ?')) {

            $.ajax({
                type: 'post',
                url: "{{ route('update_company_status') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'id=' + id + '&status=' + status,
                success: function(data) {

                    var status = data.status;
                    var msg = data.msg;
                    $('#success_msg').html(msg);
                    if (status == 'success') {
                        $("#showHideAlert").removeClass('alert-warning');
                        $("#showHideAlert").addClass('alert-success');

                        var page = window.location.hash.substr(1);
                        if (page) {
                            getData(page);
                        } else {

                            $("#successMessage").html(
                                "<div class='alert alert-success'> Status has beed changed successfully!</div>"
                                );
                            window.setTimeout(function() {
                                location.reload()
                            }, 2000)
                            // location.reload();
                            //  window.location.href = '{{ url('admin/organization_details') }}';
                        }


                    }
                    if (status == 'error') {
                        $("#showHideAlert").removeClass('alert-success');
                        $("#showHideAlert").addClass('alert-warning');
                    }
                    $("#showHideAlert").show();

                },
                'error': function(data) {
                    console.log(data);
                }
            });
        }


    }
</script>

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

