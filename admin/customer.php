<?php
require_once '../config.php';
require_once '../global.php';

if (isset($_SESSION['role'])) {
    switch($_SESSION['role']) {
        case 'admin':
            // header('location: ../admin/');
        break;
        case 'user':
            header('location: ../user/');
        break;
        case 'lineman':
            header('location: ../lineman/');
        break;
    }
} else {
    header('location: ../index.php');
}

$success_msg = $err_msg = null;

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
    <title>Customer</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>




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

        .input,
        .form-control,
        .form-select {
            border: 1px solid darkblue;
            border-radius: 15px;
            height: 50px;
            background-color: transparent;
            padding-left: 30px;
        }

        .ellipsis-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        a {
            text-decoration: none;
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

        @media print {
            #tablePreview {
                position: fixed;
                top: 0;
                left: 0;
                background: white;
                z-index: 100;
                width: 100vw;
                height: 100vh;
            }

            #tablePreview ._header {
                display: block !important;
            }

            #tablePreview h2 {
                display: block !important;
            }

            #tablePreview table tr td:first-child,
            #tablePreview table tr th:first-child,
            #tablePreview table tr td:last-child,
            #tablePreview table tr th:last-child {
                display: none !important;
            }

            #tablePreview table tr input[type="checkbox"]:not(:checked)+.ellipsis-text {
                display: none !important;
            }

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
                                    Home
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="package.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">deployed_code</span>
                                    Package
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="coverage.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Coverage
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="customer_package.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">
                                        deployed_code
                                    </span>
                                    Customer package
                                </a>
                            </li>
                            <li class="nav-item my-1 current-page">
                                <a href="customer.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">person</span>
                                    Customer
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="bill.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                    Bill
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="payment_confirmation.php" class="d-flex align-items-center justify-content-start gap-1 ml-4 fs-6">
                                    <span class="material-symbols-outlined">credit_card</span>
                                    Payment confirmation
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="finance.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">equalizer</span>
                                    Finance
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="profile.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">account_box</span>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item my-1">
                            <a href="ticket.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">confirmation_number</span>
                                    Ticket
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="logs.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">info</span>
                                    Logs
                                </a>
                            </li>




                            <li class="mt-2 d-grid">
                                <?php require_once './logout_confirmation.php'; ?>
                                <button onclick="logoutConfirmation()" class="btn btn-block text-white" style="border-radius: 50px; background: linear-gradient(45deg, dodgerblue, darkblue); background-repeat: no-repeat;">
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
                                            <li class="breadcrumb-item active" aria-current="page">Customer</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Customer</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="container-fluid">
                        <h5 class="text-success">Swiftlink</h5>
                        <?php
                        if (isset($_GET['view_user']) && !isset($_GET['update_package'])) {
                            $account_no = base64_decode(mysqli_real_escape_string($conn, trim($_GET['view_user'])));

                            $userRow = getRows("account_no='$account_no'", "accounts")[0];

                        ?>
                            <div class="bg-white p-2 p-md-3 py-2" style="border-radius: 40px;">
                                <!-- view user data -->
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="col-4 col-lg-1">
                                        <img id="profile_pic" title="Update profile picture?" style="cursor: pointer; object-fit: cover;" class="img-fluid rounded-circle hover" src="<?= isset($userRow['profile']) ? '../user/' . $userRow['profile'] : 'https://i.pinimg.com/736x/0d/64/98/0d64989794b1a4c9d89bff571d3d5842.jpg' ?>" height="90px" width="90px" alt="Profile picture of <?= $userRow['firstname'] ?? '' ?> <?= $userRow['middle_initial'] ?? '' ?> <?= $userRow['lastname'] ?? '' ?>">
                                        <input id="file_upload" type="file" accept="image/*" class="d-none">
                                        <script>
                                            $(() => {

                                                $('#profile_pic').on('click', () => {
                                                    $('#file_upload').click();
                                                })

                                                $('#file_upload').change(function(ev) {
                                                    let reader = new FileReader()
                                                    let file = $(this).prop('files')[0]

                                                    reader.onload = (e) => {
                                                        $('#profile_pic').attr('src', e.target.result)
                                                    }
                                                    reader.readAsDataURL(file);

                                                    const formdata = new FormData();
                                                    formdata.append('profileImage', file);
                                                    formdata.append('account_no',
                                                        '<?= $userRow['account_no'] ?>');


                                                    $('#loader-container').css('display', 'flex');
                                                    fetch('./update_user_profile.php', {
                                                            method: 'POST',
                                                            body: formdata
                                                        }).then(res => res.json())
                                                        .then(data => {
                                                            const {
                                                                status,
                                                                message
                                                            } = data;
                                                            setTimeout(() => {
                                                                $('#loader-container').css(
                                                                    'display', 'none');



                                                                if (status == 'success') {
                                                                    Swal.fire({
                                                                        icon: 'success',
                                                                        title: 'Success',
                                                                        text: message
                                                                    });
                                                                } else {
                                                                    Swal.fire({
                                                                        icon: 'error',
                                                                        title: 'Error',
                                                                        text: message
                                                                    })
                                                                }


                                                            }, 2000);


                                                        })
                                                        .catch(err => {
                                                            console.log(err)
                                                        });

                                                })
                                            })
                                        </script>
                                    </div>
                                    <div class="col p-3">
                                        <small class="fw-bold fs-6">
                                            <?= $userRow['firstname'] ?? '' ?>
                                            <?= $userRow['middle_initial'] ?? '' ?>
                                            <?= $userRow['lastname'] ?? '' ?>
                                        </small><br>
                                        <small><i class="fa-solid fa-location-dot mx-2"></i><?= $userRow['address'] ?>,
                                            <?= $userRow['town'] ?>, <?= $userRow['city'] ?>,
                                            <?= $userRow['province'] ?></small><br>
                                        <small><a href="tel:<?= $userRow['phone'] ?>"><i class="fa-solid fa-phone mx-2"></i>
                                                <?= $userRow['phone'] ?></a></small><br>
                                        <small><a href="mailto:<?= $userRow['email'] ?>"><i class="fa-solid fa-envelope mx-2"></i>
                                                <?= $userRow['email'] ?></a></small>
                                    </div>
                                </div>



                                <div class="table-responsive">

                                    <table class="table table-white table-striped table-hover" style="min-width: 60vw;">
                                        <thead>
                                            <tr>
                                                <th class="ellipsis-text" scope="col">Account no.</th>
                                                <th class="ellipsis-text" scope="col">Status</th>
                                                <th class="ellipsis-text" scope="col">Bill / Month</th>
                                                <th class="ellipsis-text" scope="col">Coverage</th>
                                                <th class="ellipsis-text" scope="col">Package</th>
                                                <th class="ellipsis-text" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $data = getRows("account_no = '$account_no' AND process_status = 'Done' AND variant='false'", "user_package");


                                            // Pagination parameters
                                            $totalItems = count($data);
                                            $itemsPerPage = 5;
                                            $totalPages = ceil($totalItems / $itemsPerPage);
                                            $current_page = isset($_GET['page2']) ? $_GET['page2'] : 1;
                                            $current_page = max(1, min($totalPages, intval($current_page)));
                                            $offset = ($current_page - 1) * $itemsPerPage;

                                            $dataToDisplay = array_slice($data, $offset, $itemsPerPage);

                                            $no = 1;

                                            foreach ($dataToDisplay as $row) {
                                            ?>
                                                <tr>
                                                    <td class="ellipsis-text"><?= $row['account_no'] ?? null ?></td>
                                                    <td class="ellipsis-text">
                                                        <?= $row['is_active'] == 'true' ? 'Active' : "Inactive" ?></td>
                                                    <td class="ellipsis-text"><?= $row['total'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['coverage'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['package'] ?></td>
                                                    <td class="ellipsis-text">
                                                        <a href="?update_package=<?= $row['id'] ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>

                                                        <button class="fa-regular fa-trash-can text-danger btn btn-sm" onclick="deleteConfirmation(<?= $row['id'] ?>, 'user_package')"></button>

                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <!-- Bootstrap Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Previous page link -->
                                        <li class="page-item <?= ($current_page == 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" onclick="setPage(<?= ($current_page - 1) ?>)" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <!-- Page links -->
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li class="page-item <?= ($i == $current_page ? 'active' : '') ?>">
                                                <a class="page-link" onclick="setPage(<?= $i ?>)"><?= $i ?></a>
                                            </li>
                                        <?php } ?>

                                        <!-- Next page link -->
                                        <li class="page-item <?= ($current_page == $totalPages ? 'disabled' : '') ?>">
                                            <a class="page-link" onclick="setPage(<?= ($current_page + 1) ?>)" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <script>
                                    function setPage(page) {
                                        let url = new URLSearchParams(location.href)
                                        if (url.has('page2')) {
                                            url.set('page2', page)
                                            location.href = url;
                                        } else {
                                            location.href = `?page2=${page}`;
                                        }
                                    }
                                </script>
                            </div>
                        <?php
                        }
                        ?>

                        <?php if (isset($_GET['update_package'])) { ?>
                            <?php
                            $id = validate_post_data($_GET)['update_package'];
                            if (count(getRows("id='$id'", "user_package")) == 0) {
                                echo '<script>location.href="customer.php";</script>';
                            }
                            $account_no = getRows("id='$id'", "user_package")[0]['account_no'];
                            $user_account = getRows("account_no='$account_no'", "accounts")[0];
                            $user_package = getRows("id='$id'", "user_package")[0];



                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $post = validate_post_data($_POST);
                                $total = $post['price'];
                                $coverage = $post['coverage'];
                                $package = $post['package'];


                                $sql = "UPDATE user_package SET total='$total', coverage='$coverage', package='$package'
                            WHERE id = '$id'";
                                if ($conn->query($sql)) {
                                    setLog('admin', [
                                        'account_no' => $_SESSION['account_no'],
                                        'category' => 'Activity',
                                        'remark' => 'Update package'
                                    ]);
                                    $success_msg = 'Package updated successfully!';
                                } else {
                                    $err_msg = 'Error: ' . $sql . '<br>' . $conn->error;
                                }
                            }
                            ?>

                            <form action="" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4>Update package</h4>
                                <div class="mb-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="<?= $user_account['firstname'] ?> <?= $user_account['middle_initial'] ?> <?= $user_account['lastname'] ?>" type="text" readonly class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Account no.</label>
                                    <input value="<?= $user_account['account_no'] ?>" type="number" readonly class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="" class="form-label">Coverage</label>
                                    <select required class="form-select form-select-sm" name="coverage">
                                        <option class="d-none" selected disabled value="">-- Select coverage --</option>
                                        <?php
                                        $data = getRows("status = 'Active'", "coverage");
                                        foreach ($data as $row) {
                                            echo '
                                <option ' . ($user_package['coverage'] == $row['name'] ? 'selected' : '') . ' value="' . $row['name'] . '">' . $row['name'] . '</option>
                            ';
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="mb-2">
                                    <label for="" class="form-label">Package</label>
                                    <select required class="form-select form-select-sm" id="package" name="package">
                                        <option class="d-none" selected disabled value="">-- Select package --</option>
                                        <?php
                                        $data = getRows("status = 'Active'", "package");
                                        foreach ($data as $row) {
                                            echo '
                                <option ' . ($user_package['package'] == $row['package'] ? 'selected' : '') . ' data-price="' . $row['price'] . '" value="' . $row['package'] . '">' . $row['package'] . '</option>
                            ';
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" value="<?= $user_package['total'] ?>" id="price" name="price">
                                </div>

                                <div class="mt-3">
                                    <a href="./customer.php" style="border-radius: 13px;" class="btn btn-dark">Cancel</a>
                                    <button style="border-radius: 13px;" class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        <?php } ?>
                        <?php
                        if (!isset($_GET['update_package']) && (!isset($_GET['add_customer']) || $_GET['add_customer'] != 'true') && !isset($_GET['update']) && !isset($_GET['view_user'])) {
                        ?>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <select id="action" class="form-select bg-white">
                                        <option class="d-none" disabledb selected value="">-- Choose action --</option>
                                        <option value="active">Set Active</option>
                                        <option value="inactive">Set Inactive</option>
                                        <!-- <option value="approved">Set Approved</option> -->
                                        <option value="print">Print</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center justify-content-end gap-3">
                                    <?php
                                    $status = $_GET['status'] ?? null;
                                    ?>
                                    <select class="form-select bg-white" id="chooseStatus">
                                        <option class="d-none" disabledb selected value="">-- Choose Status --</option>
                                        <option value="All" <?= $status == 'All' ? 'selected' : '' ?>>All</option>
                                        <option value="Active" <?= $status == 'Active' ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?= $status == 'Inactive' ? 'selected' : '' ?>>Inactive
                                        </option>
                                        <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending
                                        </option>
                                    </select>
                                    <a href="?add_customer=true" class="btn btn-primary btn-lg px-4 text-white d-flex align-items-center justify-content-center gap-2" style="border-radius: 20px;"><i class="fa-solid fa-plus"></i> Add</a>
                                </div>

                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (!isset($_GET['update_package']) && (!isset($_GET['add_customer']) || $_GET['add_customer'] != 'true') && !isset($_GET['update']) && !isset($_GET['view_user'])) {
                        ?>
                            <div class="table-responsive bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h4 class="text-primary fw-bold">Customer Details</h4>
                                    <div class="col col-lg-4 position-relative">
                                        <input type="search" style="padding-right: 2.5rem;" class="form-control" placeholder="Search" oninput="w3.filterHTML('#table', 'tr', this.value)">
                                        <i class="fas fa-search position-absolute" style="top: 50%;right: 20px; transform: translateY(-50%); pointer-events: none;"></i>
                                    </div>
                                </div>

                                <div id="loadingSpinner" style="display: none;">
                                    <div class="d-flex align-items-center justify-content-start gap-3">
                                        <div class="spinner-border text-primary mb-3" role="status"></div>
                                        <span class="text-muted fs-6">Please wait...</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start gap-2 py-1">
                                    <span>Show</span>
                                    <div>
                                        <select name="" id="entries" class="">
                                        </select>
                                        <script>
                                            $(() => {
                                                $('#entries').on('change', function() {
                                                    let entries = $(this).val();
                                                    let urlParams = new URLSearchParams(window.location.search);
                                                    if (urlParams.has('entries')) {
                                                        urlParams.set('entries', entries);
                                                    } else {
                                                        urlParams.append('entries', entries);
                                                    }

                                                    let newUrl = window.location.pathname + '?' + urlParams.toString();

                                                    window.location = newUrl;
                                                });

                                                for (let i = 10; i <= 4000; i *= 2) {
                                                    $('#entries').append(`<option ${i == <?= ($_GET['entries'] ?? 0) ?> ? 'selected' : ''} value="${i}">${i}</option>`)
                                                }
                                            })
                                        </script>
                                    </div><span>entries</span>
                                </div>

                                <div class="table-responsive" id="tablePreview">
                                    <div class="d-none _header">
                                        <h3 class="fw-bold">Swiftlink</h3>
                                        <div class="row">
                                            <div class="col">
                                                <b><i>Address: #184 Purok 3, Ithan, Binangonan, Rizal</i></b><br>
                                                <b>Phone: +639279972636</b><br>
                                                <b>Email: swiftlinkitsolutions@gmail.com</b>
                                            </div>
                                            <div class="col d-flex alig-items-center justify-content-end">
                                                <img src="../src/img/swLogo.png" alt="Logo" width="200px">
                                            </div>
                                        </div>

                                        <h2 class="fs-5"><I>Customer Details</I></h2>
                                    </div>
                                    <table class="table table-white table-striped table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <th class="ellipsis-text" scope="col">
                                                    <input type="checkbox" id="selectAll">
                                                </th>
                                                <th class="ellipsis-text" scope="col">Name</th>
                                                <th class="ellipsis-text" scope="col">Account no.</th>
                                                <th class="ellipsis-text" scope="col">Email</th>
                                                <th class="ellipsis-text" scope="col">Phone</th>
                                                <th class="ellipsis-text" scope="col">Status</th>
                                                <th class="ellipsis-text" scope="col">Address</th>
                                                <th class="ellipsis-text" scope="col">Valid ID</th>
                                                <th class="ellipsis-text" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Define variables


                                            function filterByStatus($status, $data)
                                            {

                                                if (!isset($status)) return $data;

                                                switch ($status) {
                                                    case 'All':
                                                        return $data;
                                                    case 'Active':
                                                    case 'Inactive':
                                                    case 'Pending':
                                                        return array_filter($data, function ($row) use ($status) {
                                                            return $row['status'] == $status;
                                                        });
                                                    default:
                                                        // Handle invalid status
                                                        return [];
                                                }
                                            }


                                            $data = filterByStatus($_GET['status'] ?? null, getRows("role='user'", "accounts"));


                                            // Pagination parameters
                                            $totalItems = count($data);
                                            $itemsPerPage = $_GET['entries'] ?? 5;
                                            $totalPages = ceil($totalItems / $itemsPerPage);
                                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $current_page = max(1, min($totalPages, intval($current_page)));
                                            $offset = ($current_page - 1) * $itemsPerPage;

                                            $dataToDisplay = array_slice($data, $offset, $itemsPerPage);

                                            $no = 1;

                                            foreach ($dataToDisplay as $row) {
                                            ?>
                                                <tr>
                                                    <td class="ellipsis-text">
                                                        <input data-email="<?= $row['email'] ?? null ?>" id="item" value="<?= $row['id'] ?? null ?>" type="checkbox">
                                                    </td>
                                                    <td class="ellipsis-text"><?= $row['firstname'] . ' ' . $row['lastname'] ?>
                                                    </td>
                                                    <td class="ellipsis-text"><?= $row['account_no'] ?? null ?></td>
                                                    <td class="ellipsis-text"><?= $row['email'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['phone'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['status'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['address'] ?>, <?= $row['town'] ?>,
                                                        <?= $row['city'] ?>, <?= $row['province'] ?></td>

                                                        <td class="ellipsis-text"><a href="../users/<?= $row['valid_id'] ?>">View ID</a></td>

                                                    <td class="ellipsis-text">
                                                        <a href="?update=<?= $row['id'] ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>

                                                        <button class="fa-regular fa-user text-success btn btn-sm" onclick="viewUser('<?= base64_encode($row['account_no']) ?>', 'accounts')"></button>

                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>

                                            <script>
                                                function viewUser(id, table) {

                                                    let url = location.search;
                                                    let params = new URLSearchParams(url);
                                                    params.delete('update_package');

                                                    if (!params.has("view_user")) {
                                                        params.append("view_user", id);
                                                    } else {
                                                        params.set("view_user", id);
                                                    }
                                                    location.href = '?' + params.toString();

                                                }
                                                $(document).ready(function() {
                                                    $('#selectAll').on('change', function() {
                                                        document.querySelectorAll('#item')
                                                            .forEach(item => {
                                                                item['checked'] = $(this).prop('checked');
                                                            })

                                                    })

                                                    $('#chooseStatus').on('change', function() {
                                                        
                                                        let status = $(this).val();
                                                        let urlParams = new URLSearchParams(window.location.search);
                                                        if (urlParams.has('status')) {
                                                            urlParams.set('status', status);
                                                        } else {
                                                            urlParams.append('status', status);
                                                        }
                                                
                                                        let newUrl = window.location.pathname + '?' + urlParams.toString();

                                                        window.location = newUrl;
                                                    
                                                        
                                                    })


                                                    $('#action').on('change', function() {
                                                        let selectedItem = [...document.querySelectorAll(
                                                                '#item')]
                                                            .filter(item => item['checked'] == true).map(item =>
                                                                parseInt(item.value));
                                                        let emailSelected = [...document.querySelectorAll(
                                                                '#item')]
                                                            .filter(item => item['checked'] == true).map(item =>
                                                                item.getAttribute('data-email'));

                                                        let status = $(this).val();


                                                        if (status == 'print') {
                                                            window.print()
                                                            return;
                                                        }

                                                        if (selectedItem.length > 0) {
                                                            $("#loadingSpinner").show();
                                                            $(this).prop('disabled', true);
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "update_status.php",
                                                                data: {
                                                                    id: selectedItem,
                                                                    table: 'accounts',
                                                                    status,
                                                                    emailSelected
                                                                },
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    $("#loadingSpinner").hide();
                                                                    $(this).prop('disabled', false);
                                                                    if (response.status ===
                                                                        "success") {
                                                                        Swal.fire({
                                                                            title: "Success!",
                                                                            text: response
                                                                                .message,
                                                                            icon: "success"
                                                                        }).then(() => {
                                                                            location
                                                                                .reload();
                                                                        });
                                                                    } else {
                                                                        Swal.fire({
                                                                            title: "Error",
                                                                            text: response
                                                                                .message,
                                                                            icon: "error"
                                                                        });
                                                                    }
                                                                },
                                                                error: function(xhr, status, error) {
                                                                    $("#loadingSpinner").hide();
                                                                    $(this).prop('disabled', false);
                                                                    console.error(xhr.responseText);
                                                                }
                                                            });

                                                            return;
                                                        }

                                                        Swal.fire({
                                                            title: "Oops!",
                                                            text: "Select an item from the table first",
                                                            icon: "error"
                                                        }).then(() => {
                                                            location.reload()
                                                        });

                                                    })
                                                })
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <!-- Bootstrap Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Previous page link -->
                                        <li class="page-item <?= ($current_page == 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?page=<?= ($current_page - 1) ?>" aria-label="Previous">
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
                                            <a class="page-link" href="?page=<?= ($current_page + 1) ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                            </div>
                        <?php
                        } elseif (isset($_GET['add_customer']) && $_GET['add_customer'] == 'true' && !isset($_GET['update'])) {
                            require_once './add_customer.php';
                        ?>
                            <form action="" enctype="multipart/form-data" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold">Add Customer</h4>
                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input autofocus placeholder="Email" value="<?php echo $_POST['email'] ?? null ?>" required type="email" class="form-control form-control-sm input" id="email" name="email">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Phone" value="<?php echo $phone ?? null ?>" required type="number" class="form-control form-control-sm input" id="phone" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Password" value="<?php echo $password ?? null ?>" required type="password" class="form-control form-control-sm input" id="password" name="password">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Confirm Password" value="<?php echo $confirm_password ?? null ?>" required type="password" class="form-control form-control-sm input" id="Confirm_password" name="confirm_password">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Firstname" value="<?php echo $firstname ?? null ?>" required type="text" class="form-control form-control-sm input" id="firstname" name="firstname">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Middle Initial" value="<?php echo $middle_initial ?? null ?>" required type="text" class="form-control form-control-sm input" id="middle_Initial" name="middle_initial">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Lastname" value="<?php echo $lastname ?? null ?>" required type="text" class="form-control form-control-sm input" id="lastname" name="lastname">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Address/House No./Street Name" value="<?php echo $address ?? null ?>" required type="text" class="form-control form-control-sm input" id="address" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Town" value="<?php echo $town ?? null ?>" required type="text" class="form-control form-control-sm input" id="town" name="town">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="City" value="<?php echo $city ?? null ?>" required type="text" class="form-control form-control-sm input" id="city" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Postal code" value="<?php echo $postal_code ?? null ?>" required type="text" class="form-control form-control-sm input" id="postal_code" name="postal_code">
                                        </div>

                                        <div class="col my-2">
                                            <input placeholder="Province" value="<?php echo $province ?? null ?>" required type="text" class="form-control form-control-sm input" id="province" name="province">
                                        </div>
                                    </div>
                                </div>


                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <!-- <h6 class="fw-bold">Coverage</h6> -->
                                            <select required class="form-select form-select-sm" name="coverage">
                                                <option class="d-none" selected disabled value="">-- Select coverage --
                                                </option>
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
                                        <div class="col my-2">
                                            <!-- <h6 class="fw-bold">Package</h6> -->
                                            <select required class="form-select form-select-sm" id="package" name="package">
                                                <option class="d-none" selected disabled value="">-- Select package --
                                                </option>
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
                                    </div>
                                </div>
                                <div class="container my-3">
                                    <h6 class="fw-bold">Valid ID</h6>
                                    <small style="font-size: 12px">LIST OF ACCEPTABLE GOVERNMENT-ISSUED IDENTIFICATION
                                        CARDS(IDS)/DOCUMENTS:</small>
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
                                            <span class="badge badge-light fw-normal text-dark border fs-6">-Driver's
                                                License</span>
                                        </div>
                                        <div class="d-inline-block mt-1">
                                            <span class="badge badge-light fw-normal text-dark border fs-6">-SSS</span>
                                        </div>
                                        <div class="d-inline-block mt-1">
                                            <span class="badge badge-light fw-normal text-dark border fs-6">-Pag-ibig</span>
                                        </div>
                                        <div class="d-inline-block mt-1">
                                            <span class="badge badge-light fw-normal text-dark border fs-6">-Other valid
                                                government-issued IDs</span>
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

                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 text-white" style="border-radius: 20px;">Save</button>
                                    <a href="./customer.php" class="btn btn-danger mx-3 btn-lg px-5 text-white" style="border-radius: 20px;">Cancel</a>
                                </div>
                            </form>
                        <?php
                        } elseif (!isset($_GET['add_customer']) && isset($_GET['update'])) {
                            $id = $_GET['update'];


                            // Fetch data only if the ID is valid
                            if ($id > 0) {
                                $data = getRows("id = $id", "accounts");
                                if (count($data) == 0) {
                                    // header("Location: customer.php");
                                }
                                $row = $data[0];
                            }


                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $post = validate_post_data($_POST);

                                $email = $post['email'];
                                $phone = $post['phone'];
                                $password = $post['password'];
                                $firstname = $post['firstname'];
                                $middle_initial = $post['middle_initial'];
                                $lastname = $post['lastname'];
                                $address = $post['address'];
                                $town = $post['town'];
                                $city = $post['city'];
                                $postal_code = $post['postal_code'];
                                $province = $post['province'];

                                $sql = "UPDATE accounts SET email='$email', phone='$phone', password='$password', firstname='$firstname', middle_initial='$middle_initial', lastname='$lastname', address='$address', town='$town', city='$city', postal_code='$postal_code', province='$province' WHERE id='$id'";
                                if ($conn->query($sql)) {
                                    $success_msg = "Details updated successfully";
                                } else {
                                    $err_msg = "Failed to update customer's details";
                                }
                            }
                        ?>
                            <form action="" enctype="multipart/form-data" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold">Edit Customer</h4>
                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input autofocus placeholder="Email" value="<?php echo $row['email'] ?? null ?>" required type="email" class="form-control form-control-sm input" id="email" name="email">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Phone" value="<?php echo $row['phone'] ?? null ?>" required type="number" class="form-control form-control-sm input" id="phone" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input readonly placeholder="Password" value="<?php echo $row['password'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="password" name="password">
                                        </div>

                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Firstname" value="<?php echo $row['firstname'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="firstname" name="firstname">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Middle Initial" value="<?php echo $row['middle_initial'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="middle_Initial" name="middle_initial">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Lastname" value="<?php echo $row['lastname'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="lastname" name="lastname">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="Address/House No./Street Name" value="<?php echo $row['address'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="address" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Town" value="<?php echo $row['town'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="town" name="town">
                                        </div>
                                        <div class="col my-2">
                                            <input placeholder="City" value="<?php echo $row['city'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="city" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col my-2">
                                            <input placeholder="Postal code" value="<?php echo $row['postal_code'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="postal_code" name="postal_code">
                                        </div>

                                        <div class="col my-2">
                                            <input placeholder="Province" value="<?php echo $row['province'] ?? null ?>" required type="text" class="form-control form-control-sm input" id="province" name="province">
                                        </div>
                                    </div>
                                </div>





                                <div class="col-12 mt-5 d-flex align-items-center justify-content-end gap-3">
                                    <a href="customer.php" class="btn btn-danger btn-lg px-5 text-white" style="border-radius: 20px;">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-lg px-5 text-white" style="border-radius: 20px;">Save</button>
                                </div>
                            </form>
                        <?php
                        }
                        ?>

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
            if (isset($err_msg)) {
            ?>
                Toast.fire({
                    icon: "error",
                    title: `<?php echo $err_msg ?>`
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
                }).then(() => {
                    location.href = 'customer.php';
                });
            <?php
            }
            ?>
        })


        function deleteConfirmation(id, table) {
            Swal.fire({
                title: "Delete",
                text: "Are you sure to delete it?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "delete_data.php",
                        data: {
                            id,
                            table
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "success") {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>