<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Resolve Issue</title>
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link rel="stylesheet" href="CSS/reportResolveIssue.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <input type="checkbox" id="check">
  <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
  <section>
    <aside class="side_bar">
      <div class="title">
        <div class="logo">StudyBuddy</div>
        <label class="button cancel" for="check"><i class="fas fa-times"></i></label>
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
        <div class="resolve-issue-card">
          <h2>Issue</h2>
          <table class="resolve-issue-table">
            <thead>
              <tr>
                <th>Report Type</th>
                <th>Description</th>
                <th>Picture</th>
                <th>Report by</th>
                <th>Issue Date</th>
                <th>Resolve Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="issueTableBody">
              <!-- Data will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="padding-container">
        <div class="resolve-issue-card">
          <h2>Resolved Issues</h2>
          <table class="resolve-issue-table">
            <thead>
              <tr>
                <th>Report Type</th>
                <th>Description</th>
                <th>Report by</th>
                <th>Issue Date</th>
                <th>Resolve Date</th>
                <th>Resolve Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="issueTableBody2">
              <!-- Data will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </article>
  </section>

  <!-- Modal for updating issue status -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="resolve-issue-actions">
        <div>
          <labelR style="margin-top:10px" for="update-status">Update Status:</labelR>
          <select id="update-status">
            <!-- Options will be populated by JavaScript -->
          </select>
        </div>
        <button class="completeBtn" id="complete-btn">Complete</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      fetch('getReportIssues.php')
        .then(response => response.json())
        .then(data => {
          let issueTableBody = document.getElementById('issueTableBody');
          data.forEach(issue => {
            let row = document.createElement('tr');
            row.innerHTML = `
                            <td>${issue.reportType}</td>
                            <td>${issue.reportDescription}</td>
                            <td style="text-align:center;"><a href="${issue.reportPicture}" target="_blank"><i class="fas fa-image"></i></a></td>
                            <td>${issue.reportBy}</td>
                            <td>${issue.reportDate}</td>
                            <td class="${getStatusClass(issue.reportStatus)}">${issue.reportStatus}</td>
                            <td><button class="update-btn" data-id="${issue.reportIssueID}" data-status="${issue.reportStatus}">Update</button></td>
                        `;
            issueTableBody.appendChild(row);
          });
          document.querySelectorAll('.update-btn').forEach(button => {
            button.addEventListener('click', function () {
              openModal(button.dataset.id, button.dataset.status);
            });
          });
        });

      fetch('getResolvedIssues.php')
        .then(response => response.json())
        .then(data => {
          let issueTableBody2 = document.getElementById('issueTableBody2');
          data.forEach(issue => {
            let row = document.createElement('tr');
            row.innerHTML = `
                            <td>${issue.reportType}</td>
                            <td>${issue.reportDescription}</td>
                            <td>${issue.reportBy}</td>
                            <td>${issue.reportDate}</td>
                            <td>${issue.resolveDate}</td>
                            <td class="${getStatusClass(issue.reportStatus)}">${issue.reportStatus}</td>
                            <td><button class="view-btn" data-id="${issue.reportIssueID}">View</button></td>
                        `;
            issueTableBody2.appendChild(row);
          });
          document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function () {
              viewIssueDetails(button.dataset.id);
            });
          });
        });
    });

    function openModal(issueID, currentStatus) {
      let modal = document.getElementById('myModal');
      let select = document.getElementById('update-status');
      select.innerHTML = ''; // Clear previous options
      let statusOptions = [];

      switch (currentStatus) {
        case 'Pending':
          statusOptions = ['In Progress', 'Resolved', 'On Hold'];
          break;
        case 'In Progress':
          statusOptions = ['Resolved', 'On Hold'];
          break;
        case 'On Hold':
          statusOptions = ['In Progress', 'Resolved'];
          break;
      }

      statusOptions.forEach(status => {
        let option = document.createElement('option');
        option.value = status;
        option.textContent = status;
        select.appendChild(option);
      });

      modal.style.display = 'block';

      document.getElementById('complete-btn').onclick = function () {
        updateIssueStatus(issueID, select.value);
      };
    }

    document.querySelector('.close').onclick = function () {
      document.getElementById('myModal').style.display = 'none';
    }

    window.onclick = function (event) {
      let modal = document.getElementById('myModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }

    function updateIssueStatus(issueID, newStatus) {
      fetch('updateReportIssueStatus.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ reportIssueID: issueID, reportStatus: newStatus })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Issue status updated successfully.');
            window.location.reload();
          } else {
            alert('Error: ' + data.message);
          }
        });
    }

    function viewIssueDetails(issueID) {
      // Implement the logic to view issue details if necessary
      alert('Viewing details for issue ID: ' + issueID);
    }

    function getStatusClass(status) {
      switch (status) {
        case 'Pending':
          return 'pending-status';
        case 'In Progress':
          return 'in-progress-status';
        case 'On Hold':
          return 'on-hold-status';
        case 'Resolved':
          return 'resolved-status';
        default:
          return '';
      }
    }
  </script>
  <script src="JS/sidebar.js"></script>
</body>

</html>
