<?php
// Include the database connection file
require_once "./MODEL/connect.php";

// Check if the resource ID is provided in the URL
if (isset($_GET['id'])) {
    $resourceID = $_GET['id'];

    // Delete the resource from the database
    $sql = "DELETE FROM resource WHERE resourceID = $resourceID";

    if (mysqli_query($conn, $sql)) {
        // Resource deleted successfully
        echo '<script>alert("Resource deleted successfully."); window.location.replace("dashbboardAdmin.php");</script>';
        exit();
    } else {
        echo "Error deleting resource: " . mysqli_error($conn);
    }
} else {
    echo "Resource ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>