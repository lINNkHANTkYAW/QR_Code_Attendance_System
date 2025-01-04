<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <link rel="stylesheet" href="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

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
}

.main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 91.5vh;
}

.student-container {
    height: 100%;
    width: 90%;
    border-radius: 20px;
    padding: 40px;
    background-color: rgba(255, 255, 255, 0.8);
    overflow-y: auto; 
}

.student-container > div {
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    border-radius: 10px;
    padding: 30px;
    height: 100%;
    overflow-y: auto;
}

.title {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting_asc_disabled, table.dataTable thead > tr > th.sorting_desc_disabled, table.dataTable thead > tr > td.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting_asc_disabled, table.dataTable thead > tr > td.sorting_desc_disabled {
    text-align: center;
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

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        table.dataTable thead>tr>th.sorting,
        table.dataTable thead>tr>th.sorting_asc,
        table.dataTable thead>tr>th.sorting_desc,
        table.dataTable thead>tr>th.sorting_asc_disabled,
        table.dataTable thead>tr>th.sorting_desc_disabled,
        table.dataTable thead>tr>td.sorting,
        table.dataTable thead>tr>td.sorting_asc,
        table.dataTable thead>tr>td.sorting_desc,
        table.dataTable thead>tr>td.sorting_asc_disabled,
        table.dataTable thead>tr>td.sorting_desc_disabled {
            text-align: center;
        }

        body {
            background: #f8f9fa;
        }

        .timetable-container {
            margin: 20px auto;
            /* Center the div horizontally */
            max-width: 90%;
            /* Optional: Define a max-width */
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 10px 10px 5px lightblue;
        }

        .table th,
        .table td {
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
            box-shadow: 10px 10px 5px lightblue;
        }

        .btn-danger {
            background-color: #FF6B6B;
            border-color: #FF6B6B;
            box-shadow: 10px 10px 5px lightblue;
        }

        .thead-dark {
            background-color: #5F9EA0;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 10px 10px 5px lightblue;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">QR Code Attendance System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./masterlist2.php">List of Students</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./admin.php">List of Teachers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./sections2.php">Sections</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./timetable2.php">Timetable <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" id="logout-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container timetable-container">
        <h1 class="text-center">Section A Timetable</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $timetableA = [
                    '08:30AM-09:30AM' => ['Monday' => '', 'Tuesday' => '', 'Wednesday' => 'Engineering Mathematics', 'Thursday' => '', 'Friday' => 'Advanced Web Technology'],
                    '09:40AM-10:40AM' => ['Monday' => 'Advanced Networking', 'Tuesday' => 'Computer Architecture', 'Wednesday' => 'Computer Architecture', 'Thursday' => 'Artificial Intelligence', 'Friday' => 'Artificial Intelligence'],
                    '10:50AM-11:50AM' => ['Monday' => 'Software Requirement Engineering', 'Tuesday' => 'Software Requirement Engineering', 'Wednesday' => 'Advanced Web Technology', 'Thursday' => 'Engineering Mathematics', 'Friday' => 'Advanced Networking'],
                    '11:50AM-12:40PM' => ['Monday' => 'Lunch Break', 'Tuesday' => 'Lunch Break', 'Wednesday' => 'Lunch Break', 'Thursday' => 'Lunch Break', 'Friday' => 'Lunch Break'],
                    '12:40PM-01:40PM' => ['Monday' => 'Artificial Intelligence', 'Tuesday' => '', 'Wednesday' => 'Artificial Intelligence', 'Thursday' => 'Advanced Networking', 'Friday' => 'Engineering Mathematics'],
                    '01:50PM-02:50PM' => ['Monday' => 'Advanced Web Technology', 'Tuesday' => 'Engineering Mathematics', 'Wednesday' => 'Advanced Networking', 'Thursday' => 'Software Requirement Engineering', 'Friday' => ''],
                    '03:00PM-04:00PM' => ['Monday' => 'Computer Architecture', 'Tuesday' => 'Advanced Web Technology', 'Wednesday' => 'Software Requirement Engineering', 'Thursday' => 'Computer Architecture', 'Friday' => ''],
                    '04:00PM-08:00AM' => ['Monday' => 'Advanced Networking', 'Tuesday' => 'Computer Architecture', 'Wednesday' => 'Computer Architecture', 'Thursday' => 'Artificial Intelligence', 'Friday' => 'Artificial Intelligence']
                ];
                foreach ($timetableA as $time => $days) {
                    echo "<tr>";
                    echo "<th scope=\"row\">$time</th>";
                    foreach ($days as $day => $subject) {
                        echo "<td>$subject</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <h1 class="text-center">Section B Timetable</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $timetableB = [
                    '08:30AM-09:30AM' => ['Monday' => 'Engineering Mathematics', 'Tuesday' => 'Software Requirement Engineering', 'Wednesday' => 'Advanced Web Technology', 'Thursday' => 'Artificial Intelligence', 'Friday' => ''],
                    '09:40AM-10:40AM' => ['Monday' => 'Computer Architecture', 'Tuesday' => 'Computer Architecture', 'Wednesday' => '', 'Thursday' => 'Advanced Networking', 'Friday' => 'Advanced Networking'],
                    '10:50AM-11:50AM' => ['Monday' => 'Advanced Web Technology', 'Tuesday' => 'Artificial Intelligence', 'Wednesday' => 'Software Requirement Engineering', 'Thursday' => '', 'Friday' => 'Engineering Mathematics'],
                    '11:50AM-12:40PM' => ['Monday' => 'Lunch Break', 'Tuesday' => 'Lunch Break', 'Wednesday' => 'Lunch Break', 'Thursday' => 'Lunch Break', 'Friday' => 'Lunch Break'],
                    '12:40PM-01:40PM' => ['Monday' => 'Advanced Networking', 'Tuesday' => 'Engineering Mathematics', 'Wednesday' => 'Computer Architecture', 'Thursday' => 'Computer Architecture', 'Friday' => 'Artificial Intelligence'],
                    '01:50PM-02:50PM' => ['Monday' => 'Software Requirement Engineering', 'Tuesday' => 'Advanced Networking', 'Wednesday' => 'Artificial Intelligence', 'Thursday' => 'Advanced Web Technology', 'Friday' => ''],
                    '03:00PM-04:00PM' => ['Monday' => '', 'Tuesday' => 'Advanced Web Technology', 'Wednesday' => 'Engineering Mathematics', 'Thursday' => 'Software Requirement Engineering', 'Friday' => ''],
                    '04:00PM-08:00AM' => ['Monday' => 'Computer Architecture', 'Tuesday' => 'Computer Architecture', 'Wednesday' => '', 'Thursday' => 'Advanced Networking', 'Friday' => 'Advanced Networking']
                ];

                foreach ($timetableB as $time => $days) {
                    echo "<tr>";
                    echo "<th scope=\"row\">$time</th>";
                    foreach ($days as $day => $subject) {
                        echo "<td>$subject</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <h1 class="text-center">Section C Timetable</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $timetableC = [
                    '08:30AM-09:30AM' => ['Monday' => 'Computer Architecture', 'Tuesday' => '', 'Wednesday' => 'Advanced Web Technology', 'Thursday' => '', 'Friday' => ''],
                    '09:40AM-10:40AM' => ['Monday' => 'Software Requirement Engineering', 'Tuesday' => 'Advanced Networking', 'Wednesday' => 'Artificial Intelligence', 'Thursday' => 'Engineering Mathematics', 'Friday' => 'Advanced Web Technology'],
                    '10:50AM-11:50AM' => ['Monday' => 'Advanced Networking', 'Tuesday' => 'Software Requirement Engineering', 'Wednesday' => 'Engineering Mathematics', 'Thursday' => 'Computer Architecture', 'Friday' => 'Artificial Intelligence'],
                    '11:50AM-12:40PM' => ['Monday' => 'Lunch Break', 'Tuesday' => 'Lunch Break', 'Wednesday' => 'Lunch Break', 'Thursday' => 'Lunch Break', 'Friday' => 'Lunch Break'],
                    '12:40PM-01:40PM' => ['Monday' => 'Engineering Mathematics', 'Tuesday' => '', 'Wednesday' => 'Computer Architecture', 'Thursday' => 'Software Requirement Engineering', 'Friday' => 'Computer Architecture'],
                    '01:50PM-02:50PM' => ['Monday' => 'Artificial Intelligence', 'Tuesday' => 'Advanced Web Technology', 'Wednesday' => 'Software Requirement Engineering', 'Thursday' => 'Advanced Networking', 'Friday' => ''],
                    '03:00PM-04:00PM' => ['Monday' => 'Advanced Web Technology', 'Tuesday' => 'Engineering Mathematics', 'Wednesday' => 'Advanced Networking', 'Thursday' => 'Artificial Intelligence', 'Friday' => ''],
                    '04:00PM-08:00AM' => ['Monday' => 'Software Requirement Engineering', 'Tuesday' => 'Advanced Networking', 'Wednesday' => 'Artificial Intelligence', 'Thursday' => 'Engineering Mathematics', 'Friday' => 'Advanced Web Technology']
                ];

                foreach ($timetableC as $time => $days) {
                    echo "<tr>";
                    echo "<th scope=\"row\">$time</th>";
                    foreach ($days as $day => $subject) {
                        echo "<td>$subject</td>";
                    }
                    echo "</tr>";
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
                window.location.href = './admin_login.php'; // Redirect to login.php
            }
        });
    </script>
</body>

</html>