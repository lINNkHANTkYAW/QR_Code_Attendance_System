<?php
include ('../conn/conn.php');

if (isset($_GET['attendance'])) {
    $attendance = $_GET['attendance'];

    try {
        // Begin transaction
        if (!$conn->inTransaction()) {
            $conn->beginTransaction();
        }

        // Delete the attendance record
        $query = "DELETE FROM tbl_attendance WHERE tbl_attendance_id = :attendance";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);
        $query_execute = $stmt->execute();

        if ($query_execute) {
            // Resequence the attendance IDs
            $conn->exec("SET @num := 0;");
            $conn->exec("UPDATE tbl_attendance SET tbl_attendance_id = (@num := @num + 1) ORDER BY tbl_attendance_id;");

            // Fetch the current maximum ID
            $stmt = $conn->query("SELECT MAX(tbl_attendance_id) as max_id FROM tbl_attendance");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $max_id = $result['max_id'];

            // Set the new auto_increment value
            $new_auto_increment = $max_id + 1;
            $conn->exec("ALTER TABLE tbl_attendance AUTO_INCREMENT = $new_auto_increment;");

            // Commit the transaction
            //$conn->commit();

            echo "
                <script>
                    alert('Attendance deleted successfully!');
                    window.location.href = 'http://localhost:8080/final_project/index.php';
                </script>
            ";
        } else {
            // Rollback if delete failed
            if ($conn->inTransaction()) {
                $conn->rollBack(); 
            }
            echo "
                <script>
                    alert('Failed to delete attendance!');
                    window.location.href = 'http://localhost:8080/final_project/index.php';
                </script>
            ";
        }
    } catch (PDOException $e) {
        // Rollback the transaction if any errors occur
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
}
?>