<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Attendance System</title>

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
                <a class="nav-link" href="./masterlist2.php">List of Students<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./admin.php">List of Teachers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./sections2.php">Sections</a>
            </li>
            <li class="nav-item ">
                    <a class="nav-link" href="./timetable2.php">Time Table</a>
                </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
                <a class="nav-link"  id="logout-link">Logout</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="main">
        
        <div class="student-container">
            <div class="student-list">
                <div class="title">
                    <h4>List of Students</h4>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal">Add Student</button>
                </div>
                <hr>
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="studentTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">CST</th>
                                <th scope="col">Section</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                include ('C:\XAMPP NEW\htdocs\final_project\conn\conn.php');

                                $stmt = $conn->prepare("SELECT * FROM tbl_student");
                                $stmt->execute();
                
                                $result = $stmt->fetchAll();
                
                                foreach ($result as $row) {
                                    $studentID = $row["tbl_student_id"];
                                    $studentName = $row["student_name"];
                                    $studentCST = $row["cst_number"];
                                    $studentCourse = $row["course_section"];
                                    $studentPassword = $row["password"];
                                    $qrCode = $row["generated_code"];
                                ?>
                                <tr>
                                    <th scope="row" id="studentID-<?= $studentID ?>"><?= $studentID ?></th>
                                    <td id="studentName-<?= $studentID ?>"><?= $studentName ?></td>
                                    <td id="studentCST-<?= $studentID ?>"><?= $studentCST ?></td>
                                    <td id="studentCourse-<?= $studentID ?>"><?= $studentCourse ?></td>
                                    <td id="studentPassword-<?= $studentID ?>"><?= $studentPassword ?></td>
                                    <td >
                                    <div class="action-button">
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#qrCodeModal<?= $studentID ?>">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1341/1341632.png" alt="" width="16">
                                            </button>
                                            <!-- QR Modal -->
                                            <div class="modal fade" id="qrCodeModal<?= $studentID ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?= $studentName ?>'s QR Code</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img id="qrCodeImage<?= $studentID ?>" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $qrCode ?>" alt="" width="300">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" onclick="downloadQRCode('qrCodeImage<?= $studentID ?>', '<?= $studentName ?>_QRCode.png')">Download</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-secondary btn-sm" onclick="updateStudent(<?= $studentID ?>)">&#128393;</button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?= $studentID ?>)">&#10006;</button>
                                        </div>

                                        <script>
                                            async function downloadQRCode(imageId, filename) {
                                                // Get the image element
                                                var qrCodeImage = document.getElementById(imageId);

                                                // Fetch the image as a blob
                                                const response = await fetch(qrCodeImage.src);
                                                const blob = await response.blob();

                                                // Create an invisible link element
                                                const downloadLink = document.createElement('a');
                                                downloadLink.href = URL.createObjectURL(blob); // Create a URL for the blob
                                                downloadLink.download = filename; // Set the download attribute with the file name

                                                // Append the link to the body
                                                document.body.appendChild(downloadLink);

                                                // Programmatically click the link to trigger the download
                                                downloadLink.click();
                                                // Clean up and remove the link
                                                document.body.removeChild(downloadLink);
                                                URL.revokeObjectURL(downloadLink.href); // Revoke the object URL to free up memory
                                            }
                                        </script>
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
    <!-- Add Modal -->
    <div class="modal fade" id="addStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudent">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/add-student.php" method="POST">
                        <div class="form-group">
                            <label for="studentName">Full Name:</label>
                            <input type="text" class="form-control" id="studentName" name="student_name" required>
                        </div>
                        <div class="form-group">
                            <label for="studentCST">CST (4-digit unique):</label>
                            <input type="text" class="form-control" id="studentCST" name="student_cst" pattern="\d{4}" title="Enter a 4-digit number" required>
                        </div>
                        <div class="form-group">
                            <label for="studentCourse">Section:</label>
                            <input type="text" class="form-control" id="studentCourse" name="student_course" required>
                        </div>
                        <div class="form-group">
                            <label for="studentPassword">Password:</label>
                            <input type="text" class="form-control" id="studentPassword" name="student_password" required>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="submit">Add Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Student Modal -->


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable();
        });
        function updateStudent(id) {
    let newStudentName = prompt("Enter new student name:", $("#studentName-" + id).text());
    let newStudentCST = prompt("Enter new student CST:", $("#studentCST-" + id).text());
    let newStudentCourse = prompt("Enter new student section:", $("#studentCourse-" + id).text());
    let newStudentPassword = prompt("Enter new student password:", $("#studentPassword-" + id).text());
    if (newStudentName != null && newStudentCST != null && newStudentCourse != null  && newStudentPassword != null) {
        $.ajax({
            url: './endpoint/update-student.php',
            method: 'POST',
            data: {
                tbl_student_id: id, // Correct key
                student_name: newStudentName,
                cst_number: newStudentCST,
                course_section: newStudentCourse, // Correct key
                password: newStudentPassword
            },
            success: function(response) {
                if (response.trim() === "Success") {
                    alert("Student updated successfully!");
                } else {
                    alert("Failed to update student: " + response);
                }
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("An error occurred. Please try again.");
            }
        });
    }
}
function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                window.location.href = "./endpoint/delete-student.php?student=" + id;
            }
        }
    </script>
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