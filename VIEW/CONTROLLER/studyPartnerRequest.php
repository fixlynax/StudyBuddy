<?php
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];

$sql = "SELECT 
            student.stdPicture, 
            student.stdName, 
            student.stdMatric, 
            studysubject.subjectName, 
            studysubject.descriptionStudy, 
            studysubject.scheduleStudy, 
            studypartner.studyPartnerID 
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
            studypartner.studyPartnerAction = 'Requested'
        ORDER BY 
            studysubject.scheduleStudy ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $sessionID, $sessionID);
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
                <td style='text-align:center;'>
                    <button class='action-button-accept' onclick='updatePartnerRequest(" . $row['studyPartnerID'] . ", \"Accepted\")'>Accept</button>
                    <button class='action-button-reject' onclick='updatePartnerRequest(" . $row['studyPartnerID'] . ", \"Rejected\")'>Reject</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No partner requests available</td></tr>";
}

// $stmt->close();
// mysqli_close($conn);
?>