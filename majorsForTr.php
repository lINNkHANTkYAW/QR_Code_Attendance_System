<?php
session_start();

// Retrieve the section and subject code from the session
$section = $_GET['section'] ?? '';
$subjectCode = $_SESSION['subject_code'] ?? '';

// Map subject codes to corresponding majors
$subjectCodeToMajorMap = [
    '5307' => 'Advanced Web Technology',
    '5105' => 'Artificial Intelligence',
    '5203' => 'Engineering Mathematics',
    '5306' => 'Software Requirement Engineering',
    '5404' => 'Advanced Networking',
    '5405' => 'Computer Architecture'
];

// Retrieve the allowed major based on the subject code
$allowedMajor = $subjectCodeToMajorMap[$subjectCode] ?? '';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .major-btn {
            display: inline-block;
            padding: 40px 40px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            margin: 10px 323px;
            transition: all 0.3s ease;
        }

        .major-btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ee5253;
        }

        .students-btn {
            display: block;
            background-color: #1dd1a1;
            color: white;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .students-btn:hover {
            background-color: #10ac84;
        }

        .back-button,
        .students-section {
            text-align: center;
            margin-top: 20px;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .container {
                margin: 20px auto;
            }

            .major-btn {
                font-size: 1rem;
                padding: 12px 20px;
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 10px 20px;
            }

            .students-btn {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand ml-4" href="#">QR Code Attendance System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./sections.php">Sections<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
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

    <div class="container">
        <h1>Majors in Section <?php echo htmlspecialchars($section); ?></h1>
        <div class="majors">
            <?php foreach ($majors as $major): ?>
                <?php if ($allowedMajor === $major): ?>
                    <a href="attendanceTrView2.php?section=<?php echo htmlspecialchars($section); ?>&major=<?php echo urlencode($major); ?>" class="major-btn"><?php echo htmlspecialchars($major); ?></a>
                    
                    <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="back-button">
            <a href="sections.php" class="btn btn-primary">Back to Sections</a>
        </div>

        <div class="students-section">
            <a href="students_section_trview2.php?section=<?php echo htmlspecialchars($section); ?>" class="students-btn">View Student List</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
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
