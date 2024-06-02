<?php
include './MODEL/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $stdID = $data['stdID'];
    $stdName = $data['stdName'];
    $stdMatric = $data['stdMatric'];
    $stdEmail = $data['stdEmail'];
    $stdPassword = $data['stdPassword'];
    $stdMajor = $data['stdMajor'];
    $stdCourse = $data['stdCourse'];
    $stdCGPA = $data['stdCGPA'];

    $sql = "UPDATE student SET stdName = ?, stdMatric = ?, stdEmail = ?, stdPassword = ?, stdMajor = ?, stdCourse = ?, stdCGPA = ? WHERE stdID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssi', $stdName, $stdMatric, $stdEmail, $stdPassword, $stdMajor, $stdCourse, $stdCGPA, $stdID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => 'User details updated successfully'));
    } else {
        echo json_encode(array('error' => 'Failed to update user details'));
    }

    $stmt->close();
}

mysqli_close($conn);
?>
