<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/company/images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/company/css/my-css.css">  
  <script src="{{ asset('assets') }}/admin/js/jquery.validate.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/company/js/jquery.min.js"></script>

</head>

<body>
  
@yield('content')

</body>

</html>