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
                student.stdCGPA,
                studysubject.subjectName, 
                studysubject.descriptionStudy, 
                studysubject.scheduleStudy, 
                studysubject.studySubjectID,
                COALESCE(rating.pointRating, 0) AS pointRating
            FROM 
                student 
            INNER JOIN 
                studysubject 
            ON 
                student.stdID = studysubject.subjectBy 
            LEFT JOIN 
                rating 
            ON 
                student.stdID = rating.studentID
            WHERE 
                studysubject.subjectName = ? 
            AND 
                studysubject.subjectBy != ? 
            AND 
                studysubject.scheduleStudy >= ?
            ORDER BY 
                student.stdCGPA DESC, 
                pointRating DESC";

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
                    <td style='text-align:left;'>" . $row['stdName'] . ' [ Rating : ' .$row['pointRating'] . ']' ."</td>
                    <td>" . $row['stdMatric'] . "</td>
                    <td>" . $row['subjectName'] . "</td>
                    <td>" . $row['stdCGPA'] . "</td>
                    <td style='text-align:left;'>" . $row['descriptionStudy'] . "</td>
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
        echo "<tr><td colspan='9'>No partners available</td></tr>";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>