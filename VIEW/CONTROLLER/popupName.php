<?php

// Start or resume the session
session_start();

// Check if the session ID is set and not empty
if (isset($_SESSION['stdID']) && !empty($_SESSION['stdID'])) {
    // Sanitize the session ID to prevent SQL injection
    $stdID = mysqli_real_escape_string($conn, $_SESSION['stdID']);

    // Query to fetch profile details based on session ID
    $sql = "SELECT * FROM student WHERE stdID = '$stdID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Extract profile details from the fetched row
        $stdName = $row['stdName'];

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "No profile found for this session ID.";
        exit; // Stop further execution if no profile found
    }
} else {
    echo "Session ID not set.";
    exit; // Stop further execution if session ID not set
}

?>