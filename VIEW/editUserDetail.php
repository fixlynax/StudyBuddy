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
  </section>
  <script src="JS/sidebar.js"></script>
  <script src="JS/loadUserDetail.js"></script>
</body>

</html>