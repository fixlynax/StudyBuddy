<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Study Partner</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/studyPartnerStudent.css">
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
                <div class="study-partner-card">
                    <h2>Study Partner</h2>
                    <button class="add-subject-button"><a href="addSubjectStudy.php">Add Subject</a></button>
                    <div class="subject-form">
                        <labelS for="subjectName">Subject Name</labelS>
                        <select id="subjectName" name="subjectName">
                            <option style="font-style: italic;" value="">Select subject</option>
                            <?php include "./CONTROLLER/dropdownFindSubject2.php"; ?>
                        </select>
                    </div>
                    <div class="buttons-container">
                        <button class="find-partner-button"><a>Find Partner</a></button>
                        <button class="show-partner-button"><a href="showPartner.php">Show Partner</a></button>
                    </div>
                    <h3>List Partner Available</h3>
                    <div class="partner-table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Matrix No</th>
                                    <th>Subject Study</th>
                                    <th>Description Study</th>
                                    <th>Available Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="partner-list">
                                <tr><td colspan='7'>Please find partner by select the subject</td></tr>
                                <!-- Partner list will be populated here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script src="JS/studyPartner.js"></script>
</body>

</html>