<?php
include './MODEL/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$stdID = $data['stdID'];
$status = $data['status'];
$description = isset($data['description']) ? $data['description'] : '';

$sql = "UPDATE student SET stdStatusAcc = ?, stdAccDate = NOW(), descStatus = ? WHERE stdID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $status, $description, $stdID);

if ($stmt->execute()) {
    echo "User status updated successfully.";
} else {
    echo "Error updating user status: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>