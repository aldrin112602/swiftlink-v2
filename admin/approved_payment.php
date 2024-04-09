<?php
require_once "../config.php";
require_once "../global.php";
require_once "../send_mail.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice = $_POST["invoice"];
    if (isDataExists("payment_confirmation", "*", "invoice='$invoice' AND status='Pending'")) {
        $sql = "UPDATE payment_confirmation SET status='Approved' WHERE invoice='$invoice'";

        $account_no = getRows("invoice='$invoice'", "user_package")[0]['account_no'];
        $email = getRows("account_no='$account_no'", "accounts")[0]['email'];
        $body = "
        <html>
        <head>
        <title>Payment Confirmation</title>
        </head>
        <body>
        <p>Dear $email</p>
        <p style='font-size: 18px;'>We are pleased to inform you that your payment has been successfully confirmed.</p>
        <p>Thank you for choosing Swiftlink.</p>
        
        <p>Best regards,<br/>Swiftlink</p>
        </body>
        </html>
        ";

        if (SendMail($email, $body, "Payment Confirmation Approved - Swiftlink")) {
            $conn->query($sql);
            $sql = "UPDATE user_package SET status='Paid' WHERE invoice='$invoice'";
            $conn->query($sql);
            setLog('admin', [
                'account_no' => $_SESSION['account_no'],
                'category' => 'Activity',
                'remark' => 'Approved payment confirmation'
            ]);
        }
    }

    header("Content-Type: application/json");
    echo json_encode([
        'status' => 'success',
        'message' => 'Payment Confirmation approved'
    ]);
}
