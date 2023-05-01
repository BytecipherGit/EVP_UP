<!DOCTYPE html>
<html lang="en">

<head>
  <title>ByteCipher - Decline Offer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="icon" href="{{ asset('assets') }}/admin/web-email//images/logo-icon.png">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/my-css.css">  

  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script src="{{ asset('assets') }}/admin/js/jquery.min.js"></script>

</head>

<body>

<header>
  <div class="container">
    <div class="navigation-wrap start-header start-style">
      <nav class="navbar navbar-expand-md navbar-light">       
          <a class="navbar-brand" href="#"><img src="{{ asset('assets') }}/admin/web-email/images/logo.png" alt=""></a>          
                      
        </nav>
    </div>     
  </div>
</header>

<div class="scheduPage">
  <div class="container">
    <div class="scheduBox">
      <h1>Decline offer</h1>
      <div class="ul-part d-flex">
        <img src="{{ asset('assets') }}/admin/web-email/images/office-icon.png" class="iconImg">
        <form action="{{ route('offer.declined_form') }}" method="post">
          @csrf
        <div class="">
          <h2>Urgent Requirement for {{ $employeofferdecline->position }} </h2>
          <p>{{ $employeofferdecline->org_name }}</p>
        </div>
      </div>
      <div class="hrBorder"></div>
      <div class="hrBorder"></div>

      <div class="ul-part">
        <div class="">
          <input type="hidden" name="interview_status" id="interview_status" value="4">
          <input type="hidden" name="employeeOfferId" id="employeeOfferId" value="{{ $employeeOfferId }}">
          <h2>Add a note for the employer (optinal)</h2>
          <textarea rows="3" name="declined_comment" class="form-textarea"></textarea>
        </div>
      </div>
      
      <button class="buttun-classA" type="submit">Decline Offer</button>
      
    </form>
    </div>  
  </div>
</div>
 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>

</body>

</html>