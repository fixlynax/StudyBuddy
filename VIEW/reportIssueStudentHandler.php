<?php
// Include the database connection file
include './MODEL/connect.php';

// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['stdID'])) {
    // Redirect to the sign-in page if not logged in
    header("Location: loginRegister.php");
    exit();
}

// Get the form data
$reportType = $_POST['typeIssue'];
$reportDescription = $_POST['description'];
$reportBy = $_SESSION['stdID'];
$reportStatus = 'Pending';
$reportDate = date("Y-m-d H:i:s");

// Handle the file upload
if (isset($_FILES['pictureIssue']) && $_FILES['pictureIssue']['error'] == 0) {
    $fileTmpPath = $_FILES['pictureIssue']['tmp_name'];
    $fileName = $_FILES['pictureIssue']['name'];
    $fileSize = $_FILES['pictureIssue']['size'];
    $fileType = $_FILES['pictureIssue']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the path where the file should be uploaded
    $uploadFileDir = './Images/';
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $reportPicture = 'Images/' . $newFileName;
    } else {
        echo 'Error moving the uploaded file.';
        exit();
    }
} else {
    $reportPicture = '';
}

// Insert the report into the database
$sql = "INSERT INTO reportissue (reportBy, reportType, reportDescription, reportPicture, reportStatus, reportDate) 
        VALUES ('$reportBy', '$reportType', '$reportDescription', '$reportPicture', '$reportStatus', '$reportDate')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Issue reported successfully');
            window.location.href='reportIssueStudent.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>