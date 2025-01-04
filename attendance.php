<?php
include("C:/XAMPP new/htdocs/final_project/conn/conn.php");
include("timetable_data.php"); // Includes timetable data only

// Fetch the section and major from GET parameters
$section = $_GET['section'] ?? '';
$major = $_GET['major'] ?? '';

// Determine the timetable based on the section
$timetable = [];
if ($section === 'A') {
    $timetable = $timetableA;
} elseif ($section === 'B') {
    $timetable = $timetableB;
} elseif ($section === 'C') {
    $timetable = $timetableC;
}

// Query to fetch attendance records
$query = "SELECT tbl_student.student_name, tbl_student.cst_number, tbl_attendance.time_in 
          FROM tbl_attendance
          JOIN tbl_student ON tbl_attendance.tbl_student_id = tbl_student.tbl_student_id
          WHERE tbl_student.course_section = :section";

$stmt = $conn->prepare($query);
$stmt->bindParam(':section', $section, PDO::PARAM_STR);
$stmt->execute();

// Fetch attendance records
$attendances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get the subject from timetable
function getSubject($timetable, $time, $day) {
    foreach ($timetable as $period => $days) {
        list($startTime, $endTime) = explode('-', $period);
        $startTime = trim($startTime);
        $endTime = trim($endTime);
        if ($time >= $startTime && $time <= $endTime && isset($days[$day])) {
            return $days[$day];
        }
    }
    return '';
}

// Display attendance data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance for <?php echo htmlspecialchars($major); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
    
        .container {
             width: 100%; /* Adjust the width as needed */
            margin: 0 auto;
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
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
            box-shadow: 10px 10px 5px lightblue;
        }

        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Simplified Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ml-4" href="#">QR Code Attendance System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="majorsForStudent.php?section=<?= htmlspecialchars($section) ?>">Sections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./timetable.php">Time Table</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
                <a class="nav-link" href="./login.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <h1 class="text-center">Attendance for <?php echo htmlspecialchars($major); ?></h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">CST</th> <!-- Added CST column header -->
                    <th scope="col">Time In</th>
                    <th scope="col">Section</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($attendances as $attendance) {
                    // Extract time and day
                    $dateTime = DateTime::createFromFormat('l, Y F d, h:i:s A', $attendance['time_in']);
                    if ($dateTime === false) {
                        // Handle parsing errors
                        echo "<tr><td colspan='5'>Error parsing date/time</td></tr>";
                        continue;
                    }

                    $time = $dateTime->format('h:i:s A');
                    $dayOfWeek = $dateTime->format('l');

                    // Get the subject from timetable
                    $subject = getSubject($timetable, $time, $dayOfWeek);
                    if ($subject === $major) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . htmlspecialchars($attendance['student_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($attendance['cst_number']) . "</td>"; // Display CST number
                        echo "<td>" . htmlspecialchars($attendance['time_in']) . "</td>";
                        echo "<td>" . htmlspecialchars($section) . "</td>";
                        echo "</tr>";
                        $count++;
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Back to Majors Button -->
        <div class="back-button">
            <a href="majorsForStudent.php?section=<?php echo htmlspecialchars($section); ?>" class="btn btn-primary">Back to Majors</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
