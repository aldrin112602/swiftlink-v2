<?php
require_once './config.php';
require_once './global.php';
require_once './send_OTP.php';


if(isset($_SESSION['email'])) {
    $token = random_int(100000, 999999);
    $email = $_SESSION[ 'email' ];

    $body = '
            <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Verification Code</title>
                        </head>
                        <body>
                            <p>Dear '. $email .',</p>
                            <p>We received a verification code request for your account. If you did not initiate this request, please ignore this email, please enter the following verification code:</p>
                            <h2 style="text-align:center; font-size:32px;">'. $token .'</h2>
                            <p>This code is valid for <b>10 minutes</b>, so please enter it as soon as possible.</p>
                            </body>
                    </html>    
    ';

    if(send_mail($email, $body)) {
        $_SESSION['validate_otp'] = $token;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
                
    } else {
        $err_msg = "Please check your internet connection";
    }
}

header('location: login.php');