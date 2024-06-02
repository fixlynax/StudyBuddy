<?php
include './MODEL/connect.php';

$sql = "SELECT reportissue.reportIssueID, reportissue.reportType, reportissue.reportDescription, student.stdName as reportBy, reportissue.reportDate, reportissue.resolveDate, reportissue.reportStatus 
        FROM reportissue 
        JOIN student ON reportissue.reportBy = student.stdID
        WHERE reportStatus = 'Resolved'";
$result = $conn->query($sql);

$issues = array();
while ($row = $result->fetch_assoc()) {
    $issues[] = $row;
}

echo json_encode($issues);

mysqli_close($conn);
?>
