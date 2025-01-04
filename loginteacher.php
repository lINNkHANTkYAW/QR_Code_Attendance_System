<?php

function validateUser($username, $password, $teacher_id, $section) {
    $users_file = "users.txt";
    $lines = file($users_file, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        list($stored_username, $stored_teacher_id, $stored_section, $stored_password) = explode(",", $line);
        if ($username === $stored_username && $teacher_id === $stored_teacher_id && $section === $stored_section && password_verify($password, trim($stored_password))) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $teacher_id = $_POST['teacher_id'];
    $section = $_POST['section'];
    $password = $_POST['password'];

    if (validateUser($username, $password, $teacher_id, $section)) {
        // Redirect based on the section
        switch ($section) {
            case 'a':
                header('Location: sectionAtr.php');
                break;
            case 'b':
                header('Location: sectionBtr.php');
                break;
            case 'c':
                header('Location: sectionCtr.php');
                break;
            case 'A':
                header('Location: sectionAtr.php');
                break;
            case 'B':
                header('Location: sectionBtr.php');
                break;
            case 'C':
                header('Location: sectionCtr.php');
                break;
            default:
                // Handle any other sections or unexpected values
                $error = "Invalid section.";
                header('Location: loginteacher.php?error=' . urlencode($error));
                exit();
        }
        exit();
    } else {
        $error = "Incorrect username, teacher ID, section, or password.";
        header('Location: loginteacher.php?error=' . urlencode($error));
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrapper">
        <form action="loginteacher.php" method="post">
            <h1>Login</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa fa-solid fa-user" style="color: #fff;"></i>
            </div>
            <div class="input-box">
                <input type="text" name="teacher_id" placeholder="Teacher ID" required>
                <i class="fa fa-solid fa-id-card" style="color: #fff;"></i>
            </div>
            <div class="input-box">
                <input type="text" name="section" placeholder="Section" required>
                <i class="fa fa-solid fa-user" style="color: #fff;"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa fa-solid fa-lock" style="color: #fff;"></i>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
