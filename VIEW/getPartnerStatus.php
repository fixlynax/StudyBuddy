<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];

$sql = "SELECT 
                    student.stdID, 
                    student.stdName, 
                    student.stdOnline 
                FROM 
                    studypartner 
                INNER JOIN 
                    student 
                ON 
                    studypartner.studyPartnerWith = student.stdID 
                WHERE 
                    studypartner.studyPartnerBy = ? 
                AND 
                    studypartner.studyPartnerAction = 'Accepted'";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sessionID);
$stmt->execute();
$result = $stmt->get_result();

$uniquePartners = [];
?>
