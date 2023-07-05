@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Invite Employee')

<!--- Main Container Start ----->
<div class="main-container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="main-heading">
        <div class="row">
            <div class="col-md-8">
                <h1>Invite Employees</h1>
                <p></p>
            </div>
            <div class="col-md-4">

                <div class="main-right-button-box">
                    <p class="loadingImg" style="padding-right:5px"></p>
                    <a href="#" name="bulk_mail_invite" id="bulk_mail_invite" class="button_background_color"
                        style="margin-right: 15px"><span class="button_text_color">Invite</span></a>
                    <a href="add-invite-employee" class="button_background_color"><img
                            src="assets/admin/images/button-plus.png"><span class="button_text_color">Add New</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--- Main Heading ----->

    <div class="employee-view-page">
        <div class="table-responsive">
            <div class="table-effect-box">

                {{-- <button><span data-toggle="modal" data-target="#bulkeditbtn"><img src="assets/admin/images/bulk-icon.png"></span> <a data-toggle="modal" data-target="#btninfo">Bulk Edit</a></button> --}}
                {{-- <button><span><a href="https://mail.google.com/mail/u/0/" target="_black"><img src="assets/admin/images/email-icon.png"></a></span> <a data-toggle="modal" data-target="#btninfo">Mail</a></button> --}}
                <span class="ml-auto d-flex">
                    <button><span class="bg-red"><img src="assets/admin/images/import.png" data-toggle="modal"
                                data-target="#btninfo"></span> <a data-toggle="modal"
                            data-target="#btninfo">Import</a></button>
                    <button><span class="button_background_color"><img src="assets/admin/images/export.png"
                                data-href="/export-csv-invite" onclick="exportTasks (event.target);"></span><a
                            data-href="/export-csv-invite" id="export"
                            onclick="exportTasks (event.target);">Export</a></button>
                    {{-- <button><span data-toggle="modal" data-target="#exporteditbtn"><img src="assets/admin/images/export.png"></span> <a data-toggle="modal" data-target="#btninfo">Export</a> --}}
                    </button>
                </span>
            </div>
            {{-- <table class="table table-striped invite-table-cust" style="width:100%"> --}}
            <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
                <thead class="primary_color">
                    <tr>
                        <th><input type="checkbox" id="selectAll" class="secondary_color"></th>
                        <th class="secondary_color">Employee Code</th>
                        <th class="secondary_color">Employee Name</th>
                        <th class="secondary_color">Employee Email</th>
                        <th class="secondary_color">Contact Number</th>
                        <th class="secondary_color">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empinvite as $invite)
                        <tr>
                            <td><input type="checkbox" name="users_id[]" class="users_checkbox"
                                    value="{{ $invite->id }}" /></td>
                            <td>#{{ $invite->empCode }}</td>
                            <td>{{ $invite->first_name . ' ' . $invite->last_name }}</td>
                            <td>{{ $invite->email }}</td>
                            <td>{{ $invite->phone }}</td>
                            {{-- <td><button class="pushme with-color active-btn-bg">Joined</button></td> --}}
                            <td class="d-flex">
                                {{-- <span class="notifi-td" data-toggle="modal" data-target="#remaiderbtninfo"><img src="assets/admin/images/bell-icon.png"></span>  --}}
                                <a href="edit-invite-employee/{{ $invite->id }}" class="edit-btn fa fa-edit"
                                    title="Edit"></a>
                                <a class="edit-btn deleteEmployee fa fa-trash" data-id="{{ $invite->id }}" title="Delete"></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!--- Employeer View Page ----->

</div>
<!--- Main Container Close ----->

<!-- The Modal No INFO -->
<div class="modal fade custu-no-select" id="btninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{-- <img src="{{ asset('assets') }}/admin/images/info.png" class="img-size-wth"> --}}
                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="upload-file" class="exportlab">Import Employee Records</label>
                        <input type="file" name="upload-file" class="form-control export">
                    </div>
                    <input class="btn-primary-custexport button_background_color " type="submit" value="Import"
                        name="submit">
                    <button type="button" class="btn-secondary-custexport" data-dismiss="modal">Cancel</button>
                </form>
                {{-- <a href="/download_invitecsv" class="sample btn btn-primary">Download sample file here </a> --}}
                <a href="/download_invitecsv" class="sample btn btn-primary downLinkCus">Download sample file here <img
                        src="assets/admin/images/import.png" class="pl-3"></a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Remaider Notification -->
<div class="modal fade custu-no-select" id="remaiderbtninfo" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="remainder-body">
                    <h1>Send reminder to complete registration.</h1>
                    <p>Your invitation or last reminder was sent 4 days ago</p>
                    <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-primary-cust">Send remainder</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pagescript')
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

<script>
    $(function() {
        //toggle classes on li element
        $('li.skils-id-1-1').on('click', function() {
            $('li.skils-id-1-1').toggleClass('clicked');
        });
        $('li.skils-id-1-2').on('click', function() {
            $('li.skils-id-1-2').toggleClass('clicked');
        });
        $('li.skils-id-1-3').on('click', function() {
            $('li.skils-id-1-3').toggleClass('clicked');
        });
        $('li.skils-id-1-4').on('click', function() {
            $('li.skils-id-1-4').toggleClass('clicked');
        });
        $('li.skils-id-1-5').on('click', function() {
            $('li.skils-id-1-5').toggleClass('clicked');
        });
        $('li.skils-id-1-6').on('click', function() {
            $('li.skils-id-1-6').toggleClass('clicked');
        });
        $('li.skils-id-1-7').on('click', function() {
            $('li.skils-id-1-7').toggleClass('clicked');
        });
        $('li.skils-id-1-8').on('click', function() {
            $('li.skils-id-1-8').toggleClass('clicked');
        });
        $('li.skils-id-1-9').on('click', function() {
            $('li.skils-id-1-9').toggleClass('clicked');
        });

    });
</script>

<script>
           $(document).on('click', '.deleteEmployee', function() {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this employee!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        // Handle the change event
                        var inviteId = $(this).data('id');
                        if (inviteId != '') {
                            var url = '{{ url('delete_invite') }}';
                            var my_data = {
                                inviteId: inviteId
                            };
                            $.ajax({
                                url: url,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: my_data,
                                success: function(data) {
                                    if (data.success) {
                                        swal("Employee successfully deleted.", {
                                            icon: "success",
                                        });
                                        setInterval(function() {
                                            location.reload();
                                        }, 2000);
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        swal("Employee is safe!");
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    }
                });
        });
</script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
<script>
    $(document).ready(function() {

        $(".with-color").click(function() {
            if ($(this).hasClass("dective-btn-bg")) {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
            } else {
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
            }
        });

        $(".pushme").click(function() {
            $(this).text(function(i, v) {
                return v === 'Joined' ? 'Dropped' : 'Joined'
            });
        });

        $(".with-color-bg").click(function() {
            if ($(this).hasClass("dective-btn-bg")) {
                $(this).addClass("active-btn-bg");
                $(this).removeClass("dective-btn-bg");
            } else {
                $(this).addClass("dective-btn-bg");
                $(this).removeClass("active-btn-bg");
            }
        });

        $(".pushme-Acp").click(function() {
            $(this).text(function(i, v) {
                return v === 'Accepted' ? 'Declied' : 'Accepted'
            });
        });
    });
</script>
<script>
    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>

<script>
    $("#selectAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    // $(document).on('click', '#bulk_mail_invite', function() {

    // swal({
    //         title: "Are you sure?",
    //         text: "You want to send invitation to selected employee!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })

    //         .then((result) => {

    //             if (result) {
    //                 var checkboxes = document.querySelectorAll('input[class="users_checkbox"]:checked');
    //                 var id = [];
    //                 for (var i = 0; i < checkboxes.length; i++) {
    //                     id.push(checkboxes[i].value);
    //                 }
    //                 if (id.length > 0) {
    //                     var url = '{{ url('send_invitation_to_employee') }}';
    //                     var my_data = {
    //                         id: id
    //                     };
    //                     $.ajax({
    //                         url: url,
    //                         type: 'POST',
    //                         headers: {
    //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    //                                 'content')
    //                         },
    //                         data: my_data,
    //                         success: function(data) {
    //                             if (data.success) {
    //                                 swal("Invitation successfully sent.", {
    //                                     icon: "success",
    //                                 });
    //                                 location.reload();
    //                             }
    //                         },
    //                         error: function(xhr, textStatus, errorThrown) {
    //                             console.log(xhr.responseText);
    //                         }
    //                     });
    //                 }
    //             } else {
    //                 swal("Please select atleast one checkbox!");
    //                 location.reload();

    //             }
    //         });
    // });

    $(document).on('click', '#bulk_mail_invite', function() {
        if (confirm) {
            // swal({
            //         title: "Are you sure?",
            //         text: "You want to send invitation to selected employee!",
            //         icon: "warning",
            //         buttons: true,
            //         dangerMode: true,
            //     })
            var checkboxes = document.querySelectorAll('input[class="users_checkbox"]:checked');
            var id = [];
            for (var i = 0; i < checkboxes.length; i++) {
                id.push(checkboxes[i].value);
            }
            if (id.length > 0) {
                $('.loadingImg').show();
                swal('Are you sure you want to send email?');
                var url = '{{ url('send_invitation_to_employee') }}';
                var my_data = {
                    id: id
                };
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: my_data,
                    success: function(data) {
                        if (data.success) {
                            swal("Invitation successfully sent.", {
                                icon: "success",
                            });
                            // location.reload();
                            $('.loadingImg').hide();
                            setInterval(function() {
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });

            } else {
                swal("Please select atleast one employee record!");
                // location.reload();
            }
        }

    });
</script>

@stop
