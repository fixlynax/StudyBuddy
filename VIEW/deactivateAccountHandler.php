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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deactivate'])) {
    // Get the student ID from the session
    $stdID = $_SESSION['stdID'];

    // Update the student's account status and description in the database
    $sql = "UPDATE student SET stdStatusAcc='Deactivate', descStatus='Account has been deactivated by own user' WHERE stdID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stdID);

    if ($stmt->execute()) {
        // Redirect to the logout handler page after successful deactivation
        header("Location: logoutHandler.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
