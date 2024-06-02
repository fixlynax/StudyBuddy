<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Status User</title>
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link rel="stylesheet" href="CSS/deactiveUser.css">
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
          <h2>Activate User</h2>
          <div class="form-group">
            <labelD for="selectUserActivate">User</labelD>
            <select id="selectUserActivate" required>
              <option style="font-style: italic;" value="">Select User..</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <button class="active" id="activateButton">Activate</button>
        </div>
        <div class="card" style="margin-top: 20px;">
          <h3>Deactivate User</h3>
          <div class="form-group">
            <labelD for="selectUserDeactivate">User</labelD>
            <select id="selectUserDeactivate" required>
              <option style="font-style: italic;" value="">Select User..</option>
              <!-- Options will be populated by JavaScript -->
            </select>
            <labelD style="margin-top:10px" for="description" class="des-label">Description</labelD>
            <textarea id="description" name="description" rows="4" placeholder="Enter description for reason.."></textarea>
          </div>
          <button class="Deactivate" id="deactivateButton">Deactivate</button>
        </div>
      </div>
    </article>
  </section>
  <script src="JS/sidebar.js"></script>
  <script>
    // Populate dropdowns with users
    document.addEventListener('DOMContentLoaded', function () {
      fetch('getUsers.php?status=Active')
        .then(response => response.json())
        .then(data => {
          let select = document.getElementById('selectUserDeactivate');
          data.forEach(user => {
            let option = document.createElement('option');
            option.value = user.stdID;
            option.textContent = user.stdName;
            select.appendChild(option);
          });
        });

      fetch('getUsers.php?status=Deactivate')
        .then(response => response.json())
        .then(data => {
          let select = document.getElementById('selectUserActivate');
          data.forEach(user => {
            let option = document.createElement('option');
            option.value = user.stdID;
            option.textContent = user.stdName;
            select.appendChild(option);
          });
        });
    });

    // Deactivate user
    document.getElementById('deactivateButton').addEventListener('click', function () {
      let userID = document.getElementById('selectUserDeactivate').value;
      fetch('updateUserStatus.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ stdID: userID, status: 'Deactivate', description: document.getElementById('description').value })
      })
        .then(response => response.text())
        .then(data => {
          alert(data);
          location.reload(); // Reload to update the dropdowns
        });
    });

    // Activate user
    document.getElementById('activateButton').addEventListener('click', function () {
      let userID = document.getElementById('selectUserActivate').value;
      fetch('updateUserStatus.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ stdID: userID, status: 'Active', description: '' })
      })
        .then(response => response.text())
        .then(data => {
          alert(data);
          location.reload(); // Reload to update the dropdowns
        });
    });
  </script>
</body>

</html>