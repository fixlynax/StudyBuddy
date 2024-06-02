<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/addSubjectStudy.css">
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
                    <h2>Add Subject Study</h2>
                    <form action="addSubjectStudyHandler.php" method="POST">
                        <labelS for="subject">Subject</labelS>
                        <select id="subject" name="subject">
                           <option style="font-style: italic;" value="">Select subject</option>
                           <?php include "./CONTROLLER/dropdownSubject.php"; ?> 
                        </select>
                        <labelS for="description">Description</labelS>
                        <textarea id="description" name="description" rows="4"></textarea>
                        <labelS for="schedule">Schedule</labelS>
                        <input type="date" id="schedule" name="schedule">
                        <button class="add-button" type="submit">Add</button>
                        <!-- <button class="show-button" type="submit">Show Subject Added</button> -->
                        <a href="showAddSubject.php" class="show-button">Show Subject Added</a>
                    </form>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>