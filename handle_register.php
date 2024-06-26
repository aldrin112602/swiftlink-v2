<?php
require_once './config.php';
require_once './global.php';

$phone = $password = $firstname = $email = $err_msg = $success_msg = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form fields
    $post = validate_post_data($_POST);
    $email = $post["email"] ?? "";
    $phone = $post["phone"] ?? "";
    $password = $post["password"] ?? "";
    $hashPass = $password;
    $confirm_password = $post["confirm_password"] ?? "";
    $firstname = $post["firstname"] ?? "";
    $middle_initial = $post["middle_initial"] ?? "";
    $lastname = $post["lastname"] ?? "";
    $address = $post["address"] ?? "";
    $town = $post["town"] ?? "";
    $city = $post["city"] ?? "";
    $province = $post["province"] ?? "";
    $postal_code = $post["postal_code"] ?? "";
    $account_no = generateRandomNumber(24);

    $coverage = $post["coverage"] ?? "";
    $package = $post["package"] ?? "";
    $total = $post["price"] ?? "";
    $invoice = generateRandomNumber(9);

    // set due date and period
    $currentDate = new DateTime();
    $currentDate->add(new DateInterval('P1M'));
    $period = $currentDate->format('M Y');
    $dueDate = $currentDate->format('d M Y');


    // Handle file upload
    $targetDir = "uploads/" . uniqid();
    $targetFile = '';
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $targetFile = $targetDir . '-' . basename($_FILES["file"]["name"]);
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $err_msg = "Sorry, there was an error uploading your file.";
            return;
        }
    } else {
        $err_msg = "Error: " . $_FILES["file"]["error"];
        return;
    }

    if (isDataExists("accounts", "*", "email = '$email'")) {
        $err_msg = "Email already registered";
    } elseif (strlen($password) < 6) {
        $err_msg = "Password must atleast 6 or more characters.";
        return;
    } elseif ($password != $confirm_password) {
        $err_msg = "Confirm password did not match.";
        return;
    } else {
        $sql = "INSERT INTO accounts (email, phone, password, firstname, middle_initial, lastname, address, town, city, province, account_no, valid_id, postal_code)
        VALUES ('$email', '$phone', '$hashPass', '$firstname', '$middle_initial', '$lastname', '$address', '$town', '$city', '$province', '$account_no', '$targetFile', '$postal_code')";

        $sql2 = "INSERT INTO user_package (account_no, invoice, package, coverage, total, period, due_date)
        VALUES ('$account_no', '$invoice', '$package', '$coverage', $total, '$period', '$dueDate')";

        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: "Thank you for signing up",
                        text: "We will send you an email when the registration is approved",
                        icon: "success",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Go to login'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = './login.php';
                        }
                    });

                })
            </script>
<?php
        } else {
        }
    }

    if (isset($err_msg) && file_exists($targetFile)) {
        unlink($targetFile);
    }
}



if (isset($_SESSION['role'])) {
    switch($_SESSION['role']) {
        case 'admin':
            header('location: ./admin/');
        break;
        case 'user':
            header('location: ./user/');
        break;
        case 'lineman':
            header('location: ./lineman/');
        break;
    }
}
