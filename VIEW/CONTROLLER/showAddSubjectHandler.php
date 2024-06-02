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

// Fetch the user's subjects from the database
$stdID = $_SESSION['stdID'];
$sql = "SELECT * FROM studySubject WHERE subjectBy='$stdID'";
$result = mysqli_query($conn, $sql);

// Loop through the subjects and create table rows
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['subjectName']}</td>";
    echo "<td>{$row['descriptionStudy']}</td>";
    echo "<td>{$row['scheduleStudy']}</td>";
    echo "<td><button class='delete-button' onclick='confirmDelete({$row['studySubjectID']})'><i style='margin-right:5px' class='fa fa-trash'></i> Delete</button></td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($conn);
?>