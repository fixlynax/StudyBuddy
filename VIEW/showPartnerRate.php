<?php

$sessionID = $_SESSION['stdID'];

$sql = "SELECT 
            sg.*, 
            ss.subjectName, 
            s.stdName 
        FROM 
            studygroup sg 
        JOIN 
            studysubject ss 
        ON 
            sg.studyGroupSubject = ss.studySubjectID 
        JOIN 
            student s 
        ON 
            sg.studyGroupPartner = s.stdID 
        WHERE 
            sg.studyGroupPartner != ? 
        AND 
            sg.studyGroupStatus = 'Done' 
        AND 
            sg.rateStatus = 'Undone'";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sessionID);
$stmt->execute();
$result = $stmt->get_result();
?>