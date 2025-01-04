<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management System</title>

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

        .teacher-container {
            height: 100%;
            width: 90%;
            border-radius: 20px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            overflow-y: auto;
        }

        .teacher-container>div {
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
        <a class="navbar-brand ml-4" href="#">Teacher Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./masterlist2.php">List of Students</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./admin.php">List of Teachers<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./sections2.php">Sections</a>
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

    <div class="main">
        <div class="teacher-container">
            <div class="teacher-list">
                <div class="title">
                    <h4>List of Teachers</h4>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#addTeacherModal">Add Teacher</button>
                </div>
                <hr>
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="teacherTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Course & Section</th>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

                            $stmt = $conn->prepare("SELECT * FROM tbl_teacher");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $row) {
                                $teacherID = $row["tbl_teacher_id"];
                                $teacherName = $row["teacher_name"];
                                $courseSection = $row["course_section"];
                                $subjectCode = $row["subject_code"];
                                $password = $row["password"];
                            ?>
                                <tr>
                                    <th scope="row" id="teacherID-<?= $teacherID ?>"><?= $teacherID ?></th>
                                    <td id="teacherName-<?= $teacherID ?>"><?= $teacherName ?></td>
                                    <td id="courseSection-<?= $teacherID ?>"><?= $courseSection ?></td>
                                    <td id="subjectCode-<?= $teacherID ?>"><?= $subjectCode ?></td>
                                    <td id="password-<?= $teacherID ?>"><?= $password ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-secondary btn-sm" onclick="updateTeacher(<?= $teacherID ?>)">&#128393;</button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteTeacher(<?= $teacherID ?>)">&#10006;</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="addTeacherModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addTeacher" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeacher">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/add-teacher.php" method="POST">
                        <div class="form-group">
                            <label for="teacherName">Full Name:</label>
                            <input type="text" class="form-control" id="teacherName" name="teacher_name" required>
                        </div>
                        <div class="form-group">
                            <label for="courseSection">Course & Section:</label>
                            <input type="text" class="form-control" id="courseSection" name="course_section" required>
                        </div>
                        <div class="form-group">
                            <label for="subjectCode">Subject Code:</label>
                            <input type="text" class="form-control" id="subjectCode" name="subject_code" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="submit">Add Teacher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Teacher Modal -->
    <?php
    foreach ($result as $row) {
        $teacherID = $row["tbl_teacher_id"];
        $teacherName = $row["teacher_name"];
        $courseSection = $row["course_section"];
        $subjectCode = $row["subject_code"];
        $password = $row["password"];
    ?>
        <div class="modal fade" id="updateTeacherModal<?= $teacherID ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Teacher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateTeacherForm<?= $teacherID ?>" action="./endpoint/update-teacher.php" method="POST">
                            <input type="hidden" name="tbl_teacher_id" value="<?= $teacherID ?>">
                            <div class="form-group">
                                <label for="teacherName<?= $teacherID ?>">Full Name:</label>
                                <input type="text" class="form-control" id="teacherName<?= $teacherID ?>" name="teacher_name" value="<?= $teacherName ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="courseSection<?= $teacherID ?>">Course & Section:</label>
                                <input type="text" class="form-control" id="courseSection<?= $teacherID ?>" name="course_section" value="<?= $courseSection ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="subjectCode<?= $teacherID ?>">Subject Code:</label>
                                <input type="text" class="form-control" id="subjectCode<?= $teacherID ?>" name="subject_code" value="<?= $subjectCode ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password<?= $teacherID ?>">Password:</label>
                                <input type="text" class="form-control" id="password<?= $teacherID ?>" name="password" value="<?= $password ?>" required>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Update Teacher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Logout Link Script -->
    <script>
        document.getElementById('logout-link').addEventListener('click', function() {
            if (confirm('Are you sure you want to log out?')) {
                window.location.href = './admin_login.php'; // Adjust this path if needed
            }
        });
    </script>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#teacherTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true
            });
        });

        function updateTeacher(id) {
            $('#updateTeacherModal' + id).modal('show');
        }

        function deleteTeacher(id) {
            if (confirm('Are you sure you want to delete this teacher?')) {
                window.location.href = "./endpoint/delete-teacher.php?teacher_id=" + id;
            }
        }
    </script>
</body>

</html>