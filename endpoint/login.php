<?php
session_start();
include('C:\XAMPP NEW\htdocs\final_project\conn\conn.php'); // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $name = trim($_POST['name']);
    $course_section = strtoupper(trim($_POST['course_section'])); // Ensure course_section is always uppercase
    $subject_code = trim($_POST['subject_code']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($name) || empty($course_section) || empty($subject_code) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../login.php");
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM tbl_teacher WHERE teacher_name = :name AND course_section = :course_section AND subject_code = :subject_code");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':course_section', $course_section);
    $stmt->bindParam(':subject_code', $subject_code);
    $stmt->execute();

    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($teacher) {
        // Check if the password matches (use password_verify if passwords are hashed)
        if ($password === $teacher['password']) {
            // Store teacher info in the session
            $_SESSION['teacher_id'] = $teacher['tbl_teacher_id'];
            $_SESSION['teacher_name'] = $teacher['teacher_name'];
            $_SESSION['course_section'] = $teacher['course_section'];
            $_SESSION['subject_code'] = $teacher['subject_code'];
            
            // Store sections into session
            $sections = explode(",", $teacher['course_section']);
            $_SESSION['sections'] = $sections;

            // Redirect based on the section (use absolute paths)
            switch (strtoupper($course_section)) {
                case 'A':
                    header('Location: /final_project/sections.php');
                    break;
                case 'B':
                    header('Location: /final_project/sections.php');
                    break;
                case 'C':
                    header('Location: /final_project/sections.php');
                    break;
                default:
                    // Handle any other sections or unexpected values
                    $_SESSION['error'] = "Invalid section.";
                    header('Location: ../login.php');
                    exit();
            }
            exit();
        } else {
            // Invalid password
            $_SESSION['error'] = "Invalid Password.";
            header("Location: ../login.php");
            exit();
        }
    } else {
        // No teacher found
        $_SESSION['error'] = "Invalid Name, Course & Section, or Subject Code.";
        header("Location: ../login.php");
        exit();
    }
} else {
    // Invalid request method
    header("Location: ../login.php");
    exit();
}
