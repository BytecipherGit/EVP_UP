<!DOCTYPE html>
<html lang="en">

<head>
    <title>ByteCipher - Suggest a new time</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" href="{{ asset('assets') }}/admin/web-email//images/logo-icon.png">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/my-css.css">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="{{ asset('assets') }}/admin/js/jquery.min.js"></script>

</head>

<body>

    <header>
        <div class="container">
            <div class="navigation-wrap start-header start-style">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="#"><img
                            src="{{ asset('assets') }}/admin/web-email/images/logo.png" alt=""></a>

                </nav>
            </div>
        </div>
    </header>

    <div class="scheduPage">
        <div class="container">
            <div class="scheduBox">
                <h1>Your feedback is very important to us.</h1>
                <form action="{{ route('interview.feedback.mail') }}" method="post">
                    @csrf
                    <div class="ul-part">
                        <div class="">
                            <h2>Interview Status</h2>
                            <select class="form-control" id="interviewer_status" name="interviewer_status">
                                <option value="Unclear">Not Clear</option>
                                <option value="Clear">Clear</option>
                            </select>
                        </div>
                        <div class="">
                            <input type="hidden" name="interviewEmpRoundsId" id="interviewEmpRoundsId" value="{{ $interviewEmpRoundsId }}">
                            <h2>Share your feedback</h2>
                            <textarea rows="3" name="interviewer_feedback" class="form-textarea"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="buttun-classA">Submit Request</button>
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
