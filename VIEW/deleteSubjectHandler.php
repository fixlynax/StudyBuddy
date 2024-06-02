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

// Get the studySubjectID from the URL
$studySubjectID = $_GET['id'];

// Delete the subject from the database
$sql = "DELETE FROM studySubject WHERE studySubjectID='$studySubjectID'";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Subject deleted successfully');
            window.location.href='showAddSubject.php';
          </script>";
} else {
    echo "Error deleting subject: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
