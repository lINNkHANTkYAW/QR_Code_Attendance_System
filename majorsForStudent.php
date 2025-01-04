<?php

    

$section = $_GET['section'] ?? '';
$majors = [
    "Advanced Web Technology",
    "Artificial Intelligence",
    "Engineering Mathematics",
    "Software Requirement Engineering",
    "Advanced Networking",
    "Computer Architecture"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majors in Section <?php echo htmlspecialchars($section); ?></title>
    <link rel="stylesheet" href="majorstyles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

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

    </style>
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
                    <a class="nav-link" href="majorsForStudent.php?section=<?php echo htmlspecialchars(string: $section); ?>">Sections</a>
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
        <h1 style="color:#00b4d8">Majors in Section <?php echo htmlspecialchars($section); ?></h1>
        <div class="majors">
            <?php foreach ($majors as $major): ?>
                <a href="attendance.php?section=<?php echo htmlspecialchars($section); ?>&major=<?php echo urlencode($major); ?>" class="major-btn"><?php echo htmlspecialchars($major); ?></a>
            <?php endforeach; ?>
        </div>
        <div class="students-section">
            <a href="students_section.php?section=<?php echo htmlspecialchars($section); ?>" class="students-btn">View Student List</a>
        </div>
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
