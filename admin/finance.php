<?php 
    require_once '../config.php';
    require_once '../global.php';

    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] == 'user') {
            header('location: ../user');
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
    <title>Finance</title>
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
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
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

    .form-control,
    .form-select {
        border: 1px solid darkblue;
        border-radius: 15px;
        height: 50px;
        background-color: transparent;
        padding-left: 30px;
    }

    .form-select {
        background-color: white;
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
                    <a class="d-xl-none d-lg-none" href="#">Finance</a>
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
                                    Home
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="package.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">deployed_code</span>
                                    Package
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="coverage.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Coverage
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="customer_package.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">
                                        deployed_code
                                    </span>
                                    Customer package
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="customer.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">person</span>
                                    Customer
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="bill.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                    Bill
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="payment_confirmation.php"
                                    class="d-flex align-items-center justify-content-start gap-1 ml-4 fs-6">
                                    <span class="material-symbols-outlined">credit_card</span>
                                    Payment confirmation
                                </a>
                            </li>

                            <li class="nav-item my-1 current-page">
                                <a href="finance.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">equalizer</span>
                                    Finance
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
                                <a href="help.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">help</span>
                                    Help
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="logs.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">info</span>
                                    Logs
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
                                            <li class="breadcrumb-item">Finance</li>
                                            <li class="breadcrumb-item active" aria-current="page">Income</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Finance</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>

                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="ecommerse-widget">
                        <h3 class="text-success">Swiftlink</h3>
                        <div class="bg-white p-4 d-block" style="border-radius: 25px;">
                            <div class="row justify-content-between container-fluid">
                                <div class="col">
                                    <div>
                                        <h5 class="fw-bold text-success">THIS MONTH<br>
                                            <?php
                                            $data = getRows("status='Paid'", "user_package");
                                            $sum = 0;
                                            foreach($data as $row) {
                                                $dateTime = new DateTime($row['updated_at']);
                                                
                                                $month = $dateTime->format('m');
                                                $currentMonth = date('m');

                                                if($month == $currentMonth) {
                                                    $sum += (int) $row['total'];
                                                }
                                            }
                                            echo '<span class="text-dark">PHP ' . $sum . '</span>';  
                                        ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h5 class="fw-bold">LAST MONTH<br>
                                            PHP
                                            <?php
                                        $currentDate = new DateTime();
                                        $lastMonth = $currentDate->modify('first day of last month')->format('m');
                                        $data = getRows("status='Paid'", "user_package");
                                        $sumLastMonth = 0;
                                        foreach($data as $row) {
                                            
                                            $dateTime = new DateTime($row['updated_at']);
                                            $month = $dateTime->format('m');
                                            if($month == $lastMonth) {
                                                $sumLastMonth += (int) $row['total'];
                                            }
                                        }
                                        echo $sumLastMonth;
                                        ?>
                                        </h5>
                                    </div>

                                </div>
                                <div class="col">
                                    <div>
                                        <h5 class="fw-bold">TODAY<br>
                                            PHP
                                            <?php
                                        $today = date('Y-m-d');
                                        $data = getRows("status='Paid'", "user_package");
                                        $sumToday = 0;
                                        foreach($data as $row) {
                                            // replace data with updated_at
                                            if($row['updated_at'] == $today) {
                                                $sumToday += (int) $row['total'];
                                            }
                                        }
                                        echo $sumToday;
                                        ?>
                                        </h5>
                                    </div>

                                </div>
                                <div class="col">
                                    <div>
                                        <h5 class="fw-bold">YESTERDAY<br>
                                            PHP
                                            <?php
                                        $yesterday = date('Y-m-d', strtotime('-1 day'));
                                        $data = getRows("status='Paid'", "user_package");
                                        $sumYesterday = 0;
                                        foreach($data as $row) {
                                            // replace data with updated_at
                                            if($row['updated_at'] == $yesterday) {
                                                $sumYesterday += (int) $row['total'];
                                            }
                                        }
                                        echo $sumYesterday;
                                        ?>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-between container-fluid mt-3">
                                <div class="col">
                                    <div>
                                        <br>
                                        <button class="btn btn-sm form-control mt-2">Print</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="" class="form-label">Created by</label>
                                        <select name="" id="created_by" class="form-select form-select-sm">
                                            <option value="" selected class="d-none" disabled>-- Select one --</option>
                                            <?php
                                            $accouts = getRows("status='Active' AND role='user'", "accounts");

                                            $account_no = $_GET['created_by'] ?? null;

                                            foreach ($accouts as $row) {
                                                echo '<option '. ($account_no == $row['account_no'] ? 'selected' : '') .' value="' . $row['account_no'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
                                            }

                                            ?>
                                        </select>



                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="" class="form-label">Payment Method</label>
                                        <select name="" id="payment_method" class="form-select form-select-sm">
                                            <option value="" selected class="d-none" disabled>-- Select one --</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'Gcash' ? 'selected' : null ?>
                                                value="Gcash">Gcash</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'Maya' ? 'selected' : null ?>
                                                value="Maya">Maya</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'Paypal' ? 'selected' : null ?>
                                                value="Paypal">Paypal</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'Cash' ? 'selected' : null ?>
                                                value="Cash">Cash</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'Others' ? 'selected' : null ?>
                                                value="Others">Others</option>
                                            <option
                                                <?= ($_GET['payment_method'] ?? null) == 'All' ? 'selected' : null ?>
                                                value="All">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="" class="form-label">From Date</label>
                                        <input value="<?= $_GET['from_date'] ?? null ?>" type="date" name=""
                                            id="from_date" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="" class="form-label">Till Date</label>
                                        <input value="<?= $_GET['till_date'] ?? null ?>" type="date" name=""
                                            id="till_date" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <script>
                            function setUrlParam(param, value) {
                                let url = new URLSearchParams(location.search)
                                if (url.has(param)) {
                                    url.set(param, value)
                                } else {
                                    url.append(param, value)
                                }

                                location.href = '?' + url.toString();
                            }
                            $(() => {
                                // from date
                                $('#from_date').change(function() {
                                    setUrlParam('from_date', $(this).val())
                                })
                                // till date
                                $('#till_date').change(function() {
                                    setUrlParam('till_date', $(this).val())
                                })

                                // till date
                                $('#payment_method').change(function() {
                                    setUrlParam('payment_method', $(this).val())
                                })

                                // created by
                                $('#created_by').change(function() {
                                    setUrlParam('created_by', $(this).val())
                                })
                            })
                            </script>
                            <div class="table-responsive mt-3" style="min-height: 100px;">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Account no.</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <!-- <th>Created by</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $data = getRows("status='Paid'", "user_package");


                                    // Pagination parameters
                                    $totalItems = count($data);
                                    $itemsPerPage = 5;
                                    $totalPages = ceil($totalItems / $itemsPerPage);
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $current_page = max(1, min($totalPages, intval($current_page)));
                                    $offset = ($current_page - 1) * $itemsPerPage;

                                    $user_package = array_slice($data, $offset, $itemsPerPage);
                                    function createdByFilter($account_no, $data): array {
                                        if(!isset($account_no)) return [];

                                        $filteredData = [];
                                        foreach ($data as $row) {
                                            if ($row['account_no'] == $account_no) {
                                                $filteredData[] = $row;
                                            }
                                        }

                                        return $filteredData;
                                    }
                                    function paymentMethodFilter($payment_method, $data): array {
                                        if(!isset($payment_method) || $payment_method == 'All') return $data;
                                        $filteredData = [];

                                        if($payment_method == 'Others') {
                                            foreach ($data as $row) {
                                                $pm = getRows("invoice='{$row['invoice']}'", "payment_confirmation")[0]['payment_method'] ?? null;
                                                if (!in_array($pm, ['Gcash', 'Maya', 'Paypal', 'Cash', 'All'])) {
                                                    $filteredData[] = $row;
                                                }
                                            }

                                            return $filteredData;
                                        }

                                        
                                        
                                        foreach ($data as $row) {
                                            $pm = getRows("invoice='{$row['invoice']}'", "payment_confirmation")[0]['payment_method'] ?? null;
                                            if ($pm == $payment_method) {
                                                $filteredData[] = $row;
                                            }
                                        }
                                        return $filteredData;
                                    }
                                    function filterDataByDateRange($data, $fromDate = null, $tillDate = null): array {
                                        $filteredData = [];

                                        foreach ($data as $row) {
                                            $rowDate = explode(" ", $row['date'])[0];
                                            if (
                                                (!$fromDate || $rowDate >= $fromDate) &&
                                                (!$tillDate || $rowDate <= $tillDate)
                                            ) {
                                                $filteredData[] = $row;
                                            }
                                        }

                                        return $filteredData;
                                    }


                                    $get = validate_post_data($_GET);

                                    $user_package = filterDataByDateRange(paymentMethodFilter($get['payment_method'] ?? null, createdByFilter($get['created_by'] ?? null, $user_package)), $get['from_date'] ?? null, $get['till_date'] ?? null);


                                    $i = 1;
                                    $user = getRows("account_no='{$user_package[0]['account_no']}'", "accounts")[0] ?? [];




                                    foreach($user_package as $row) {
                                        $payment_method = getRows("invoice='{$row['invoice']}'", "payment_confirmation")[0]['payment_method'] ?? null;

                                        $user_ = getRows("account_no='{$row['account_no']}'", "accounts")[0];
                                        
                                        echo "<tr>
                                            <td>$i</td>
                                            <td>{$row['account_no']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$user_['firstname']} {$user_['middle_initial']} {$user_['lastname']}</td>
                                            <td>$payment_method</td>
                                            <td>{$row['total']} PHP</td>
                                        </tr>";

                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Bootstrap Pagination -->
                            <br>
                            <nav aria-label="Page navigation">
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
                                        <a class="page-link" href="?page=<?= ($current_page + 1) ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
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


</body>

</html>