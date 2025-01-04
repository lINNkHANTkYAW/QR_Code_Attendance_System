<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['qr_code'])) {
        $qrCode = $_POST['qr_code'];

        // Prepare and execute the SELECT statement
        $selectStmt = $conn->prepare("SELECT tbl_student_id FROM tbl_student WHERE generated_code = :generated_code");
        $selectStmt->bindParam(":generated_code", $qrCode, PDO::PARAM_STR);

        if ($selectStmt->execute()) {
            $result = $selectStmt->fetch();
            if ($result !== false) {
                $studentID = $result["tbl_student_id"];
                date_default_timezone_set("Asia/Yangon");
                $timeIn =  date("l, Y F d, h:i:s A");

                try {
                    // Prepare and execute the INSERT statement
                    $stmt = $conn->prepare("INSERT INTO tbl_attendance (tbl_student_id, time_in) VALUES (:tbl_student_id, :time_in)");
                    $stmt->bindParam(":tbl_student_id", $studentID, PDO::PARAM_INT);
                    $stmt->bindParam(":time_in", $timeIn, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        echo "
                            <script>
                                alert('Attendance recorded successfully!');
                                window.location.href = '../index.php';
                            </script>
                        ";
                    } else {
                        echo "
                            <script>
                                alert('Failed to record attendance!');
                                window.location.href = '../index.php';
                            </script>
                        ";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "
                    <script>
                        alert('No student found for the provided QR Code!');
                        window.location.href = '../index.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script>
                    alert('Failed to execute the select statement!');
                    window.location.href = '../index.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('QR Code is required!');
                window.location.href = '../index.php';
            </script>
        ";
    }
}
?>