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
                            <a href=""><img src="assets/company/images/back-icon.png"></a>
                        </div>
                        <h6>Company Verification Document</h6>
                        <div class="form-group">
                            <label>Company Registration No.</label>

                            <input type="text" name="reg_id" id="reg_id" class="form-control"
                                value="{{ old('reg_id') }}" placeholder="EVP_ Enter Registration Id">
                            @error('reg_id')
                                <p class="velidation">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="document">
              <div class="row new-changeLS customer_records">
                <div class="col-md-6">
                  <div class="form-groupbox">
                    <label>Upload required document </label>     
                    <div class="upload-img-file">
                      <div class="p-image ml-auto">
                        <input type="file" name="document[]" id="file-upload" class="form-control" required>
                        @error('document')
                        <p class="velidation">{{ $message }}</p>
                        @enderror
                     </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-groupbox">
                      <label>&nbsp;</label>   
                     <select class="form-control" name="doc_type[]" id="doc_type" style="height: 60px;" required>
                      <option value="">Document Type</option>
                      <option value="GST">GST No</option>
                      <option value="Pan Card">Pan Card</option>
                     </select>
                     @error('doc_type')
                     <p class="velidation">{{ $message }}</p>
                     @enderror
                  </div> 
                </div>
                <label>&nbsp;</label>  
                <div class="add-plus mt-custom-plus extra-fields-customer"><span><img src="/assets/company/images/button-plus.png"></span></div>
                    
              </div>
               <div class="customer_records_dynamic"></div>
            </div>  --}}

                        <div class="document">
                            <div class="row new-changeLS customer_records">
                                <div class="col-md-12">
                                    <div class="form-groupbox">
                                        <label>Upload GST document </label>
                                        <div class="upload-img-file">
                                            <div class="p-image ml-auto">
                                                <input type="file" name="gst" id="gst"
                                                    class="form-control">
                                                @error('gst')
                                                    <p class="velidation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-groupbox">
                                        <label>Upload PAN Card document </label>
                                        <div class="upload-img-file">
                                            <div class="p-image ml-auto">
                                                <input type="file" name="pancard" id="pancard"
                                                    class="form-control">
                                                @error('pancard')
                                                    <p class="velidation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <label>&nbsp;</label>  
                <div class="add-plus mt-custom-plus extra-fields-customer"><span><img src="/assets/company/images/button-plus.png"></span></div> --}}

                            </div>
                            <div class="customer_records_dynamic"></div>
                        </div>


                        <div class="form-group">
                            <button type="submit">Submit</button>
                            {{-- <button type="submit" data-toggle="modal" data-target="#seccess-veriId" aria-hidden="true">Submit</button> --}}
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

{{-- 
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Add/Remove Multiple Input Fields Example</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ url('store-input-fields') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Subject</button></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-outline-success btn-block">Save</button>
        </form>
    </div>
</body>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
</html> --}}
