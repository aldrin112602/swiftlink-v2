<?php
require_once "../config.php";
require_once "../global.php";
require_once "../send_mail.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice = $_POST["invoice"];

    $msg = [];
    // check if the data is exist
    if(isDataExists("payment_confirmation", "*", "invoice='$invoice' AND status='Pending'")) {
        // $sql = "UPDATE payment_confirmation SET status='Approved' WHERE invoice='$invoice'";
        // $conn->query($sql);

        // get user email first
        $sql = "SELECT pc.invoice, ac.account_no, ac.email, up.invoice, up.account_no
        FROM payment_confirmation AS pc
        JOIN user_package AS up ON pc.invoice = up.invoice
        JOIN accounts AS ac ON ac.account_no = up.account_no
        WHERE up.invoice = '$invoice'";

        $result = $conn->query($sql);
        $email = $result->fetch_all(MYSQLI_ASSOC)[0]['email'];

        $body = "<h2>
        Dear ". $email .", <br>
        We regret to inform you that we cannot process your payment due to incomplete information provided. Please review and resubmit with all required details accurately.
        <br><br>
        Thank you for your cooperation.
        <br><br>
        Best regards,<br>
        Swiftlink
        </h2>";
        $subject = 'Payment Confirmation Declined';

        if(SendMail($email, $body, $subject)) {
            $sql = "DELETE FROM payment_confirmation WHERE invoice = '$invoice'";
            if($conn->query($sql)) {
                $msg = [
                    'status' => 'success',
                    'message' => 'Payment confirmation denied successfully'
                ];
            } else {
                $msg = [
                    'status' => 'error',
                    'message' => 'Failed to delete payment confirmation'
                ];
            }
        }


    } else {
        $msg = [
            'status' => 'error',
            'message' => 'Data did not exist'
        ];
    }

    header("Content-Type: application/json");
    echo json_encode($msg);
}

