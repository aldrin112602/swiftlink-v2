<?php

require_once '../config.php';
require_once '../global.php';
require_once "../send_mail.php";


$err_msg = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);

    if (explode('-', $post['to_date'])[1] == explode('-', $post['from_date'])[1]) {
        echo "<script>alert('Invalid date, please try again')</script>";
    } else {
        $account_no = $post['selected_customer'];
        $to_date = new DateTime($post['to_date']);
        $from_date = new DateTime($post['from_date']);

        $package_coverage = explode(" - ", $post['package_coverage']);
        $total = $post['total'];


        $coverage = trim($package_coverage[1]);
        $package = trim($package_coverage[0]);
        $category = $post['category'] ?? 'Fiber';
        $invoice = generateRandomNumber(9);


        $period = $to_date->format('M Y');
        $dueDate = $to_date->format('d M Y');

        $insertQuery = "INSERT INTO user_package (account_no, invoice, package, coverage, total, period, due_date, process_status, variant, status) VALUES ('$account_no', '$invoice', '$package', '$coverage', $total, '$period', '$dueDate', 'Done', 'true', 'Paid')";

        $email = getRows("account_no='$account_no'", "accounts")[0]['email'];

        $body = "";

        $body .= "<p style='font-size: 18px'>Dear $email,<br><br>";
        $body .= "We are pleased to inform you that your recent bill has been successfully processed.<br><br>";
        $body .= "Below are the details of your bill:<br><br>";
        $body .= "<strong>Account Number:</strong> $account_no<br>";
        $body .= "<strong>Package:</strong> $package<br>";
        $body .= "<strong>Coverage:</strong> $coverage<br>";
        // $body .= "<strong>Total Amount Due:</strong> $total<br>";
        $body .= "<strong>Invoice Period:</strong> $period<br>";
        $body .= "<strong>Due Date:</strong> $dueDate<br><br>";
        $body .= "If you have any questions or concerns regarding this bill, please feel free to contact us.<br><br>";
        $body .= "Thank you for choosing Swiftlink!<br>";
        $body .= "</p>";


        if (SendMail($email, $body, "Bill added successfully - Swiftlink")) {
            if ($conn->query($insertQuery)) {
                echo '<script>
                $(() => {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Bill added successfully",
                    });
                })
              </script>';
            } else {
                $error_msg = "Something went wrong, please try again";
            }
        }
    }
}
