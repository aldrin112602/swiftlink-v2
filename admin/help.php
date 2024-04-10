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
    <title>Help</title>
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
                            <li class="nav-item my-1 current-page">
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
                                            <li class="breadcrumb-item active" aria-current="page">Help</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2"></h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>

                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="ecommerse-widget">

                        <div class="shadow p-5 bg-white" style="border-radius: 25px;">
                            <div class="mb-4 col-12 col-lg-3">
                                <label for="help" class="form-label">Help</label>
                                <select class="form-select" name="help" id="help">
                                    <option selected disabled class="d-none">-- Select option --</option>
                                    <option value="Ticket" <?= ($_GET['help'] ?? null) == 'Ticket' ? 'selected' : null ?>>Ticket</option>
                                    <option value="Category" <?= ($_GET['help'] ?? null) == 'Category' ? 'selected' : null ?>>Category
                                    </option>
                                </select>
                            </div>

                            <!-- ticket container -->
                            <div class="container-fluid <?= (isset($_GET['help']) && $_GET['help'] == 'Ticket') || !isset($_GET['help']) ? '' : 'd-none' ?>">
                                <div class="row py-1">
                                    <div class="col-12 col-lg-4 py-2 text-center border-right">
                                        <h4>Pending</h4>
                                        <h1><?= count(getRows("status='Pending'", "customer_ticket")) ?></h1>
                                    </div>
                                    <div class="col-12 col-lg-4 py-2 text-center border-right">
                                        <h4>Process</h4>
                                        <h1><?= count(getRows("status='Process'", "customer_ticket")) ?></h1>
                                    </div>
                                    <div class="col-12 col-lg-4 py-2 text-center">
                                        <h4>Closed</h4>
                                        <h1><?= count(getRows("status='Closed'", "customer_ticket")) ?></h1>
                                    </div>
                                </div>

                                <div class="d-block d-md-flex justify-content-end align-items-center gap-3 my-4">
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
                                                    var months = ['January', 'February', 'March', 'April', 'May',
                                                        'June',
                                                        'July',
                                                        'August', 'September', 'October', 'November',
                                                        'December', 'All'
                                                    ];

                                                    var currentMonth = '<?php echo $_GET['month'] ?? ''; ?>';
                                                    months.forEach(function(month) {
                                                        var selected = (currentMonth === month) ?
                                                            'selected' :
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
                                                <option value="All" <?= ($_GET['year'] ?? null) == 'All' ? 'selected' : null ?>>All</option>
                                            </select>
                                            <script>
                                                // Generate years from current year till 2000
                                                let currentYear = new Date().getFullYear();
                                                let untillYear = 2024;


                                                var getCurrentYearParam = '<?php echo $_GET['year'] ?? 0; ?>';

                                                while (currentYear >= untillYear) {
                                                    // add year option
                                                    var selected = (currentYear == getCurrentYearParam) ? 'selected' :
                                                        '';
                                                    $('#year').append(
                                                        `<option value="${currentYear}" ${selected}>${currentYear}</option>`
                                                    );
                                                    currentYear--;
                                                }

                                                // var selected = (currentYear === getCurrentYearParam) ? 'selected' :
                                                //         '';

                                                // $('#year').append(
                                                //         `<option value="All" ${selected}>All</option>`
                                                //     );
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
                                                <option class="d-none" disabledb selected value="">-- Choose Status --
                                                </option>
                                                <option value="All" <?= $status == 'All' ? 'selected' : '' ?>>All
                                                </option>
                                                <option value="Process" <?= $status == 'Process' ? 'selected' : '' ?>>
                                                    Process
                                                </option>
                                                <option value="Closed" <?= $status == 'Closed' ? 'selected' : '' ?>>
                                                    Closed
                                                </option>
                                                <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>
                                                    Pending
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
                                                    $('#help').change(function() {
                                                        filterData('help', $(this).val())
                                                    });

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

                                <!-- view file modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">View ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="my-2">
                                                        <label for="account_no">Name</label>
                                                        <input style="border-radius: 15px;" readonly class="form-control" name="name" id="name">
                                                    </div>
                                                    <div class="my-2">
                                                        <label for="account_no">Account no</label>
                                                        <input style="border-radius: 15px;" readonly class="form-control" name="account_no" id="account_no">
                                                    </div>
                                                    <div class="my-2">
                                                        <label for="report">Report</label>
                                                        <input style="border-radius: 15px;" readonly class="form-control" name="report" id="report">
                                                    </div>
                                                    <div class="my-2">
                                                        <label for="remark">Remark</label>
                                                        <textarea style="border-radius: 15px;" readonly class="form-control" name="remark" id="remark"></textarea>
                                                    </div>


                                                    <div class="my-2">
                                                        <label for="document">Document</label>
                                                        <img src="" alt="" srcset="" id="document" width="200px" class="mx-auto d-block" height="200px" style="object-fit: cover; border-radius: 15px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="markBtn" onclick="actionConfirmation('Mark as Process')" type="button" class="btn btn-primary" style="border-radius: 15px;">Mark as
                                                    Process</button>
                                                <button id="finishedBtn" onclick="actionConfirmation('Mark as Closed')" type="button" class="btn btn-dark" style="border-radius: 15px;">Mark
                                                    as
                                                    Closed</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    const actionConfirmation = (action) => {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: 'This action cannot be undone',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, proceed!'
                                        }).then((result) => {
                                            // Check user's choice
                                            if (result.isConfirmed) {
                                                let status;
                                                if (action == 'Mark as Process') {
                                                    $('#finishedBtn').attr('disabled', true)
                                                    $('#markBtn').attr('disabled', true).html(
                                                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &nbsp; Loading...`
                                                    );
                                                    status = 'Process';
                                                } else {
                                                    $('#markBtn').attr('disabled', true)
                                                    $('#finishedBtn').attr('disabled', true).html(
                                                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &nbsp; Loading...`
                                                    );
                                                    status = 'Closed';
                                                }


                                                fetch(
                                                        `./update_customer_ticket.php?account_no=${$('#viewFileModal #account_no').val()}&status=${status}&report=${$('#viewFileModal #report').val()}`
                                                    )
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        const {
                                                            status
                                                        } = data;
                                                        if (status === 'success') {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Success',
                                                                text: 'Ticket update was successful.',
                                                            }).then(() => {
                                                                location.reload();
                                                            });
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Error',
                                                                text: 'Ticket update failed. Please try again.',
                                                            });
                                                        }
                                                    })
                                                    .catch(err => {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: `An error occurred: ${err}`,
                                                        });
                                                    })
                                                    .finally(() => {
                                                        $('#finishedBtn').attr('disabled', false).html(
                                                            `Mark as Closed`);
                                                        $('#markBtn').attr('disabled', false).html(
                                                            `Mark as Process`);
                                                        $('#viewFileModal').modal('hide');
                                                    });



                                            }
                                        });
                                    }
                                </script>

                                <div class="table-responsive">
                                    <?php
                                    $data = getRows(null, "customer_ticket");
                                    // Pagination parameters
                                    $totalItems = count($data);
                                    $itemsPerPage = 5;
                                    $totalPages = ceil($totalItems / $itemsPerPage);
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $current_page = max(1, min($totalPages, intval($current_page)));
                                    $offset = ($current_page - 1) * $itemsPerPage;

                                    $dataToDisplay = array_slice($data, $offset, $itemsPerPage);


                                    // filter by month only
                                    function filterByMonth($month, $data): array
                                    {
                                        if ($month == "All") return $data;
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
                                            'December' => '12',
                                            'All' => 'All'
                                        ];
                                        $filteredData = [];
                                        foreach ($data as $item) {
                                            $date_time = new DateTime($item['date']);
                                            $formatted_date = $date_time->format('M d Y');
                                            $datePayment = $formatted_date;
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
                                        if ($year == "All") return $data;
                                        $filteredData = [];
                                        foreach ($data as $item) {
                                            $date_time = new DateTime($item['date']);
                                            $formatted_date = $date_time->format('M d Y');
                                            $datePayment = $formatted_date;
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
                                        if ($status == "All") return $data;
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
                                            return [];
                                        }
                                    }

                                    // Extract the month parameter from the URL query string
                                    $month = isset($_GET['month']) ? $_GET['month'] : null;
                                    $year = isset($_GET['year']) ? $_GET['year'] : null;
                                    $status = isset($_GET['status']) ? $_GET['status'] : null;



                                    $dataToDisplay = filterDate($month, $year, $status, $dataToDisplay);

                                    if (count($data) == 0) {
                                    ?>
                                        <div class="alert alert-info alert-dismissible fade show py-3" role="alert">
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <p>
                                                No data is available at the moment.
                                            </p>
                                        </div>


                                    <?php
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-white" style="min-width: 100vw;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Ticket No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Account No</th>
                                                    <th scope="col">Report</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($dataToDisplay as $row) {
                                                    $date_time = new DateTime($row['date']);
                                                    $formatted_date = $date_time->format('M d Y');
                                                    $getUser = getRows("role='user' AND account_no='{$row['account_no']}'", 'accounts')[0];

                                                ?>
                                                    <tr class="py-0">
                                                        <td><?= $count ?></td>
                                                        <td><?= $formatted_date ?? null ?></td>
                                                        <td><?= $row['ticket_no'] ?? null ?></td>
                                                        <td><?= $getUser['firstname'] . ' ' . $getUser['lastname'] ?></td>
                                                        <td><?= $row['account_no'] ?? null ?></td>
                                                        <td><?= $row['report'] ?? null ?></td>
                                                        <td><?= $row['status'] ?? null ?></td>
                                                        <td class="">
                                                            <a onclick="showViewFileModal('<?= $row['id'] ?? null ?>')" href="#" class="fas fa-folder"></a>
                                                            <i style="cursor: pointer;" class="fa-solid fa-trash-can text-danger mx-2" onclick="deleteConfirmation(<?= $row['id'] ?>, 'customer_ticket')"></i>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $count++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <script>
                                        function showViewFileModal(id) {
                                            fetch(`./get_data.php?id=${id}&tablename=customer_ticket`)
                                                .then(res => res.json())
                                                .then(data => {
                                                    const keys = ['account_no', 'document', 'remark', 'report',
                                                        'status', 'ticket_no'
                                                    ];

                                                    fetch(`./get_name.php?account_no=${data[0]['account_no']}`)
                                                        .then(res => res.json())
                                                        .then(({
                                                            name
                                                        }) => {
                                                            $(`#viewFileModal input[name="name"]`).val(name)
                                                        })
                                                        .catch(err => {
                                                            console.error(err)
                                                            alert(err)
                                                        });

                                                    keys.forEach(key => {
                                                        if (['status', 'document', 'remark'].includes(key)) {
                                                            switch (key) {
                                                                case 'remark':
                                                                    $(`#viewFileModal textarea[name="${key}"]`)
                                                                        .val(data[0][key])
                                                                    break
                                                                case 'document':
                                                                    $(`#viewFileModal img[id="document"]`).attr(
                                                                        'src', `../user/${data[0][key]}`)
                                                            }
                                                        } else {
                                                            $(`#viewFileModal input[name="${key}"]`).val(data[0]
                                                                [key])
                                                        }

                                                    });

                                                    $('#viewFileModal').modal('show')
                                                })
                                                .catch(err => {
                                                    alert(err)
                                                })
                                        }
                                    </script>

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
                            </div>
                            <!-- end ticket container -->

                            <!-- Category container -->
                            <div class="container-fluid <?= (isset($_GET['help']) && $_GET['help'] == 'Category') ? '' : 'd-none' ?>">
                                <!-- Add category Modal -->
                                <form action="" method="post" class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content" style="border-radius: 25px;">
                                            <div class="modal-header px-4 border-0">
                                                <h5 class="modal-title" id="addCategory">Add Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body border-0">
                                                <div class="container-fluid">
                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Type</label>
                                                        <input required type="text" class="form-control" name="type" id="type">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="remarks" class="form-label">Remarks</label>
                                                        <textarea name="remarks" id="remarks" class="form-control" required style="border: 1px solid darkblue;
                                                        border-radius: 15px; height: 80px;background-color: transparent;padding-left: 30px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="reset" class="btn px-4 btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px;">Close</button>
                                                <button type="submit" id="__submit_btn" class="btn px-4 btn-primary" style="border-radius: 25px;">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <!-- Update category Modal -->
                                <form action="" method="post" class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateCategory" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content" style="border-radius: 25px;">
                                            <div class="modal-header px-4 border-0">
                                                <h5 class="modal-title" id="updateCategory">Update Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body border-0">
                                                <div class="container-fluid" id="input_con"></div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="reset" class="btn px-4 btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px;">Close</button>
                                                <button type="submit" id="__submit_btn" class="btn px-4 btn-primary" style="border-radius: 25px;">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <!-- Add help remoarks Modal -->
                                <form action="" method="post" class="modal fade" id="addHelpRemarksModal" tabindex="-1" role="dialog" aria-labelledby="addHelpRemarks" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content" style="border-radius: 25px;">
                                            <div class="modal-header px-4 border-0">
                                                <h5 class="modal-title" id="addHelpRemarks">Add Help Remarks</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body border-0">
                                                <div class="container-fluid">
                                                    <div class="mb-3">
                                                        <label for="help" class="form-label">Help</label>
                                                        <input required type="text" class="form-control" name="help" id="help">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Type</label>
                                                        <select name="type" id="type" class="form-select" required>
                                                            <option disabled selected class="d-none">-- Select type --
                                                            </option>
                                                            <?php
                                                            $data = getRows(null, 'help_category');
                                                            foreach ($data as $row) {
                                                                echo '<option value="' . $row['type'] . '">' . $row['type'] . ' </option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="remarks" class="form-label">Remarks</label>
                                                        <textarea name="remarks" id="remarks" class="form-control" required style="border: 1px solid darkblue;
                                                        border-radius: 15px; height: 80px;background-color: transparent;padding-left: 30px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="reset" class="btn px-4 btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px;">Close</button>
                                                <button type="submit" id="__submit_btn" class="btn px-4 btn-primary" style="border-radius: 25px;">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Update help remarks Modal -->
                                <form action="" method="post" class="modal fade" id="updateRemarksModal" tabindex="-1" role="dialog" aria-labelledby="updateRemarks" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content" style="border-radius: 25px;">
                                            <div class="modal-header px-4 border-0">
                                                <h5 class="modal-title" id="updateRemarks">Update Help Remarks</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body border-0">
                                                <div class="container-fluid" id="input_con"></div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="reset" class="btn px-4 btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px;">Close</button>
                                                <button type="submit" id="__submit_btn" class="btn px-4 btn-primary" style="border-radius: 25px;">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- handling adding category function -->
                                <script>
                                    function handleFormSubmission(modalSelector, url, successMessage) {
                                        return function(ev) {
                                            ev.preventDefault();
                                            const dataParams = $(this).serialize();
                                            const $modal = $(modalSelector);

                                            $(`${modalSelector} #__submit_btn`)
                                                .attr('disabled', true)
                                                .html(
                                                    `<span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span role="status">&nbsp;&nbsp;Please wait...</span>`
                                                );

                                            let xhr = new XMLHttpRequest();
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === XMLHttpRequest.DONE && xhr
                                                    .status === 200) {

                                                    setTimeout(() => {
                                                        Swal.fire({
                                                            title: "Success",
                                                            text: successMessage,
                                                            icon: "success",
                                                        }).then(() => {
                                                            $modal.trigger('reset');
                                                            $modal.modal('hide');
                                                            $(`${modalSelector} #__submit_btn`)
                                                                .attr('disabled', true)
                                                                .html(['./add_category.php',
                                                                        './add_help_remarks.php'
                                                                    ].includes(url) ?
                                                                    'Add' : 'Save changes');
                                                            setTimeout(() => {
                                                                location
                                                                    .reload();
                                                            }, 200);
                                                        })
                                                    }, 500)
                                                }
                                            };
                                            xhr.open('POST', url, true);
                                            xhr.setRequestHeader('Content-Type',
                                                'application/x-www-form-urlencoded');
                                            xhr.send(dataParams);
                                        };
                                    }

                                    $('#addCategoryModal').submit(handleFormSubmission('#addCategoryModal',
                                        './add_category.php', 'Category added successfully'));
                                    $('#addHelpRemarksModal').submit(handleFormSubmission('#addHelpRemarksModal',
                                        './add_help_remarks.php', 'Help remarks added successfully'));

                                    $('#updateCategoryModal').submit(handleFormSubmission(
                                        '#updateCategoryModal', './update_category.php',
                                        'Category updated successfully'));
                                    $('#updateRemarksModal').submit(handleFormSubmission('#updateRemarksModal',
                                        './update_help_remarks.php', 'Help remarks updated successfully'));






                                    function updateCategory(id) {
                                        fetch(`./get_data.php?tablename=help_category&id=${id}`)
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.length > 0) {
                                                    const {
                                                        type,
                                                        remarks,
                                                        id
                                                    } = data[0];
                                                    const templateInputs = `
                                                    <input value="${id}" type="hidden" name="id">
                                                    <div class="mb-3">
                                                        <label  class="form-label">Type</label>
                                                        <input value="${type}" required type="text" class="form-control" name="type">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label  class="form-label">Remarks</label>
                                                        <textarea name="remarks" class="form-control" required style="border: 1px solid darkblue;border-radius: 15px; height: 80px;background-color: transparent;padding-left: 30px;">${remarks}</textarea>
                                                    </div>
                                                    `;
                                                    $('#updateCategoryModal #input_con').html(
                                                        templateInputs);
                                                    $('#updateCategoryModal').modal('show');

                                                }
                                            })
                                    }


                                    function updateRemarks(id) {
                                        fetch(`./get_data.php?tablename=help_remarks&id=${id}`)
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.length > 0) {
                                                    const {
                                                        type,
                                                        remarks,
                                                        help,
                                                        id
                                                    } = data[0];
                                                    const templateInputs = `
                                                    <input value="${id}" type="hidden" name="id">
                                                    <div class="mb-3">
                                                        <label  class="form-label">Help</label>
                                                        <input value="${help}" required type="text" class="form-control" name="help">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label  class="form-label">Type</label>
                                                        <input value="${type}" required type="text" class="form-control" name="type">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label  class="form-label">Remarks</label>
                                                        <textarea name="remarks" class="form-control" required style="border: 1px solid darkblue;border-radius: 15px; height: 80px;background-color: transparent;padding-left: 30px;">${remarks}</textarea>
                                                    </div>
                                                    `;
                                                    $('#updateRemarksModal #input_con').html(
                                                        templateInputs);
                                                    $('#updateRemarksModal').modal('show');

                                                }
                                            })
                                    }
                                </script>

                                <div class="d-flex align-items-center justify-content-between py-2">
                                    <h1 class="fs-5 fw-bold">Category</h1>
                                    <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-success px-5" style="border-radius: 25px;">Add</button>
                                </div>

                                <div style="min-height: 200px;">
                                    <table class="table table-striped table-hover table-white">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = getRows(null, "help_category");
                                            $i = 1;
                                            foreach ($data as $row) {
                                                echo '<tr>';
                                                echo '<td>' . $i . '</td>';
                                                echo '<td>' . $row['type'] . '</td>';
                                                echo '<td>' . $row['remarks'] . '</td>';
                                                echo '<td>
                                                            <button onclick="updateCategory(' . $row['id'] . ')" class="fa-solid fa-pen-to-square btn btn-sm text-success"></button>
                                                            <button onclick="deleteConfirmation(' . $row['id'] . ', \'help_category\')" class="fa-regular fa-trash-can btn btn-sm text-danger"></button>
                                                </td>';
                                                echo '</tr>';
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <br>
                                <br>

                                <!-- help remarks -->
                                <div class="d-flex align-items-center justify-content-between py-2">
                                    <h1 class="fs-5 fw-bold">Help remarks</h1>
                                    <button class="btn btn-success px-5" style="border-radius: 25px;" data-bs-toggle="modal" data-bs-target="#addHelpRemarksModal">Add</button>
                                </div>
                                <div style="min-height: 200px;">
                                    <table class="table table-striped table-hover table-white">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Help</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = getRows(null, "help_remarks");
                                            $i = 1;
                                            foreach ($data as $row) {
                                                echo '<tr>';
                                                echo '<td>' . $i . '</td>';
                                                echo '<td>' . $row['help'] . '</td>';
                                                echo '<td>' . $row['type'] . '</td>';
                                                echo '<td><small onclick="alert(`' . $row['remarks'] . '`)" class="text-success" style="cursor: pointer;">Show Solution</small></td>';
                                                echo '<td>
                                                            <button onclick="updateRemarks(' . $row['id'] . ')" class="fa-solid fa-pen-to-square btn btn-sm text-success"></button>
                                                            <button onclick="deleteConfirmation(' . $row['id'] . ', \'help_remarks\')" class="fa-regular fa-trash-can btn btn-sm text-danger"></button>
                                                </td>';
                                                echo '</tr>';
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end help remarks table -->
                            </div>
                            <!-- end Category container -->
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