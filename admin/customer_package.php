<?php
require_once '../config.php';
require_once '../global.php';
require_once '../send_mail.php';
$err_msg = $success_msg = null;
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
    <title>Customer Package</title>
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

        .input,
        .form-control,
        .form-select {
            border: 1px solid darkblue;
            border-radius: 15px;
            height: 50px;
            background-color: transparent;
            padding-left: 30px;
        }


        .btn {
            border: 1px solid darkblue;
            border-radius: 15px;
            height: 40px;
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
                            <li class="nav-item my-1 current-page">
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
                                            <li class="breadcrumb-item active" aria-current="page">Customer package</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <!-- <h2 class="pageheader-title font-weight-bold py-2">Customer package</h2> -->
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="text-success">Swiftlink</h5>
                        </div>
                        <?php
                        if (!isset($_GET['add_package'])) {
                        ?>

                            <div class="row gap-2 mb-2 flex-wrap">

                                <div class="col">
                                    <select id="coverage" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose coverage --</option>
                                        <?php
                                        $coverage = getRows("status='Active'", "coverage");
                                        foreach ($coverage as $row) {
                                            $selected = ($_GET['coverage'] ?? null) == $row['name'] ? 'selected' : '';
                                            echo '
                                                <option value="' . $row['name'] . '" ' . $selected . '>' . $row['name'] . '</option>
                                            ';
                                        }
                                        ?>

                                        <option <?= ($_GET['coverage'] ?? null) == 'All' ? 'selected' : '' ?> value="All">All</option>
                                    </select>
                                </div>


                                <div class="col">
                                    <select id="package" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose package --</option>
                                        <?php
                                        $package = getRows("status='Active'", "package");
                                        foreach ($package as $row) {
                                            $selected = ($_GET['package'] ?? null) == $row['package'] ? 'selected' : '';
                                            echo '
                                                <option value="' . $row['package'] . '" ' . $selected . '>' . $row['package'] . '</option>
                                            ';
                                        }
                                        ?>

                                        <option <?= ($_GET['package'] ?? null) == 'All' ? 'selected' : '' ?> value="All">All</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <select class="form-select bg-white mt-1" id="status">
                                        <option class="d-none" disabled selected value="">-- Choose status --</option>

                                        <option value="Process" <?= ($_GET['status'] ?? null) == 'Process' ? 'selected' : '' ?>>Process
                                        </option>
                                        <option value="Active" <?= ($_GET['status'] ?? null) == 'Active' ? 'selected' : '' ?>>Active
                                        </option>
                                        <option value="Pending" <?= ($_GET['status'] ?? null) == 'Pending' ? 'selected' : '' ?>>Pending
                                        </option>
                                        <option value="All" <?= ($_GET['status'] ?? null) == 'All' ? 'selected' : '' ?>>
                                            All</option>

                                    </select>
                                </div>

                                <script>
                                    $(() => {
                                        $('#coverage, #status, #package')
                                            .change(function() {
                                                let param = $(this).attr('id')
                                                let value = $(this).val()
                                                let urlParams = new URLSearchParams(window.location.search);
                                                if (urlParams.has(param)) {
                                                    urlParams.set(param, value);
                                                } else {
                                                    urlParams.append(param, value);
                                                }

                                                let newUrl = window.location.pathname + '?' + urlParams
                                                    .toString();

                                                window.location = newUrl;

                                            })
                                    })
                                </script>

                            </div>

                            <div class="container-fluid bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold d-flex align-items-center justify-content-between">Customer
                                    package <a href="?add_package=true" class="btn btn-primary">+ Add</a></h4>
                                <div class="d-flex align-items-center justify-content-between mb-4">

                                    <div class="col col-lg-4 position-relative mt-3">
                                        <input type="search" style="padding-right: 2.5rem;" class="form-control" placeholder="Search" oninput="w3.filterHTML('#table', 'tr', this.value)">
                                        <i class="fas fa-search position-absolute" style="top: 50%;right: 20px; transform: translateY(-50%); pointer-events: none;"></i>
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
                                <div class="table-responsive">
                                    <table id="table" class="table table-white table-striped table-hover" style="min-width: 100vw;">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col">Id</th> -->
                                                <th scope="col">Name</th>
                                                <th scope="col">account no.</th>
                                                <th scope="col">Invoice</th>
                                                <th scope="col">Package</th>
                                                <th scope="col">Coverage</th>
                                                <th scope="col">Total</th>
                                                <!-- <th scope="col">Status</th> -->
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = getRows("variant='false'", "user_package");

                                            function filterByCoverage($coverage, $data): array
                                            {
                                                if (!isset($coverage) || $coverage == 'All') return $data;

                                                $filteredData = [];
                                                foreach ($data as $row) {
                                                    if ($row['coverage'] == $coverage) {
                                                        $filteredData[] = $row;
                                                    }
                                                }
                                                return $filteredData;
                                            }

                                            function filterByPackage($package, $data): array
                                            {
                                                if (!isset($package) || $package == 'All') return $data;

                                                $filteredData = [];
                                                foreach ($data as $row) {
                                                    if ($row['package'] == $package) {
                                                        $filteredData[] = $row;
                                                    }
                                                }
                                                return $filteredData;
                                            }


                                            function filterByStatus($status, $data): array
                                            {
                                                if (!isset($status) || $status == 'All') return $data;

                                                $filteredData = [];
                                                foreach ($data as $row) {
                                                    if ($row['process_status'] == $status) {
                                                        $filteredData[] = $row;
                                                    }
                                                }
                                                return $filteredData;
                                            }

                                            $data = filterByStatus(
                                                $_GET['status'] ?? null,
                                                filterByPackage(
                                                    $_GET['package'] ?? null,
                                                    filterByCoverage(
                                                        $_GET['coverage'] ?? null,
                                                        $data
                                                    )
                                                )
                                            );



                                            // Pagination parameters
                                            $totalItems = count($data);
                                            $itemsPerPage = ($_GET['entries'] ?? 10);
                                            $totalPages = ceil($totalItems / $itemsPerPage);
                                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $current_page = max(1, min($totalPages, intval($current_page)));
                                            $offset = ($current_page - 1) * $itemsPerPage;

                                            $data = array_slice($data, $offset, $itemsPerPage);
                                            



                                            foreach ($data as $row) {
                                                // get user name
                                                $user = getRows("account_no='{$row['account_no']}'", "accounts")[0] ?? [];
                                                $name = ($user['firstname'] ?? null) . " " . ($user['middle_initial'] ?? null) . ". " . ($user['lastname'] ?? null);


                                                $selected_date = $row['selected_date'] == date("Y-m-d");
                                            ?>
                                                <tr>
                                                    <!-- <td><?= $row['id'] ?></td> -->
                                                    <td><?= $name ?></td>
                                                    <td><?= $row['account_no'] ?></td>
                                                    <td><?= $row['invoice'] ?></td>
                                                    <td><?= $row['package'] ?></td>
                                                    <td><?= $row['coverage'] ?></td>
                                                    <td><?= $row['total'] ?></td>
                                                    <!-- <td><?= $row['status'] ?></td> -->
                                                    <td><?= $row['process_status'] ?></td>
                                                    <td><?= $row['date'] ?></td>
                                                    <td>
                                                        <select onchange="packageAction(<?= $row['id'] ?>, this)">
                                                            <option value="" selected disabled class="d-none">Choose one
                                                            </option>
                                                            <option value="Process" <?= in_array($row['process_status'], ['Active', 'Process']) ? 'disabled' : null ?>>Process</option>
                                                            <option value="Active" <?= in_array($row['process_status'], ['Active', 'Pending']) || !$selected_date ? 'disabled' : null ?>>Active</option>
                                                            <option value="Delete">Delete</option>
                                                            <!-- <option value="Active" <?= $row['is_active'] == 'true' ? 'disabled' : null ?>>Active</option>
                                                            <option value="Inactive" <?= $row['is_active'] == 'false' ? 'disabled' : null ?>>Inactive</option> -->
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- function packageAction -->
                                    <script>
                                        function packageAction(id, el, table = 'user_package') {
                                            let action = $(el).val().trim().toLowerCase();

                                            // create confirmation

                                            Swal.fire({
                                                title: action,
                                                text: `Are you sure to ${action} item \`${id}\`?`,
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: `Yes, ${action} it!`
                                            }).then((result) => {
                                                let dateSelected = "";
                                                if (result.isConfirmed) {
                                                    if (action == 'process') {
                                                        Swal.fire({
                                                            title: "Installation date",
                                                            html: `<div>
                                                                <input required id="date_" type="date" class="form-control"/>
                                                            </div>`,
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Submit',
                                                            preConfirm: () => {
                                                                dateSelected = $('#date_').val().trim()
                                                                if (dateSelected == "") {
                                                                    return;
                                                                }

                                                                loader_con.style.display = 'flex'
                                                                $.ajax({
                                                                    type: "GET",
                                                                    url: "customer_package_action.php",
                                                                    data: {
                                                                        id,
                                                                        table,
                                                                        action,
                                                                        dateSelected
                                                                    },
                                                                    dataType: "json",
                                                                    success: function(response) {
                                                                        if (response.status ===
                                                                            "success") {
                                                                            loader_con.style
                                                                                .display =
                                                                                'none'
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
                                                                            loader_con.style
                                                                                .display =
                                                                                'none'
                                                                            Swal.fire({
                                                                                title: "Error",
                                                                                text: response
                                                                                    .message,
                                                                                icon: "error"
                                                                            }).then(() => {
                                                                                location
                                                                                    .reload();
                                                                            });
                                                                        }
                                                                    },
                                                                    error: function(xhr, status,
                                                                        error) {
                                                                        console.error(xhr
                                                                            .responseText);
                                                                        loader_con.style
                                                                            .display = 'none';
                                                                    }
                                                                });
                                                            }
                                                        });


                                                    } else {
                                                        loader_con.style.display = 'flex'
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "customer_package_action.php",
                                                            data: {
                                                                id,
                                                                table,
                                                                action,
                                                                dateSelected
                                                            },
                                                            dataType: "json",
                                                            success: function(response) {
                                                                if (response.status === "success") {
                                                                    loader_con.style.display = 'none'
                                                                    Swal.fire({
                                                                        title: "Success!",
                                                                        text: response.message,
                                                                        icon: "success"
                                                                    }).then(() => {
                                                                        location.reload();
                                                                    });
                                                                } else {
                                                                    loader_con.style.display = 'none'
                                                                    Swal.fire({
                                                                        title: "Error",
                                                                        text: response.message,
                                                                        icon: "error"
                                                                    }).then(() => {
                                                                        location.reload();
                                                                    });
                                                                }
                                                            },
                                                            error: function(xhr, status, error) {
                                                                console.error(xhr.responseText);
                                                                loader_con.style.display = 'none';
                                                            }
                                                        });
                                                    }

                                                }
                                            });
                                        }
                                    </script>

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
                        } elseif (isset($_GET['add_package']) && $_GET['add_package'] == 'true') {
                        ?>
                            <div class="container-fluid">
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $post = validate_post_data($_POST);

                                    $account_no = $post['account_no'];
                                    $total = $post['price'];

                                    $coverage = $post['coverage'];
                                    $package = $post['package'];
                                    $category = $post['category'];
                                    $invoice = generateRandomNumber(9);

                                    // set due date and period
                                    $currentDate = new DateTime();
                                    $currentDate->add(new DateInterval('P1M'));
                                    $period = $currentDate->format('M Y');
                                    $dueDate = $currentDate->format('d M Y');

                                    // get email
                                    $email = getRows("account_no='$account_no'", "accounts")[0]['email'];

                                    if (SendMail($email, "Dear $email,<br><br>
                                We're thrilled to inform you that an administrator has added a new package to your account! 🎉<br>
                                If you have any questions or need further assistance, please don't hesitate to reach out to us at swiftlinkitsolution@gmail.com.<br>
                                <br><br>
                                Best regards,<br>
                                The Swiftlink Team", "Package Submission Confirmation")) {

                                        $insertQuery = "INSERT INTO user_package (account_no, invoice, package, coverage, total, period, due_date, process_status)
                                    VALUES ('$account_no', '$invoice', '$package', '$coverage', $total, '$period', '$dueDate', 'Active')";


                                        $result = mysqli_query($conn, $insertQuery);
                                        if ($result) {
                                            $success_msg = "Package added successfully!";
                                            setLog('admin', [
                                                'account_no' => $_SESSION['account_no'],
                                                'category' => 'Activity',
                                                'remark' => 'Added package ' . $package
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
                                        <h6 class="fw-bold">Accounts</h6>
                                        <select required class="form-select form-select-sm" name="account_no">
                                            <option class="d-none" selected disabled value="">-- Select account --</option>
                                            <?php
                                            $data = getRows("status = 'Active' AND verified='true' AND role='user'", "accounts");
                                            foreach ($data as $row) {
                                                echo '
                                                <option value="' . $row['account_no'] . '">' . $row['firstname'] . ' ' . $row['middle_initial'] . ' ' . $row['lastname'] . ' - ' . $row['account_no'] . ' - ' . $row['address'] . '</option>
                                            ';
                                            }
                                            ?>
                                        </select>
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

                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn btn-primary text-white">Save</button>
                                        <a href="./customer_package.php" class="btn btn-danger text-white mx-3">Cancel</a>
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
                }).then(() => {
                    location.href = 'coverage.php';
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