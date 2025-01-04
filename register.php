<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="text" id="id" name="id" pattern="CST-\d{4}" title="Format: CST-####" placeholder="ID (Format: CST-####)" required>
            </div>
            <div class="form-group">
                <input type="text" id="section" name="section"  placeholder="Section" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already registered? <a href="index.html#login">Login here</a></p>
    </div>

    <?php
    // Registration Logic
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
        $username = $_POST["username"];
        $id = $_POST["id"];
        $section = $_POST["section"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password !== $confirm_password) {
            echo "<p>Passwords do not match.</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $data = "$username,$id,$section,$hashed_password" . PHP_EOL;
            $file = fopen("users.txt", "a");
            fwrite($file, $data);
            fclose($file);

            echo '<script>alert("Registered successfully! Login now."); window.location.replace("index.html#login");</script>';
            exit;
        }
    }
    ?>
</body>
</html>
