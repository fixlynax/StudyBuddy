<?php
session_start();
include './MODEL/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studyGroupID = $_POST['studyGroupID'];
    $partnerID = $_POST['partnerID'];
    $rating = $_POST['star'];

    $points = match ($rating) {
        '1' => 3,
        '2' => 7,
        '3' => 15,
        '4' => 30,
        '5' => 50,
        default => 0
    };

    // Check if the student has already been rated
    $sql = "SELECT * FROM rating WHERE studentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $partnerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Student already rated before, update the points
        $row = $result->fetch_assoc();
        $newPoints = $row['pointRating'] + $points;
        $update_sql = "UPDATE rating SET pointRating = ? WHERE studentID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('ii', $newPoints, $partnerID);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // New rating entry
        $insert_sql = "INSERT INTO rating (studentID, pointRating) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param('ii', $partnerID, $points);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    // Update the study group rate status
    $update_study_sql = "UPDATE studygroup SET rateStatus = 'Done' WHERE studyGroupID = ?";
    $update_study_stmt = $conn->prepare($update_study_sql);
    $update_study_stmt->bind_param('i', $studyGroupID);
    $update_study_stmt->execute();
    $update_study_stmt->close();

    $stmt->close();
    $conn->close();

    header('Location: dashboardStudent.php');
    exit();
}
?>