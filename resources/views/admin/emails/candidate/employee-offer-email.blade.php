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
                <img src="images/logo.png" style="width: 150px; background-size: cover; height: auto">
            </header> 
            <div style="background: #fff; border-top:4px solid #5533FF; margin:0 30px; padding:0 0 30px">

                <h2 style="font-weight: 600; font-size: 18px; line-height: 32px; color: #373E57; padding: 27px 20px 22px; margin:0; text-align: left;">
                    Dear {{$mailData['name']}},
                </h2>
                <p style="font-size: 18px; line-height: 28px; color: #373E57; padding: 0 20px 0px; margin:0; font-family: 'DM Sans', sans-serif; text-align: left;">We are pleased to offer you the {{ $mailData['name'] }} at Bytecipher Pvt.Ltd. with a start date of 12-April-2023. You will be reporting directly to Rahul Sharma at Indore MP. We believe your skills and experience are an excellent match for our company.</p>

                <div style="border-top: 1px solid #c3baba; margin:15px 20px;">
                    <a href="{{ route('offer.accepted', ['EmployeeOfferId' => $mailData['EmployeeOfferId']]) }}"
                        style="margin-bottom:15px; font-size:20px; font-weight: 600; padding: 20px 0; background: #5533ff; float: left; width: 100%; border-radius: 5px; color: #fff; text-decoration: none;"
                        target="_black">
                        <sapn style="padding: 0 5px;">Accepted</sapn>
                    </a>
                    <a href="{{ route('offer.declined', ['EmployeeOfferId' => $mailData['EmployeeOfferId']]) }}"
                        style="margin-bottom:15px; font-size:20px; font-weight: 600; padding: 20px 0; background: #5533ff; float: left; width: 100%; border-radius: 5px; color: #fff; text-decoration: none;"
                        target="_black">
                        <sapn style="padding: 0 5px;">Declined</sapn>
                    </a>
                </div>
                

                <p style="margin-top:15px;margin-bottom:15px; margin-top: 30px; font-size:16px;line-height: 24px; color: #373E57;  text-align: left; padding: 0 20px 0px; font-family: 'DM Sans', sans-serif;">Kind regards,</br>
                    ByteCipher Pvt Ltd</p>
            </div> 

            <footer style="padding:20px;">
                <p style="font-weight:300;font-size: 16px; line-height: 32px; color: #373E57; font-family: 'DM Sans', sans-serif; margin: 0;">Copyright 2023 <span style="color: #5533FF;">ByteCipher</span>. All Right Reserved.</p>
                <ul style="margin:15px 0 0; padding:0">
                    <li style="list-style-type: none; display: inline-block;"><a href="#"><img src="images/instagram-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="images/twitter-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="images/facebook-icon.png"></a></li>
                    <li style="list-style-type: none; display: inline-block; padding-left: 30px;"><a href="#"><img src="images/google-icon.png"></a></li>
                </ul>
            </footer>

        </center> 
    </section>

     
</body>

</html>