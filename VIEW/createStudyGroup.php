<?php
session_start();
include './MODEL/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studyGroupName = $_POST['studyGroupName'];
    $typeStudyGroup = $_POST['typeStudyGroup'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $studyPartner = $_POST['studyPartner'];
    $studySubjectID = $_POST['studySubjectID'];
    $sessionID = $_SESSION['stdID'];

    // Calculate the date 7 days from today
    $sevenDaysLater = date('Y-m-d', strtotime('+7 days'));

    // Validate the date
    if ($date < $sevenDaysLater) {
        // Date is not valid
        $suggestionDate = date('d F Y', strtotime('+7 days')); // Format the suggestion date as dd-mm-yyyy
        echo "<script>
                alert('The date is not valid. Please enter a date that is at least 7 days after the current date. This is a suggested date: $suggestionDate. Please add the subject after this date.');
                window.history.back();
              </script>";
        exit();
    }

    $sql = "INSERT INTO studygroup 
            (studyGroupName, studyGroupType, studyGroupDescription, studyGroupTime, studyGroupDate, studyGroupPartner, studyGroupSubject, studyPartnerBy, studyGroupStatus) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssssiii', $studyGroupName, $typeStudyGroup, $description, $time, $date, $studyPartner, $studySubjectID, $sessionID);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Study group created successfully.');
                    window.location.href='studyGroupStudent.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href='studyGroupStudent.php';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }

    mysqli_close($conn);
}
?>