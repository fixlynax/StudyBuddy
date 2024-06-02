<?php
// Include the database connection file
include './MODEL/connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $stdName = mysqli_real_escape_string($conn, $_POST['stdName']);
    $stdMatric = mysqli_real_escape_string($conn, $_POST['stdMatric']);
    $stdEmail = mysqli_real_escape_string($conn, $_POST['stdEmail']);
    $stdMajor = mysqli_real_escape_string($conn, $_POST['stdMajor']);
    $stdCourse = mysqli_real_escape_string($conn, $_POST['stdCourse']);
    $stdCGPA = mysqli_real_escape_string($conn, $_POST['stdCGPA']);

    // Check the details against the database
    $sql = "SELECT stdID FROM student WHERE stdName='$stdName' AND stdMatric='$stdMatric' AND stdEmail='$stdEmail' AND stdMajor='$stdMajor' AND stdCourse='$stdCourse' AND stdCGPA='$stdCGPA'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Fetch the stdID
        $row = mysqli_fetch_assoc($result);
        $stdID = $row['stdID'];

        // Show alert and redirect to resetPassword.php
        echo '<script>
                alert("The data that you entered is correct.");
                window.location.href = "resetPassword.php?stdID=' . $stdID . '";
              </script>';
        exit();
    } else {
        echo '<script>alert("The details do not match any record in our database.");</script>';
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
    <title>Forgot Password</title>
</head>
<body>
    <div class="container" id="container">
        <div class="card">
            <form method="POST">
                <h1>Forgot Password</h1>
                <label for="name">Name</label>
                <input type="text" name="stdName" placeholder="Enter Your Name" required />
                <label for="name">Matric No</label>
                <input type="text" name="stdMatric" placeholder="Enter Your Matric" required />
                <label for="name">Email</label>
                <input type="email" name="stdEmail" placeholder="Enter Your Email" required />
                <label for="name">Major</label>
                <input type="text" name="stdMajor" placeholder="Enter Your Major" required />
                <label for="name">Course</label>
                <input type="text" name="stdCourse" placeholder="Enter Your Course" required />
                <label for="name">CGPA</label>
                <input type="text" name="stdCGPA" placeholder="Enter Your CGPA" required />
                <button type="submit">Submit</button>
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
