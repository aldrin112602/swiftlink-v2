<?php
require_once '../config.php';
require_once '../global.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = validate_post_data($_POST);
    $condition = $_POST['condition'];
    $table = $post['table'];

    $response = null;
    if (isDataExists($table, "*", $condition)) {
        if ($table == 'customer_ticket') {
            // get document
            $document = getRows("$condition", $table)[0]['document'];
            if (file_exists('./' . $document)) unlink('./' . $document);
        }



        $sql = "DELETE FROM $table WHERE $condition";
        if (mysqli_query($conn, $sql)) {
            $response = [
                'status' => 'success',
                'message' => 'Data removed successfully'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => mysqli_error($conn)
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data not removed'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
