<?php
include './MODEL/connect.php';

$sql = "SELECT reportissue.reportIssueID, reportissue.reportType, reportissue.reportDescription, reportissue.reportPicture, student.stdName as reportBy, reportissue.reportDate, reportissue.reportStatus 
        FROM reportissue 
        JOIN student ON reportissue.reportBy = student.stdID
        WHERE reportStatus IN ('Pending', 'In Progress', 'On Hold')";
$result = $conn->query($sql);

$issues = array();
while ($row = $result->fetch_assoc()) {
    $issues[] = $row;
}

echo json_encode($issues);

mysqli_close($conn);
?>
