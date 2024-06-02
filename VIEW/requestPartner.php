<?php
session_start();
include './MODEL/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partnerID = $_POST['partnerID'];
    $studySubjectID = $_POST['studySubjectID'];
    $sessionID = $_SESSION['stdID'];

    // Check if the request already exists
    $check_sql = "SELECT * FROM studypartner WHERE studyPartnerBy = ? AND studyPartnerSubject = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('ii', $sessionID, $studySubjectID);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Record already exists
        echo "<script>
                alert('This partner has already been requested for this subject.');
                window.location.href='studyPartnerStudent.php';
              </script>";
    } else {
        // Insert new request
        $insert_sql = "INSERT INTO studypartner (studyPartnerBy, studyPartnerWith, studyPartnerSubject, studyPartnerAction) VALUES (?, ?, ?, 'Requested')";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param('iii', $sessionID, $partnerID, $studySubjectID);

        if ($insert_stmt->execute()) {
            echo "<script>
                    alert('Request sent successfully.');
                    window.location.href='studyPartnerStudent.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href='studyPartnerStudent.php';
                  </script>";
        }
    }

    $check_stmt->close();
    $conn->close();
}
?>
