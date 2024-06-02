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

// Get the session ID
$reportBy = $_SESSION['stdID'];

// Fetch the report issues from the database filtered by session ID
$sql = "SELECT reportType, reportDescription, reportDate, reportStatus FROM reportissue WHERE reportBy = '$reportBy'";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['reportType'] . "</td>";
        echo "<td>" . $row['reportDescription'] . "</td>";
        echo "<td>" . date("F j, Y", strtotime($row['reportDate'])) . "</td>";
        $statusClass = '';
        if ($row['reportStatus'] == 'Pending') {
            $statusClass = 'status-pending';
        } elseif ($row['reportStatus'] == 'In Progress') {
            $statusClass = 'status-in-progress';
        } elseif ($row['reportStatus'] == 'Resolved') {
            $statusClass = 'status-accept';
        } elseif ($row['reportStatus'] == 'On Hold') {
            $statusClass = 'status-onhold';
        }
        echo "<td class='" . $statusClass . "'>" . $row['reportStatus'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No report issues found.</td></tr>";
}

// Close the database connection
mysqli_close($conn);
?>