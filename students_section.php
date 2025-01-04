<?php
// Include the connection and check for the section
include('./conn/conn.php');

if (isset($_GET['section'])) {
    $section = $_GET['section'];

    $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE course_section = :section");
    $stmt->bindParam(':section', $section, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll();
} else {
    echo "Section not specified";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students in Section <?= htmlspecialchars($section) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
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
                    <a class="nav-link" href="majorsForStudent.php?section=<?php echo htmlspecialchars(string: $section); ?>"> Sections</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./timetableForStudent.php">Time Table</a>
                </li>
                <li class="nav-item ">
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
        <h1>Students in Section <?= htmlspecialchars($section) ?></h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>CST</th>
                    <th>Section</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($result as $row) {
                    $studentID = htmlspecialchars($row["tbl_student_id"]);
                    $studentName = htmlspecialchars($row["student_name"]);
                    $studentCST = htmlspecialchars($row["cst_number"]);
                    $section = htmlspecialchars($row["course_section"]);
                    $qrCode = htmlspecialchars($row["generated_code"]);

                    echo "<tr>";
                    echo "<td>$counter</td>";
                    echo "<td>$studentName</td>";
                    echo "<td>$studentCST</td>";
                    echo "<td>$section</td>";
                    echo "<td><button class='btn btn-success btn-sm' data-toggle='modal' data-target='#qrCodeModal$studentID'><img src='https://cdn-icons-png.flaticon.com/512/1341/1341632.png' alt='' width='16'></button></td>";
                    echo "</tr>";
                   // Modal for QR Code and Download button
                   echo "<div class='modal fade' id='qrCodeModal$studentID' tabindex='-1' aria-hidden='true'>
                   <div class='modal-dialog'>
                       <div class='modal-content'>
                           <div class='modal-header'>
                               <h5 class='modal-title'>$studentName's QR Code</h5>
                               <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                   <span aria-hidden='true'>&times;</span>
                               </button>
                           </div>
                           <div class='modal-body text-center'>
                               <img id='qrCodeImage$studentID' src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$qrCode' alt='' width='300'>
                           </div>
                           <div class='modal-footer'>
                               <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                               <button type='button' class='btn btn-primary' onclick=\"downloadQRCode('qrCodeImage$studentID', '$studentName _QRCode.png')\">Download</button>
                           </div>
                       </div>
                   </div>
               </div>";
    
    
                    $counter++;
                }
                ?>
            </tbody>
        </table>

        <!-- Back Button -->
        <div class="back-button mt-4">
            <a href="majorsForStudent.php?section=<?= htmlspecialchars($section) ?>" class="btn btn-primary">Back to Majors</a>
        </div>
    </div>
    <!-- JavaScript function for downloading QR Code -->
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

</body>

</html>