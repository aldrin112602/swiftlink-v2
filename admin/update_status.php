<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require "../vendor/autoload.php";
require_once "../config.php";
require_once "../global.php";
require_once "../send_mail.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $emailSelected = $_POST["emailSelected"];
    $table = mysqli_real_escape_string($conn, $_POST["table"]);
    $status = ucwords(mysqli_real_escape_string($conn, $_POST["status"]));

    if ($status == "Active" && count($emailSelected) > 0) {
        foreach ($emailSelected as $key => $email) {
            $sql = "SELECT * FROM $table WHERE email = '$email' AND verified = 'false' AND role = 'user'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "caballeroaldrin02@gmail.com";
                    $mail->Password = "psfgjxovixwhnjtd";
                    $mail->SMTPSecure = "ssl";
                    $mail->Port = 465;
                    $mail->setFrom(
                        "caballeroaldrin02@gmail.com",
                        "Swiftlink",
                        true
                    );
                    $mail->isHTML(true);
                    $mail->Subject =
                        "Congratulations, registration approved successfully - Swiftlink";
                    $mail->addAddress($email);
                    $row = $result->fetch_assoc();
                    $mail->Body =
                        "Dear $email,<br>Your registration has been approved. Welcome to Swiftlink!<br><br>
                        Heres your credentials:<br>
                        Email: " .
                        $row["email"] .
                        "<br>
                        Password: " .
                        $row["password"] .
                        "<br>
                        ";
                    if ($mail->send()) {
                        $sql = "UPDATE accounts SET verified = 'true' WHERE email = '$email'";
                        $conn->query($sql);
                    }
                } catch (Exception $e) {
                    error_log("Exception caught: " . $e->getMessage());
                    $response = [
                        "status" => "error",
                        "message" => "An error occurred while sending emails.",
                    ];
                    break;
                }
            }
        }
    }

    if (!isset($response)) {
        foreach ($id as $key => $value) {
            $sql = "UPDATE $table SET status = '$status' WHERE id = $value";
            if ($status == 'Inactive') {
                $email = getRows("id='$value'", "accounts")[0]['email'];
                $current_date = date("F j, Y");
                $body = "
                <p style=\"font-size: 18px;\">
                Dear $email, <br><br>
                We regret to inform you that your account has been deactivated as of $current_date. <br><br>
                Should you require any assistance or wish to address any concerns, please feel free to reach out to us at swiftlinkitsolution@gmail.com. <br><br>
                Best regards, <br>
                <b>Swiftlink</b>
                </p>
                ";



                if (SendMail($email, $body, "Your account has been Deactivated - Swiftlink")) {
                    if (mysqli_query($conn, $sql)) {
                        $response = [
                            "status" => "success",
                            "message" => "Data updated successfully",
                        ];

                        setLog('admin', [
                            'account_no' => $_SESSION['account_no'],
                            'category' => 'Activity',
                            'remark' => 'Approved user registration'
                        ]);
                    } else {
                        $response = [
                            "status" => "error",
                            "message" => mysqli_error($conn),
                        ];
                        break;
                    }
                }
            }
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
