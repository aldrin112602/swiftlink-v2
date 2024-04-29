<?php
$err_msg = $success_msg = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['announcement'])) {
    $post = validate_post_data($_POST);
    $announcement = $post['announcement'];
    $description = $post['description'];
    $file = $_FILES['file'];

    $target_dir = "uploads/" . uniqid() . "_";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    if ($file["size"] > 500000) {
        $uploadOk = 0;
    }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $err_msg = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $sql = "INSERT INTO announcement (announcement, description, uploaded_file) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $announcement, $description, $target_file);
            $stmt->execute();
            $success_msg = "Record inserted successfully.";
        } else {
            $err_msg = "Sorry, there was an error uploading your file.";
        }
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