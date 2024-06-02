<?php
include 'connect.php';

if (isset($_POST['course'])) {
    $courseName = mysqli_real_escape_string($conn, $_POST['course']);

    // Check if course already exists
    $checkQuery = "SELECT * FROM course WHERE courseName = '$courseName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Course already exists.";
    } else {
        // Insert new course
        $insertQuery = "INSERT INTO course (courseName) VALUES ('$courseName')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Course added successfully.";
        } else {
            echo "Error adding course: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
