<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Show Study Group</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/showStudyGroup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <section class="container">
        <aside class="side_bar">
            <div class="title">
                <div class="logo">StudyBuddy</div>
                <label class="button cancel" for="check"><i class="fas fa-times"></i></label>
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
                    <h2>List Study Group</h2>
                    <labelS for="searchType">Search by status</labelS>
                    <input type="text" id="searchType" class="input-field" placeholder="Enter type..."
                        onkeyup="filterTable()">
                    <table class="table" id="studyGroupTable">
                        <thead>
                            <tr>
                                <th>Name Study Group</th>
                                <th>Type</th>
                                <th>Subject Study</th>
                                <th>Description</th>
                                <th>Date and Time</th>
                                <th>Partner</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            session_start();
                            include './MODEL/connect.php';

                            $sessionID = $_SESSION['stdID'];
                            $currentDate = date('Y-m-d');
                            $currentTime = date('H:i:s');

                            $sql = "SELECT 
                                sg.*, 
                                ss.subjectName, 
                                s.stdName 
                            FROM 
                                studygroup sg 
                            JOIN 
                                studysubject ss 
                            ON 
                                sg.studyGroupSubject = ss.studySubjectID 
                            JOIN 
                                student s 
                            ON 
                                sg.studyGroupPartner = s.stdID 
                            WHERE 
                                sg.studyGroupPartner != ?";

                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('i', $sessionID);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                $status = $row['studyGroupStatus'];
                                $statusColor = '';
                                $actionButton = '';

                                if ($status == 'Pending') {
                                    $statusColor = 'orange';
                                } elseif ($status == 'Ongoing') {
                                    $statusColor = 'blue';
                                    $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
                                } elseif ($status == 'Done') {
                                    $statusColor = 'green';
                                } elseif ($status == 'Delay') {
                                    $statusColor = 'red';
                                    $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
                                }

                                $groupDateTime = strtotime($row['studyGroupDate'] . ' ' . $row['studyGroupTime']);
                                $currentDateTime = strtotime($currentDate . ' ' . $currentTime);

                                // Automatically update status based on current date and time
                                if ($status == 'Pending' && $groupDateTime <= $currentDateTime) {
                                    $status = 'Ongoing';
                                    $statusColor = 'blue';
                                    $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
                                    // Update the status in the database
                                    $update_sql = "UPDATE studygroup SET studyGroupStatus = 'Ongoing' WHERE studyGroupID = ?";
                                    $update_stmt = $conn->prepare($update_sql);
                                    $update_stmt->bind_param('i', $row['studyGroupID']);
                                    $update_stmt->execute();
                                } elseif ($status == 'Ongoing' && $groupDateTime != $currentDateTime) {
                                    $status = 'Delay';
                                    $statusColor = 'red';
                                    $actionButton = "<button class='finish-button' data-id='{$row['studyGroupID']}'>Finish Study</button>";
                                    // Update the status in the database
                                    $update_sql = "UPDATE studygroup SET studyGroupStatus = 'Delay' WHERE studyGroupID = ?";
                                    $update_stmt->bind_param('i', $row['studyGroupID']);
                                    $update_stmt->execute();
                                }

                                echo "<tr>
                                <td>{$row['studyGroupName']}</td>
                                <td>{$row['studyGroupType']}</td>
                                <td>{$row['subjectName']}</td>
                                <td>{$row['studyGroupDescription']}</td>
                                <td>{$row['studyGroupDate']} - {$row['studyGroupTime']}</td>
                                <td>{$row['stdName']}</td>
                                <td class='status-text' style='color: $statusColor;'>$status</td>
                                <td style='text-align:center;'>$actionButton</td>
                              </tr>";
                            }

                            $stmt->close();
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script>
        function filterTable() {
            var input = document.getElementById("searchType");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("studyGroupTable");
            var tr = table.getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[6];
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        document.querySelectorAll('.finish-button').forEach(button => {
            button.addEventListener('click', function () {
                var studyGroupID = this.getAttribute('data-id');
                if (confirm('Are you sure you want to finish this study group?')) {
                    window.location.href = 'finishStudyGroup.php?studyGroupID=' + studyGroupID;
                }
            });
        });
    </script>
</body>

</html>