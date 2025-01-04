<?php
$sections = ['A', 'B', 'C'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections</title>
    <link rel="stylesheet" href="styles.css">
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
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    body {
    background: linear-gradient(to bottom, rgba(173, 216, 230, 0.5) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(32, 178, 170, 0.5) 100%), 
        radial-gradient(at top center, rgba(255, 255, 255, 0.4) 0%, rgba(173, 216, 230, 0.4) 120%);
    background-blend-mode: multiply, multiply;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    height: 100vh; /* Full height */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: flex-start; /* Align items towards the top */
}

.main-container {
    width: 80%; /* Adjust width as needed */
    margin: 0 auto; /* Center horizontally */
    position: absolute; /* Use absolute positioning */
    top: 50%; /* Position the top of the container at the center */
    left: 50%; /* Position the left edge of the container at the center */
    transform: translate(-50%, -50%); /* Center both horizontally and vertically */
    padding: 20px; /* Optional: Add padding */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Optional: Add shadow */
    background-color: #f9f9f9; /* Optional: Background color */
}

img {
    max-width: 100%;
    height: auto;
}

.section-buttons {
    display: flex;
    flex-direction: column; /* Arrange buttons vertically */
    gap: 10px;
}

button {
    padding: 10px;
    width: 150px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}




    .sections {
        display: flex;
        justify-content: space-around;
    }

    .section-btn {
        padding: 10px 20px;
        background-color: #007ea7;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    .section-btn:hover {
        background-color: #005f73;
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
                    <a class="nav-link" href="./masterlist2.php">List of Students</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./admin.php">List of Teachers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./sections2.php">Sections<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./timetable2.php">Time Table</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" id="logout-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main-container">
        <div class="left-container">
            <div class="left-section"></div>
        </div>
        <div class="right-container">
            <div class="right-section">
                <h1 style="color:#007ea7">Select a Section</h1>
                <div class="sections">
                    <!-- Section Links -->
                    <?php foreach ($sections as $section): ?>
                        <a href="majors.php?section=<?php echo $section; ?>" class="section-btn">Section <?php echo $section; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
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
                window.location.href = './admin_login.php'; // Redirect to login.php
            }
        });
    </script>
</body>

</html>
