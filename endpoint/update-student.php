<?php
include ('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['student_name'], $_POST['cst_number'], $_POST['course_section'], $_POST['password'], $_POST['tbl_student_id'])) {
        $studentId = $_POST['tbl_student_id'];
        $studentName = $_POST['student_name'];
        $studentCST = $_POST['cst_number'];
        $studentCourse = $_POST['course_section'];
        $studentPassword = $_POST['password'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_student SET student_name = :student_name, cst_number = :cst_number, course_section = :course_section, password = :password WHERE tbl_student_id = :tbl_student_id");
            $stmt->bindParam(":tbl_student_id", $studentId, PDO::PARAM_INT);
            $stmt->bindParam(":student_name", $studentName, PDO::PARAM_STR);
            $stmt->bindParam(":cst_number", $studentCST, PDO::PARAM_STR);
            $stmt->bindParam(":course_section", $studentCourse, PDO::PARAM_STR);
            $stmt->bindParam(":password", $studentPassword, PDO::PARAM_STR);

            if($stmt->execute()) {
                echo "Success";
            } else {
                echo "Failed to update the student.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields!";
    }
}
