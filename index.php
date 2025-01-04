<?php
session_start();

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve teacher details from session
$teacher_name = $_SESSION['teacher_name'];
$course_section = $_SESSION['course_section'];
$subject_code = $_SESSION['subject_code'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Attendance System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9) 0%, rgba(173, 216, 230, 0.5) 50%, rgba(32, 178, 170, 0.5) 100%),
                radial-gradient(at top center, rgba(255, 255, 255, 0.4) 0%, rgba(173, 216, 230, 0.4) 120%);
            background-blend-mode: multiply, multiply;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 91.5vh;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .attendance-container {
            height: 90%;
            width: 90%;
            border-radius: 20px;
            padding: 40px;
            background-color: #20B2AA;
            overflow-y: auto;
        }

        .attendance-container>div {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
            padding: 30px;
            background-color: #FFFFFF;
            overflow-y: auto;
        }

        .attendance-container>div:last-child {
            width: 64%;
            margin-left: auto;
        }

        .btn-dark {
            background-color: #008080;
            border-color: #008080;
        }

        .btn-danger {
            background-color: #FF6B6B;
            border-color: #FF6B6B;
        }

        .thead-dark {
            background-color: #5F9EA0;

        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 5px 5px 2px lightblue;
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
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./sections.php">Sections</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./timetable.php">Time Table</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" id="logout-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main">
        <div class="attendance-container row">
            <div class="qr-container col-4">
                <div class="scanner-con">
                    <h5 class="text-center">Scan your QR Code here for your attendance</h5>
                    <video id="interactive" class="viewport" width="100%"></video>
                </div>

                <div class="qr-detected-container" style="display: none;">
                    <form action="./endpoint/add-attendance.php" method="POST">
                        <h4 class="text-center">Student QR Detected!</h4>
                        <input type="hidden" id="detected-qr-code" name="qr_code">
                        <button type="submit" class="btn btn-dark form-control">Submit Attendance</button>
                    </form>
                </div>
            </div>

            <div class="attendance-list">
                <h4>List of Present Students</h4>
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="attendanceTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">CST</th> <!-- New CST column -->
                                <th scope="col">Section</th>
                                <th scope="col">Time In</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('C:\XAMPP new\htdocs\qr-code-attendance-system\conn\conn.php');

                            $stmt = $conn->prepare("SELECT tbl_attendance.*, tbl_student.student_name, tbl_student.cst_number, tbl_student.course_section FROM tbl_attendance LEFT JOIN tbl_student ON tbl_student.tbl_student_id = tbl_attendance.tbl_student_id");
                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $attendanceID = $row["tbl_attendance_id"];
                                $studentName = $row["student_name"];
                                $studentCST = $row["cst_number"]; // Retrieve CST number
                                $studentCourse = $row["course_section"];
                                $timeIn = $row["time_in"];
                            ?>
                                <tr>
                                    <th scope="row"><?= $attendanceID ?></th>
                                    <td><?= $studentName ?></td>
                                    <td><?= $studentCST ?></td> <!-- Display CST number -->
                                    <td><?= $studentCourse ?></td>
                                    <td><?= $timeIn ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-danger btn-sm" onclick="deleteAttendance(<?= $attendanceID ?>)">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" width="16">
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <!-- Instascan JS -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
        let scanner;

        function startScanner() {
            scanner = new Instascan.Scanner({
                video: document.getElementById('interactive')
            });

            scanner.addListener('scan', function(content) {
                $("#detected-qr-code").val(content);
                console.log(content);
                scanner.stop();
                document.querySelector(".qr-detected-container").style.display = '';
                document.querySelector(".scanner-con").style.display = 'none';
            });

            Instascan.Camera.getCameras()
                .then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                })
                .catch(function(err) {
                    console.error('Camera access error:', err);
                    alert('Camera access error: ' + err);
                });
        }

        document.addEventListener('DOMContentLoaded', startScanner);

        function deleteAttendance(id) {
            if (confirm("Do you want to remove this attendance?")) {
                window.location = "./endpoint/delete-attendance.php?attendance=" + id;
            }
        }
    </script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var confirmLogout = confirm('Are you sure you want to logout?');
            if (confirmLogout) {
                window.location.href = './login.php'; // Redirect to login.php
            }
        });
    </script>
</body>

</html>
