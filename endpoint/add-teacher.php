<?php
include('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

if (isset($_POST['submit'])) {
    $teacherName = $_POST['teacher_name'];
    $courseSection = $_POST['course_section'];
    $subjectCode = $_POST['subject_code'];
    $password = $_POST['password'];

    // Validate Course & Section (only A, B, or C)
    if (!preg_match('/^[A-C]{1,2}$/', $courseSection)) {
        echo "<script>alert('Invalid Course & Section. Only A, B, or C allowed.'); window.location.href='../admin.php';</script>";
        exit;
    }

    // Validate Subject Code
    $validSubjectCodes = ['5307', '5105', '5203', '5306', '5404', '5405'];
    if (!in_array($subjectCode, $validSubjectCodes)) {
        echo "<script>alert('Invalid Subject Code.'); window.location.href='../admin.php';</script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tbl_teacher (teacher_name, course_section, subject_code, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$teacherName, $courseSection, $subjectCode, $password]);

    echo "<script>alert('Teacher added successfully.'); window.location.href='../admin.php';</script>";
}
?>
