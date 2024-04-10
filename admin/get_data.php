<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);
    $tablename = $get['tablename'];
    $id = $get['id'];


    header("Content-Type: application/json");
    $data = getRows("id=$id", $tablename);
    echo json_encode($data);
}
