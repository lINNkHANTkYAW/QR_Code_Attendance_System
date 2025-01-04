<?php
session_start();
include('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

// Retrieve student CST number
$cst_number = $_SESSION['cst_number'] ?? '';

// Query to fetch attendance counts for each course_section for the student
$query = "SELECT tbl_student.course_section, COUNT(*) as attendance_count 
          FROM tbl_attendance 
          JOIN tbl_student ON tbl_attendance.tbl_student_id = tbl_student.tbl_student_id
          WHERE tbl_student.cst_number = :cst_number
          GROUP BY tbl_student.course_section";

$stmt = $conn->prepare($query);
$stmt->bindParam(':cst_number', $cst_number, PDO::PARAM_STR);
$stmt->execute();

// Fetch the attendance data
$attendances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total number of classes per course_section (e.g., 20 per month)
$total_classes = 20;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Summary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .table{
            text-align: center;
        }
        .navbar {
            background: linear-gradient(to right, #1f4037, #99f2c8);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #c3cfe2;
        }

        .navbar-dark .navbar-brand {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-4" href="#">QR Code Attendance System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="majorsForStudent.php?section=B">Sections</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./timetableForStudent.php">Time Table</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./checkAttendanceForStu.php">Check Attendance</a>
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" id="logout-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h1 class="text-center mt-5">Attendance Summary for CST Number: <?= htmlspecialchars($cst_number) ?></h1>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">Attendance Count</th>
                <th scope="col">Attendance Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($attendances as $attendance) {
                $attendance_count = $attendance['attendance_count'];
                $attendance_percentage = ($attendance_count / $total_classes) * 100;
                ?>
                <tr>
                    
                    <td><?= htmlspecialchars($attendance_count) ?></td>
                    <td><?= round($attendance_percentage, 2) ?>%</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var confirmLogout = confirm('Are you sure you want to logout?');
            if (confirmLogout) {
                window.location.href = './logintestForstu.php'; // Redirect to login.php
            }
        });
    </script>
</body>
</html>
