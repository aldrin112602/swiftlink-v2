<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Swiftlink</title>
    <link rel="stylesheet" href="src/bootstrap.min.css" />
    <script src="./src/jquery.min.js"></script>
    <script src="./src/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Favicon -->
    <link rel="icon" href="./src/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./src/img/favicon.ico" type="image/x-icon" />
    <meta name="theme-color" content="#ffffff">
    <meta name="background-color" content="#ffffff">
    <meta name="display" content="standalone">
    <link rel="icon" type="image/png" sizes="192x192" href="./src/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="./src/img/android-chrome-512x512.png">
    
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

    .form {
        width: 500px;
    }

    .form .input, .form-select {
        border: 1px solid darkblue;
        border-radius: 15px;
        height: 50px;
        background-color: transparent;
        padding-left: 30px;
    }

    div src/img {
        z-index: 100;
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
        cursor:grab;
        
    } </style>
</head>

<body>
    <?php 
        require_once './handle_register.php';
        require_once './loading_banner.php'; 
    ?>
    <div style="
        min-height: 100vh;
      " class="w-full d-flex align-items-center justify-content-center flex-column px-3 bg-success py-3">
        
        <form action="" enctype="multipart/form-data" method="post" class="form p-5 py-3 bg-white rounded col-12 col-lg-4 mb-4">
            <img class="d-block mx-auto my-4" style="width: 80%;" src="src/img/swLogo.png">
            <div class="container my-3">
                <input autofocus placeholder="Email" value="<?php echo $email ?? null ?>" required type="email" class="form-control form-control-sm input"
                    id="email" name="email">
            </div>
            <div class="container my-3">
                <input placeholder="Phone" value="<?php echo $phone ?? null ?>" required type="number" class="form-control form-control-sm input"
                    id="phone" name="phone">
            </div>

            <div class="container my-3 d-flex align-items-center justify-content-between gap-2">
                <div class="">
                    <input placeholder="Password" value="<?php echo $password ?? null ?>" required type="password" class="form-control form-control-sm input"
                    id="password" name="password">
                </div>
                <div class="">
                    <input placeholder="Confirm Password" value="<?php echo $confirm_password ?? null ?>" required type="password" class="form-control form-control-sm input"
                    id="Confirm_password" name="confirm_password">
                </div>
            </div>

            <div class="container my-3">
                <input placeholder="Firstname" value="<?php echo $firstname ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="firstname" name="firstname">
            </div>
            <div class="container my-3">
                <input placeholder="Middle Initial" value="<?php echo $middle_initial ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="middle_Initial" name="middle_initial">
            </div>
            <div class="container my-3">
                <input placeholder="Lastname" value="<?php echo $lastname ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="lastname" name="lastname">
            </div>
            <div class="container my-3">
                <input placeholder="Address/House No./Street Name" value="<?php echo $address ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="address" name="address">
            </div>
            <div class="container my-3 d-flex align-items-center justify-content-between gap-2">
                <div class="">
                    <input placeholder="Town" value="<?php echo $town ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="town" name="town">
                </div>
                <div class="">
                    <input placeholder="City" value="<?php echo $city ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="city" name="city">
                </div>
            </div>
            <div class="container my-3">
                <input placeholder="Province" value="<?php echo $province ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="province" name="province">
            </div>
            <div class="container my-3">
                <input placeholder="Postal code" value="<?php echo $postal_code ?? null ?>" required type="text" class="form-control form-control-sm input"
                    id="postal_code" name="postal_code">
            </div>

            <div class="container my-3">
                <h6 class="fw-bold">Coverage</h6>
                <select required class="form-select form-select-sm" name="coverage">
                    <option class="d-none" selected disabled value="">-- Select coverage --</option>
                    <?php 
                        $data = getRows("status = 'Active'", "coverage");
                        foreach ($data as $row) {
                            echo '
                                <option value="' . $row['name'] . '">' . $row['name'] . '</option>
                            ';
                        }
                    ?>
                </select>
            </div>


            <div class="container my-3">
                <h6 class="fw-bold">Valid ID</h6>
                <small style="font-size: 12px">LIST OF ACCEPTABLE GOVERNMENT-ISSUED IDENTIFICATION CARDS(IDS)/DOCUMENTS:</small>
                <div class="py-2">
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-Philsys</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-Passport</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-PRC</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-Driver's License</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-SSS</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-Pag-ibig</span>
                    </div>
                    <div class="d-inline-block mt-1">
                        <span class="badge badge-light fw-normal text-dark border fs-6">-Other valid government-issued IDs</span>
                    </div>
                </div>

                <!-- file -->
                <input required type="file" name="file" accept="" class="d-none" id="file">
                <button id="fileBtn" type="button" class="btn btn-sm btn-success p-1 py-0" style="height: 40px; width: 150px;">
                <i class="fas fa-file-upload mx-2"></i>Add file</button>
                <small id="filename" class="text-muted px-2">No file selected yet..</small>
                <script>
                    $('#fileBtn').on('click', function() {
                        $('#file').click()
                    })

                    $('#file').on('change', function() {
                        var fullPath = $(this).val();
                        var filename = fullPath.split('\\').pop().split('/').pop();
                        $('#filename').html(filename);
                    });
                </script>
            </div>

            <div class="container my-3">
                <h6 class="fw-bold">Package</h6>
                <select required class="form-select form-select-sm" id="package" name="package">
                    <option class="d-none" selected disabled value="">-- Select package --</option>
                    <?php 
                        $data = getRows("status = 'Active'", "package");
                        foreach ($data as $row) {
                            echo '
                                <option data-price="' . $row['price'] . '" value="' . $row['package'] . '">' . $row['package'] . '</option>
                            ';
                        }
                    ?>
                </select>
                <input type="hidden" id="price" name="price">
            </div>
            
            
            <div class="container my-3 mt-4">
                <div class="form-check">
                    <input required class="form-check-input" type="checkbox" value="" id="termsOfService">
                    <label class="form-check-label" for="termsOfService">
                        <a href="#" class="text-muted fw-bold mx-auto" style="text-decoration: none; font-size: 14px">Agree to Tersm and Conditions & Privacy Policy</a>
                    </label>
                </div>
            </div>
            <div class="container my-3 text-center d-grid">
                    <button type="submit" class="btn mb-3 btn-sm btn-success btn-block">Register</button>
                </div>
                <p style="font-size: 14px" class="text-center">Already have an account? <a href="./login.php" class="nav-link btn d-inline text-dark fw-bold">Login</a></p>

                <p style="font-size: 13px" class="text-center text-muted py-3">@2023 Swiftlink UI. All Rights Reserved.</p>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#package').on('change', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');
                $('#price').val(price);
            });
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
                });
                <?php
            }    
            ?>
        })
    </script>

</body>

</html>