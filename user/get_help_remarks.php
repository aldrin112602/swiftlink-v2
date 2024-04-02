<?php
require_once "../config.php";
require_once "../global.php";

header("Content-Type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['type'])) {
    $get = validate_post_data($_GET);
    $type = $get['type'];

    $data = getRows("type='$type'", "help_remarks");
    echo json_encode($data);
} else {
    echo json_encode([]);
}