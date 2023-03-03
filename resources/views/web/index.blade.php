<!DOCTYPE html>
<html lang="en">

<head>
  <title>Employee Verification - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/company/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/my-css.css">  

  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/company/js/jquery.min.js"></script>

</head>

<body>

<header>
  <div class="container-fluid">
    <div class="navigation-wrap start-header start-style">
      <nav class="navbar navbar-expand-md navbar-light">
        
          <a class="navbar-brand" href="index.html"><img src="{{ asset('assets') }}/company/images/logo.png" alt=""></a>  
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto py-4 py-md-0">
              <li class="nav-item active">
                <a class="nav-link" href="company-index">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login">Company Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="individual-login">Individual Login</a>
              </li>
            </ul>
          </div>            
        </nav>
    </div>     
  </div>
</header>
 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/company/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/company/js/bootstrap.min.js"></script>

</body>

</html>