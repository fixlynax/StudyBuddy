<?php
session_start();
include './MODEL/connect.php';

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (senderID, receiverID, messageText, timestamp) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iis', $sender, $receiver, $message);

if ($stmt->execute()) {
    echo "Message sent";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>
