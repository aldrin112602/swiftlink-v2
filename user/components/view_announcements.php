<?php
$rows = getRows(null, "announcement");
?>
<div class="modal fade" id="viewAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewAnnouncementModalLabel">Announcements</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0"  style="max-height: 300px; overflow: auto;">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Announcement</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Date</th>

                </tr>
            </thead>
            <tbody>
               <?php
               foreach ($rows as $row) {
                ?>
                <tr>
                    <td><?= $row['announcement']?></td>
                    <td><?= $row['description']?></td>
                    <td>
                        <img style="height: 60px; width: 60px; object-fit: cover;" src="../admin/<?= $row['uploaded_file']?>" alt="<?= $row['uploaded_file']?>">
                    </td>
                    <td><?= $row['date']?></td>
                </tr>
               <?php
               }
               ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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