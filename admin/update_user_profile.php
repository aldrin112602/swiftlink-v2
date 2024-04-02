<?php
require_once '../config.php';
require_once '../global.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];
    $account_no = $_POST['account_no'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../user/profile/';
        $fileName = uniqid('profile_') . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;
        $user_location_path = 'profile/' . $fileName;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $sql = "UPDATE accounts SET profile = '$user_location_path' WHERE account_no = '$account_no'";
            setLog('admin', [
                'account_no' => $_SESSION['account_no'],
                'category' => 'Activity',
                'remark' => 'Updated user profile picture'
            ]);
            if(mysqli_query($conn, $sql)) {
                $response = [
                    "status" => "success",
                    "message" => "Profile updated successfully",
                ];
            } else {
                
                $response = [
                    "status" => "error",
                    "message" => 'Error updating record: '. mysqli_error($conn),
                ];
            }

        } else {
            
            $response = [
                "status" => "error",
                "message" => 'Error moving the uploaded file.',
            ];
        }
    } else {

        $response = [
            "status" => "error",
            "message" => 'Error during file upload. Error code: ' . $file['error'],
        ];
    }




    header("Content-Type: application/json");
    echo json_encode($response);
}

