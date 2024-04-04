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
    <title>Dashoboard</title>
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

    <script src="../src/chart.js"></script>

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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">

                        <ul class="navbar-nav flex-column justify-content-start">
                            <img src="../src/img/swLogo.png" width="100%">
                            <li class="nav-item my-1 current-page">
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

                            <li class="nav-item my-1">
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
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Main Dashboard</h2>
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
                        <div class="d-lg-flex d-block justify-content-between container mx-auto">
                            <a href="./customer.php"
                                class="d-flex align-items-center justify-content-start bg-white px-3 py-2 gap-2 mt-3"
                                style="border-radius: 30px; min-width: calc(100%/5);">
                                <span style="height: 50px; width: 50px; background-color: #DCF2F1; border-radius: 50%;"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <div>
                                    <span style="margin-top: 20px; display: block;">Customer</span>
                                    <h3 class="fw-bold">
                                        <?php
                                        $customer_counts = count(getRows("role='user'", 'accounts'));
                                        echo $customer_counts;
                                    ?>
                                    </h3>
                                </div>

                            </a>


                            <a href="./payment_confirmation.php"
                                class="d-flex align-items-center justify-content-start bg-white px-3 py-2 gap-2 mt-3"
                                style="border-radius: 30px; min-width: calc(100%/5);">
                                <span style="height: 50px; width: 50px; background-color: #DCF2F1; border-radius: 50%;"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </span>
                                <div style="margin-right: -30px;">
                                    <span style="margin-top: 20px; display: inline-block; white-space: nowrap;">Total
                                        Payments</span>
                                    <h3 class="fw-bold">
                                        <?php
                                        $data = getRows("status='Paid'", 'user_package');
                                        $total_payments = 0;
                                        foreach($data as $row) {
                                            $total_payments = $total_payments + ((int)$row['total']);
                                        }

                                        echo $total_payments;
                                        
                                    ?>
                                    </h3>
                                </div>

                            </a>



                            <a href="./customer.php"
                                class="d-flex align-items-center justify-content-start bg-white px-3 py-2 gap-2 mt-3"
                                style="border-radius: 30px; min-width: calc(100%/5);">
                                <span style="height: 50px; width: 50px; background-color: #DCF2F1; border-radius: 50%;"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <div>
                                    <span style="margin-top: 20px; display: block;">Active</span>
                                    <h3 class="fw-bold">
                                        <?php
                                        $customer_counts = count(getRows("role='user' AND status='Active'", 'accounts'));
                                        echo $customer_counts;
                                    ?>
                                    </h3>
                                </div>

                            </a>




                            <a href="./bill.php"
                                class="d-flex align-items-center justify-content-start bg-white px-3 py-2 gap-2 mt-3"
                                style="border-radius: 30px; min-width: calc(100%/5);">
                                <span style="height: 50px; width: 50px; background-color: #DCF2F1; border-radius: 50%;"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </span>
                                <div>
                                    <span style="margin-top: 20px; display: block;">Unpaid Bills</span>
                                    <h3 class="fw-bold">
                                        <?php
                                        $data = getRows("status='Unpaid' AND process_status='Done'", 'user_package');
                                        $unpaid_bills = 0;
                                        foreach($data as $row) {
                                            $unpaid_bills = $unpaid_bills + ((int)$row['total']);
                                        }

                                        echo $unpaid_bills;
                                        
                                    ?>
                                    </h3>
                                </div>

                            </a>

                        </div>



                        <div class="row py-2 mt-2 gap-3 justify-content-center">
                            <div class="col col-lg-6 bg-white p-3 shadow" style="border-radius: 15px;">
                                <canvas id="myChart" height="230px"></canvas>
                            </div>
                            <div class="col col-lg-5 bg-white p-3 shadow" style="border-radius: 15px;">
                                <h4>Payment analysis</h4>
                                <canvas id="paymentPieChart"></canvas>
                            </div>
                        </div>


                        <div class="row py-2 justify-content-center gap-2">
                            <div class="col col-lg-8 shadow bg-white p-3" style="border-radius: 15px;">
                                <h4>Logs</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-white">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold">No</th>
                                                <th class="fw-bold">Name</th>
                                                <th class="fw-bold">Date</th>
                                                <th class="fw-bold">category</th>
                                                <th class="fw-bold">Remark</th>
                                                <th class="fw-bold">Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- contents -->
                                            <?php
                                        $data = array_reverse(getRows(null, "admin_log_activity"));
                                        // Pagination parameters
                                        $totalItems = count($data);
                                        $itemsPerPage = 5;
                                        $totalPages = ceil($totalItems / $itemsPerPage);
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $current_page = max(1, min($totalPages, intval($current_page)));
                                        $offset = ($current_page - 1) * $itemsPerPage;

                                        $dataToDisplay = array_slice($data, $offset, $itemsPerPage);
                                        
                                        $count = 1;
                                        foreach($dataToDisplay as $row) {
                                            $user = getRows("account_no='{$row['account_no']}'", "accounts")[0];
                                            $name = $user['firstname'] . ' ' . $user['lastname'];
                                            echo '<tr>
                                                <td>'. $count .'</td>
                                                <td>'. $name .'</td>
                                                <td>'. $row['date'] .'</td>
                                                <td>'. $row['category'] .'</td>
                                                <td>'. $row['remark'] .'</td>
                                                <td>'. $row['level'] .'</td>
                                            </tr>';

                                            $count++;
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
                            <div class="col col-lg-3 shadow bg-white p-3" style="border-radius: 15px;">
                            <div class="my-3 p-3 bg-white shadow" style="border-radius: 15px;">
                                <div>
                                    <!-- icon -->
                                </div>
                                <div>
                                    <small>Pending ticket</small><br>
                                    <h3>
                                        <?php
                                        $pending_ticket =getRows("status='Pending'", "customer_ticket");
                                        echo count($pending_ticket);
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="my-3 p-3 bg-white shadow" style="border-radius: 15px;">
                                <div>
                                    <!-- icon -->
                                </div>
                                <div>
                                    <small>Pending Payment</small><br>
                                    <h3>
                                    <?php
                                        $pending_payment =getRows("status='Pending'", "payment_confirmation");
                                        echo count($pending_payment);
                                    ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="my-3 p-3 bg-white shadow" style="border-radius: 15px;">
                                <div>
                                    <!-- icon -->
                                </div>
                                <div>
                                    <small>Closed Ticket</small><br>
                                    <h3>
                                    <?php
                                        $closed_ticket =getRows("status='Closed'", "customer_ticket");
                                        echo count($closed_ticket);
                                    ?>
                                    </h3>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT SUM(total) AS total FROM user_package WHERE status='Paid'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $total = (int)$row[0]['total'];


                        $data = getRows("status='Paid'", "user_package");
                        $months = ['Jan' => '1', 'Feb' => '2', 'Mar' => '3', 'Apr' => '4', 'May' => '5', 'Jun' => '6', 'Jul' => '7', 'Aug' => '8', 'Sep' => '9', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12'];
                        foreach($months as $month => $equivalent_number) {
                            
                        }
                        ?>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx = document.getElementById('myChart');

                            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            const DATA_COUNT = months.length;
                            const NUMBER_CFG = {
                                count: DATA_COUNT,
                                min: 0,
                                max: parseInt(<?= $highest_bill ?>)
                            };

                            // Generate random labels for months
                            const labels = Array.from({
                                length: DATA_COUNT
                            }, (_, i) => months[i]);

                            // Generate random data for datasets
                            const data = {
                                labels: labels,
                                datasets: [{
                                        label: 'Dataset 1',
                                        data: Array.from({
                                            length: DATA_COUNT
                                        }, () => Math.floor(Math.random() * (NUMBER_CFG.max -
                                            NUMBER_CFG.min + 1)) + NUMBER_CFG.min),
                                        borderColor: 'red',
                                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                        tension: 0.4,
                                    }
                                ]
                            };

                            const config = {
                                type: 'line',
                                data: data,
                                options: {
                                    animations: {
                                        radius: {
                                            duration: 400,
                                            easing: 'linear',
                                            loop: (context) => context.active
                                        }
                                    },
                                    hoverRadius: 12,
                                    hoverBackgroundColor: 'yellow',
                                    interaction: {
                                        mode: 'nearest',
                                        intersect: false,
                                        axis: 'x'
                                    },
                                    plugins: {
                                        tooltip: {
                                            enabled: false
                                        }
                                    }
                                }
                            };

                            new Chart(ctx, config);
                        });

                        <?php
                        $unpaid = getRows("status='Unpaid' AND process_status='Done'", "user_package");
                        $paid = getRows("status='Paid' AND process_status='Done'", "user_package");

                        $all_total_sum = 0;
                        $paid_total_sum = 0;
                        $unpaid_total_sum = 0;

                        // Calculate total sums
                        foreach($unpaid as $row) {
                            $all_total_sum += (int)$row['total'];
                            $unpaid_total_sum += (int)$row['total'];
                        }
                        foreach($paid as $row) {
                            $all_total_sum += (int)$row['total'];
                            $paid_total_sum += (int)$row['total'];
                        }

                        // Calculate percentages
                        $paid_percentage = ($paid_total_sum / $all_total_sum) * 100;
                        $unpaid_percentage = ($unpaid_total_sum / $all_total_sum) * 100;
                    ?>
                        const paymentData = {
                            labels: ['Payments Done', 'Payments Pending'],
                            datasets: [{
                                data: [<?= $paid_percentage ?>, <?= $unpaid_percentage ?>],
                                backgroundColor: [
                                    '#378CE7',
                                    '#DFF5FF'
                                ]
                            }]
                        };


                        const ctx = document.getElementById('paymentPieChart').getContext('2d');
                        const myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: paymentData,
                            options: {
                                responsive: true,
                                title: {
                                    display: true,
                                    text: 'Payment Status'
                                }
                            }
                        });
                        </script>

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