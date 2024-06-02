<?php
include './MODEL/connect.php';

header('Content-Type: application/json');

// Fetch data for resource statistics based on categoryResource
$query = "SELECT categoryResource, COUNT(*) AS totalResources 
          FROM resource 
          GROUP BY categoryResource";

$result = mysqli_query($conn, $query);

$response = [];
while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
}

echo json_encode($response);
?>
