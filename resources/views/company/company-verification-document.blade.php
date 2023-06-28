@extends('company/layouts.appcom')
@section('content')
@section('title', 'EVP - Company Verification Document')

<style>
    .clones {
        display: none;
    }
</style>

<div class="d-flex main-form-part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 pad-0">
                <div class="main-box-img">
                    <img src="assets/company/images/login-bg.jpg">
                </div>
            </div>
            <div class="col-lg-6 form-section">
                <div class="login-box-txt org-basic-info">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('store.document') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex close-butn">
                            <a href="{{route('login')}}"><img src="assets/company/images/back-icon.png"></a>
                        </div>
                        <h6>Company Verification Document</h6>
                        {{-- <div class="form-group">
                            <label>Company Registration No.</label>

                            <input type="text" name="reg_id" id="reg_id" class="form-control"
                                value="{{ old('reg_id') }}" placeholder="Enter Registration Number">
                            @error('reg_id')
                                <p class="validation">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div class="document">
                            <div class="row new-changeLS customer_records">
                                <div class="col-md-12">
                                    <div class="form-groupbox">
                                        <label>Registration ID Proof <strong style="color:red">*</strong>
                                        <p><b>File type:</b> Only .jpeg, .pdf, .docs, or .doc files allowed.
                                        <b>File Size:</b> Max:10MB</p></label>
                                        <div class="upload-img-file">
                                            <div class="p-image ml-auto">
                                                <input type="file" name="id_proof" id="id_proof"
                                                    class="form-control">
                                                @error('id_proof')
                                                    <p class="validation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-groupbox">
                                        <label>Address Proof <strong style="color:red">*</strong>
                                        <p><b>File type:</b> Only .jpeg, .pdf, .docs, or .doc files allowed.
                                            <b>File Size:</b> Max:10MB</p></label>
                                        <div class="upload-img-file">
                                            <div class="p-image ml-auto">
                                                <input type="file" name="address_proof" id="address_proof"
                                                    class="form-control">
                                                @error('address_proof')
                                                    <p class="validation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-groupbox">
                                        <label>Registration Document Proof <strong style="color:red">*</strong>
                                            <p><b>File type:</b> Only .jpeg, .pdf, .docs, or .doc files allowed.
                                            <b>File Size:</b> Max:10MB</p></label>
                                        <div class="upload-img-file">
                                            <div class="p-image ml-auto">
                                                <input type="file" name="document_proof" id="document_proof"
                                                    class="form-control">
                                                @error('document_proof')
                                                    <p class="validation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="customer_records_dynamic"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Email verified-->
<div class="modal fade custom-modal" id="seccess-veriId" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/assets/company/images/checksign.png">
                <h2>Successfully Added</h2>
                <p>Please wait while we are processing your request...</p>
                <div></div>
                <a href="">Back</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".add-btn").click(function() {
            var html = $(".clones").html();
            $(".increment").after(html);
        });
        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>
<script>
    function openForm() {
        $("#button").click(function() {
            $("#seccess-veriId").css("display", "block")
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][rid]" class="form-control" placeholder="Enter your number"></td><td><input type="text" name="addMoreInputFields[' +
            i +
            '][doc]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="/assets/company/js/bootstrap.min.js"></script>
<script src="/assets/company/js/file-upload.js"></script>
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
    $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="assets/company/images/minus-icon.png"></span></a>'
        );
        $('.customer_records_dynamic > .single').attr("class", "row");

        $('.customer_records_dynamic input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
    });
</script>

@endsection
