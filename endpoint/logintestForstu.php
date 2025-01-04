<?php
session_start();
include('C:\XAMPP NEW\htdocs\final_project\conn\conn.php'); // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $student_name = trim($_POST['name']);  
    $course_section = trim($_POST['course_section']);
    $cst_number = trim($_POST['cst_number']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($student_name) || empty($course_section) || empty($cst_number) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../logintestForstu.php");
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE student_name = :student_name AND course_section = :course_section AND cst_number = :cst_number AND password = :password");
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':course_section', $course_section);
    $stmt->bindParam(':cst_number', $cst_number);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        // Authentication successful
        $_SESSION['student_id'] = $student['tbl_student_id'];
        $_SESSION['student_name'] = $student['student_name'];
        $_SESSION['course_section'] = $student['course_section'];
        $_SESSION['cst_number'] = $student['cst_number'];

        // Redirect based on the section
        header("Location: ../majorsForStudent.php?section=" . urlencode($student['course_section']));
        exit();
    } else {
        // Authentication failed
        $_SESSION['error'] = "Invalid Name, Course & Section, CST Number, or Password.";
        header("Location: ../logintestForstu.php");
        exit();
    }
} else {
    // Invalid request method
    header("Location: ../logintestForstu.php");
    exit();
}
