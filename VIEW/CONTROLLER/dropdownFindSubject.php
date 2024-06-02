<?php
include './MODEL/connect.php';

$sql = "SELECT subjectID, subjectName FROM subject";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['subjectName'] . "'>" . $row['subjectName'] . "</option>";
}

mysqli_close($conn);
?>