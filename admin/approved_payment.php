<?php
require_once "../config.php";
require_once "../global.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice = $_POST["invoice"];

    // check if the data is exist
    if(isDataExists("payment_confirmation", "*", "invoice='$invoice' AND status='Pending'")) {
        $sql = "UPDATE payment_confirmation SET status='Approved' WHERE invoice='$invoice'";
        $conn->query($sql);
        $sql = "UPDATE user_package SET status='Paid' WHERE invoice='$invoice'";
        $conn->query($sql);
        setLog('admin', [
            'account_no' => $_SESSION['account_no'],
            'category' => 'Activity',
            'remark' => 'Approved payment confirmation'
                                    ]);
    }

    header("Content-Type: application/json");
    echo json_encode([
        'status' => 'success',
        'message' => 'Payment Confirmation approved'
    ]);
}

