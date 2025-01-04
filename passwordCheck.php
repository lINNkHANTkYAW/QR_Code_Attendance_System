<?php
// Function to verify user credentials
function verify_user($username, $password) {
    $filename = 'users.txt';
    if (!file_exists($filename)) {
        return false;
    }
    $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $user) {
        list($stored_username, $stored_hashed_password) = explode(':', $user);
        if ($stored_username === $username && password_verify($password, $stored_hashed_password)) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (verify_user($username, $password)) {
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php?error=' . urlencode("Incorrect username or password"));
        exit();
    }
}
?>