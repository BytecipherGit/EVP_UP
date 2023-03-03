{{-- <div class="row">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>

    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
       
        </tbody>
    </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script> --}}
@extends('company/layouts.app')
@section('content')
@section('title','EVP - Onboarding-Employee')

<div class="main-container">
    @if (session()->has('msg'))
<div class="alert alert-success">
    {{ session()->get('msg') }}
</div>
  @endif
    <form action="{{url('csv')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="form-group">
                <label for="upload-file">Upload</label>
                <input type="file" name="upload-file" class="form-control">
            </div>
            <input class="btn btn-success" type="submit" value="Upload Image" name="submit">
        </form>
    </div>
@endsection