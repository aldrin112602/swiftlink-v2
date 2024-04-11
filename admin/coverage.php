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
    <title>Coverage</title>
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

                            <li class="nav-item my-1 current-page">
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
                                            <li class="breadcrumb-item active" aria-current="page">Coverage</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Coverage</h2>
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
                            <a href="?add_coverage=true" class="btn btn-primary btn-sm px-4 text-white" style="border-radius: 50px;"><i class="fa-solid fa-plus"></i> Add</a>
                        </div>
                        <?php
                        if ((!isset($_GET['add_coverage']) || $_GET['add_coverage'] != 'true') && !isset($_GET['update'])) {
                        ?>
                            <div class="table-responsive bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold">Coverage</h4>
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

                                                    let newUrl = window.location.pathname + '?' + urlParams
                                                        .toString();

                                                    window.location = newUrl;
                                                });

                                                for (let i = 10; i <= 4000; i *= 2) {
                                                    $('#entries').append(
                                                        `<option ${i == <?= ($_GET['entries'] ?? 0) ?> ? 'selected' : ''} value="${i}">${i}</option>`
                                                    )
                                                }
                                            })
                                        </script>
                                    </div><span>entries</span>
                                </div>
                                <table class="table table-white table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data = getRows(null, "coverage");

                                        // Pagination parameters
                                        $totalItems = count($data);
                                        $itemsPerPage = $_GET['entries'] ?? 10;
                                        $totalPages = ceil($totalItems / $itemsPerPage);
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $current_page = max(1, min($totalPages, intval($current_page)));
                                        $offset = ($current_page - 1) * $itemsPerPage;

                                        $dataToDisplay = array_slice($data, $offset, $itemsPerPage);

                                        foreach ($dataToDisplay as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['status'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td>
                                                    <a href="?update=<?= $row['id'] ?>">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <button class="fa-regular fa-trash-can text-danger btn btn-sm" onclick="deleteConfirmation(<?= $row['id'] ?>, 'coverage')"></button>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                        } elseif (isset($_GET['add_coverage']) && $_GET['add_coverage'] == 'true' && !isset($_GET['update'])) {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name = trim($_POST['name']);
                                $status = trim($_POST['status']);
                                $insertQuery = "INSERT INTO coverage (name, status) VALUES ('$name','$status')";
                                $result = mysqli_query($conn, $insertQuery);
                                if ($result) {
                                    $success_msg = "Coverage added successfully!";
                                    setLog('admin', [
                                        'account_no' => $_SESSION['account_no'],
                                        'category' => 'Activity',
                                        'remark' => 'Added coverage'
                                    ]);
                                } else {
                                    $err_msg = "Error adding coverage: " . mysqli_error($conn);
                                }
                            }
                        ?>
                            <form action="" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold">Add Coverage</h4>
                                <div class="container my-3 d-md-flex align-items-center justify-content-between gap-2">
                                    <div class="col-lg-6 col-12 mt-1">
                                        <label class="form-label">Name</label>
                                        <input required type="text" class="form-control form-control-sm input" id="name" name="name">
                                    </div>
                                    <div class="col-lg-6 col-12 mt-1">
                                        <label class="form-label">Status</label>
                                        <select required class="form-select form-select-sm" name="status">
                                            <option class="d-none" selected disabled value="">-- Select Status --</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 text-white" style="border-radius: 20px;">Save</button>
                                </div>
                            </form>
                        <?php
                        } elseif (!isset($_GET['add_coverage']) && isset($_GET['update'])) {
                            $id = isset($_GET['update']) ? intval($_GET['update']) : 0;

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name = trim($_POST['name']);
                                $status = trim($_POST['status']);

                                // Use prepared statements to prevent SQL injection
                                $updateQuery = "UPDATE coverage SET name = ?, status = ? WHERE id = ?";
                                $stmt = mysqli_prepare($conn, $updateQuery);
                                mysqli_stmt_bind_param($stmt, "ssi", $name, $status, $id);
                                $result = mysqli_stmt_execute($stmt);

                                if ($result) {
                                    $success_msg = "Coverage updated successfully!";
                                    setLog('admin', [
                                        'account_no' => $_SESSION['account_no'],
                                        'category' => 'Activity',
                                        'remark' => 'Updated coverage information'
                                    ]);
                                } else {
                                    $err_msg = "Error updating coverage: " . mysqli_error($conn);
                                }
                            }

                            // Fetch data only if the ID is valid
                            if ($id > 0) {
                                $data = getRows("id = $id", "coverage");
                                if (count($data) == 0) {
                                    header("Location: coverage.php");
                                }
                                $row = $data[0];
                            }
                        ?>
                            <form action="" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 20px;">
                                <h4 class="text-primary fw-bold">Edit Coverage</h4>
                                <div class="container my-3 d-md-flex align-items-center justify-content-between gap-2">
                                    <div class="col-lg-6 col-12 mt-1">
                                        <label class="form-label">Name</label>
                                        <input value="<?= $row['name'] ?? null ?>" required type="text" class="input form-control form-control-sm" id="name" name="name">
                                    </div>
                                    <div class="col-lg-6 col-12 mt-1">
                                        <label class="form-label">Status</label>
                                        <select required class="form-select form-select-sm" name="status">
                                            <option class="d-none" selected disabled value="">-- Select Status --</option>
                                            <option value="Active" <?= ($row['status'] == 'Active') ? 'selected' : ''; ?>>
                                                Active
                                            </option>
                                            <option value="Inactive" <?= ($row['status'] == 'Inactive') ? 'selected' : ''; ?>>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mt-5 d-flex align-items-center justify-content-end gap-3">
                                    <a href="coverage.php" class="btn btn-danger btn-lg px-5 text-white" style="border-radius: 20px;">Cancel</a>
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