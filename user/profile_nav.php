<div class="col d-flex align-items-center justify-content-end gap-4">
    <?php
        date_default_timezone_set('Asia/Manila');
        $formattedDateTime = date('l d-m-Y H:i:s');
    ?>
    <h6 class="fw-bold mt-4"><?= $formattedDateTime ?></h6>
    <div class="bg-white text-center d-flex align-items-center justify-content-center"
        style="border-radius: 50px; flex-direction: column; height: 60px; width: 400px; line-height: -50px; position: relative;">
        <p class="mt-4" style="margin-right: 20px;">
            <span class="fw-bold"><?= $_SESSION[ 'name' ] ?></span><br>
            <span style="font-size: 12px;">
                <?= $_SESSION[ 'role' ] == 'admin' ? 'Administrator' : 'Customer' ?></span>
        </p>
        <?php
        $user = getRows("email = '{$_SESSION['email']}'", 'accounts')[0];
        ?>
        <img id="profile" alt="Profile"
            src="<?= $user[ 'profile' ] ?? 'https://www.oneeducation.org.uk/wp-content/uploads/2020/06/cool-profile-icons-69.png'  ?>"
            class="rounded-circle"
            style="position: absolute; right: 7px; height: 50px; width: 50px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <input type="file" accept="image/*" class="d-none" id="chooseFile">
    </div>
</div>
<script>
$(document).ready(function() {
    $('#profile').on('click', function() {
        Swal.fire({
            title: "Change profile",
            text: "Do you want to Update your profile?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Continue"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#chooseFile').click();
            }
        });

    })

    $('#chooseFile').on('change', function() {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#profile').attr('src', e.target.result);

            let formData = new FormData();
            formData.append('profileImage', $('#chooseFile')[0].files[0]);

            $.ajax({
                url: 'update_profile.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire(
                        'Success!',
                        'Profile updated successfully',
                        'success'
                    )
                },
                error: function(error) {
                    Swal.fire(
                        'Error!',
                        'Failed to update profile',
                        'success'
                    )
                }
            });
        }
        reader.readAsDataURL($('#chooseFile').prop('files')[0]);


    })
})
</script>