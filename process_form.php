<?php
// Define the file path where you want to store the data
$file = 'feedbackdata.txt';

// Initialize response array
$response = array('status' => 'error', 'message' => '');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare the data to be saved
    $data = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message\n\n";
    
    // Read the existing data from the file
    $existingData = '';
    if (file_exists($file)) {
        $existingData = file_get_contents($file);
    }
    
    // Check if the new data is a duplicate
    if (strpos($existingData, $data) === false) {
        // Write the data to the file
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
            // Set success response
            $response['status'] = 'success';
            $response['message'] = 'Your message has been sent. Thank you!';
        } else {
            // Set error response
            $response['message'] = 'Error: Unable to save the data.';
        }
    } else {
        // Set response for duplicate data
        $response['message'] = 'Duplicate entry detected. Your message was not saved.';
    }

    // Return JSON response
    echo json_encode($response);
}
?>
