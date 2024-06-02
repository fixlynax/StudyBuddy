<?php
session_start();

// Include the database connection file
require_once "./MODEL/connect.php";

// Check if the user is logged in
if (!isset($_SESSION['stdID'])) {
    // Redirect to the login page if not logged in
    header("Location: loginRegister.php");
    exit();
}

// Fetch uploaded resources by session ID (stdID)
$stdID = $_SESSION['stdID'];
$sql = "SELECT * FROM resource WHERE uploadBy = $stdID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['topicResource'] . "</td>";
        echo "<td>" . $row['categoryResource'] . "</td>";
        echo "<td>" . $row['descResource'] . "</td>";
        echo "<td>" . $row['dateResource'] . "</td>";
        echo "<td>";
        // echo '<a href="viewResource.php?id=' . $row['resourceID'] . '" class="view-button">View</a>';
        echo '<a href="' . $row['fileResource'] . '" target="_blank" class="view-button">View</a>';
        echo '<a href="deleteResource.php?id=' . $row['resourceID'] . '" class="delete-button">Delete</a>';
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No resources found.</td></tr>";
}

// Close the database connection
mysqli_close($conn);
?>