<?php
include './MODEL/connect.php';
include "./CONTROLLER/viewProfileStdHandler.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Profie</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/profileStudent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
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
        <article class="content">
            <div class="padding-container">
                <div class="card">
                    <?php if (!empty($stdPicture)): ?>
                        <img src="<?php echo $stdPicture; ?>" alt="Profile Picture"><br>
                    <?php else: ?>
                        <img src="Images/defaultProfile.jpg" alt="Profile Picture"><br>
                    <?php endif; ?>

                    <labelP for="name">Name</labelP>
                    <input type="text" id="name" name="name" value="<?php echo $stdName; ?>" readonly>

                    <labelP for="matric">Matric</labelP>
                    <input type="text" id="matric" name="matric" value="<?php echo $stdMatric; ?>" readonly>

                    <labelP for="email">Email</labelP>
                    <input type="email" id="email" name="email" value="<?php echo $stdEmail; ?>" readonly>

                    <div class="password-container">
                        <labelP for="password">Password</labelP>
                        <div class="input-group">
                            <input type="password" id="password" name="password" value="<?php echo $stdPassword; ?>"
                                readonly>
                            <span class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <labelP for="course">Course</labelP>
                    <input type="text" id="course" name="course" value="<?php echo $stdCourse; ?>" readonly>

                    <labelP for="major">Major</labelP>
                    <input type="text" id="major" name="major" value="<?php echo $stdMajor; ?>" readonly>

                    <labelP for="cgpa">CGPA</labelP>
                    <input type="text" id="cgpa" name="cgpa" value="<?php echo $stdCGPA; ?>" readonly>

                    <a href="editProfileStudent.php" class="edit-button">Edit</a>
                    <form id="deactivateForm" method="post" action="deactivateAccountHandler.php"
                        style="display: inline;">
                        <input type="hidden" name="deactivate">
                        <button type="button" class="deactivate-button" onclick="confirmDeactivation()">Deactivate Account</button>
                    </form>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script>
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

        function confirmDeactivation() {
            if (confirm("Are you sure you want to deactivate your account?")) {
                document.getElementById('deactivateForm').submit();
            }
        }
    </script>
</body>

</html>