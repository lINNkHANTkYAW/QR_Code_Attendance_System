<?php
include ('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

if (isset($_GET['student'])) {
    $student = $_GET['student'];

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Set tbl_student_id to NULL in tbl_attendance before deleting the student
        $query1 = "UPDATE tbl_attendance SET tbl_student_id = NULL WHERE tbl_student_id = :student";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bindParam(':student', $student, PDO::PARAM_INT);
        $stmt1->execute();

        // Delete the student
        $query2 = "DELETE FROM tbl_student WHERE tbl_student_id = :student";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':student', $student, PDO::PARAM_INT);
        $query_execute = $stmt2->execute();

        if ($query_execute) {
            // Resequence the student IDs
            $conn->exec("SET @num := 0;");
            $conn->exec("UPDATE tbl_student SET tbl_student_id = (@num := @num + 1) ORDER BY tbl_student_id;");
            $conn->exec("ALTER TABLE tbl_student AUTO_INCREMENT = 1;");

            // Commit the transaction
            //$conn->commit();

            echo "
                <script>
                    alert('Student deleted successfully!');
                    window.location.href = 'http://localhost:8080/final_project/masterlist2.php';
                </script>
            ";
        } else {
            // Rollback if delete failed
            $conn->rollBack();
            echo "
                <script>
                    alert('Failed to delete student!');
                    window.location.href = 'http://localhost:8080/final_project/masterlist2.php';
                </script>
            ";
        }
    } catch (PDOException $e) {
        // Check if the transaction is active before attempting rollback
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
