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
    $matric = mysqli_real_escape_string($conn, $_POST['matric']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM student WHERE stdEmail='$email' AND stdID != {$_SESSION['stdID']}";
    $result_check_email = mysqli_query($conn, $sql_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        // Email already exists
        echo '<script>alert("This email is already taken or registered. Please use a different email."); window.location.replace("editProfileStudent.php");</script>';
        exit();
    }

    // Check if the matriculation number already exists in the database
    $sql_check_matric = "SELECT * FROM student WHERE stdMatric='$matric' AND stdID != {$_SESSION['stdID']}";
    $result_check_matric = mysqli_query($conn, $sql_check_matric);

    if (mysqli_num_rows($result_check_matric) > 0) {
        // Matriculation number already exists
        echo '<script>alert("This matric number is already taken or registered. Please use a different matric."); window.location.replace("editProfileStudent.php");</script>';
        exit();
    }

    // Validate the password length and complexity
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        echo '<script>alert("Password must be at least 8 characters long and contain both letters and numbers."); window.location.replace("editProfileStudent.php");</script>';
        exit();
    }

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
        echo '<script>alert("Edit successful. The data has been updated successfully."); window.location.replace("profileStudent.php");</script>';
        exit();
    } else {
        // Error handling for database update failure
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>