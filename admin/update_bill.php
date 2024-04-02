<?php
require_once "../config.php";
require_once "../global.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoiceSelected = $_POST["invoiceSelected"];
    $action = ucwords($_POST["action"]);
    

    $response = null;

    foreach($invoiceSelected as $value) {
        if($action == 'Delete') {
            $conn->query("DELETE FROM user_package WHERE invoice='$value'");
        } else {
            $conn->query("UPDATE user_package SET status='$action' WHERE invoice='$value'");
        }
        
    }

    if (!isset($response)) {
        $response = [
            "status" => "success",
            "message" => (strtolower($action) == 'delete' ? "Data removed successfully":"Data updated successfully"),
        ];

        setLog('admin', [
            'account_no' => $_SESSION['account_no'],
            'category' => 'Activity',
            'remark' => 'Update user bill/s to ' . $action
        ]);

        
    } else {
        $response = [
            "status" => "error",
            "message" => mysqli_error($conn),
        ];
                
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
