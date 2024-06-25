<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $table = mysqli_real_escape_string($conn, $_POST['table']);

    $checkDataExistence = "SELECT * FROM $table WHERE id = '$id'";
    $resultCheckData = mysqli_query($conn, $checkDataExistence);

    if (mysqli_num_rows($resultCheckData) > 0) {
        if ($table == 'customer_ticket') {
            // get document
            $document = getRows("id='$id'", $table)[0]['document'];
            if(file_exists('../user/' . $document)) unlink('../user/' . $document);
        }
        $sql = "DELETE FROM $table WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            $response = [
                'status' => 'success',
                'message' => 'Data removed successfully'
            ];

            setLog('admin', [
                'account_no' => $_SESSION['account_no'],
                'category' => 'Activity',
                'remark' => 'Removed data'
            ]);
        } else {
            $response = [
                'status' => 'error',
                'message' => mysqli_error($conn)
            ];
        }
    } else {
        // Data does not exist
        $response = [
            'status' => 'error',
            'message' => 'Data with the specified ID does not exist'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
