<?php
// Include the database connection file
include '../VIEW/MODEL/connect.php';

// Start or resume the session
session_start();

// Check if the signin button is clicked
if (isset($_POST['signin'])) {
    // Get the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize the inputs
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check user credentials
    $sql = "SELECT * FROM student WHERE stdEmail = '$email' AND stdPassword = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // User found, fetch profile details
        $row = mysqli_fetch_assoc($result);
        $stdID = $row['stdID'];
        $stdType = $row['userType']; // Assuming stdType is stored in userType
        $stdPicture = $row['stdPicture'];
        $stdName = $row['stdName'];
        $stdMatric = $row['stdMatric'];
        $stdMajor = $row['stdMajor'];
        $stdCourse = $row['stdCourse'];
        $stdCGPA = $row['stdCGPA'];
        $stdStatus = $row['stdStatus'];
        $stdAccDate = $row['stdAccDate'];
        $stdStatusAcc = $row['stdStatusAcc'];
        $descStatus = $row['descStatus'];

        // Check if the account is active
        if ($stdStatusAcc !== 'Active') {
            echo "<script>
                    alert('$descStatus');
                    window.location.href='loginRegister.php';
                  </script>";
            exit();
        }

        // Check if the last access date is over 30 days
        $currentDate = new DateTime();
        $lastAccessDate = new DateTime($stdAccDate);
        $interval = $currentDate->diff($lastAccessDate);

        if ($interval->days > 30) {
            // Update the account status to Deactivate
            $updateDeactivateSql = "UPDATE student SET stdStatusAcc = 'Deactivate', descStatus = 'This account already deactived because over 30 days' WHERE stdID = $stdID";
            mysqli_query($conn, $updateDeactivateSql);

            echo "<script>
                    alert('Over 30 days');
                    window.location.href='loginRegister.php';
                  </script>";
            exit();
        }

        // Update the stdOnline status to "Online" and stdAccDate to the current date
        $currentDateStr = $currentDate->format('Y-m-d H:i:s');
        $updateStatusSql = "UPDATE student SET stdOnline = 'Online', stdAccDate = '$currentDateStr' WHERE stdID = $stdID";
        mysqli_query($conn, $updateStatusSql);

        // Store user data in session variables
        $_SESSION['stdID'] = $stdID;
        $_SESSION['stdName'] = $stdName;

        // Redirect based on user type
        if ($stdType == 'Student') {
            header("Location: dashboardStudent.php");
        } elseif ($stdType == 'Admin') {
            header("Location: dashboardAdmin.php");
        }
        exit();
    } else {
        // User not found or invalid credentials
        echo "<script>
                alert('Invalid email or password. Please try again.');
                window.location.href='loginRegister.php';
              </script>";
    }
} else {
    // Redirect to the sign-in page if accessed directly without submitting the form
    header("Location: loginRegister.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>