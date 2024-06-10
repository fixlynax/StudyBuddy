<?php
// Include the database connection file
require_once "./MODEL/connect.php";

// Fetch the deactivated users from the database
$sql = "SELECT stdPicture, stdName, stdMatric, stdEmail, stdStatusAcc, descStatus FROM student WHERE stdStatusAcc = 'Deactivate'";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><img src='" . $row['stdPicture'] . "' alt='User Picture' style='width:50px;height:50px;'></td>";
        echo "<td>" . $row['stdName'] . "</td>";
        echo "<td>" . $row['stdMatric'] . "</td>";
        echo "<td>" . $row['stdEmail'] . "</td>";
        echo "<td>" . $row['stdStatusAcc'] . "</td>";
        echo "<td>" . $row['descStatus'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No deactivated users found.</td></tr>";
}

// Close the database connection
mysqli_close($conn);
?>