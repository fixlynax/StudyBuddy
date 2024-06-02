<?php
// Start or resume the session
session_start();

// Include the database connection file
include '../VIEW/MODEL/connect.php';

// Get the user ID from the session
if (isset($_SESSION['stdID'])) {
    $stdID = $_SESSION['stdID'];

    // Update the stdOnline status to "Offline"
    $updateStatusSql = "UPDATE student SET stdOnline = 'Offline' WHERE stdID = ?";
    $stmt = $conn->prepare($updateStatusSql);
    $stmt->bind_param('i', $stdID);
    $stmt->execute();
    $stmt->close();
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Close the database connection
mysqli_close($conn);

// Redirect to the sign-in page after logout
header("Location: loginRegister.php");
exit();
?>
