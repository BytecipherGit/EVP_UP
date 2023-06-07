@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Onboarding-Employee')

<div class="main-container">
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session()->get('msg') }}
        </div>
    @endif
    <form action="{{ url('csv') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="upload-file">Upload</label>
            <input type="file" name="upload-file" class="form-control">
        </div>
        <input class="btn btn-success" type="submit" value="Upload Image" name="submit">
    </form>
</div>
@endsection
