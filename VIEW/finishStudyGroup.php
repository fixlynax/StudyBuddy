<?php
session_start();
include './MODEL/connect.php';

if (isset($_GET['studyGroupID'])) {
    $studyGroupID = $_GET['studyGroupID'];

    $sql = "UPDATE studygroup SET studyGroupStatus = 'Done', rateStatus = 'Undone' WHERE studyGroupID = ?";
    $stmt = $conn->prepare($sql); 
    if ($stmt) {
        $stmt->bind_param('i', $studyGroupID);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Study group finished successfully.');
                    window.location.href='showStudyGroup.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href='showStudyGroup.php';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }

    mysqli_close($conn);
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href='showStudyGroup.php';
          </script>";
}
?>
