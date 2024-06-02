<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>View Analytics</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/viewGraph.css">
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
                    <h2>User Statistic</h2>
                    <img src="images/image1.jpg" alt="User Statistic">
                    <p>This graph shows the user statistics, including the total number of students, their online status, and account status.</p>
                    <a href="viewAnalytics.php" class="button">Go to page</a>
                </div>
                <div class="card">
                    <h2>Subject Statistic</h2>
                    <img src="images/image2.jpg" alt="Subject Statistic">
                    <p>This graph shows the total number of study subjects, categorized by their subject names.</p>
                    <a href="viewAnalytics3.php" class="button">Go to page</a>
                </div>
                <div class="card">
                    <h2>Resource Statistic</h2>
                    <img src="images/image4.jpg" alt="Resource Statistic">
                    <p>This graph shows the resource statistics, categorized by resource categories [Subject Name].</p>
                    <a href="viewAnalytics2.php" class="button">Go to page</a>
                </div>
                <div class="card">
                    <h2>Study Group Statistic</h2>
                    <img src="images/image3.jpg" alt="Study Group Statistic">
                    <p>This graph shows the statistics of study groups, categorized by their types [Location Study].</p>
                    <a href="viewAnalytics4.php" class="button">Go to page</a>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>
