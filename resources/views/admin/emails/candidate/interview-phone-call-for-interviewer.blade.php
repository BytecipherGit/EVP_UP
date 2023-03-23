<!DOCTYPE html>
<html lang="en">

<head>
    <title>Email Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets') }}/admin/images/logo-icon.png">


</head>

<body style="margin: 0 auto; padding:0; font-family: 'Poppins', sans-serif;">


    <section style="max-width: 680px; margin:20px auto; background:#f2f2f3; display:block; border-radius: 10px;">
        <center>
            <header style="width: 100%; padding:30px 0 20px">
                <img src="{{ asset('assets') }}/admin/images/logo.png"
                    style="width: 150px; background-size: cover; height: auto">
            </header>
            <div style="background: #fff; border-top:4px solid #5533FF; margin:0 30px; padding:0 0 30px">

                <h2
                    style="font-weight: 600; font-size: 18px; line-height: 32px; color: #373E57; padding: 27px 20px 22px; margin:0; text-align: left;">
                    Hi {{ $mailData['interviewer_name'] }},
                </h2>
                <h1
                    style="font-weight: 800; font-size: 26px; line-height: 32px; color: #373E57; padding: 0 20px 22px; margin:0; text-align: left;">
                    You received a phone interview request for one of the candidate {{ $mailData['interviewee_name'] }}
                </h1>
                <p
                    style="font-size: 18px; line-height: 28px; color: #373E57; padding: 0 20px 0px; margin:0; font-family: 'DM Sans', sans-serif; text-align: left;">
                    We requested to you please take this video interview on urgnet basis for {{ $mailData['position'] }}
                    position at {{ $mailData['organisationName'] }}.</p>

                <div style="border-top: 1px solid #c3baba; margin:15px 20px;"></div>

                <h2 style="font-size: 20px; text-align:left; padding:0 20px; display: flex; align-items: center;"><img
                        src="{{ asset('assets') }}/admin/images/message-icon.png"
                        style="width: 28px;padding: 5px;height: 28px;border: 1px solid #c3baba;border-radius: 6px; margin-right: 10px;">
                    Message from interviewer</h2>
                <p
                    style="font-size: 18px; line-height: 32px; color: #373E57; padding:0 20px 0px; margin:0; font-family: 'DM Sans', sans-serif; text-align: left;">
                    we requested to you please take interview by click on given below interview link
                </p>

                <div style="padding: 0 20px; width: 100%; display: flex;">
                    <div
                        style="width:75%; border: 1px solid #c3baba; border-radius: 6px; float: left; padding: 10px 15px; margin: 20px 0; background: #f3f1f1;">
                        <h1
                            style="font-size:20px; line-height: 24px; font-weight: 800; border-bottom: 1px solid #c3baba;padding-bottom: 15px; margin-bottom: 15px;">
                            Phone interview with {{ $mailData['organisationName'] }}.</h1>
                        <h6
                            style="text-align: left; font-size: 16px; font-weight: 200; display: flex; align-items: center; word-break: break-all;">
                            <img src="{{ asset('assets') }}/admin/candidate/images/phone-call.png"
                                style="width: 24px; margin-right: 10px;"> {{ $mailData['phone'] }}
                        </h6>
                        <h6
                            style="font-size:16px; line-height: 24px; font-weight: 600; text-align: left; display: flex; align-items: center; word-break: break-all;">
                            <img src="{{ asset('assets') }}/admin/candidate/images/calendar-icon.png"
                                style="width: 24px; margin-right: 10px;"> On dated {{ $mailData['meeting_date'] }} and
                            <br> start time {{ $mailData['meeting_start_time'] }} and duration of interview is
                            {{ $mailData['duration'] }}
                        </h6>

                        <a href="{{ route('interview.feedback', ['interviewEmpRoundsId' => $mailData['interviewEmpRoundsId']]) }}"
                            style="margin-bottom:15px; font-size:20px; font-weight: 600; padding: 20px 0; background: #5533ff; float: left; width: 100%; border-radius: 5px; color: #fff; text-decoration: none;"
                            target="_black">
                            <sapn style="padding: 0 5px;">Interview Feedback </sapn>
                        </a>
                    </div>
                </div>


                <div style="display: block; border-top: 1px solid #c3baba; margin:15px 20px; float: left; width: 92%;">
                </div>


                <p
                    style="width:100%; margin-top:15px;margin-bottom:15px; margin-top: 30px; font-size:16px;line-height: 24px; color: #373E57;  text-align: left; padding: 0 20px 0px; font-family: 'DM Sans', sans-serif;">
                    Kind regards,</br>
                    {{ $mailData['organisationName'] }}.</p>
            </div>

            <footer style="padding:20px;">
                <p
                    style="font-weight:300;font-size: 16px; line-height: 32px; color: #373E57; font-family: 'DM Sans', sans-serif; margin: 0;">
                    Copyright 2023 <span style="color: #5533FF;">{{ $mailData['organisationName'] }}</span>. All Right
                    Reserved.</p>
                <ul style="margin:15px 0 0; padding:0">
                    <li style="list-style-type: none; display: inline-block;"><a href="#"><img
                                src="{{ asset('assets') }}/admin/candidate/images/instagram-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ asset('assets') }}/admin/candidate/images/twitter-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ asset('assets') }}/admin/candidate/images/facebook-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ asset('assets') }}/admin/candidate/images/google-icon.png"></a></li>
                </ul>
            </footer>

        </center>
    </section>


</body>

</html>
