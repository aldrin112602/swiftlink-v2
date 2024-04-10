<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = validate_post_data($_POST);

    $id = $post['id'];
    $type = $post['type'];
    $remarks = $post['remarks'];

    if (!empty($type) && !empty($remarks)) {
        $sql = "UPDATE help_category SET type='$type', remarks='$remarks' WHERE id=$id";
        $conn->query($sql);
    }
}
