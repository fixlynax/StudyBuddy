<?php
session_start();
include './MODEL/connect.php';

// Ensure the user is logged in
if (!isset($_SESSION['stdID'])) {
    header("Location: loginRegister.php");
    exit();
}

$sessionID = $_SESSION['stdID'];

// Fetch accepted study partners for the logged-in user
$sql = "SELECT 
            student.stdPicture,
            student.stdName,
            student.stdMatric,
            studysubject.subjectName,
            studysubject.descriptionStudy,
            studysubject.scheduleStudy
        FROM 
            studypartner
        INNER JOIN 
            student
        ON 
            student.stdID = studypartner.studyPartnerWith
        INNER JOIN 
            studysubject
        ON 
            studysubject.studySubjectID = studypartner.studyPartnerSubject
        WHERE 
            studypartner.studyPartnerBy = ?
        AND 
            studypartner.studyPartnerAction = 'Accepted'";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
$stmt->bind_param('i', $sessionID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><img src='" . $row['stdPicture'] . "' alt='Profile Picture'></td>
                <td>" . $row['stdName'] . "</td>
                <td>" . $row['stdMatric'] . "</td>
                <td>" . $row['subjectName'] . "</td>
                <td>" . $row['descriptionStudy'] . "</td>
                <td>" . $row['scheduleStudy'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No accepted study partners available</td></tr>";
}

$stmt->close();
mysqli_close($conn);
?>