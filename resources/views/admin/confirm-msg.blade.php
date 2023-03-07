<!DOCTYPE html>
<html lang="en">

<head>
  <title>Email Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/logo-icon.png">

  
</head>

<body style="margin: 0 auto; padding:0; font-family: 'Poppins', sans-serif;" >


    <section style="max-width: 680px; margin:20px auto; background:#f2f2f3; display:block; border-radius: 10px;"> 
        <center>
            <header style="width: 100%; padding:30px 0 20px">
                <img src="{{ asset('assets') }}/email/images/logo.png" style="width: 150px; background-size: cover; height: auto">
            </header> 
            <div style="background: #fff; border-top:4px solid #5533FF; margin:0 30px; padding:0 0 30px">
                <h1 style="padding:27px 10px 25px; font-weight: bold; font-size: 26px; line-height: 38px; color: #373E57; margin:0">
                    Request Processed
                </h1>
                <img src="{{ asset('assets') }}/email/images/processing.png" style="margin-bottom: 20px; width: 100px;">
                <h2 style="font-weight: 800; font-size: 18px; line-height: 32px; color: #373E57; padding: 0 40px 22px; margin:0;">
                   Thank You 
                </h2>
                <p style="font-size: 18px; line-height: 32px; color: #373E57; padding: 0 20px 10px; margin:0; font-family: 'DM Sans', sans-serif; text-align: center;"> 
                    Your request for  Organization is processed.</p> 
            </div> 

            <footer style="padding:20px;">
                <p style="font-weight:300;font-size: 16px; line-height: 24px; color: #373E57; font-family: 'DM Sans', sans-serif; margin: 0;">Copyright 2023 <span style="color: #5533FF;">EVP</span>. All Right Reserved.</p>
                <ul style="margin:15px 0 0; padding:0">
                    {{-- <li style="list-style-type: none; display: inline-block;"><a href="#"><img src="{{ asset('assets') }}/email/images/instagram-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="{{ asset('assets') }}/email/images/twitter-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="{{ asset('assets') }}/email/images/facebook-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="{{ asset('assets') }}/email/images/google-icon.png"></a></li> --}}
                </ul>
            </footer>

        </center> 
    </section>

     
</body>

</html>