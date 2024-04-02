<?php
require_once './send_OTP.php';
require_once './config.php';
require_once './global.php';


if ( isset( $_SESSION[ 'role' ] ) ) {
    if ( $_SESSION[ 'role' ] == 'user' ) {
        header( 'location: ./user/' );
    } else {
        header( 'location: ./admin/' );
    }
}
 $email = $err_msg = $success_msg = null;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email'] ?? '');
    $query = "SELECT * FROM accounts WHERE email = '$email' LIMIT 1";
    if ($result = mysqli_query($conn, $query)) {
        if (!mysqli_num_rows($result) > 0) {
            $err_msg = "User email did not exist!";
        } else {
            $row = mysqli_fetch_assoc($result);

            $token = random_int(100000, 999999);
            $body = '
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Verification Code</title>
                    </head>
                    <body>
                        <p>Dear ' . $row['email'] . ',</p>
                        <p>We received a reset verification code request for your account. If you did not initiate this request, please ignore this email, please enter the following verification code:</p>
                        <h2 style="text-align:center; font-size:32px;">' . $token . '</h2>
                        <p>This code is valid for <b>2 minutes</b>, so please enter it as soon as possible.</p>
                        <p>If you have any trouble entering the code, please don\'t hesitate to contact us at <a href="mailto:cabaleroaldrin02@gmail.com">swiftlink@gmail.com</a>.</p>
                    </body>
                </html>';
            if (send_mail($row['email'], $body, 'Reset Password Verification (Swiftlink)')) {
                $_SESSION['reset_verification'] = $token;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (2 * 60);
                $_SESSION['email'] = $row['email'];
            } else {
                $err_msg = "Something went wrong, please try again!";
            }
        }

        
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['otp'])) {
    if(!($_SESSION['reset_verification'] == $_POST['otp'])) {
        $err_msg = "Invalid OTP verification code!";
    } else {
        $_SESSION['reset_verification'] = null;
        $_SESSION['new_password'] = true;
        $success_msg = "OTP verified successfully!";
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['password'])) {
    $inpt_password = trim($_POST['password']);
    $hashPass = $inpt_password;
    $confirm_password = trim($_POST['confirm_password']);
    // Validate password
    $uppercase    = preg_match( '@[A-Z]@', $inpt_password );
    $lowercase    = preg_match( '@[a-z]@', $inpt_password );
    $_number       = preg_match( '@[0-9]@', $inpt_password );
    $specialChars = preg_match( '@[^\w]@', $inpt_password );
    $length       =  strlen( $inpt_password ) < 8;

    // validate code 
    if ( !$lowercase ) $err_msg  = 'Password must atleast have one lowercase!';
    elseif ( !$_number ) $err_msg = 'Password must atleast have one digit!';
    elseif ( !$specialChars ) $err_msg  = 'Password must atleast have one special character!';
    elseif ( $length ) $err_msg  = 'Password must atleast eight characters!';
    elseif ($inpt_password != $confirm_password) {
        $err_msg = 'Confirm password did not match, please try again!';
    } else {
        // update password
        if(isset($_SESSION['email'])) {
            $sql = "UPDATE accounts SET password = '$hashPass' WHERE email = '{$_SESSION['email']}'";
            if( mysqli_query($conn, $sql) ) {
                $success_msg = 'Password changed successfully!';
                
                session_destroy();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot password - Swiftlink</title>
    <link rel="stylesheet" href="src/bootstrap.min.css" />
    <script src="./src/jquery.min.js"></script>
    <script src="./src/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="./src/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./src/img/favicon.ico" type="image/x-icon" />
    <meta name="theme-color" content="#ffffff">
    <meta name="background-color" content="#ffffff">
    <meta name="display" content="standalone">
    <link rel="icon" type="image/png" sizes="192x192" href="./src/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="./src/img/android-chrome-512x512.png">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="msapplication-TileColor" content="#ffffff" />

    <!-- Poppins font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- custom styles -->
    <style>
    * {
        font-family: "Poppins", sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        transition: all 0.5s; text-decoration: none;
    } a {text-decoration: none !important;}


    .form .input {
        border: 1px solid darkblue;
        border-radius: 15px;
        height: 50px;
        background-color: transparent;
        padding-left: 30px;
    }

    
    .btn {
        border-radius: 15px;
    }

    

    ::-webkit-scrollbar {
        outline: none;
        height: 5px;
        width: 5px;
        background-color: rgba(0, 0, 0, 0.1);
    }

    ::-webkit-scrollbar-thumb {
        height: 5px;
        width: 5px;
        background-color: rgba(0, 0, 100, 0.3);
        border-radius: 2px;
        cursor:grab;
        
    } 
    #btn:hover {
        background-color: dodgerblue !important;
        color: white;
        box-shadow: inset 1px -1px 10px rgba(0, 0, 0, 0.2), inset -1px 1px 10px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>


<body>
    <?php
    require_once './loading_banner.php'; 
    ?>

    <div style="
        min-height: 100vh;
      " class="w-full d-flex align-items-center justify-content-center flex-column px-3 position-relative bg-light">
        <a href="./clear_session.php" class="btn btn-dark border position-absolute"
            style="top: 30px; left: 30px; z-index:10;">Cancel</a>
        <img src="./src/img/swLogo.png" alt="logo" class="mb-2" width="200px">
        <?php if(!isset($_SESSION['reset_verification']) && !isset($_SESSION['new_password'])) { ?>
        <form action="" method="post" class="form p-5 shadow col-12 col-lg-5 bg-white" style="border-radius: 25px;">
            <h1 class="fw-bolder fs-5">Forgot Password</h1>
            <small class="d-block text-muted my-4">No worries! We're here to help you get back into your account quickly and securely. </small>
            <div class="container my-3">
                <small for="username" class="mx-2">EMAIL</small>
                <input value="<?php echo $email ?? '' ?>" required type="email"
                    class="form-control input" id="email" name="email">
            </div>
            <div class="d-grid my-3 container">
                <button type="submit" style="height: 50px;" class="btn btn-primary btn-block">Continue</button>
            </div>
        </form>
        <?php } elseif (isset($_SESSION['reset_verification']) && !isset($_SESSION['new_password'])) {
        ?>
        <script>
        let remaining_time = parseInt(<?php echo(($_SESSION['expire'] - time()) / 60) * 60 ?>);
        let interval = setInterval(() => {
            if (remaining_time > 0) remaining_time--;
            else {
                $('#time').html('<code>Verification code expired!</code>');
                Swal.fire({
                    title: "Opsss!",
                    text: "verification code expired!",
                    icon: "error",
                    onClose: function() {
                        location.href = "./clear_session.php";
                    }
                });
                clearInterval(interval);
                return;
            }
            $('#time').html('Verification code will be expired <br> after <code>' + remaining_time +
            's</code>');
        }, 1000);
        </script>
        <form action="" method="post" class="form p-5 shadow col-12 col-lg-5 bg-white" style="border-radius: 25px;">
            <h1 class="fw-bolder fs-4">OTP verification</h1>
            <h3 class="fw-semibold fs-6 p-3 text-muted">We have sent a six digit code in your email address!
            </h3>
            <p id="time" class=" text-muted px-3 text-center" style="font-size: 14px;"></p>
            <div class="container my-3">
                <small for="otp" class="mx-2">Enter 6 digits code:</small>
                <input placeholder="xxxxxx" value="<?php echo $_POST[ 'otp' ] ?? null ?>" required type="number"
                    class="form-control form-control-sm input" id="otp" name="otp">
            </div>
            <div class="d-grid my-3 container">
                <button id="btn" type="submit" style="height: 50px; background: rgba(0, 0, 0, 0.1);" class="btn btn-block border">Verify</button>
            </div>
            <div class="container my-3 text-center">
                
                <p class="mt-3 fs-6">Didn't receive OTP? <a href="#" class="">Resend</a></p>
            </div>
        </form>
        <?php } else { ?>
        <form action="" method="post" class="form p-5 shadow col-12 col-lg-5 bg-white" style="border-radius: 25px;">
            <h1 class="fw-bolder fs-5">Create new password</h1>
            <div class="container my-3">
                <small class="mx-2">Enter password</small>
                <input value="<?php echo $_POST[ 'password' ] ?? null ?>" required type="password"
                    class="form-control form-control-sm input" name="password">
            </div>
            <div class="container my-3">
                <small class="mx-2">Confirm password</small>
                <input value="<?php echo $_POST[ 'confirm_password' ] ?? null ?>" required type="password"
                    class="form-control form-control-sm input" name="confirm_password">
            </div>
            <div class="d-grid my-3 container">
                <button id="btn" type="submit" style="height: 50px; background: rgba(0, 0, 0, 0.1);" class="btn btn-block border">Submit</button>
            </div>
        </form>
        <?php } ?>
    </div>
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            <?php
            if(isset($err_msg)) {
                ?>
                Toast.fire({
                    icon: "error",
                    title: "<?php echo $err_msg ?>"
                });
                <?php
            }    
            ?>

            <?php
            if(isset($success_msg)) {
                ?>
                Toast.fire({
                    icon: "success",
                    title: "<?php echo $success_msg ?>"
                }).then(() => {
                    location.href = './forgot_password.php';
                });
                <?php
            }    
            ?>
        })
    </script>
 
</body>

</html>