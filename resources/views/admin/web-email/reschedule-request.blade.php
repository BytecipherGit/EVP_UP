<!DOCTYPE html>
<html lang="en">

<head>
  <title>ByteCipher - Recheduled Request</title>
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
    <div class="request-declinenotifi">
      <p><img src="{{ asset('assets') }}/admin/web-email/images/check-icon.png"> Recheduled request sent</p>
    </div>
    <div class="scheduBox">
      <div class="ul-part d-flex pb-0 pt-0">
        <div class="">
          <h2>Your request to reschedule is pending</h2>     
          <p>We'll notify when the employer responds</p>     
        </div>
      </div> 
    </div>

    <div class="scheduBox">
      <h1 class="">Interview details</h1>
      <p class="pt-2"><span class="font-bgClcncl">CANCELLED</span></p>
      <div class="ul-part">
        <div class="rightBorder">
          <h2>Tuesday, March 8, 2022</h2>
          <p>4:30 Am - 6:30 Am IST</p>
        </div>
      </div> 
      <div class="noti-declinenotifi mb-0">
        <p><img src="{{ asset('assets') }}/admin/web-email/images/info_icon.png"> We updated the time zone to match your browser's settings.</p>        
      </div>

      <p class="schud-pare pt-2 pb-3"><span class="form-textBold">Interview details:</span>https://meet.google.com/xvh-pobm-rxs</p>

      <div class="hrBorder"></div>

      <div class="ul-part">
        <div class="rightBorder">
          <h2>Your interview availability:</h2>
          <p>I am available between 4 to 5pm tomorrow</p>
        </div>
      </div>       

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