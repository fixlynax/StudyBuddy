<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Show Resource</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/showResource.css">
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
                <h2>List Uploaded Resource</h2>
                <labelR for="courseSearch">Search by course</labelR>
                <input type="text" id="courseSearch" name="courseSearch" onkeyup="searchByCourse()">
                <!-- <button class="find-button" onclick="searchByCourse()">Find</button> -->

                <table>
                    <tr>
                        <th>Topic Name</th>
                        <th>Course</th>
                        <th>Description</th>
                        <th>Upload Date</th>
                        <th>Action</th>
                    </tr>
                    <?php include "./CONTROLLER/showResourceHandler.php"; ?>
                </table>
            </div>
        </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script src="JS/searchByCourse.js"></script>

</body>

</html>