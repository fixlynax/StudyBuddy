<?php
include './MODEL/connect.php';

if (isset($_GET['stdID'])) {
    $stdID = $_GET['stdID'];

    $sql = "SELECT * FROM student WHERE stdID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $stdID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(array('error' => 'User not found'));
    }

    $stmt->close();
}

mysqli_close($conn);
?>
