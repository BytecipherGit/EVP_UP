
@extends('company/layouts.app')
@section('content')
@section('title','EVP - Email Templates')

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <div class="main-container">
        <div class="main-heading">        
            <div class="row">
              <div class="col-md-12">
                <div class="main-right-button-box backhover">
                  <a href="/admin" class="button_background_color"><img src="{{ asset('assets') }}/admin/images/back-icon.png" class="back"> <span class="button_text_color">Back</span></a>
                </div>
              </div>  
            </div>
          </div><!--- Main Heading ----->
          @if (Session::has('success'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('success') }}
            </div>
        @elseif(Session::has('failed'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('failed') }}
            </div>
        @endif
            <form action="{{ route('qualified-template') }}" method="POST">
              @csrf
              <div class="row">
                  <div class="col-xl-12 col-lg-8 col-sm-12 col-12 m-auto">
                     
                      <div class="card shadow">
                          <div class="card-header">
                              <h4 class="card-title"> </h4>
                          </div>
                          <div class="card-body">
                   
                              <div class="form-group">
                                  <label><h3> Template for qualified</h3></label>
                                  <textarea class="ckeditor form-control" id="content" placeholder="Enter the Description" name="content">@if($templateQualified) {{$templateQualified->content}} @endif</textarea>
                              </div>
                              
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary button_background_color"><span class="button_text_color">Save Changes</span></button>
                            </div>
                          </div>
                       
                      </div>
                  </div>
              </div>
          </form>
    </div>
</body>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
</html>
@endsection
