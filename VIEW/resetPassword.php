<?php
// Include the database connection file
include './MODEL/connect.php';

// Start or resume the session
session_start();

// Check if stdID is passed in the URL
if (!isset($_GET['stdID'])) {
    // Redirect to the forgot password page if stdID is not provided
    header("Location: forgotPassword.php");
    exit();
}

// Get the stdID from the URL
$stdID = $_GET['stdID'];

// Fetch the student's name from the database
$sql = "SELECT stdName FROM student WHERE stdID='$stdID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$stdName = $row['stdName'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $reEnterNewPassword = mysqli_real_escape_string($conn, $_POST['reEnterNewPassword']);

    // Validate the password
    if (strlen($newPassword) < 8 || !preg_match('/[A-Za-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword)) {
        echo '<script>alert("Password must be at least 8 characters long and contain both letters and numbers.");</script>';
    } elseif ($newPassword !== $reEnterNewPassword) {
        echo '<script>alert("Passwords do not match.");</script>';
    } else {
        // Update the password in the database
        $updateSql = "UPDATE student SET stdPassword='$newPassword' WHERE stdID='$stdID'";
        if (mysqli_query($conn, $updateSql)) {
            echo '<script>
                    alert("Password reset successful. Please sign in with your new password.");
                    window.location.href = "loginRegister.php";
                  </script>';
            exit();
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/resetForgot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="container" id="container">
        <div class="card">
            <form method="POST">
                <h1>Reset Password for <?php echo htmlspecialchars($stdName); ?></h1>
                <label for="name">New Password</label>
                <input type="password" name="newPassword" placeholder="New Password" required />
                <label for="name">Re-Enter New Password</label>
                <input type="password" name="reEnterNewPassword" placeholder="Re-enter New Password" required />
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>
    <footer>
        <p>
            Created with <i>StudyBuddy</i> by
            <a target="_blank" href="https://www.umpsa.edu.my/">Yapish</a>
            - Final Year Project
            <a target="_blank" href="https://www.umpsa.edu.my/">UMPSA</a>.
        </p>
    </footer>
    <script src="JS/loginRegister.js" defer></script>
</body>
</html>
