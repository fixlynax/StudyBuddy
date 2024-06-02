<?php
include 'connect.php';

if (isset($_POST['course']) && isset($_POST['subject'])) {
    $courseID = $_POST['course'];
    $subjectName = mysqli_real_escape_string($conn, $_POST['subject']);

    // Check if subject already exists
    $checkQuery = "SELECT * FROM subject WHERE subjectName = '$subjectName' AND subjectCourse = '$courseID'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Subject already exists.";
    } else {
        // Insert new subject
        $insertQuery = "INSERT INTO subject (subjectCourse, subjectName) VALUES ('$courseID', '$subjectName')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Subject added successfully.";
        } else {
            echo "Error adding subject: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
