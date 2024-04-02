<?php 
    require_once '../config.php';
    require_once '../global.php';

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
    <title>History</title>
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
                            <li class="nav-item my-1">
                                <a href="./index.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">home</span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="package.php"
                                    class="text-center d-flex align-items-center justify-content-start gap-2 ml-4 fs-6">
                                    <span class="material-symbols-outlined">deployed_code</span>
                                    Package
                                </a>
                            </li>
                            <li class="nav-item my-1 current-page">
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
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= isset($_GET['payment_confirmation']) ? 'Payment Confirmation' : 'History' ?>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">
                                        <?= isset($_GET['payment_confirmation']) ? 'Payment Confirmation' : 'History' ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <!-- history -->




                    <!-- view user -->
                    
                    <?php
                        if(isset($_GET['view_user']) && !isset($_GET['update_package'])) {
                            $account_no = base64_decode(mysqli_real_escape_string($conn, trim($_GET['view_user'])));

                            $userRow = getRows("account_no='$account_no'", "accounts")[0];
                           
                            ?>
                        <div class="bg-white p-2 p-md-3 py-2" style="border-radius: 40px;">
                            <!-- view user data -->
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="col-4 col-lg-1">
                                    <img id="profile_pic" title="Update profile picture?"
                                        style="cursor: pointer; object-fit: cover;"
                                        class="img-fluid rounded-circle hover"
                                        src="<?= isset($userRow['profile']) ? '../user/' . $userRow['profile'] : 'https://i.pinimg.com/736x/0d/64/98/0d64989794b1a4c9d89bff571d3d5842.jpg' ?>"
                                        height="90px" width="90px"
                                        alt="Profile picture of <?= $userRow['firstname'] ?? '' ?> <?= $userRow['middle_initial'] ?? '' ?> <?= $userRow['lastname'] ?? '' ?>">
                                    <input id="file_upload" type="file" accept="image/*" class="d-none">
                                    
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
                                    <small><a href="mailto:<?= $userRow['email'] ?>"><i
                                                class="fa-solid fa-envelope mx-2"></i>
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
                                            <!-- <th class="ellipsis-text" scope="col">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlQuery = "SELECT up.id, ac.firstname, ac.lastname, ac.account_no, ac.email, ac.phone, up.status, ac.address, up.total, up.coverage, up.package, up.process_status
                                        FROM accounts AS ac
                                        JOIN user_package AS up ON ac.account_no = up.account_no  
                                        WHERE ac.account_no = '$account_no' AND up.process_status = 'Done'";


                                        $result = $conn->query( $sqlQuery );
                                        $data = [];
                                        if ( $result && $result->num_rows>0 ) {
                                            while( $row = $result->fetch_assoc() ) {
                                                $data[] = $row;
                                            }
                                        }


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
                                            <td class="ellipsis-text"><?= $row['status'] ?></td>
                                            <td class="ellipsis-text"><?= $row['total'] ?></td>
                                            <td class="ellipsis-text"><?= $row['coverage'] ?></td>
                                            <td class="ellipsis-text"><?= $row['package'] ?></td>
                                            <!-- <td class="ellipsis-text">
                                                <a href="?update_package=<?= $row['id'] ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>

                                                <button class="fa-regular fa-trash-can text-danger btn btn-sm"
                                                    onclick="deleteConfirmation(<?= $row['id'] ?>, 'user_package')"></button>

                                            </td> -->
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
                                        <a class="page-link" onclick="setPage(<?= ($current_page - 1) ?>)"
                                            aria-label="Previous">
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
                                        <a class="page-link" onclick="setPage(<?= ($current_page + 1) ?>)"
                                            aria-label="Next">
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

                    <!-- end view user -->

                    <div class="col col-lg-3">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-select" name="" id="history_select">
                                <option value="All" <?= ($_GET['selected'] ?? null) == 'All' ? 'selected' : null ?>>All
                                </option>
                                <option value="History"
                                    <?= ($_GET['selected'] ?? null) == 'History' ? 'selected' : null ?>>
                                    History</option>
                                <option value="Ticket History"
                                    <?= ($_GET['selected'] ?? null) == 'Ticket History' ? 'selected' : null ?>>Ticket
                                    History
                                </option>
                            </select>
                        </div>
                        <script>
                        $(() => {
                            $('#history_select').on('change', () => {
                                location.href = `?selected=${$('#history_select').val()}`;
                            })
                        })
                        </script>
                    </div>
                    <div class="ecommerse-widget bg-white <?= isset($_GET['payment_confirmation']) ? 'd-none' : '' ?>">
                        <table
                            class="table table-striped table-hover table-white <?= ($_GET['selected'] ?? null) == 'Ticket History' ? 'd-none' : null ?>">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Account no.</th>
                                    <th scope="col">Period</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = getRows("account_no = '{$_SESSION['account_no']}'", "user_package");

                                // Pagination parameters
                                $totalItems = count($data);
                                $itemsPerPage = 5;
                                $totalPages = ceil($totalItems / $itemsPerPage);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $current_page = max(1, min($totalPages, intval($current_page)));
                                $offset = ($current_page - 1) * $itemsPerPage;

                                $dataToDisplay = array_slice($data, $offset, $itemsPerPage);

                                $count = 1;
                                foreach ($dataToDisplay as $row) {
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $row['account_no'] ?? null ?></td>
                                    <td><?= $row['period'] ?? null ?></td>
                                    <td><?= $row['total'] ?? null ?></td>
                                    <td class="<?= $row['status'] == 'Unpaid' ? 'text-danger' : 'text-success' ?>">
                                        <?= $row['status'] ?? null ?></td>
                                    <td>
                                        <a href="?view=<?= $row['invoice'] ?? null ?>" class="btn p-0">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="?view_user=<?= base64_encode($row['account_no']  ?? null ) ?>" class="btn text-warning p-0 mx-2">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                                }
                                ?>
                            </tbody>
                        </table>

                        

                        <br>
                        <br>
                        <br>


                        <div class="table-responsive <?= ($_GET['selected'] ?? null) == 'History' ? 'd-none' : null ?>">
                            <h3 class="fw-bold">Ticket History</h3>
                            <table class="table table-striped table-hover table-white">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Account no.</th>
                                        <th scope="col">Ticket no.</th>
                                        <th scope="col">Report</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $data = getRows("account_no = '{$_SESSION['account_no']}'", "customer_ticket");

                                // Pagination parameters
                                $totalItems = count($data);
                                $itemsPerPage = 5;
                                $totalPages = ceil($totalItems / $itemsPerPage);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $current_page = max(1, min($totalPages, intval($current_page)));
                                $offset = ($current_page - 1) * $itemsPerPage;

                                $dataToDisplay = array_reverse(array_slice($data, $offset, $itemsPerPage));

                                $count = 1;
                                foreach ($dataToDisplay as $row) {
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $row['account_no'] ?? null ?></td>
                                        <td><?= $row['ticket_no'] ?? null ?></td>
                                        <td><?= $row['report'] ?? null ?></td>
                                        <td><?= $row['date'] ?? null ?></td>
                                        <td><?= $row['status'] ?? null ?></td>
                                        <td>
                                            <button class="btn btn-sm p-0 text-success"
                                                onclick="viewTicketHistory('<?= $row['ticket_no'] ?? null ?>')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                onclick="deleteConfirmation(`ticket_no='<?= ($row['ticket_no'] ?? null) ?>'`, 'customer_ticket')"
                                                class="btn btn-sm p-0 text-danger mx-2">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <script>
                            function viewTicketHistory(ticket_no) {
                                const condition = `ticket_no='${ticket_no}'`;
                                fetch(`./get_data.php?table=customer_ticket&condition=${btoa(condition)}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        const formatData = (data) => {
                                            let formattedData =
                                                '<div class="d-block" style="text-align: left !important;">';
                                            for (const key in data) {
                                                if (!['id', 'document'].includes(key)) {
                                                    formattedData +=
                                                        `<label class="form-label my-0" for="${key}">${key.replace(/_/g, ' ')}</label>
                                                        <input id="${key}" type="text" readonly class="form-control form-control-sm py-0 my-0" value="${data[key]}">
                                                        <br>`;
                                                }
                                            }
                                            return formattedData + '</div>';
                                        };

                                        const showData = () => {
                                            Swal.fire({
                                                title: 'Ticket',
                                                html: formatData(data[0]),
                                                icon: 'info',
                                                confirmButtonText: 'Close'
                                            });
                                        };

                                        showData();
                                    })
                                    .catch(err => {
                                        alert(err.message)
                                    });



                            }
                            </script>
                        </div>



                        <?php
                        if(isset($_GET['view'])) {

                            $invoice = mysqli_real_escape_string($conn, trim($_GET['view']));
                            $row = getRows("invoice='$invoice'", "user_package");
                            
                            // if data did not exist return to history.php
                            if(count($row) == 0) {
                                echo '<script>location.href="history.php";</script>';
                            } else {
                                $row = $row[0];
                            }
                        ?>

                        <!-- Modal -->
                        <div class="modal fade border-0" id="historyModal" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="historyModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg border-0">
                                <div class="modal-content" style="border-radius: 40px; border: 0;">
                                    <div class="modal-header px-5 mt-1">
                                        <h1 class="modal-title fs-3 fw-bold" id="historyModalLabel">
                                            <?= $row['period'] ?>
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h3 class="text-muted">Account No</h3>
                                                <h3>
                                                    <?= $row['account_no'] ?>
                                                </h3>
                                            </div>
                                            <div class="col text-center">
                                                <h3 class="text-muted">Status</h3>
                                                <h3
                                                    class="<?= $row['status'] == 'Unpaid' ? 'text-danger' : 'text-success' ?>">
                                                    <?= strtoupper($row['status']) ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h3 class="text-muted">Amount</h3>
                                            <h1 class="fw-bold mt-3"><?= $row['total'] ?></h1>

                                            <h3 class="fw-bold mt-3">
                                                <?= $row['package'] ?>
                                            </h3>

                                            <a href="?payment_confirmation=<?= $row['invoice'] ?>"
                                                class="btn btn-danger text-white px-5"
                                                style="border-radius: 17px;">Payment Confirmation</a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="history.php" style="border-radius: 17px;"
                                            class="btn btn-dark">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                        $(document).ready(function() {
                            $('#historyModal').modal('show');
                        });
                        </script>

                        <?php
                        }
                        ?>
                    </div>

                    <div class="ecommerse-widget <?= isset($_GET['payment_confirmation']) ? '' : 'd-none' ?>">
                        <?php 
                    if(isset($_GET['payment_confirmation'])) {  
                        $invoice = mysqli_real_escape_string($conn, trim($_GET['payment_confirmation']));
                        $row = getRows("invoice='$invoice'", "user_package");
                            
                        // if data did not exist return to history.php
                        if(count($row) == 0) {
                            echo '<script>location.href="history.php";</script>';
                        } else {
                            $row = $row[0];
                        }

                        // save payment information
                        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Handle file upload
                            $targetDir = "proof_of_payment/" . uniqid();
                            $targetFile = '';

                            $payment_method = mysqli_real_escape_string($conn, trim($_POST['payment_method']));
                            $date_payment = mysqli_real_escape_string($conn, trim($_POST['date_payment']));
                            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                                $targetFile = $targetDir . '-' . basename($_FILES["file"]["name"]);
                                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                                    $date_payment = $_POST['date_payment'];
                                    $sql = "INSERT INTO payment_confirmation(invoice, payment_method, date_payment, image_path)
                                    VALUES('$invoice', '$payment_method', '$date_payment', '$targetFile')";

                                    if($conn->query($sql)) {
                                        $success_msg = "Payment Information has been submitted successfully";
                                    } else {
                                        $error_msg = "Failed to submit information, please try again";
                                    }
                                }
                            }
                        }


                        // check if the user already submitted payment confirmation
                        $already_submitted = isDataExists('payment_confirmation', '*', "invoice='$invoice'");

                        // check if the user approved payment confirmation
                        $is_payment_approved = isDataExists('payment_confirmation', '*', "invoice='$invoice' AND status='Approved'");

                        // get image path to display proof of payment
                        if($already_submitted) {
                            $image_path = getRows("invoice='$invoice'", "payment_confirmation")[0]['image_path'];
                        }
                    }
                    ?>
                        <div class="row bg-white p-5" style="border-radius: 50px;">
                            <div class="col-12 col-lg-6">
                                <form action="" method="post" class="" enctype="multipart/form-data">
                                    <h3 class="fw-bold">Payment</h3>
                                    <div class="alert alert-warning alert-dismissible fade show <?= (!$already_submitted || $is_payment_approved) ? 'd-none': '' ?>"
                                        role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        Thank you for submitting your payment confirmation. We will notify you once your
                                        payment has been verified. <br> Thank you for your patience.
                                    </div>

                                    <div class="alert alert-primary alert-dismissible fade show <?= !$is_payment_approved ? 'd-none': '' ?>"
                                        role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        Thank you for submitting your payment confirmation. Your payment confirmation
                                        has been approved.
                                    </div>

                                    <div class="mb-3">
                                        <label for="invoice_no" class="form-label">Invoice No</label>
                                        <input readonly value="<?= $row['invoice'] ?>" type="text" class="form-control"
                                            name="invoice_no" id="invoice_no">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input readonly value="<?= $_SESSION['name'] ?>" type="text"
                                            class="form-control" name="name" id="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="account_no" class="form-label">Account No</label>
                                        <input readonly value="<?= $row['account_no'] ?>" type="number"
                                            class="form-control" name="account_no" id="account_no">
                                    </div>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input readonly value="<?= $row['total'] ?>" type="number"
                                                    class="form-control" name="amount" id="amount">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="period" class="form-label">Period</label>
                                                <input readonly value="<?= $row['period'] ?>" type="text"
                                                    class="form-control" name="period" id="period">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 <?= $already_submitted ? 'd-none': '' ?>">
                                        <label for="payment_method" class="form-label">Payment method</label>
                                        <select required class="form-select" name="payment_method" id="payment_method">
                                            <option selected value="" disabled class="d-none">-- Select Payment Method
                                                --</option>
                                            <option value="Gcash">Gcash</option>
                                            <option value="Paypal">Maya</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>


                                    </div>
                                    <div class="mb-3">
                                        <label for="date_payment" class="form-label">Date Payment</label>
                                        <input readonly value="<?= date('Y-m-d') ?>" type="text" class="form-control"
                                            name="date_payment" id="date_payment">
                                    </div>
                                    <div class="mb-3">
                                        <a href="history.php" class="btn btn-danger px-5 btn-lg"
                                            style="border-radius: 15px;">Cancel</a>

                                        <button id="insertFileBtn" type="button"
                                            class="btn btn-primary px-5 btn-lg mx-2 <?= $already_submitted ? 'd-none' : null ?>"
                                            style="border-radius: 15px;">Insert
                                            image</button>
                                        <input accept="image/*" id="file" type="file" name="file" class="d-none"
                                            required>
                                        <script>
                                        $(document).ready(function() {
                                            $('#insertFileBtn').on('click', function() {
                                                if ($(this).attr('type') == 'button') {
                                                    $('#file').click();
                                                }
                                            })


                                            $('#closeImg').on('click', function() {
                                                $('#preview').attr('src', null);
                                                $('#insertFileBtn').html('Insert image').removeClass(
                                                    'btn-success').addClass('btn-primary').attr(
                                                    'type', 'button');
                                                $(this).hide()
                                            });

                                            $('#file').on('change', function(ev) {
                                                let reader = new FileReader();
                                                reader.onload = e => {
                                                    $('#preview').attr('src', e.target.result);
                                                    $('#insertFileBtn').html('Submit').toggleClass(
                                                        'btn-success').attr('type', 'submit');
                                                    $('#closeImg').show()
                                                }

                                                reader.readAsDataURL($(this).prop('files')[0]);
                                            })
                                        })
                                        </script>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-lg-6 p-4 d-flex align-items-center justify-content-start">

                                <div class="position-relative container-fluid p-0">
                                    <img id="preview" <?= $already_submitted ? 'src="' . $image_path . '"': null ?>
                                        alt=""
                                        style="height: 600px; width: 100%; border-radius: 50px; border: 4px dashed rgba(0,0,0,0.3);">
                                    <i title="Change picture?" id="closeImg"
                                        class="fas fa-close position-absolute text-dark fs-3"
                                        style="top: 30px; right: 30px;cursor: pointer; display: none"></i>
                                </div>


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






    function deleteConfirmation(condition, table) {
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
                    url: "./delete_data.php",
                    data: {
                        condition,
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