<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];
$partnerWith = $_GET['partnerID'];

$sql = "SELECT 
            messages.*, 
            sender.stdName AS senderName, 
            receiver.stdName AS receiverName 
        FROM 
            messages 
        INNER JOIN 
            student AS sender 
        ON 
            messages.senderID = sender.stdID 
        INNER JOIN 
            student AS receiver 
        ON 
            messages.receiverID = receiver.stdID 
        WHERE 
            (messages.senderID = ? AND messages.receiverID = ?) 
            OR 
            (messages.senderID = ? AND messages.receiverID = ?)
        ORDER BY 
            messages.timestamp ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('iiii', $sessionID, $partnerWith, $partnerWith, $sessionID);
$stmt->execute();
$result = $stmt->get_result();

$messages = '';
while ($row = $result->fetch_assoc()) {
    $class = $row['senderID'] == $sessionID ? 'self' : 'other';
    $messages .= "<div class='message $class'><strong>{$row['senderName']}<br></strong> {$row['messageText']}<br><small>{$row['timestamp']}</small></div>";
}

echo $messages;

$stmt->close();
mysqli_close($conn);
?>
