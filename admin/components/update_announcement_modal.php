<?php
$err_msg = $success_msg = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_announcement'])) {
    $post = validate_post_data($_POST);
    $announcement = $post['update_announcement'];
    $description = $post['description'];


    $uploadPath = '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $uploadDir = 'uploads/';
        $fileName = uniqid('upload_') . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $err_msg = 'Error moving the uploaded file.';
        }
    }


    $updateQuery = "UPDATE announcement SET";
    if (!empty($uploadPath)) {
        $updateQuery .= " uploaded_file = '$uploadPath',";
    }
    $updateQuery .= " announcement = $announcement, description = '$description' WHERE id = $id";
    $result = mysqli_query($conn, $updateQuery);

    if($result) {
        $success_msg = "Announcement updated successfully!";
    } else {
        $err_msg = "Error updating announcement: ". mysqli_error($conn);
    }
}
?>


<form method="post" enctype="multipart/form-data" class="modal fade" id="announcementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="announcementModalLabel">Make announcement</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                    <label for="announcement" class="form-label">announcement</label>
                    <textarea required name="announcement" id="announcement" class="form-control"></textarea>
                </div>
                <div class="mt-2">
                    <label for="description" class="form-label">description</label>
                    <textarea required name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mt-2">
                    <label for="file" class="form-label">Add image</label>
                    <input type="file" class="form-control" required name="file" accept="image/*" id="file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(() => {
        <?php
        if (isset($err_msg)) {
        ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $err_msg ?>'
            });
        <?php
        }

        if (isset($success_msg)) {
        ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= $success_msg ?>'
            });
        <?php
        }
        ?>
    })
</script>