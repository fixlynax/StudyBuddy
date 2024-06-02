<?php
session_start();
include './MODEL/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectName = $_POST['subjectName'];
    $sessionID = $_SESSION['stdID'];
    $currentDate = date('Y-m-d', strtotime('-3 days'));

    $sql = "SELECT 
                student.stdID,
                student.stdPicture, 
                student.stdName, 
                student.stdMatric, 
                studysubject.subjectName, 
                studysubject.descriptionStudy, 
                studysubject.scheduleStudy, 
                studysubject.studySubjectID 
            FROM 
                student 
            INNER JOIN 
                studysubject 
            ON 
                student.stdID = studysubject.subjectBy 
            WHERE 
                studysubject.subjectName = ? 
            AND 
                studysubject.subjectBy != ? 
            AND 
                studysubject.scheduleStudy >= ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('sis', $subjectName, $sessionID, $currentDate);
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
                    <td>
                        <form method='POST' action='requestPartner.php'>
                            <input type='hidden' name='partnerID' value='" . $row['stdID'] . "'>
                            <input type='hidden' name='studySubjectID' value='" . $row['studySubjectID'] . "'>
                            <button type='submit' class='action-button'>Request</button>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No partners available</td></tr>";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>