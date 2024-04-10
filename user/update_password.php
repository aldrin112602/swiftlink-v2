<?php
require_once '../config.php';
require_once '../global.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'user') {
        header('location: ../admin');
    }
} else {
    header('location: ../index.php');
}

$sql = "SELECT * FROM accounts WHERE email = '{$_SESSION['email']}' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$profile = !empty($row['profile']) ? $row['profile'] : 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png';
$email = $row['email'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update password</title>
    <link rel="stylesheet" href="../src/bootstrap.min.css" />
    <link rel="icon" href="../src/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../src/img/favicon.ico" type="image/x-icon" />
    <meta name="theme-color" content="#ffffff">
    <meta name="background-color" content="#ffffff">
    <meta name="display" content="standalone">
    <link rel="icon" type="image/png" sizes="192x192" href="../src/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../src/img/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Poppins font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../src/style.css">
    <script src="../src/jquery.min.js"></script>
    <script src="../src/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../src/w3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


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

        .current-page {
            background: transparent;
            border-radius: 2px;
            border-right: 3px solid blue;
            color: darkblue;
        }

        .current-page a {
            color: darkblue;
        }

        .nav-item:hover {
            color: darkblue;
            background: transparent;
            border-radius: 2px;
            border-right: 3px solid blue;
            color: darkblue;
        }

        .nav-item a:hover {
            color: darkblue;
        }

        @media (max-width: 767px) {
            .navbar {
                background: #222;
            }
        }

        .form .input {
            border: 1px solid darkblue;
            border-radius: 15px;
            height: 50px;
            background-color: transparent;
            padding-left: 30px;
        }

        .form .btn {
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

<body>
    <?php require_once '../loading_banner.php' ?>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div>
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">

                        <ul class="navbar-nav flex-column justify-content-start">
                            <img src="../src/img/swLogo.png" width="100%">
                            <li class="nav-item my-1">
                                <a href="./index.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">home</span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="package.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">deployed_code</span>
                                    Package
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="customer.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">history</span>
                                    History
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="bill.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">receipt</span>
                                    Ticket
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="help.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">help</span>
                                    Help
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="logs.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">manage_history</span>
                                    Logs
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="profile.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">account_box</span>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item my-1 current-page">
                                <a href="./update_password.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">lock</span>
                                    Update password
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="about.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">info</span>
                                    About
                                </a>
                            </li>

                            <li class="mt-2 d-grid">
                                <?php require_once './logout_confirmation.php'; ?>
                                <button onclick="logoutConfirmation()" class="btn btn-block text-white" style="border-radius: 50px; background: linear-gradient(45deg, dodgerblue, darkblue); background-repeat: no-repeat;" style="border-radius: 50px;">
                                    Logout
                                </button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col">
                            <div class="page-header">
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="" class="breadcrumb-link">Pages</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Update password</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Update Password</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <?php
                    $sql = "SELECT * FROM accounts WHERE email = '{$_SESSION['email']}' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    // handle change password
                    if (isset($_POST['change-password'])) {

                        $current_password = trim($_POST['current_password']);
                        $password = trim($_POST['password']);
                        $hashPass = $password;
                        $confirm_password = trim($_POST['confirm_password']);
                        // Validate password
                        $uppercase    = preg_match('@[A-Z]@', $password);
                        $lowercase    = preg_match('@[a-z]@', $password);
                        $_number       = preg_match('@[0-9]@', $password);
                        $specialChars = preg_match('@[^\w]@', $password);
                        $length       =  strlen($password) < 8;

                        // validate code 
                        if ($current_password != $row['password']) $err_msg  = 'Incorrect password!';
                        elseif (!$lowercase) $err_msg  = 'Password must atleast have one lowercase!';
                        elseif (!$_number) $err_msg = 'Password must atleast have one digit!';
                        elseif (!$specialChars) $err_msg  = 'Password must atleast have one special character!';
                        elseif ($length) $err_msg  = 'Password must atleast eight characters!';
                        elseif ($password != $confirm_password) {
                            $err_msg = 'Confirm password did not match, please try again!';
                        } else {
                            // update password
                            $sql = "UPDATE accounts SET password = '$hashPass' WHERE email = '{$_SESSION['email']}'";
                            if (mysqli_query($conn, $sql)) {
                                $success_msg = 'Password changed successfully!';
                                setLog('user', [
                                    'account_no' => $_SESSION['account_no'],
                                    'category' => 'Activity',
                                    'activity' => 'Updated password security'
                                ]);
                            }
                        }
                    }

                    ?>
                    <div class="ecommerse-widget">
                        <h5 class="text-success">Swiftlink</h5>
                        <form action="" style="max-width: 900px; border-radius: 40px;" method="post" class="form p-5 col-12 bg-white mx-auto">
                            <h3 class="my-2 pb-2">Update Password*</h3>
                            <div class="container my-3">
                                <label class="form-label" for="current_password">Current password</label>
                                <input autofocus value="<?php echo $_POST['current_password'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="current_password" name="current_password">
                            </div>
                            <div class="container my-3">
                                <label class="form-label" for="password">Password</label>
                                <input value="<?php echo $password ?? null ?>" required type="password" class="form-control form-control-sm input" id="password" name="password">
                            </div>
                            <div class="container my-3">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input value="<?php echo $confirm_password ?? null ?>" required type="password" class="form-control form-control-sm input" id="confirm_password" name="confirm_password">
                            </div>


                            <div class="container mt-4">
                                <button name="change-password" type="submit" class="btn mb-3 btn-sm btn-primary">Change Password</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->

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