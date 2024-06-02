<?php
include 'connect.php';

$query = "SELECT courseID, courseName FROM course";
$result = mysqli_query($conn, $query);

// $options = "<option value=''>Select Course</option>";

while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['courseID']}'>{$row['courseName']}</option>";
}

echo $options;

mysqli_close($conn);
?>