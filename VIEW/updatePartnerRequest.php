<?php
session_start();
include './MODEL/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['studyPartnerID']) && isset($data['action'])) {
    $studyPartnerID = $data['studyPartnerID'];
    $action = $data['action'];

    $sql = "UPDATE studypartner SET studyPartnerAction = ? WHERE studyPartnerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $action, $studyPartnerID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Request updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update request: ' . $conn->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>