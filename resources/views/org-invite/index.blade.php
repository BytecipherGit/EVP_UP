<!DOCTYPE html>
<html lang="en">

<head>
  <title>ByteCipher - Invite Employee Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/org-invite/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/org-invite/css/main-container.css">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}//js/jquery.min.js"></script>

  
</head>

<body>  
  <div class="invite-popup-box d-flex">
    <div class="container-fluid">
      <div class="align-self-center pad-0 form-section">
        <div class="cover-box-txt"> 
          <img src="{{ asset('assets') }}/org-invite/images/logo.png" class="login-logo">
          <h1>Confirm your action</h1>
          <p>Are you sure you want to register here?</p> 
          {{-- <a href="#" class="btn-secondary-cust">Cancel</a> --}}
          <a href="{{route('basic-info')}}/{{ encrypt($employee->id) }}" class="btn-primary-cust">Confirm</a>
          <div class="foot-bottom">
            <p>© {{date('Y')}} EVP</p>
          </div> 
        </div>
      </div> 
    </div>  
  </div>
  
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script> 
    <script src="{{ asset('assets') }}/js/file-upload.js"></script>

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

</body>

</html>
