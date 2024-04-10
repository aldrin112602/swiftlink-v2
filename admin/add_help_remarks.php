<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);
    $help = $post['help'];
    $type = $post['type'];
    $remarks = $post['remarks'];

    $sql = "INSERT INTO help_remarks(help, type, remarks) VALUES('$help','$type', '$remarks')";
    setLog('admin', [
        'account_no' => $_SESSION['account_no'],
        'category' => 'Activity',
        'remark' => 'Added help remarks'
    ]);
    $conn->query($sql);
}
