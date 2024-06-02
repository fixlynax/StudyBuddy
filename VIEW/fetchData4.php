<?php
include './MODEL/connect.php';

header('Content-Type: application/json');

// Fetch data for study group statistics based on studyGroupType
$query = "SELECT studyGroupType, COUNT(*) AS totalGroups 
          FROM studygroup 
          GROUP BY studyGroupType";

$result = mysqli_query($conn, $query);

$response = [];
while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
}

echo json_encode($response);
?>
