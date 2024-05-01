<?php
$err_msg = $success_msg = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_announcement']) && isset($_GET['update'])) {
    $post = validate_post_data($_POST);
    $announcement = $post['update_announcement'];
    $description = $post['description'];

    $id = validate_post_data($_GET)['update'];


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
    $updateQuery .= " announcement = '$announcement', description = '$description' WHERE id = $id";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        $success_msg = "Announcement updated successfully!";
        unset($_GET['update']);
        $_GET['update'] = null;
    } else {
        $err_msg = "Error updating announcement: " . mysqli_error($conn);
    }
}


$row = [];
if (isset($_GET['update'])) {
?>
    <script>
        $(() => {
            $('#updateAnnouncementModal').modal('show')
        })
    </script>

<?php
    $id = validate_post_data($_GET)['update'];
    $row = getRows("id='$id'", "announcement")[0] ?? [];
    if(count($row) == 0) {
        ?>
        <script>
            location.href = "index.php";
        </script>
        <?php
    } 
}
?>




<form method="post" enctype="multipart/form-data" class="modal fade" id="updateAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateAnnouncementModalLabel">Update announcement</h1>
                <a class="btn-close" href="./index.php" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                    <label for="announcement" class="form-label">announcement</label>
                    <textarea required name="update_announcement" id="announcement" class="form-control"><?= $row['announcement'] ?></textarea>
                </div>
                <div class="mt-2">
                    <label for="description" class="form-label">description</label>
                    <textarea required name="description" id="description" class="form-control"><?= $row['description'] ?></textarea>
                </div>
                <div class="mt-2">
                    <label for="file" class="form-label">Add image</label>
                    <input type="file" class="form-control" name="file" accept="image/*" id="file">
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="./index.php">Cancel</a>
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
            }).then(() => {
                location.href = "index.php";
            })
        <?php
        }

        if (isset($success_msg)) {
        ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= $success_msg ?>'
            }).then(() => {
                location.href = "index.php";
            })
        <?php
        }
        ?>
    })
</script>