<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];

$sql = "SELECT 
            student.stdPicture, 
            student.stdName, 
            student.stdMatric, 
            studysubject.subjectName, 
            studysubject.descriptionStudy, 
            studysubject.scheduleStudy, 
            studypartner.studyPartnerID,
            studypartner.studyPartnerWith
        FROM 
            studypartner
        INNER JOIN 
            student 
        ON 
            studypartner.studyPartnerBy = student.stdID 
        INNER JOIN 
            studysubject 
        ON 
            studypartner.studyPartnerSubject = studysubject.studySubjectID 
        WHERE 
            studypartner.studyPartnerWith = ? 
        AND 
            studypartner.studyPartnerBy != ? 
        AND 
            studypartner.studyPartnerAction = 'Accepted'
        ORDER BY 
            studysubject.scheduleStudy DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $sessionID, $sessionID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><img src='" . $row['stdPicture'] . "' alt='Profile Picture' class='rounded-image'></td>
                <td>" . $row['stdName'] . "</td>
                <td>" . $row['stdMatric'] . "</td>
                <td>" . $row['subjectName'] . "</td>
                <td>" . $row['descriptionStudy'] . "</td>
                <td>" . $row['scheduleStudy'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No partner accepted available</td></tr>";
}

$stmt->close();
mysqli_close($conn);
?>