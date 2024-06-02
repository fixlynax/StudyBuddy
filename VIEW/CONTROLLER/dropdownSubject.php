<?php
// Include the database connection file
include './MODEL/connect.php';

// Start session to get the student ID
session_start();

// Get student ID from session
$stdID = $_SESSION['stdID'];

// Fetch the student's course from the database
$studentQuery = "SELECT stdCourse FROM student WHERE stdID = '$stdID'";
$studentResult = mysqli_query($conn, $studentQuery);

if ($studentResult && mysqli_num_rows($studentResult) > 0) {
    $student = mysqli_fetch_assoc($studentResult);
    $stdCourse = $student['stdCourse'];

    // Fetch subjects that match the student's course
    $subjectQuery = "SELECT subjectID, subjectName FROM subject WHERE subjectMajor = '$stdCourse'";
    $subjectResult = mysqli_query($conn, $subjectQuery);

    // Loop through the subjects and create options
    while ($row = mysqli_fetch_assoc($subjectResult)) {
        echo "<option value='" . $row['subjectID'] . "'>" . $row['subjectName'] . "</option>";
    }
} else {
    echo "<option value=''>No subjects available</option>";
}

// Close the database connection
mysqli_close($conn);
?>