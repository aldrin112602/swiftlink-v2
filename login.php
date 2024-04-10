<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Swiftlink</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- custom styles -->
    <style>
        * {
            font-family: "Poppins", sans-serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            transition: all 0.5s;
            text-decoration: none;
        }

        a {
            text-decoration: none !important;
        }

        .form {
            width: 400px;
            background-image: url('src/img/Officepicture.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .form .input {
            border: 1px solid darkblue;
            border-radius: 15px;
            height: 50px;
            background-color: transparent;
            padding-left: 30px;
        }


        .btn {
            height: 50px;
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
            cursor: grab;

        }
    </style>
</head>

<body class="">

    <?php
    require_once './handle_login.php';
    require_once './loading_banner.php';
    ?>
    <div style="min-height: 100vh;" class="w-full d-flex align-items-center justify-content-center flex-column px-3 bg-light">
        <?php if (!isset($_SESSION['validate_otp'])) { ?>
            <div class="bg-success p-5">
                <form action="" method="post" class="form p-5 col-12 col-lg-4 bg-white rounded">
                    <img class="d-block mx-auto" style="width: 80%;" src="src/img/swLogo.png">
                    <div class="container my-3">
                        <label class="form-label" for="email">Email</label>
                        <input autofocus placeholder="Email" value="<?php echo $_POST['email'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="email" name="email">
                    </div>
                    <div class="container my-3">
                        <label class="form-label" for="password">Password</label>
                        <div class="d-block position-relative">
                            <input placeholder="Password" value="<?php echo $_POST['password'] ?? null ?>" required type="password" class="form-control form-control-sm input" id="password" name="password">
                            <i class="fas fa-eye text-dark" id="fa-eye" style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <script>
                            // toggle show/hide password function
                            $(function() {
                                $('#fa-eye').click(function() {
                                    $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');
                                    $('#password').attr('type', $('#password').attr('type') == 'password' ? 'text' : 'password');
                                })
                            })
                        </script>
                    </div>

                    <div class="container my-3 d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        <a href="./forgot_password.php" class="text-dark fw-bold" style="font-size: 13px;">Forgot password?</a>
                    </div>

                    <div class="container text-center d-grid mt-5">
                        <button type="submit" class="btn mb-3 btn-sm btn-success btn-block">Login</button>
                    </div>
                    <p style="font-size: 14px" class="text-center">Don't have an account? <a href="./register.php" class="nav-link btn d-inline text-dark fw-bold">Create an Account</a></p>
                </form>
            </div>
        <?php } else { ?>
            <script>
                let remaining_time = parseInt(<?php echo (($_SESSION['expire'] - time()) / 60) * 60 ?>);
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
            <form action="" method="post" class="form p-5 col-12 col-lg-4 shadow" style="background: #fff; width: 500px;">
                <a href="./logout.php"><i class="fas fa-arrow-left fs-5"></i></a>
                <h1 class="text-center fw-bolder fs-5 my-3">Enter Verification Code</h1>
                <h3 class="text-center fw-semibold fs-6 p-3 text-muted">We have sent the OTP to your given email, please check it.
                </h3>
                <p id="time" class=" text-muted px-3 text-center" style="font-size: 14px;"></p>
                <div class="container my-3">
                    <input placeholder="Enter code" value="<?php echo $_POST['otp'] ?? null ?>" required type="number" class="form-control form-control-sm input" id="otp" name="otp">
                </div>
                <div class="container my-3 text-center">
                    <button type="submit" class="btn btn-sm btn-primary" style="height: 40px; width: 200px;">Submit</button><br>
                    <p class="mt-3 fs-6">Didn't receive OTP? <a href="./resend_OTP.php" class="text-decoration-none">Resend code</a></p>
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
            if (isset($err_msg)) {
            ?>
                Toast.fire({
                    icon: "error",
                    title: "<?php echo $err_msg ?>"
                });
            <?php
            }
            ?>

            <?php
            if (isset($success_msg)) {
            ?>
                Toast.fire({
                    icon: "success",
                    title: "<?php echo $success_msg ?>"
                });
            <?php
            }
            ?>
        })
    </script>

</body>

</html>