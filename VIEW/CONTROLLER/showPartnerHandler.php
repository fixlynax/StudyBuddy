<?php
// Include the database connection file
include './MODEL/connect.php';

// Fetch partners from the database
$sessionID = $_SESSION['stdID'];
$currentDate = date('Y-m-d', strtotime('-3 days'));

$sql = "SELECT 
            student.stdPicture, 
            student.stdName, 
            student.stdMatric, 
            student.stdCourse, 
            studysubject.descriptionStudy, 
            studysubject.scheduleStudy, 
            studypartner.studyPartnerID, 
            studypartner.studyPartnerAction 
        FROM 
            student 
        INNER JOIN 
            studysubject 
        ON 
            student.stdID = studysubject.subjectBy 
        LEFT JOIN 
            studypartner 
        ON 
            studypartner.studyPartnerWith = student.stdID 
        WHERE 
            studysubject.subjectBy = ? 
        AND 
            studysubject.scheduleStudy >= ? 
        AND 
            (studypartner.studyPartnerAction IS NULL OR studypartner.studyPartnerAction = 'Request')
        ORDER BY 
            studysubject.scheduleStudy ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $sessionID, $currentDate);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td><img src='" . $row['stdPicture'] . "' alt='Profile Picture'></td>
            <td>" . $row['stdName'] . "</td>
            <td>" . $row['stdMatric'] . "</td>
            <td>" . $row['stdCourse'] . "</td>
            <td>" . $row['descriptionStudy'] . "</td>
            <td>" . $row['scheduleStudy'] . "</td>
            <td><button class='action-button' data-partner-id='" . $row['studyPartnerID'] . "'>Request</button></td>
          </tr>";
}

// Close the database connection
$stmt->close();
mysqli_close($conn);
?>