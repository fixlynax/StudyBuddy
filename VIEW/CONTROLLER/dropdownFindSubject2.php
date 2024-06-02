<?php
session_start();
include './MODEL/connect.php';

// Assuming sessionID (stdID) is stored in $_SESSION['sessionID']
$sessionID = $_SESSION['stdID'];

$sql = "SELECT subjectName FROM studysubject WHERE subjectBy = ?";
$stmt = $conn->prepare($sql); 
if ($stmt) {
    $stmt->bind_param('i', $sessionID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['subjectName'] . "'>" . $row['subjectName'] . "</option>";
    }
    $stmt->close();
} else {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

mysqli_close($conn);
?>
