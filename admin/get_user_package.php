<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);
    $tablename = $get['tablename'];
    $account_no = $get['account_no'];


    header("Content-Type: application/json");
    $data = getRows("account_no=$account_no AND variant='false'", $tablename);
    echo json_encode($data);
}
