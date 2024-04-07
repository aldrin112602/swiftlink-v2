<?php 
    require_once '../config.php';
    require_once '../global.php';
    require_once '../send_mail.php';

    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] != 'user') {
            header('location: ../admin');
        }
    } else {
        header('location: ../index.php');
    }

    $sql = "SELECT * FROM accounts WHERE email = '{$_SESSION['email']}' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Package</title>
    <link rel="stylesheet" href="../src/bootstrap.min.css" />
    <link rel="icon" href="../src/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../src/img/favicon.ico" type="image/x-icon" />
    <meta name="theme-color" content="#ffffff">
    <meta name="background-color" content="#ffffff">
    <meta name="display" content="standalone">
    <link rel="icon" type="image/png" sizes="192x192" href="../src/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../src/img/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Poppins font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../src/style.css">
    <script src="../src/jquery.min.js"></script>
    <script src="../src/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../src/w3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- custom styles -->
    <style>
    * {
        font-family: "Poppins", sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        transition: all 0.5s; text-decoration: none;
    } a {text-decoration: none !important;}

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

    .input {
        border: 1px solid darkblue;
        border-radius: 15px;
        height: 50px;
        background-color: transparent;
        padding-left: 30px;
    }

    .form .input,
    .form-select {
        border: 1px solid darkblue;
        border-radius: 15px;
        height: 50px;
        background-color: transparent;
        padding-left: 30px;
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">

                        <ul class="navbar-nav flex-column justify-content-start">
                            <img src="../src/img/swLogo.png" width="100%">
                            <li class="nav-item my-1">
                                <a href="./index.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">home</span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item my-1 current-page">
                                <a href="package.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">deployed_code</span>
                                    Package
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="history.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">history</span>
                                    History
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="open_ticket.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">receipt</span>
                                     Ticket
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="help.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">help</span>
                                    Help
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="logs.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">manage_history</span>
                                    Logs
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="profile.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">account_box</span>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="./update_password.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">lock</span>
                                    Update password
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="about.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">info</span>
                                    About
                                </a>
                            </li>
                            
                            <li class="mt-2 d-grid">
                                <?php  require_once './logout_confirmation.php'; ?>
                                <button onclick="logoutConfirmation()" class="btn btn-block text-white"
                                    style="border-radius: 50px; background: linear-gradient(45deg, dodgerblue, darkblue); background-repeat: no-repeat;">
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
                                            <li class="breadcrumb-item active" aria-current="page">Package</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Package</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <?php 
                    $data = getRows("email = '{$_SESSION['email']}'", "accounts")[0];
                    ?>
                    <?php 
                        if((!isset($_GET['add_package']) || $_GET['add_package'] != 'true')) {
                    ?>
                    <div class="ecommerse-widget">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="text-success">Swiftlink</h5>
                            <a href="?add_package=true" class="btn btn-primary btn-sm px-4 text-white"
                                style="border-radius: 50px;"><i class="fa-solid fa-plus"></i> Add</a>
                        </div>

                        <div class="row gap-5 justify-content-center">
                            <div class="col-12 col-lg-5 bg-white shadow p-4 " style="border-radius: 40px;">
                                <h3>Package</h3>
                                <!-- <hr class="divider mt-2"> -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Items</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = getRows("account_no = '{$_SESSION['account_no']}' AND variant='false'", "user_package");

                                            // Pagination parameters
                                            $totalItems = count($data);
                                            $itemsPerPage = 5;
                                            $totalPages = ceil($totalItems / $itemsPerPage);
                                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $current_page = max(1, min($totalPages, intval($current_page)));
                                            $offset = ($current_page - 1) * $itemsPerPage;

                                            $dataToDisplay = array_slice($data, $offset, $itemsPerPage);


                                            foreach ($dataToDisplay as $row) {
                                                ?>
                                            <tr>
                                                <td><?= $row['package'] ?? null ?></td>
                                                <td><?= $row['category'] ?? "Fiber" ?></td>
                                                <td><?= $row['process_status'] ?? "Pending" ?></td>
                                            </tr>
                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bootstrap Pagination -->
                                <nav aria-label="Page navigation" class="mt-5">
                                    <ul class="pagination">
                                        <!-- Previous page link -->
                                        <li class="page-item <?= ($current_page == 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?page=<?= ($current_page - 1) ?>"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <!-- Page links -->
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                        <li class="page-item <?= ($i == $current_page ? 'active' : '') ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                        <?php } ?>

                                        <!-- Next page link -->
                                        <li class="page-item <?= ($current_page == $totalPages ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?page=<?= ($current_page + 1) ?>"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <?php
                            $data = getRows("account_no='{$_SESSION['account_no']}'", "accounts")[0];
                            ?>
                            <div class="col-12 col-lg-5 bg-white shadow p-4 " style="border-radius: 40px;">
                                <h3>Details</h3>
                                <div class="container my-2">
                                    <label class="form-label">Account No.</label>
                                    <input value="<?= $data['account_no'] ?? null ?>" type="number"
                                        class="form-control form-control-sm input" readonly>
                                </div>

                                <div class="container my-2">
                                    <label class="form-label">Name</label>
                                    <input value="<?= $_SESSION['name'] ?? null ?>" type="text"
                                        class="form-control form-control-sm input" readonly>
                                </div>

                                <div class="container my-2">
                                    <label class="form-label">Email</label>
                                    <input value="<?= $data['email'] ?? null ?>" type="email"
                                        class="form-control form-control-sm input" readonly>
                                </div>

                                <div class="container my-2">
                                    <label class="form-label">Address</label>
                                    <input value="<?= $data['address'] ?? null ?>" type="text"
                                        class="form-control form-control-sm input" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    } elseif(isset($_GET['add_package']) && $_GET['add_package'] == 'true') {?>
                    <div class="ecommerse-widget">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $account_no = $_SESSION['account_no'];
                                $total = trim($_POST['price']);
                                
                                $coverage = trim($_POST['coverage']);
                                $package = trim($_POST['package']);
                                $category = trim($_POST['category']);
                                $invoice = generateRandomNumber(9);

                                // set due date and period
                                $currentDate = new DateTime();
                                $currentDate->add(new DateInterval('P1M'));
                                $period = $currentDate->format('M Y');
                                $dueDate = $currentDate->format('d M Y');

                                // get email
                                $email = getRows("account_no='$account_no'", "accounts")[0]['email'];

                                if(SendMail($email, " Dear ". $email .", <br><br>
                                    Thank you for submitting a new package! 🎉<br>
                                    Our team will promptly review your package request.<br>
                                    <br><br>
                                    Best regards,<br>
                                    Swiftlink", "Package Submission Confirmation")) {
                                    $insertQuery = "INSERT INTO user_package (account_no, invoice, package, coverage, total, period, due_date)
                                    VALUES ('$account_no', '$invoice', '$package', '$coverage', $total, '$period', '$dueDate')";

                                    
                                    $result = mysqli_query($conn, $insertQuery);
                                    if ($result) {
                                        $success_msg = "Package added successfully!";
                                        setLog('user', [
                                            'account_no' => $_SESSION['account_no'],
                                            'category' => 'Activity',
                                            'activity' => 'Added package ' . $package
                                        ]);
                                    } else {
                                        $err_msg = "Error adding package: " . mysqli_error($conn);
                                    }
                                } else {
                                    $err_msg = "Something went wrong, please check internet  connection ";
                                }



                                
                            }
                            ?>
                        <form action="" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                            <h4 class="text-primary fw-bold">Add Package</h4>

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

                            <div class="container my-3">
                                <h6 class="fw-bold">Category</h6>
                                <select required class="form-select form-select-sm" name="category">
                                    <option class="d-none" selected disabled value="">-- Select category --</option>
                                    <option value="Fiber">Fiber</option>
                                </select>
                            </div>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 text-white"
                                    style="border-radius: 20px;">Save</button>
                                <a href="./package.php" class="btn btn-danger btn-lg px-5 text-white mx-3"
                                    style="border-radius: 20px;">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <?php
                    }
                    ?>
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