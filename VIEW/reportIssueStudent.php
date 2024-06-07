<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/reportIssueStudent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <section class="container">
        <aside class="side_bar">
            <div class="title">
                <div href="dashboardAdmin.php" class="logo">StudyBuddy</div>
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
        <h2>Report Issue</h2>
        <form action="reportIssueStudentHandler.php" method="POST" enctype="multipart/form-data">
            <labelI for="typeIssue">Type Issue</labelI>
            <select id="typeIssue" name="typeIssue" required>
                <option style="font-style: italic;" value="">Select Type..</option>
                <option value="Bug">Bug</option>
                <option value="Feature Request">Feature Request</option>
                <option value="Study Partner">Study Partner</option>
                <option value="Resource">Resource</option>
                <option value="Subject Request">Subject Request</option>
                <option value="other">Other</option>
            </select>
            <labelI for="pictureIssue">Picture Issue</labelI>
            <input type="file" id="pictureIssue" name="pictureIssue" accept="image/*">
            <labelI for="description">Description</labelI>
            <textarea id="description" name="description" rows="4" placeholder="Enter report description.." required></textarea>
            <button class="submit-button" type="submit">Submit</button>
        </form>
    </div> 

    <div class="card">
        <h2>List Report Issue</h2>
        <table>
            <thead>
                <tr>
                    <th>Report Type</th>
                    <th>Description</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php include './CONTROLLER/listReportIssueHandler.php'; ?>
            </tbody>
        </table>
    </div>
  </div>
</article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>