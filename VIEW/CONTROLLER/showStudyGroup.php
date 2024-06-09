<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

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
                                sg.studyGroupPartner != ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sessionID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $status = $row['studyGroupStatus'];
    $statusColor = '';
    $actionButton = '';

    if ($status == 'Pending') {
        $statusColor = 'orange';
    } elseif ($status == 'Ongoing') {
        $statusColor = 'blue';
        $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
    } elseif ($status == 'Done') {
        $statusColor = 'green';
    } elseif ($status == 'Delay') {
        $statusColor = 'red';
        $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
    }

    $groupDateTime = strtotime($row['studyGroupDate'] . ' ' . $row['studyGroupTime']);
    $currentDateTime = strtotime($currentDate . ' ' . $currentTime);

    // Automatically update status based on current date and time
    if ($status == 'Pending' && $groupDateTime <= $currentDateTime) {
        $status = 'Ongoing';
        $statusColor = 'blue';
        $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
        // Update the status in the database
        $update_sql = "UPDATE studygroup SET studyGroupStatus = 'Ongoing' WHERE studyGroupID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('i', $row['studyGroupID']);
        $update_stmt->execute();
    } elseif ($status == 'Ongoing' && $groupDateTime != $currentDateTime) {
        $status = 'Delay';
        $statusColor = 'red';
        $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
        // Update the status in the database
        $update_sql = "UPDATE studygroup SET studyGroupStatus = 'Delay' WHERE studyGroupID = ?";
        $update_stmt->bind_param('i', $row['studyGroupID']);
        $update_stmt->execute();
    }

    echo "<tr>
                                <td>{$row['studyGroupName']}</td>
                                <td>{$row['studyGroupType']}</td>
                                <td>{$row['subjectName']}</td>
                                <td>{$row['studyGroupDescription']}</td>
                                <td>{$row['studyGroupDate']} - {$row['studyGroupTime']}</td>
                                <td>{$row['stdName']}</td>
                                <td class='status-text' style='color: $statusColor;'>$status</td>
                                <td style='text-align:center;'>$actionButton</td>
                              </tr>";
}else {
    echo "<tr><td colspan='8'>No study group created</td></tr>";
}

$stmt->close();
mysqli_close($conn);
?>