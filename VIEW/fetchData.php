<?php
include './MODEL/connect.php';

header('Content-Type: application/json');

$response = [];

$online = mysqli_query($conn, "SELECT COUNT(*) as count FROM student WHERE stdOnline='Online'");
$offline = mysqli_query($conn, "SELECT COUNT(*) as count FROM student WHERE stdOnline='Offline'");
$response['online'] = mysqli_fetch_assoc($online)['count'];
$response['offline'] = mysqli_fetch_assoc($offline)['count'];

$active = mysqli_query($conn, "SELECT COUNT(*) as count FROM student WHERE stdStatusAcc='Active'");
$deactivated = mysqli_query($conn, "SELECT COUNT(*) as count FROM student WHERE stdStatusAcc='Deactivate'");
$response['active'] = mysqli_fetch_assoc($active)['count'];
$response['deactivated'] = mysqli_fetch_assoc($deactivated)['count'];

echo json_encode($response);
?>
