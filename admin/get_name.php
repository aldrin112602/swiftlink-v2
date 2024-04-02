<?php   
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);
    $account_no = $get['account_no'];
    $data = getRows("account_no='$account_no'", "accounts");
    $name = $data[0]['firstname'] . ' ' . $data[0]['lastname'];
    
    header("Content-Type: application/json");
    echo json_encode([
        'name' => $name
    ]);
}