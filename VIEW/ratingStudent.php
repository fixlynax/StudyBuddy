<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Rating</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/rankingRate.css">
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
                <div class="upload-card">
                    <h2 Rate>Rating Student</h2>
                    <div class="card" id="studentList">
                        <!-- Student list will be loaded here -->
                    </div>
                </div>
            </div>
        </article>

    </section>
    <script src="JS/sidebar.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetchData();
        });

        function fetchData() {
            var url = "fetchStudents.php";

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("studentList").innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>