<?php
include './MODEL/connect.php';
?><!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Show Partner</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/showPartner.css">
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
                <h2>List Study Partner</h2>
                <labelP for="subjectSearch">Search by subject</labelP>
                <input type="text" id="subjectSearch" name="subjectSearch" placeholder="Enter subject study to serach..">
                <button class="find-button">Find</button>

                <table>
                    <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Matrix No</th>
                    <th>Subject Study</th>
                    <th>Description Study</th>
                    <th>Available Date</th>
                    </tr>
                    <?php include './CONTROLLER/showAcceptPartner.php'; ?>
                </table>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>