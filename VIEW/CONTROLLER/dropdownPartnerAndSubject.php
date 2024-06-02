<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];
$sql = "SELECT 
                                sp.studyPartnerWith, 
                                ss.subjectName, 
                                s.stdName,
                                sp.studyPartnerSubject
                            FROM 
                                studypartner sp 
                            JOIN 
                                studysubject ss 
                            ON 
                                sp.studyPartnerSubject = ss.studySubjectID 
                            JOIN 
                                student s 
                            ON 
                                sp.studyPartnerWith = s.stdID 
                            WHERE 
                                sp.studyPartnerBy = ? 
                            AND 
                                sp.studyPartnerAction = 'Accepted'
                            AND 
                                NOT EXISTS (
                                    SELECT 1 FROM studygroup sg 
                                    WHERE sg.studyGroupPartner = sp.studyPartnerWith 
                                    AND sg.studyGroupSubject = sp.studyPartnerSubject
                                )";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sessionID);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['studyPartnerWith'] . "' data-subject-id='" . $row['studyPartnerSubject'] . "'>" . $row['stdName'] . " - " . $row['subjectName'] . "</option>";
}

$stmt->close();
mysqli_close($conn);
?>