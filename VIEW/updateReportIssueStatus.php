<?php
include './MODEL/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$reportIssueID = $data['reportIssueID'];
$reportStatus = $data['reportStatus'];
$resolveDate = ($reportStatus === 'Resolved') ? date('Y-m-d H:i:s') : NULL;

$sql = "UPDATE reportissue 
        SET reportStatus = ?, resolveDate = ? 
        WHERE reportIssueID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $reportStatus, $resolveDate, $reportIssueID);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Issue status updated successfully.";
} else {
    $response['success'] = false;
    $response['message'] = "Error updating issue status: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);

echo json_encode($response);
?>