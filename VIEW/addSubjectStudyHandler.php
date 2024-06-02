<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['stdID'])) {
    // Redirect to the sign-in page if not logged in
    header("Location: loginRegister.php");
    exit();
}

// Include the database connection file
include './MODEL/connect.php';

// Get the form data
$subjectID = $_POST['subject'];
$description = $_POST['description'];
$schedule = $_POST['schedule'];
$uploadBy = $_SESSION['stdID'];

// Calculate the date 7 days from today
$sevenDaysLater = date('Y-m-d', strtotime('+7 days'));

// Validate the schedule date
if ($schedule < $sevenDaysLater) {
    // Date is not valid
    $suggestionDate = date('d-m-Y', strtotime('+7 days')); // Format the suggestion date as dd-mm-yyyy
    echo "<script>
            alert('The date is not valid. Please enter a date that is at least 7 days after the current date. This is a suggested date: $suggestionDate. (Please add the subject after this date.)');
            window.history.back();
          </script>";
    exit();
}

// Fetch the subject name from the subjects table
$sql = "SELECT subjectName FROM subject WHERE subjectID = '$subjectID'";
$result = mysqli_query($conn, $sql);
$subjectRow = mysqli_fetch_assoc($result);
$subjectName = $subjectRow['subjectName'];

// Insert the data into the studySubject table
$sql = "INSERT INTO studySubject (subjectBy, subjectName, descriptionStudy, scheduleStudy) 
        VALUES ('$uploadBy', '$subjectName', '$description', '$schedule')";

if (mysqli_query($conn, $sql)) {
    // Success, redirect or show a success message
    echo "<script>
            alert('Subject study added successfully');
            window.location.href='showAddSubject.php';
          </script>";
} else {
    // Error, show an error message
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>