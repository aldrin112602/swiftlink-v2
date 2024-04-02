<?php   
require_once '../config.php';
require_once '../global.php';
require_once '../send_mail.php';


header("Content-Type: application/json");



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $get = validate_post_data($_GET);
    $tablename = $get['table'];
    $id = $get['id'];
    $dateSelected = $get['dateSelected'];
    $action = strtolower($get['action']);

    $sql = "";

    switch($action) {
        case 'process':
            $sql = "UPDATE $tablename SET process_status='Process' WHERE id='$id'";
            $response = [
                'message' => 'Customer package updated successfully',
                'status' => 'success'
            ];

            
            $account_no = getRows("id='$id'", $tablename)[0]['account_no'];
            $email = getRows("account_no='$account_no'", "accounts")[0]['email'];

            $subject = "Customer Package Update Notification";
            $bodytemplate = "<p style=\"font-size: 20px;\"><p style=\"font-size: 20px;\">Dear " . $email . ",<br><br>We are writing to inform you that your package has been successfully updated and is now in process as of $dateSelected. Please prepare <b>500.00 PHP</b> for the installation fee.<br><br>
            Thank you for choosing our services.<br><br>Best regards,<br>Swiftlink </p>";


            if(SendMail($email, $bodytemplate, $subject)) {
                setLog('admin', [
                    'account_no' => $_SESSION['account_no'],
                    'category' => 'Activity',
                    'remark' => 'Updated data'
                ]);
                if(!$conn->query($sql)) {
                    $response = [
                        'message' => 'Something went wrong please try again',
                        'status' => 'error'
                    ];
                }
            } else {
                $response = [
                    'message' => 'Something went wrong, please check your internet connection',
                    'status' => 'error'
                ];
            }
        break;
        case 'delete':
            $sql = "DELETE FROM $tablename WHERE id='$id'";
        
            if($conn->query($sql)) {
                $response = [
                    'message' => 'Data deleted successfully',
                    'status' => 'success'
                ];
            } else {
                $response = [
                    'message' => 'Failed to remove data',
                    'status' => 'error'
                ];
            } 
        break;
        case 'done':
            $sql = "UPDATE $tablename SET process_status='Done' WHERE id='$id'";
            $response = [
                'message' => 'Customer package updated successfully',
                'status' => 'success'
            ];

            $account_no = getRows("id='$id'", $tablename)[0]['account_no'];
            $email = getRows("account_no='$account_no'", "accounts")[0]['email'];

            
            $subject = "Customer Package Update: Completed";
            $bodytemplate = "<p style=\"font-size: 20px;\"> Dear " . $email . ",<br><br>We are pleased to inform you that your package has been successfully completed.<br><br>If you have any further inquiries or require assistance, please feel free to contact us.<br><br>Thank you for choosing our services.<br><br>Best regards, <br>Swiftlink </p>";


            if(SendMail($email, $bodytemplate, $subject)) {
                setLog('admin', [
                    'account_no' => $_SESSION['account_no'],
                    'category' => 'Activity',
                    'remark' => 'Updated data'
                ]);

                if(!$conn->query($sql)) {
                    $response = [
                        'message' => 'Something went wrong please try again',
                        'status' => 'error'
                    ];
                }
            } else {
                $response = [
                    'message' => 'Something went wrong, please check your internet connection',
                    'status' => 'error'
                ];
            }
        break;
    }

    echo json_encode($response);
}