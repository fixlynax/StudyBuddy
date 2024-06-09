<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/editProfileStudent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <section class="container">
        <aside class="side_bar">
            <div class="title">
                <div class="logo">StudyBuddy</div>
                <label class="button cancel" for="check"><i class="fas fa-times"></i></label>
            </div>
            <ul>
                <?php
                include './CONTROLLER/sidebarNav.php';
                ?>
            </ul>
            <div class="media_icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </aside>
        <?php
        // Include the database connection file
        include './MODEL/connect.php';

        // Start or resume the session
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['stdID'])) {
            // Redirect to the sign-in page if not logged in
            header("Location: loginRegister.php");
            exit();
        }

        // Fetch the user's current data from the database
        $sql = "SELECT * FROM student WHERE stdID={$_SESSION['stdID']}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Fetch all courses from the database
        $courseSql = "SELECT * FROM course";
        $courseResult = mysqli_query($conn, $courseSql);

        // Close the database connection
        mysqli_close($conn);
        ?>
        <article class="content">
            <div class="padding-container">
                <form action="editProfileHandler.php" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <h2>Edit Profile</h2>
                        <labelP for="pictureIssue">Profile Image</labelP>
                        <input type="file" id="pictureIssue" name="pictureIssue" accept="image/*">

                        <labelP for="name">Name</labelP>
                        <input type="text" id="name" name="name" value="<?php echo $row['stdName']; ?>" required>

                        <labelP for="matric">Matric</labelP>
                        <input type="text" id="matric" name="matric" value="<?php echo $row['stdMatric']; ?>" required>

                        <labelP for="email">Email</labelP>
                        <input type="email" id="email" name="email" value="<?php echo $row['stdEmail']; ?>" required>

                        <div class="password-container">
                            <labelP for="password">Password</labelP>
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                    value="<?php echo $row['stdPassword']; ?>" required>
                                <span class="toggle-password" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>

                        <labelP for="course">Course</labelP>
                        <select id="course" name="course" required>
                            <?php
                            // Loop through the courses and create options
                            while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                $selected = $row['stdCourse'] == $courseRow['courseID'] ? 'selected' : '';
                                echo "<option value='" . $courseRow['courseName'] . "' $selected>" . $courseRow['courseName'] . "</option>";
                            }
                            ?>
                        </select>

                        <labelP for="major">Major</labelP>
                        <select id="major" name="major" required>
                    <!-- Options will be populated dynamically -->
                        </select>
        
                <labelP for="cgpa">CGPA</labelP>
                        <input type="text" id="cgpa" name="cgpa" value="<?php echo $row['stdCGPA']; ?>" required>
        
                        <button type="submit" name="edit" class="save-button">Save</button>
                </form>
            </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script>
        const majors = {
            "Faculty Computing": [
                "Software Engineering",
                "Networking",
                "Graphic And Multimedia",
                "Cyber Security"
            ],
            "Faculty Electrical": [
                "Electronics",
                "Electrical",
                "Power & Machine",
                "Computer System",
                "Electrical Systems Maintenance",
                "Industrial Electronic Automation",
                "Electrical Engineering"
            ],
            "Faculty Mechanical": [
                "Mechanical Engineering",
                "Automotive",
                "Oil And Gas",
                "Design And Analysis",
                "Welding"
            ]
        };

        document.addEventListener('DOMContentLoaded', function () {
            const courseSelect = document.getElementById('course');
            const majorSelect = document.getElementById('major');

            courseSelect.addEventListener('change', function () {
                updateMajors();
            });

            // Populate majors based on the initially selected course
            updateMajors();

            function updateMajors() {
                const selectedCourse = courseSelect.value;
                majorSelect.innerHTML = ''; // Clear existing options

                if (majors[selectedCourse]) {
                    majors[selectedCourse].forEach(major => {
                        const option = document.createElement('option');
                        option.value = major;
                        option.textContent = major;
                        majorSelect.appendChild(option);
                    });

                    // Set the previously selected major
                    const selectedMajor = "<?php echo $row['stdMajor']; ?>";
                    majorSelect.value = selectedMajor;
                }
            }
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
