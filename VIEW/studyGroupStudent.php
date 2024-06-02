<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Study Group</title>
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link rel="stylesheet" href="CSS/studyGroupStudent.css">
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
          <h2>Create Study Group</h2>
          <form method="POST" action="createStudyGroup.php">
            <labelS for="studyGroupName">Study Group Name</labelS>
            <input type="text" id="studyGroupName" name="studyGroupName" required>

            <labelS for="typeStudyGroup">Type Study Group</labelS>
            <select id="typeStudyGroup" name="typeStudyGroup" required>
              <option style="font-style: italic;" value="">Select type</option>
              <option value="Zoom">Online by Zoom</option>
              <option value="Google Meet">Online by Google Meet</option>
              <option value="Microsoft Team">Online by Microsoft Team</option>
              <option value="Meet Up at Room 24 Hour">Meet up on Room 24 Hour</option>
              <option value="Meet Up at library">Meet up on library</option>
            </select>

            <labelS for="description">Description</labelS>
            <textarea id="description" name="description" rows="4" required></textarea>

            <labelS for="date">Date</labelS>
            <input type="date" id="date" name="date" required>

            <labelS for="time">Time</labelS>
            <input type="time" id="time" name="time" required>

            <labelS for="studyPartner">Study Partner with Subject</labelS>
            <select id="studyPartner" name="studyPartner" required>
              <option style="font-style: italic;" value="">Select Partner</option>
              <?php include './CONTROLLER/dropdownPartnerAndSubject.php'; ?>
            </select>
            <input type="hidden" id="studySubjectID" name="studySubjectID" required>

            <button type="submit" class="submit-button" style="background-color: #66b1f1;">Submit</button>
            <button class="show-button" style="background-color: #66b1f1;">
            <a href="showStudyGroup.php">Show Study Group</a>
          </button>
          </form>
        </div>
      </div>
    </article>

    <script>
      document.getElementById('studyPartner').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var subjectID = selectedOption.getAttribute('data-subject-id');
        document.getElementById('studySubjectID').value = subjectID;
      });
    </script>

  </section>
  <script src="JS/sidebar.js"></script>
</body>

</html>