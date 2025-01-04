<?php
include('../conn/conn.php');

if (isset($_GET['teacher_id'])) {
    $teacherId = $_GET['teacher_id'];

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Optionally, handle related records if needed
        // For example: $query1 = "UPDATE tbl_related_table SET teacher_id = NULL WHERE teacher_id = :teacher_id";
        // $stmt1 = $conn->prepare($query1);
        // $stmt1->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
        // $stmt1->execute();

        // Delete the teacher
        $query2 = "DELETE FROM tbl_teacher WHERE tbl_teacher_id = :teacher_id";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
        $query_execute = $stmt2->execute();

        if ($query_execute) {
            // Optionally resequence IDs if needed
             $conn->exec("SET @num := 0;");
             $conn->exec("UPDATE tbl_teacher SET tbl_teacher_id = (@num := @num + 1) ORDER BY tbl_teacher_id;");
             $conn->exec("ALTER TABLE tbl_teacher AUTO_INCREMENT = 1;");

            // Commit the transaction
            //$conn->commit();
            echo "<script>alert('Teacher deleted successfully!'); window.location.href='../admin.php';</script>";
        } else {
            // Rollback if delete failed
            $conn->rollBack();
            echo "<script>alert('Failed to delete teacher!'); window.location.href='../admin.php';</script>";
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