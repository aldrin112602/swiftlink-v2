<?php   
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);
    $table = $get['table'];
    $condition = base64_decode($get['condition']);

    
    header("Content-Type: application/json");
    $data = getRows("$condition", $table);
    echo json_encode($data);
}