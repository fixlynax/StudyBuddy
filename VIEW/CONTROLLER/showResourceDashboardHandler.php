<?php
// session_start();

// Include the database connection file
include "./MODEL/connect.php";

// Fetch resource data from the database
$sql = "SELECT * FROM resource";
$result = mysqli_query($conn, $sql);

// Generate table rows dynamically
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['topicResource']}</td>";
        echo "<td>{$row['categoryResource']}</td>";
        echo "<td>{$row['descResource']}</td>";
        echo "<td>{$row['dateResource']}</td>";
        echo "<td style='text-align: center;'>";
        echo '<a href="' . $row['fileResource'] . '" target="_blank" class="view-button" style="margin-right: 8px;"><i class="fas fa-eye"></i></a>';
        echo "<a href='downloadFile.php?file={$row['fileResource']}' class='download-button'><i class='fas fa-download'></i></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No resources found.</td></tr>";
}

// Close the database connection
mysqli_close($conn);
?>