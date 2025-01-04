<?php
// Validate the admin credentials
function validateAdmin($admin_name, $admin_password, $admin_id) {
    // Set the default admin credentials
    $correct_admin_name = "Student Affairs";
    $correct_admin_id = "2025";
    $correct_admin_password = "qrcode2025";

    // Validate the input against the default credentials
    if ($admin_name === $correct_admin_name && $admin_id === $correct_admin_id && $admin_password === $correct_admin_password) {
        return true;
    }
    return false;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_name = $_POST['admin_name'];
    $admin_id = $_POST['admin_id'];
    $admin_password = $_POST['admin_password'];

    if (validateAdmin($admin_name, $admin_password, $admin_id)) {
        header('Location: admin.php');
        exit();
    } else {
        $error = "Incorrect admin name, admin ID, or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrapper">
        <form action="admin_login.php" method="post">
            <h1>Admin Login</h1>
            <?php
            if (!empty($error)) {
                echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
            }
            ?>
            <div class="input-box">
                <input type="text" name="admin_name" placeholder="Admin Name" required>
                <i class="fa fa-solid fa-user" style="color: #fff;"></i>
            </div>
            <div class="input-box">
                <input type="text" name="admin_id" placeholder="Admin ID" required>
                <i class="fa fa-solid fa-id-card" style="color: #fff;"></i>
            </div>
            <div class="input-box">
                <input type="password" name="admin_password" placeholder="Password" required>
                <i class="fa fa-solid fa-lock" style="color: #fff;"></i>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
