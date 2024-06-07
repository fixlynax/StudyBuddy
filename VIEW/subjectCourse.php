<?php
// Include the database connection file
include '../VIEW/MODEL/connect.php';

// Initialize variables
$subjectError = '';
$courseError = '';
$subjectSuccess = '';
$courseSuccess = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitSubject'])) {
        // Handle subject submission
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $courseID = mysqli_real_escape_string($conn, $_POST['courseID']);

        // Check if the subject already exists
        $sql = "SELECT * FROM subject WHERE subjectName = '$subject'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $subjectError = "This subject already exists.";
        } else {
            // Insert the new subject
            $sql = "INSERT INTO subject (subjectName, subjectMajor) VALUES ('$subject', '$courseID')";
            if (mysqli_query($conn, $sql)) {
                $subjectSuccess = "Subject added successfully.";
            } else {
                $subjectError = "Error: " . mysqli_error($conn);
            }
        }
    } elseif (isset($_POST['submitCourse'])) {
        // Handle course submission
        $course = mysqli_real_escape_string($conn, $_POST['course']);

        // Check if the course already exists
        $sql = "SELECT * FROM course WHERE courseName = '$course'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $courseError = "This course already exists.";
        } else {
            // Insert the new course
            $sql = "INSERT INTO course (courseName) VALUES ('$course')";
            if (mysqli_query($conn, $sql)) {
                $courseSuccess = "Course added successfully.";
            } else {
                $courseError = "Error: " . mysqli_error($conn);
            }
        }
    }
}

// Fetch all courses for the dropdown
$sql = "SELECT * FROM course";
$courses = mysqli_query($conn, $sql);

// Fetch all subjects and their corresponding courses

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Subject Course</title>
    <link rel="icon" href="Images/icon.png" type="image/icon type">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/editUserDetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script>
        function showAlert(message, type) {
            let alertBox = document.createElement('div');
            alertBox.className = 'alert-box ' + type;
            alertBox.innerText = message;
            document.body.appendChild(alertBox);

            setTimeout(() => {
                alertBox.remove();
            }, 3000);
        }

        window.onload = function() {
            <?php if ($subjectError): ?>
                showAlert("<?= $subjectError ?>", 'error');
            <?php elseif ($subjectSuccess): ?>
                showAlert("<?= $subjectSuccess ?>", 'success');
            <?php endif; ?>

            <?php if ($courseError): ?>
                showAlert("<?= $courseError ?>", 'error');
            <?php elseif ($courseSuccess): ?>
                showAlert("<?= $courseSuccess ?>", 'success');
            <?php endif; ?>
        };
    </script>
    <style>
        .alert-box {
            position: fixed;
            top: 3%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 30px;
            border-radius: 5px;
            z-index: 1000;
            text-align: center;
        }
    
        .alert-box.success {
            background-color: #4CAF50;
            color: white;
        }
    
        .alert-box.error {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <section class="container">
        <aside class="side_bar">
            <div class="title">
                <div class="logo">StudyBuddy</div>
                <label class=" button cancel" for="check"><i class="fas fa-times"></i></label>
            </div>
            <ul>
                <?php
                include './CONTROLLER/sidebarNavAdmin.php';
                ?>
            </ul>
            <div class="media_icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </aside>
        <article class="content">
    <div class="padding-container">
        <div class="card">
            <h2>Subject</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <labelE for="select-subject">Select Course</labelE>
                    <select id="selectcourse" name="courseID" required>
                        <option style="font-style: italic;" value="">Select Course..</option>
                        <?php while ($row = mysqli_fetch_assoc($courses)): ?>
                                    <option value="<?= $row['courseName'] ?>"><?= $row['courseName'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <input type="text" id="subject" name="subject" placeholder="Type a name of subject.. eg: Software Bester" required>
                            <button type="submit" name="submitSubject">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <h2>Course</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <labelE for="select-course">Course</labelE>
                            <input type="text" id="course" name="course" placeholder="Type a name of course.." required>
                            <button type="submit" name="submitCourse">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>