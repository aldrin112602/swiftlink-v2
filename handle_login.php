<?php
require_once './config.php';
require_once './global.php';
require_once './send_OTP.php';


$email = $password = $err_msg = $success_msg = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $post = validate_post_data($_POST);
    $email = $post['email'];
    $password = $post['password'];
    $hashPass = $password;
    $condition = "email = '$email' AND password = '$hashPass' AND status IN ('Approved', 'Active')";
    if (isDataExists('accounts', '*', $condition)) {
        foreach (getRows($condition, 'accounts') as $row) {
            $token = random_int(100000, 999999);
            $body = '
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Verification Code</title>
                        </head>
                        <body>
                            <p>Dear ' . $row['email'] . ',</p>
                            <p>We received a verification code request for your account. If you did not initiate this request, please ignore this email, please enter the following verification code:</p>
                            <h2 style="text-align:center; font-size:32px;">' . $token . '</h2>
                            <p>This code is valid for <b>10 minutes</b>, so please enter it as soon as possible.</p>
                            </body>
                    </html>';

            if ($row['enable2FA'] == 'true') {
                if (send_mail($row['email'], $body)) {
                    $_SESSION['validate_otp'] = $token;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
                } else {
                    $err_msg = "Please check your internet connection";
                }
            } else {
                $_SESSION['validate_otp'] = null;
                $_SESSION['login'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['profile'] = $row['profile'];
                $_SESSION['account_no'] = $row['account_no'] ?? null;
                $_SESSION['name'] = $row['firstname'] . ' ' . $row['middle_initial'] . '. ' . $row['lastname'];
                $success_msg = 'Logged in successfully';
            }
        }
    } else {
        $err_msg = 'Invalid email or password';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {
    if ($_POST['otp'] == $_SESSION['validate_otp']) {
        $condition = "email = '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' AND status IN ('Approved', 'Active')";
        if (isDataExists('accounts', '*', $condition)) {
            foreach (getRows($condition, 'accounts') as $row) {
                $_SESSION['validate_otp'] = null;
                $_SESSION['login'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['profile'] = $row['profile'];
                $_SESSION['account_no'] = $row['account_no'] ?? null;
                $_SESSION['name'] = $row['firstname'] . ' ' . $row['middle_initial'] . '. ' . $row['lastname'];
            }
        }

        $success_msg = 'Logged in successfully';
    } else {
        $err_msg = 'Invalid OTP code';
    }
}

if (isset($_SESSION['role'])) {
    switch($_SESSION['role']) {
        case 'admin':
            header('location: ./admin/');
        break;
        case 'user':
            header('location: ./user/');
        break;
        case 'lineman':
            header('location: ./lineman/');
        break;
    }
}
