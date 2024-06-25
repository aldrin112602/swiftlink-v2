<?php
require_once '../config.php';
require_once '../global.php';
require_once '../send_mail.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);

    $account_no = $get['account_no'];
    $status = $get['status'];
    $report = $_GET['report'];


    // get user email
    $email = getRows("account_no='$account_no'", "accounts")[0]['email'] ?? 'caballeroaldrin02@gmail.com';

    $response;
    $body = '<p style="font-size: 18px">Dear ' . $email . ',<br><br>

    We hope this message finds you well. We would like to inform you about an issue that has been identified and apologize for any inconvenience it may have caused. Our team is actively working on resolving the matter, and we anticipate having it fixed within the next 2-5 working days.<br><br>

    We appreciate your understanding and patience during this time. If you have any further questions or concerns, please feel free to reach out to our support team at swiftlinkitsolution@gmail.com.<br><br>

    Thank you for your cooperation.<br><br>

    Best regards,<br>
    Swiftlink Support Team</p>';

    $subject = 'Swiftlink - Important Notice Regarding Ticket Report - ' . $report;

    if ($status == 'Process') {
        if (SendMail($email, $body, $subject)) {
            $sql = "UPDATE customer_ticket SET status='$status' WHERE account_no='$account_no'";
            if ($conn->query($sql)) {
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'failed'];
            }
        } else {
            $response = ['status' => 'failed'];
        }
    } else {

        $body = '<p style="font-size: 18px">Dear ' . $email . ',<br><br>
        We hope this message finds you well. We would like to inform you about an issue that has been identified and apologize for any inconvenience it may have caused.
        <br>Your ticket has been closed!<br>

        If you have any further questions or concerns, please feel free to reach out to our support team at swiftlinkitsolution@gmail.com.<br><br>

        Thank you for your cooperation.<br><br>

        Best regards,<br>
        Swiftlink Support Team </p>';

        $subject = 'Swiftlink - Important Notice Regarding Ticket Report - ' . $report;

        if (SendMail($email, $body, $subject)) {
            $sql = "UPDATE customer_ticket SET status='$status' WHERE account_no='$account_no'";
            if ($conn->query($sql)) {
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'failed'];
            }
        } else {
            $response = ['status' => 'failed'];
        }
    }



    header("Content-Type: application/json");
    echo json_encode($response);
}
