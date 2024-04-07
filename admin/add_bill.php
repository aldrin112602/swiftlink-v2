<?php

require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);

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

    $insertQuery = "INSERT INTO user_package (account_no, invoice, package, coverage, total, period, due_date, process_status, variant, status)
    VALUES ('$account_no', '$invoice', '$package', '$coverage', $total, '$period', '$dueDate', 'Done', 'true', 'Paid')";

    if($conn->query($insertQuery)) {
        $success_msg = "Bill added successfully";
    } else {
        $error_msg = "Something went wrong, please try again";
    }
}
