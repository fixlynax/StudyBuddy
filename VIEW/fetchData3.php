<?php
include './MODEL/connect.php';

header('Content-Type: application/json');

// Fetch data for study subject statistics based on subjectName
$query = "SELECT subjectName, COUNT(*) AS totalSubjects 
          FROM studysubject 
          GROUP BY subjectName";

$result = mysqli_query($conn, $query);

$response = [];
while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
}

echo json_encode($response);
?>