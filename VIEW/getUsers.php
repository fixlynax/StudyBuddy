<?php
include './MODEL/connect.php';

$status = $_GET['status'];

$sql = "SELECT stdID, stdName 
        FROM student 
        WHERE stdStatusAcc = ? AND userType = 'Student'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $status);
$stmt->execute();
$result = $stmt->get_result();

$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$stmt->close();
mysqli_close($conn);

echo json_encode($users);
?>