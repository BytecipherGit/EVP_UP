<!DOCTYPE html>
<html lang="en">

<head>
  <title>Email Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('assets') }}/email/images/logo-icon.png">

  
</head>

<body style="margin: 0 auto; padding:0; font-family: 'Poppins', sans-serif;" >


    <section style="max-width: 680px; margin:20px auto; background:#f2f2f3; display:block; border-radius: 10px;"> 
        <center>
            <header style="width: 100%; padding:30px 0 20px">
                {{-- <img src="{{ asset('assets') }}/email/images/logo.png" style="width: 150px; background-size: cover; height: auto"> --}}
            </header> 
            <div style="background: #fff; border-top:4px solid #5533FF; margin:0 30px; padding:0 0 30px">
                <h2 style="font-weight: 600; font-size: 18px; line-height: 32px; color: #373E57; padding: 27px 20px 22px; margin:0; text-align: left;">
                    Hi there!,
                </h2>
                <p style="font-size: 18px; line-height: 32px; color: #373E57; padding: 0 20px 0px; margin:0; font-family: 'DM Sans', sans-serif; text-align: left;">                 
                You have been invited by  to join the organization: ByteCipher.  You can have access to this organization, once you accept the invite.</p> 

                <p style="font-size: 18px; line-height: 32px; color: #373E57; padding:15px 20px 0px; margin:0; font-family: 'DM Sans', sans-serif; text-align: left;">
                   We hope you enjoy ByteCipher 
                </p>

                 

                 <button style="background: #5533FF; border:none; border-radius: 6px; padding:15px 40px; margin:25px 0">
                    <a href="#" style="color: #fff; text-decoration:none; font-weight: 500; font-size: 20px; line-height: 26px; font-family: 'DM Sans', sans-serif;">
                    Accept Invitation
                    </a>
                </button>


                <p style="text-align: center; margin-bottom: 30px; padding: 0 20px 0px; font-family: 'DM Sans', sans-serif;">
                    <span style="margin-bottom: 10px; display: block;">OR</span>
                    <br>
                    <span>Follow the link: <a href="email-config" style="text-decoration: underline; cursor: pointer; color: #18a749; ">https://bytecipher.net/employee-verification/org-invite/</a></span>
                </p>

                <p style="margin-top:15px;margin-bottom:15px;font-size:16px;line-height: 24px; color: #373E57;  text-align: left; padding: 0 20px 0px; font-family: 'DM Sans', sans-serif;">
                    If you need additional assistance, please visit our
                    <a href="#" style="cursor: pointer; color: #5533FF; text-decoration: none;">Help Center</a>
                    <br>
                    <div style="margin-bottom: 10px; text-align: left; padding: 0 20px 0px;"> The ByteCipher Team</div>
                </p>
            </div> 

            <footer style="padding:20px;">
                <p style="font-weight:300;font-size: 16px; line-height: 24px; color: #373E57; font-family: 'DM Sans', sans-serif; margin: 0;">Copyright 2022 <span style="color: #5533FF;">ByteCipher</span>. All Right Reserved.</p>
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