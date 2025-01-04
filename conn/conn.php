<?php
$servername = "localhost";
$port = 3307; // Default MySQL port, change if necessary
$username = "root";
$password = ""; // Provide the correct password
$dbname = "qr_attendance_db";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
