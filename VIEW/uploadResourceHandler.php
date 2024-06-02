<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['stdID'])) {
    // Redirect to the sign-in page if not logged in
    header("Location: signIn.php");
    exit();
}

// Include the database connection file
require_once './MODEL/connect.php';

// Check if the form is submitted for upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    // Retrieve form data
    $topicName = mysqli_real_escape_string($conn, $_POST['topicName']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Generate dateResource
    $dateResource = date("Y-m-d");

    // Detect uploadBy using session ID
    $uploadBy = $_SESSION['stdID'];

    // Handle file upload
    $targetDir = "Files/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is selected
    if (!empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowedTypes = array('pdf', 'docx', 'xlsx');

        if (in_array($fileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert data into database
                // Update fileResource path for database insertion
                $fileResource = $targetFilePath;
                $sql = "INSERT INTO resource (topicResource, categoryResource, fileResource, descResource, uploadBy, dateResource) VALUES ('$topicName', '$category', '$fileResource', '$description', '$uploadBy', '$dateResource')";

                if (mysqli_query($conn, $sql)) {
                    // Upload successful
                    echo '<script>alert("Resource uploaded successfully."); window.location.replace("showResource.php");</script>';
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File type not allowed.";
        }
    } else {
        echo "Please select a file to upload.";
    }
}

// Close the database connection
mysqli_close($conn);
?>