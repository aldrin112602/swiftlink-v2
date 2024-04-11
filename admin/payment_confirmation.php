<?php
require_once '../config.php';
require_once '../global.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'user') {
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
    <title>Payment Confirmation</title>
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

            #tablePreview th:last-child,
            #tablePreview td:last-child {
                display: none;
            }

            #tablePreview ._header {
                display: block !important;
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

        img {
            object-fit: cover !important;
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
                    <a class="d-xl-none d-lg-none" href="#">Payment confirmation</a>
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
                            <li class="nav-item my-1">
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
                            <li class="nav-item my-1 current-page">
                                <a href="payment_confirmation.php" class=" d-flex align-items-center justify-content-start ml-4 fs-6">
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
                                <a href="help.php" class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">help</span>
                                    Help
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
                                            <li class="breadcrumb-item active" aria-current="page">Payment confirmation
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Payment confirmation</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>

                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="container-fluid <?= isset($_GET['payment_confirmation']) ? 'd-none' : '' ?>">
                        <h5 class="text-success">Swiftlink</h5>
                        <div class="d-block d-md-flex justify-content-between align-items-center gap-3">
                            <button id="printBtn" class="btn mt-3" style="border: 1px solid lime; border-radius: 10px;background: white;"><i class="fa-solid fa-print"></i> Print</button>
                            <script>
                                $(() => {
                                    $('#printBtn').click(() => {
                                        window.print();
                                    })
                                })
                            </script>
                            <span>
                                <div class="mb-3">
                                    <label for="month" class="form-label">Month</label>
                                    <select class="form-select" name="month" id="month">
                                        <option disabled selected class="d-none">
                                            -- Select month --
                                        </option>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            var months = ['January', 'February', 'March', 'April', 'May', 'June',
                                                'July',
                                                'August', 'September', 'October', 'November', 'December', 'All'
                                            ];

                                            var currentMonth = '<?php echo $_GET['month'] ?? ''; ?>';
                                            months.forEach(function(month) {
                                                var selected = (currentMonth === month) ? 'selected' :
                                                    '';
                                                $('#month').append(
                                                    `<option value="${month}" ${selected}>${month}</option>`
                                                );
                                            });
                                        });
                                    </script>


                                </div>
                            </span>
                            <span>
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <select class="form-select" name="year" id="year">
                                        <option disabled selected class="d-none">
                                            -- Select year --
                                        </option>
                                        <option value="All" <?= ($_GET['year'] ?? null) == 'All' ? 'selected' : null ?>>
                                            All</option>
                                    </select>
                                    <script>
                                        // Generate years from current year till 2000
                                        let currentYear = new Date().getFullYear();
                                        let untillYear = 2023;


                                        var getCurrentYearParam = '<?php echo $_GET['year'] ?? 0; ?>';

                                        while (currentYear >= untillYear) {
                                            // add year option
                                            var selected = (currentYear == getCurrentYearParam) ? 'selected' :
                                                '';
                                            $('#year').append(
                                                `<option value="${currentYear}" ${selected}>${currentYear}</option>`);
                                            currentYear--;
                                        }
                                    </script>

                                </div>
                            </span>
                            <span>
                                <div class="mb-3">
                                    <?php
                                    $status = $_GET['status'] ?? null;
                                    ?>
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select bg-white" id="status">
                                        <option class="d-none" disabledb selected value="">-- Choose Status --</option>
                                        <!-- <option value="All" <?= $status == 'All' ? 'selected' : '' ?>>All</option> -->
                                        <option value="Approved" <?= $status == 'Approved' ? 'selected' : '' ?>>Verified
                                        </option>
                                        <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending
                                        </option>
                                        <option value="All" <?= $status == 'All' ? 'selected' : '' ?>>All
                                        </option>
                                    </select>

                                    <script>
                                        // function to handle changes to select element
                                        // filtering data
                                        function filterData(key, value) {
                                            let url = location.search;
                                            let params = new URLSearchParams(url);
                                            if (!params.has(key)) {
                                                params.append(key, value);
                                            } else {
                                                params.set(key, value);
                                            }
                                            location.href = '?' + params.toString();
                                        }

                                        // now use the function
                                        $(function() {
                                            $('#month').change(function() {
                                                filterData('month', $(this).val())
                                            })
                                            $('#year').change(function() {
                                                filterData('year', $(this).val())
                                            })
                                            $('#status').change(function() {
                                                filterData('status', $(this).val())
                                            })
                                        });
                                    </script>

                                </div>
                            </span>
                        </div>
                        <div class="bg-white shadow p-5 table-responsive" style="border-radius: 25px;">
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
                            <div style="min-height: 200px; min-width: 100vw;" id="tablePreview">
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
                                    <h2 class="fs-5"><I>Payments details</I></h2>
                                </div>
                                <table class="table table-striped table-hover table-white">
                                    <thead>
                                        <tr>
                                            
                                            <th scope="col">Invoice No.</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Account No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Date Payment</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT pc.invoice, pc.payment_method, pc.date_payment, pc.image_path, pc.status, pc.id, ac.account_no, ac.firstname, ac.lastname, uc.period, uc.invoice, uc.account_no
                                    FROM payment_confirmation AS pc
                                    JOIN user_package AS uc ON pc.invoice = uc.invoice
                                    JOIN accounts AS ac ON ac.account_no = uc.account_no";

                                        $result = $conn->query($sql);
                                        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                        // Pagination parameters

                                        $totalItems = count($data);
                                        $itemsPerPage = $_GET['entries'] ?? 10;
                                        $totalPages = ceil($totalItems / $itemsPerPage);
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $current_page = max(1, min($totalPages, intval($current_page)));
                                        $offset = ($current_page - 1) * $itemsPerPage;

                                        $dataToDisplay = array_slice($data, $offset, $itemsPerPage);

                                        // filter by month only
                                        function filterByMonth($month, $data): array
                                        {
                                            if ($month == 'All' || !isset($month)) {
                                                return $data;
                                            }
                                            $months = [
                                                'January' => '01',
                                                'February' => '02',
                                                'March' => '03',
                                                'April' => '04',
                                                'May' => '05',
                                                'June' => '06',
                                                'July' => '07',
                                                'August' => '08',
                                                'September' => '09',
                                                'October' => '10',
                                                'November' => '11',
                                                'December' => '12'
                                            ];
                                            $filteredData = [];
                                            foreach ($data as $item) {
                                                $datePayment = $item['date_payment'];
                                                $paymentMonth = date('m', strtotime($datePayment));

                                                if (trim($paymentMonth) == $months[trim($month)]) {
                                                    $filteredData[] = $item;
                                                }
                                            }
                                            return $filteredData;
                                        }



                                        // filter by year only
                                        function filterByYear($year, $data): array
                                        {
                                            if ($year == 'All' || !isset($year)) {
                                                return $data;
                                            }
                                            $filteredData = [];
                                            foreach ($data as $item) {
                                                $datePayment = $item['date_payment'];
                                                $paymentYear = date('Y', strtotime($datePayment));
                                                if (trim($paymentYear) == trim($year)) {
                                                    $filteredData[] = $item;
                                                }
                                            }
                                            return $filteredData;
                                        }


                                        // filter by year only
                                        function filterByStatus($status, $data): array
                                        {
                                            if ($status == 'All' || !isset($status)) {
                                                return $data;
                                            }
                                            $filteredData = [];
                                            foreach ($data as $item) {
                                                if ($item['status'] == trim($status)) {
                                                    $filteredData[] = $item;
                                                }
                                            }
                                            return $filteredData;
                                        }


                                        function filterDate($month, $year, $status, $data): array
                                        {
                                            // Filter by month only
                                            if (isset($month) && !isset($year) && !isset($status)) {
                                                return filterByMonth($month, $data);
                                            }
                                            // Filter by year only
                                            elseif (!isset($month) && isset($year) && !isset($status)) {
                                                return filterByYear($year, $data);
                                            }

                                            // Filter by status only
                                            elseif (!isset($month) && !isset($year) && isset($status)) {
                                                return filterByStatus($status, $data);
                                            }

                                            // Filter by month and year only
                                            elseif (isset($month) && isset($year) && !isset($status)) {
                                                return filterByYear($year, filterByMonth($month, $data));
                                            }

                                            // Filter by month and status only
                                            elseif (isset($month) && !isset($year) && isset($status)) {
                                                return filterByStatus($status, filterByMonth($month, $data));
                                            } elseif (isset($month) && isset($year) && isset($status)) {
                                                return filterByStatus($status, filterByYear($year, filterByMonth($month, $data)));
                                            } else {
                                                return $data;
                                            }
                                        }

                                        // Extract the month parameter from the URL query string
                                        $month = isset($_GET['month']) ? $_GET['month'] : null;
                                        $year = isset($_GET['year']) ? $_GET['year'] : null;
                                        $status = isset($_GET['status']) ? $_GET['status'] : null;


                                        $dataToDisplay = filterDate($month, $year, $status, $dataToDisplay);

                                        // var_dump($dataToDisplay);


                                        $count = 1;
                                        foreach ($dataToDisplay as $row) {
                                        ?>
                                            <tr class="py-0">
                                                
                                                <td><?= $row['invoice'] ?? null ?></td>
                                                <td><?= $row['period'] ?? null ?></td>
                                                <td><?= $row['account_no'] ?? null ?></td>
                                                <td><?= $row['firstname'] ?? null ?> <?= $row['lastname'] ?? null ?></td>
                                                <td><?= $row['payment_method'] ?? null ?></td>
                                                <td><?= $row['date_payment'] ?? null ?></td>
                                                <td>
                                                    <a href="../user/<?= $row['image_path'] ?? null ?>">
                                                        <img width="50px" height="40px" src="../user/<?= $row['image_path'] ?? null ?>" alt="">
                                                    </a>
                                                </td>
                                                <td><?= $row['status'] ?? null ?></td>
                                                <td>
                                                    <a href="?payment_confirmation=<?= $row['invoice'] ?? null ?>" class="fas fa-eye fs-6 text-dark btn btn-sm"></a>
                                                    <!-- 
                                                function `deleteConfirmation` is at the bottom, 
                                                please see t*nga ka pa naman 
                                            -->
                                                    <button class="fa-solid fa-trash-can fs-6 text-danger btn btn-sm" onclick="deleteConfirmation(<?= $row['id'] ?>, 'payment_confirmation')"></button>
                                                </td>
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <!-- Bootstrap Pagination -->
                        <br>
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

                    <div class="ecommerse-widget <?= isset($_GET['payment_confirmation']) ? '' : 'd-none' ?>">
                        <?php
                        if (isset($_GET['payment_confirmation'])) {
                            $invoice = mysqli_real_escape_string($conn, trim($_GET['payment_confirmation']));


                            $sql = "SELECT pc.invoice, pc.payment_method, pc.date_payment, pc.image_path, pc.status, ac.account_no, ac.firstname, ac.lastname, uc.period, uc.invoice, uc.account_no, uc.total
                                FROM payment_confirmation AS pc
                                JOIN user_package AS uc ON pc.invoice = uc.invoice
                                JOIN accounts AS ac ON ac.account_no = uc.account_no
                                WHERE uc.invoice = '$invoice'";

                            $result = $conn->query($sql);
                            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            // if data did not exist return to history.php
                            if (count($row) == 0) {
                                echo '<script>location.href="payment_confirmation.php";</script>';
                            } else {
                                $row = $row[0];
                            }
                        }
                        ?>
                        <div class=" bg-white d-block d-lg-flex align-items-center justify-content-start" style="border-radius: 50px;">
                            <div class="col">
                                <div class="p-5">
                                    <h3 class="fw-bold">Payment Confirmation</h3>
                                    <div class="alert alert-primary alert-dismissible fade show <?= $row['status'] == 'Approved' ? '' : "d-none" ?> pb-3" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        You have already approved this payment confirmation
                                    </div>


                                    <script>
                                        var alertList = document.querySelectorAll('.alert');
                                        alertList.forEach(function(alert) {
                                            new bootstrap.Alert(alert)
                                        })
                                    </script>


                                    <script>
                                        var alertList = document.querySelectorAll('.alert');
                                        alertList.forEach(function(alert) {
                                            new bootstrap.Alert(alert)
                                        })
                                    </script>

                                    <div class="mb-3">
                                        <label for="invoice_no" class="form-label">Invoice No</label>
                                        <input readonly value="<?= $row['invoice'] ?>" type="text" class="form-control" name="invoice_no" id="invoice_no">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input readonly value="<?= $_SESSION['name'] ?>" type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="account_no" class="form-label">Account No</label>
                                        <input readonly value="<?= $row['account_no'] ?>" type="number" class="form-control" name="account_no" id="account_no">
                                    </div>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input readonly value="<?= $row['total'] ?>" type="number" class="form-control" name="amount" id="amount">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="period" class="form-label">Period</label>
                                                <input readonly value="<?= $row['period'] ?>" type="text" class="form-control" name="period" id="period">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment method</label>
                                        <input readonly value="<?= $row['payment_method'] ?>" type="text" class="form-control" id="payment_method">
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_payment" class="form-label">Date Payment</label>
                                        <input readonly value="<?= $row['date_payment'] ?>" type="text" class="form-control" name="date_payment" id="date_payment">
                                    </div>
                                    <div class="mb-3 <?= $row['status'] == 'Approved' ? 'd-none' : '' ?>">
                                        <button id="deny_btn" class="btn btn-danger px-5 btn-lg" style="border-radius: 15px;">Deny</button>

                                        <button id="verify_btn" type="submit" class="btn btn-primary mx-3 px-5 btn-lg" style="border-radius: 15px;">Verify</button>
                                        <script>
                                            $(document).ready(() => {
                                                const urlParams = new URLSearchParams(window.location.search);
                                                const paymentConfirmation = urlParams.get('payment_confirmation');

                                                $('#deny_btn').on('click', function() {
                                                    Swal.fire({
                                                        title: "Confirmation",
                                                        text: "Are you sure to deny this payment",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        cancelButtonColor: "#d33",
                                                        confirmButtonText: "Yes, continue"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $(this)
                                                                .attr('disabled', true)
                                                                .html(
                                                                    `<span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span role="status">&nbsp;&nbsp;Processing...</span>`
                                                                );

                                                            $.ajax({
                                                                type: "POST",
                                                                url: "deny_payment.php",
                                                                data: {
                                                                    invoice: paymentConfirmation
                                                                },
                                                                dataType: "json",
                                                                success: function(
                                                                    response) {
                                                                    if (response
                                                                        .status ===
                                                                        "success") {
                                                                        $('#deny_btn')
                                                                            .attr(
                                                                                'disabled',
                                                                                false)
                                                                            .html(
                                                                                `Deny`);
                                                                        Swal.fire({
                                                                            title: "Success",
                                                                            text: "Payment denied successfully!",
                                                                            icon: "success",
                                                                        });
                                                                    } else {
                                                                        $('#deny_btn')
                                                                            .attr(
                                                                                'disabled',
                                                                                false)
                                                                            .html(
                                                                                `Deny`);
                                                                        Swal.fire({
                                                                            title: "Error",
                                                                            text: "An error occurred while processing your request.",
                                                                            icon: "error",
                                                                        });
                                                                    }
                                                                },
                                                                error: function(xhr, status,
                                                                    error) {
                                                                    console.error(xhr
                                                                        .responseText
                                                                    );
                                                                }
                                                            });
                                                        }
                                                    });
                                                });

                                                $('#verify_btn').on('click', function() {
                                                    Swal.fire({
                                                        title: "Confirmation",
                                                        text: "Are you sure to approve this payment?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        cancelButtonColor: "#d33",
                                                        confirmButtonText: "Yes, continue"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "approved_payment.php",
                                                                data: {
                                                                    invoice: paymentConfirmation
                                                                },
                                                                dataType: "json",
                                                                success: function(
                                                                    response) {
                                                                    if (response
                                                                        .status ===
                                                                        "success") {
                                                                        Swal.fire({
                                                                            title: "Success",
                                                                            text: "Payment approved successfully!",
                                                                            icon: "success",
                                                                        }).then(
                                                                            () => {
                                                                                location
                                                                                    .reload();
                                                                            });
                                                                    } else {
                                                                        Swal.fire({
                                                                            title: "Error",
                                                                            text: "An error occurred while processing your request.",
                                                                            icon: "error",
                                                                        });
                                                                    }
                                                                },
                                                                error: function(xhr, status,
                                                                    error) {
                                                                    console.error(xhr
                                                                        .responseText
                                                                    );
                                                                }
                                                            });
                                                        }
                                                    });
                                                });
                                            });
                                        </script>


                                    </div>
                                </div>
                            </div>
                            <div class="col p-5 d-flex align-items-center justify-content-start">
                                <img id="preview" alt="" src="../user/<?= $row['image_path'] ?>" style="height: 600px; width: 80%; border-radius: 50px; border: 4px dashed rgba(0,0,0,0.3);">
                            </div>
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
    <script>
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