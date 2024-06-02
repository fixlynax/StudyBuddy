<?php
include './MODEL/connect.php';

$sql = "SELECT stdID, stdName FROM student WHERE userType ='Student'";
$result = $conn->query($sql);

$users = array();
while ($row = $result->fetch_assoc()) {
  $users[] = $row;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Edit Detail</title>
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link rel="stylesheet" href="CSS/editUserDetail.css">
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
                <h2>Edit User Details</h2>
                <div class="form-group">
                    <labelE for="select-user">Select User</labelE>
                    <select id="select-user" onchange="loadUserDetails()">
                        <option value="0">Select a user</option>
                <?php foreach ($users as $user): ?>
                <option value="<?= $user['stdID'] ?>"><?= $user['stdName'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <h3>Details User :</h3>
          <div id="user-details">
            <!-- User details will be loaded here -->
          </div>
          <button type="submit" onclick="submitUserDetails()">Submit</button>
        </div>
      </div>
    </article>
    
    <script>
      function loadUserDetails() {
        const userID = document.getElementById('select-user').value;
        if (!userID) return;

        fetch(`getUserDetails.php?stdID=${userID}`)
          .then(response => response.json())
          .then(data => {
            const userDetails = document.getElementById('user-details');
            userDetails.innerHTML = `
                            <div class="form-group">
                                <labelE for="name">Name</labelE>
                                <input type="text" id="name" name="name" value="${data.stdName}">
                            </div>
                            <div class="form-group">
                                <labelE for="matric">Matric</labelE>
                                <input type="text" id="matric" name="matric" value="${data.stdMatric}">
                            </div>
                            <div class="form-group">
                                <labelE for="email">Email</labelE>
                                <input type="email" id="email" name="email" value="${data.stdEmail}">
                            </div>
                            <div class="form-group">
                                <labelE for="password">Password</labelE>
                                <input type="text" id="password" name="password" value="${data.stdPassword}">
                            </div>
                            <div class="form-group">
                                <labelE for="major">Major</labelE>
                                <input type="text" id="major" name="major" value="${data.stdMajor}">
                            </div>
                            <div class="form-group">
                                <labelE for="course">Course</labelE>
                                <input type="text" id="course" name="course" value="${data.stdCourse}">
                            </div>
                            <div class="form-group">
                                <labelE for="cgpa">CGPA</labelE>
                                <input type="text" id="cgpa" name="cgpa" value="${data.stdCGPA}">
                            </div>
                        `;
          });
      }

      function submitUserDetails() {
        const userID = document.getElementById('select-user').value;
        const name = document.getElementById('name').value;
        const matric = document.getElementById('matric').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const major = document.getElementById('major').value;
        const course = document.getElementById('course').value;
        const cgpa = document.getElementById('cgpa').value;

        fetch('updateUserDetails.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            stdID: userID,
            stdName: name,
            stdMatric: matric,
            stdEmail: email,
            stdPassword: password,
            stdMajor: major,
            stdCourse: course,
            stdCGPA: cgpa
          })
        }).then(response => {
          if (response.ok) {
            alert('User details updated successfully');
            location.reload(); // Reload the page
          } else {
            alert('Failed to update user details');
          }
        });
      }
    </script>
  </section>
  <script src="JS/sidebar.js"></script>
</body>

</html>