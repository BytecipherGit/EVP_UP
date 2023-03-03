<!DOCTYPE html>
<html lang="en">

<head>
  <title>ByteCipher - Interview Scheduled</title>
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
      <p><img src="{{ asset('assets') }}/admin/web-email/images/check-icon.png"> Your interview is scheduled</p>
    </div>
    <div class="scheduBox">
      <div class="ul-part d-flex pb-0 pt-0">
        <div class="">
          <h2>3 days until your interview for Human Resource Executive at ByteCipher PVt Ltd</h2>     
          <p>View details or make chnage below. Good luck!</p>     
        </div>
      </div> 
    </div>

    <div class="scheduBox">
      <h1 class="">Interview details</h1>
      <div class="ul-part">
        <div class="rightBorder">
          <h2>Tuesday, March 8, 2022</h2>
          <p>4:30 Am - 6:30 Am IST</p>
        </div>
      </div> 
      <div class="noti-declinenotifi mb-0">
        <p><img src="{{ asset('assets') }}/admin/web-email/images/info_icon.png"> We updated the time zone to match your browser's settings.</p>        
      </div>

      <p class="schud-pare pt-2"><span class="form-textBold">Interview details:</span>https://meet.google.com/xvh-pobm-rxs</p>
      
      <button class="buttun-classA"><a href="https://calendar.google.com/calendar/u/0/r?pli=1" target="_black">Add to Google Calender</a></button>

      <div class="hrBorder"></div>

      <h1 class="mt-3">Can't make it to the interview?</h1>

      <p class="schud-pare pt-2">Please note: Employers may choose to notify ByteCipher about the result of interviews, including
whether or not you addended the interview. Employers appreciate being kept in the loop.</p>
      
      <button class="buttun-classA"><a href="reschedule-interview">Reschedule</a></button>

    </div>  
  </div>
</div>
 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('{{ asset('assets') }}') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>

</body>

</html>