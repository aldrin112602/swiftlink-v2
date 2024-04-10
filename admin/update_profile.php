<?php
require_once '../config.php';
require_once '../global.php';
if (isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'profile/';
        $fileName = uniqid('profile_') . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $sql = "UPDATE accounts SET profile = '$uploadPath' WHERE email= '{$_SESSION['email']}'";
            setLog('admin', [
                'account_no' => $_SESSION['account_no'],
                'category' => 'Activity',
                'remark' => 'Updated profile picture'
            ]);
            mysqli_query($conn, $sql);
        } else {
            echo 'Error moving the uploaded file.';
        }
    } else {
        echo 'Error during file upload. Error code: ' . $file['error'];
    }
}
