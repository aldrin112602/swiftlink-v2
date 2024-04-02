<?php   
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);

    $id = $post['id'];
    $help = $post['help'];
    $type = $post['type'];
    $remarks = $post['remarks'];

    $sql = "UPDATE help_remarks SET help='$help', type='$type', remarks='$remarks' WHERE id=$id";
    $conn->query($sql);
}