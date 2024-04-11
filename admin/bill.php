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
    <title>Bill</title>
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



    <!-- jspdf cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- htmltocanvas cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



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

        .ellipsis-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-select {
            /* padding: 0 20px; */
            font-size: 12px;
            height: 40px;
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
            #tablePreview table tr th:first-child {
                display: none !important;
            }

            #tablePreview table tr input[type="checkbox"]:not(:checked)+.ellipsis-text {
                display: none !important;
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
                            <li class="nav-item my-1  current-page">
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
                                            <li class="breadcrumb-item active" aria-current="page">Bill</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <h2 class="pageheader-title font-weight-bold py-2">Bill</h2>
                                </div>
                            </div>
                        </div>

                        <?php require_once './profile_nav.php' ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="container-fluid <?= !isset($_GET['view']) ? 'd-none' : null ?>">
                        <!-- preview invoice -->
                        <div class="bg-white p-5 py-3" style="border-radius: 15px;" id="preview_invoice">
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
                            <hr>

                            <div id="btns">
                                <button onclick="downLoadAsPdf()" class="btn btn-white btn-sm border">Print</button>
                                <button onclick="handleDownloadPDF()" class="btn btn-white btn-sm border">Download</button>
                            </div>
                            <h2 class="fw-bold text-primary" style="text-align: right !important; font-family: serif">
                                INVOICE</h2>
                            <?php
                            // get account no
                            $get = validate_post_data($_GET);
                            $view = $get['view'];
                            $account_no = getRows("invoice='$view'", "user_package")[0]['account_no'];
                            $user_account = getRows("account_no='$account_no'", "accounts")[0];
                            $invoice = getRows("invoice='$view'", "user_package")[0];
                            ?>
                            <div class="row">
                                <div class="col">
                                    <span class="my-2">To:</span><br>
                                    <strong class="fw-bold my-2">
                                        <?= $user_account['firstname'] . ' ' . $user_account['middle_initial'] . ' ' . $user_account['lastname'] ?>
                                    </strong><br>
                                    <span class="my-2">
                                        <?= $user_account['phone'] ?>
                                    </span><br>
                                    <span class="my-2">
                                        <?= $user_account['address'] ?>,
                                        <?= $user_account['town'] ?>,
                                        <?= $user_account['city'] ?>,
                                        <?= $user_account['province'] ?>
                                    </span>
                                </div>
                                <div class="col">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td align="right" class="py-1">
                                                    <b>Account No:</b>
                                                </td>
                                                <td align="right" class="py-1">
                                                    <?= $account_no ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="py-1">
                                                    <b>Invoice:</b>
                                                </td>
                                                <td align="right" class="py-1">
                                                    <?= $view ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="py-1">
                                                    <b>Date Invoice:</b>
                                                </td>
                                                <td align="right" class="py-1">
                                                    <?php
                                                    $date = explode(" ", $invoice['date'])[0];
                                                    echo $date;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="py-1">
                                                    <b>Due Date:</b>
                                                </td>
                                                <td align="right" class="py-1">
                                                    <?= $invoice['due_date'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex mt-3 align-items-center justify-content-between">
                                <span>Period
                                    <?= $invoice['period'] ?>
                                </span>
                                <span class="fw-bold text-danger">
                                    <?= strtoupper($invoice['status']) ?>
                                </span>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Items</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <!-- <th>Discount</th> -->
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $invoice['package'] ?></td>
                                        <td>1</td>
                                        <td><?= $invoice['total'] ?></td>
                                        <td><?= $invoice['total'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex mt-3 align-items-center justify-content-end gap-4">
                                <strong>Total</strong>
                                <strong><?= $invoice['total'] ?></strong>
                            </div>
                            <?php
                            function numberToWords($num)
                            {
                                $ones = array(
                                    0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                                    7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                                    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen',
                                    18 => 'eighteen', 19 => 'nineteen'
                                );

                                $tens = array(
                                    0 => '', 1 => '', 2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty', 6 => 'sixty',
                                    7 => 'seventy', 8 => 'eighty', 9 => 'ninety'
                                );

                                if ($num < 20) {
                                    return $ones[$num];
                                }

                                if ($num < 100) {
                                    return $tens[floor($num / 10)] . (($num % 10 !== 0) ? ' ' . $ones[$num % 10] : '');
                                }

                                if ($num < 1000) {
                                    return $ones[floor($num / 100)] . ' hundred' . (($num % 100 !== 0) ? ' and ' . numberToWords($num % 100) : '');
                                }

                                if ($num < 1000000) {
                                    return numberToWords(floor($num / 1000)) . ' thousand' . (($num % 1000 !== 0) ? ' ' . numberToWords($num % 1000) : '');
                                }

                                return 'number is too large to handle';
                            }

                            ?>
                            <p>
                                <i>
                                    * Count: <?= numberToWords((int)$invoice['total']) ?>
                                </i>
                            </p>
                            <strong class="d-block">
                                Bank Transfer:
                            </strong>
                            <p>
                                GCASH: 09279972636 A/N JOHN GODWIN DITABLAN <br>
                                BDO: 0912090091653 A/N JOHN GODWIN DITABLAN <br>
                                MAYA: 09279972636 A/N JOHN GODWIN DITABLAN
                            </p>

                            <strong class="d-block mt-3">
                                Payment Confirmation:
                            </strong>
                            <p>
                                EMAIL: swiftlinkitsolutions@gmail.com<br>
                                CONTACT: 09279972636
                            </p>
                        </div>



                        <script>
                            function downLoadAsPdf() {
                                $('#btns').hide();
                                var divContents = $("#preview_invoice");
                                var printWindow = window.open('', '',
                                    `height=${divContents.prop('offsetHeight')},width=${divContents.prop('offsetWidth')}`
                                );
                                printWindow.document.write('<html><head><title>Invoice Contents</title>');
                                printWindow.document.write('</head><body>');
                                printWindow.document.write(divContents.html());
                                printWindow.document.write('</body></html>');
                                printWindow.document.close();
                                printWindow.print();

                                setTimeout(() => {
                                    $('#btns').show();
                                }, 100)
                            }


                            const handleDownloadPDF = () => {
                                $('#btns').hide();
                                const domElement = document.getElementById('preview_invoice');
                                if (domElement) {
                                    html2canvas(domElement).then((canvas) => {
                                        const imgData = canvas.toDataURL('image/png');

                                        const pdf = new jspdf.jsPDF();
                                        pdf.addImage(imgData, 'JPEG', 0, 0, pdf.internal.pageSize.getWidth(),
                                            pdf.internal.pageSize.getHeight());
                                        pdf.save(`${new Date().toISOString()}.pdf`);
                                    });
                                }

                                setTimeout(() => {
                                    $('#btns').show();
                                }, 100)
                            };
                        </script>
                    </div>
                    <div class="container-fluid <?= isset($_GET['view']) ? 'd-none' : null ?>">
                        <h5 class="text-success">Swiftlink</h5>
                        <?php
                        if (!(isset($_GET['add_bill']) && $_GET['add_bill'] == 'true' || isset($_GET['update']))) {
                        ?>
                            <div class="d-flex align-items-center justify-content-end my-2">
                                <a href="?add_bill=true" class="btn btn-primary text-white d-flex align-items-center justify-content-center gap-2" style="border-radius: 20px;"><i class="fa-solid fa-plus"></i> Add</a>
                            </div>

                            <div class="d-flex align-items-center justify-content-start gap-2 mb-2 flex-wrap">
                                <div>
                                    <select id="action" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose action --</option>
                                        <option value="print">Print Selected</option>
                                        <option value="paid">Paid Selected</option>
                                        <option value="delete">Delete Selected</option>
                                    </select>
                                </div>

                                <div>
                                    <select id="coverage" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose coverage --</option>
                                        <?php
                                        $coverage = getRows("status='Active'", "coverage");
                                        foreach ($coverage as $row) {
                                            echo '
                                                <option value="' . $row['name'] . '">' . $row['name'] . '</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <select id="month" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose month --</option>

                                    </select>
                                </div>

                                <div>
                                    <select id="year" class="form-select bg-white mt-1">
                                        <option class="d-none" disabled selected value="">-- Choose year --</option>

                                    </select>
                                </div>


                                <div>
                                    <?php
                                    $status = $_GET['status'] ?? null;
                                    ?>
                                    <select class="form-select bg-white mt-1" id="chooseStatus">
                                        <option class="d-none" disabled selected value="">-- Choose status --</option>
                                        <option value="Unpaid" <?= $status == 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                        <option value="Paid" <?= $status == 'Paid' ? 'selected' : '' ?>>Paid</option>
                                        <option value="All" <?= $status == 'All' ? 'selected' : '' ?>>All</option>

                                    </select>
                                </div>

                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if ((!isset($_GET['add_bill']) || $_GET['add_bill'] != 'true') && !isset($_GET['update'])) {
                        ?>
                            <div class="table-responsive bg-white p-2 p-md-5" style="border-radius: 40px;">

                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="col col-lg-4 position-relative">
                                        <input type="search" style="padding-right: 2.5rem;" class="form-control" placeholder="Search" oninput="w3.filterHTML('#tablePreview', 'tr', this.value)">
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

                                        <h2 class="fs-5"><I>Customer Bills</I></h2>
                                    </div>
                                    <table class="table table-white table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="ellipsis-text" scope="col">
                                                    <input type="checkbox" id="selectAll">
                                                </th>
                                                <th class="ellipsis-text" scope="col">Name</th>
                                                <th class="ellipsis-text" scope="col">Account no - Invoice</th>
                                                <th class="ellipsis-text" scope="col">Period</th>
                                                <th class="ellipsis-text" scope="col">Due Date</th>
                                                <th class="ellipsis-text" scope="col">Total</th>
                                                <th class="ellipsis-text" scope="col">Status</th>
                                                <th class="ellipsis-text" scope="col">Address</th>
                                                <!-- <th class="ellipsis-text" scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            // set default status to Unpaid
                                            $status = "Unpaid";
                                            if (isset($_GET['status']) && in_array(mysqli_real_escape_string($conn, trim($_GET['status'])), ['Unpaid', 'Paid', 'All'])) {
                                                $status = mysqli_real_escape_string($conn, trim($_GET['status']));
                                            }

                                            $sql = null;
                                            if ($status == 'All') {
                                                $sql = "SELECT up.account_no, up.invoice, up.package, up.coverage, up.total, up.id, up.category, up.period, up.due_date, up.status, ac.firstname, ac.lastname, ac.account_no, ac.address, ac.email FROM user_package AS up
                                    JOIN accounts AS ac
                                    ON ac.account_no = up.account_no";
                                            } else {
                                                $sql = "SELECT up.account_no, up.invoice, up.package, up.coverage, up.total, up.id, up.category, up.period, up.due_date, up.status, ac.firstname, ac.lastname, ac.account_no, ac.address, ac.email FROM user_package AS up
                                        JOIN accounts AS ac
                                        ON ac.account_no = up.account_no
                                        WHERE up.status = '$status'";
                                            }



                                            $result = $conn->query($sql);

                                            if ($result) {
                                                $data = $result->fetch_all(MYSQLI_ASSOC);
                                            } else {
                                                die("Error executing query: " . $conn->error);
                                            }



                                            // Pagination parameters
                                            $totalItems = count($data);
                                            $itemsPerPage = $_GET['entries'] ?? 10;
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
                                                        <input id="item" value="<?= $row['id'] ?? null ?>" data-invoice="<?= $row['invoice'] ?? null ?>" type="checkbox">
                                                    </td>
                                                    <td class="ellipsis-text"><?= $row['firstname'] . ' ' . $row['lastname'] ?>
                                                    </td>
                                                    <td class="ellipsis-text"><?= $row['account_no'] ?? null ?> <br>
                                                        <?= $row['invoice'] ?? null ?>
                                                    </td>
                                                    <td class="ellipsis-text"><?= $row['period'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['due_date'] ?></td>
                                                    <td class="ellipsis-text"><?= $row['total'] ?></td>
                                                    <td class="ellipsis-text"><?= strtoupper($row['status']) ?></td>
                                                    <td class="ellipsis-text"><?= $row['address'] ?></td>
                                                    <td class="ellipsis-text">
                                                        <a href="?view=<?= $row['invoice'] ?? 0 ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button class="fa-regular fa-trash-can text-danger btn btn-sm" onclick="deleteConfirmation(<?= ($row['id'] ?? null) ?>, 'user_package')"></button>

                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#selectAll').on('change', function() {
                                                        document.querySelectorAll('#item')
                                                            .forEach(item => {
                                                                item['checked'] = $(this).prop('checked');
                                                            })

                                                    })

                                                    $('#chooseStatus').on('change', function() {
                                                        let status = $(this).val();
                                                        let urlParams = new URLSearchParams(window.location
                                                            .search);
                                                        if (urlParams.has('status')) {
                                                            urlParams.set('status', status);
                                                        } else {
                                                            urlParams.append('status', status);
                                                        }

                                                        let newUrl = window.location.pathname + '?' + urlParams
                                                            .toString();

                                                        window.location = newUrl;
                                                    })


                                                    $('#action').on('change', function() {
                                                        let invoiceSelected = [...document.querySelectorAll(
                                                                '#item')]
                                                            .filter(item => item['checked'] == true).map(item =>
                                                                item.getAttribute('data-invoice'));

                                                        let action = $(this).val()

                                                        if (action == 'print') {
                                                            window.print()
                                                            return;
                                                        }

                                                        if (invoiceSelected.length > 0) {
                                                            $("#loadingSpinner").show();
                                                            $(this).prop('disabled', true);

                                                            $.ajax({
                                                                type: "POST",
                                                                url: "update_bill.php",
                                                                data: {
                                                                    invoiceSelected,
                                                                    action
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
                        } elseif (isset($_GET['add_bill']) && $_GET['add_bill'] == 'true' && !isset($_GET['update'])) {
                            require_once './add_bill.php';
                        ?>
                            <form action="" method="POST" class="bg-white p-2 p-md-5" style="border-radius: 40px;">
                                <h4 class="text-primary fw-bold">Add Bill</h4>
                                <div class="mb-3 px-2">
                                    <label for="selected_customer" class="form-label">Select Customer</label>
                                    <select required class="form-select" name="selected_customer" id="selected_customer">
                                        <option selected class="d-none" disabled value="">--- Selected one ---</option>
                                        <?php
                                        $customer = getRows("status='Active' AND role='user'", "accounts");
                                        foreach ($customer as $row) {
                                            echo '<option value="' . $row['account_no'] . '" data-account-no="' . $row['account_no'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . ' - ' . $row['account_no'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row px-3">
                                    <div class="mb-3 px-2 col">
                                        <label for="from_date" class="form-label">From:</label>
                                        <input type="date" name="from_date" id="from_date" class="form-control input" required>
                                    </div>

                                    <div class="mb-3 px-2 col">
                                        <label for="to_date" class="form-label">To:</label>
                                        <input type="date" name="to_date" id="to_date" class="form-control input" required>
                                    </div>
                                </div>
                                <input type="hidden" id="_total" name="total">
                                <div class="mb-3 px-2 col" id="package_and_coverage" style="display: none;"></div>
                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 text-white" style="border-radius: 20px;">Generate bill</button>
                                </div>
                            </form>
                            <script>
                                $(function() {
                                    $('#selected_customer').change(function() {
                                        fetch(
                                                `./get_user_package.php?tablename=user_package&account_no=${$(this).find(':selected').data('account-no')}`
                                            )
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.length) {
                                                    let option = '';
                                                    data.forEach(row => {
                                                        const {
                                                            invoice,
                                                            package,
                                                            coverage,
                                                            account_no,
                                                            total
                                                        } = row;
                                                        $('#_total').val(total)
                                                        option +=
                                                            `<option>${package} - ${coverage}</option>`;
                                                    })
                                                    $('#package_and_coverage').show(100).html(
                                                        `<label for="package_coverage" class="form-label">Package - Coverage</label><select required name="package_coverage" id="package_coverage" class="form-select"><option selected class="d-none" disabled value="">--- Selected one ---</option>${option}</select>`
                                                    );
                                                }
                                            })
                                            .catch(err => {
                                                alert(err)
                                                console.error(err)
                                            })
                                    })
                                })
                            </script>
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
                }).then(() => {
                    location.href = 'bill.php';
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
                    location.href = 'bill.php';
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