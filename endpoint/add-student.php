<?php
include ('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

if (isset($_POST['submit'])) {
    $studentName = $_POST['student_name'];
    $studentCST = $_POST['student_cst'];
    $studentCourse = $_POST['student_course'];
    $studentPassword = $_POST['student_password'];

    // Check if the CST is unique
    $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE cst_number = ?");
    $stmt->execute([$studentCST]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('CST number must be unique.'); window.location.href='../masterlist2.php';</script>";
    } else {
        $qrCode = uniqid(); // Generating unique code

        $stmt = $conn->prepare("INSERT INTO tbl_student (student_name, cst_number, course_section, generated_code, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$studentName, $studentCST, $studentCourse, $qrCode, $studentPassword]);

        echo "<script>alert('Student added successfully.'); window.location.href='../masterlist2.php';</script>";
    }
}
?>