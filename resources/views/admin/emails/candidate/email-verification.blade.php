<!DOCTYPE html>
<html lang="en">

<head>
    <title>Email Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/admin/images/logo-icon.png">


</head>

<body style="margin: 0 auto; padding:0; font-family: 'Poppins', sans-serif;">


    <section style="max-width: 680px; margin:20px auto; background:#f2f2f3; display:block; border-radius: 10px;">
        <center>
            <header style="width: 100%; padding:30px 0 20px">
                <img src="{{ URL::asset('assets/admin/images/logo.png') }}"
                    style="width: 150px; background-size: cover; height: auto">
            </header>
            <div style="background: #fff; border-top:4px solid #5533FF; margin:0 30px; padding:0 0 30px">
                <h2
                    style="font-weight: 600; font-size: 18px; line-height: 32px; color: #373E57; padding: 27px 20px 22px; margin:0; text-align: left;">
                    Hi {{ $verifyMailData['name'] }},
                </h2>
                <h1
                    style="font-weight: 800; font-size: 26px; line-height: 32px; color: #373E57; padding: 0 20px 22px; margin:0; text-align: left;">
                    Please verify your account </h1>
       
            </div>
          
            <button style="background: #5533FF; border:none; border-radius: 6px; padding:15px 40px; margin:25px 0">
             <a href="{{route('verification.success')}}/{{ $verifyMailData['id'] }}" style="color: #fff; text-decoration:none; font-weight: 500; font-size: 20px; line-height: 26px; font-family: 'DM Sans', sans-serif;">
                Verify Account
                </a>
            </button>

            <footer style="padding:20px;">
                <p
                    style="font-weight:300;font-size: 16px; line-height: 24px; color: #373E57; font-family: 'DM Sans', sans-serif; margin: 0;">
                    Copyright 2023 <span style="color: #5533FF;">Employee Verificaiton Portal.</span>. All Right Reserved.</p>
                <ul style="margin:15px 0 0; padding:0">
                    <li style="list-style-type: none; display: inline-block;"><a href="#"><img
                                src="{{ URL::asset('assets/admin/candidate/images/instagram-icon.png') }}"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ URL::asset('assets/admin/candidate/images/twitter-icon.png') }}"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ URL::asset('assets/admin/candidate/images/facebook-icon.png') }}"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img
                                src="{{ URL::asset('assets/admin/candidate/images/google-icon.png') }}"></a></li>
                </ul>
            </footer>

        </center>
    </section>


</body>

</html>
