<?php   
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);
    $type = $post['type'];
    $remarks = $post['remarks'];

    if(!empty($type) && !empty($remarks)) {
        $sql = "INSERT INTO help_category(type, remarks) VALUES('$type', '$remarks')";
        setLog('admin', [
            'account_no' => $_SESSION['account_no'],
            'category' => 'Activity',
            'remark' => 'Added category'
        ]);
        $conn->query($sql);
    }
}