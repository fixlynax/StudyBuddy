<?php
// Start or resume the session
session_start();

// Include the database connection file
include './MODEL/connect.php';

// Check if the user is logged in
if (!isset($_SESSION['stdID'])) {
    // Redirect to the sign-in page if not logged in
    header("Location: loginRegister.php");
    exit();
}

// Check if the form is submitted for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    // Retrieve the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $matric = mysqli_real_escape_string($conn, 'NULL');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $major = mysqli_real_escape_string($conn, 'NULL');
    $course = mysqli_real_escape_string($conn, 'NULL');
    $cgpa = mysqli_real_escape_string($conn, 'NULL');

    // Handle profile picture upload if a new picture is selected
    if ($_FILES['pictureIssue']['size'] > 0) {
        // Define upload directory and allowed file types
        $uploadDir = "Images/"; // Change this to your desired directory
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

        // Get the uploaded file details
        $fileName = basename($_FILES['pictureIssue']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if the file type is allowed
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Upload the file to the server
            if (move_uploaded_file($_FILES['pictureIssue']['tmp_name'], $targetFilePath)) {
                // Update the profile picture path in the database
                $picturePath = $targetFilePath;
                $updatePictureSql = "UPDATE student SET stdPicture='$picturePath' WHERE stdID={$_SESSION['stdID']}";
                mysqli_query($conn, $updatePictureSql);
            }
        }
    }

    // Update other profile information
    $updateSql = "UPDATE student SET stdName='$name', stdMatric='$matric', stdEmail='$email', stdPassword='$password', stdMajor='$major', stdCourse='$course', stdCGPA='$cgpa' WHERE stdID={$_SESSION['stdID']}";

    if (mysqli_query($conn, $updateSql)) {
        // Edit successful
        echo '<script>alert("Edit successful. The data has been updated successfully."); window.location.replace("profileAdmin.php");</script>';
        exit();
    } else {
        // Error handling for database update failure
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>