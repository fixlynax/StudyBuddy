<?php
// Include the database connection file
include '../VIEW/MODEL/connect.php';

// Check if the signup button is clicked
if (isset($_POST['signup'])) {
    // Get the submitted form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize the inputs
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Set the userType to Student
    $currentDate = new DateTime();
    $currentDateStr = $currentDate->format('Y-m-d H:i:s');
    $userType = 'Student';
    $stdOnline = 'Offline';
    $stdStatusAcc = 'Active';

    // Validate the password
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        echo '<script>alert("Password must be at least 8 characters long and contain both letters and numbers."); window.location.replace("loginRegister.php");</script>';
    } else {
        // Check if the email already exists in the database
        $sql_check_email = "SELECT * FROM student WHERE stdEmail='$email'";
        $result_check_email = mysqli_query($conn, $sql_check_email);

        if (mysqli_num_rows($result_check_email) > 0) {
            // Email already exists
            echo '<script>alert("This email is already taken or registered. Please use a different email."); window.location.replace("register.php");</script>';
        } else {
            // Insert the new user into the database
            $sql_insert = "INSERT INTO student (stdName, stdEmail, stdPassword, userType, stdOnline, stdAccDate, stdStatusAcc) VALUES ('$name', '$email', '$password', '$userType', '$stdOnline', '$currentDateStr', '$stdStatusAcc')";
            if (mysqli_query($conn, $sql_insert)) {
                // Sign up successful
                echo '<script>alert("Sign up successful. Please sign in to start the journey."); window.location.replace("loginRegister.php");</script>';
            } else {
                // Error handling for database insertion failure
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
            }
        }
    }
} else {
    // Redirect to the sign-up page if accessed directly without submitting the form
    header("Location: loginRegister.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>