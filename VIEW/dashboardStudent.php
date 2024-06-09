<?php
include './MODEL/connect.php';
include "./CONTROLLER/popupName.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/dashboardStudent.css">
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
                <div id="timeContainer" style="text-align: right;">
                    <p1>
                        <span1 id="currentTime"></span1>
                    </p1>
                </div>
                <div class="card">
                    <p>Welcome, <span class="name"><?php echo $stdName; ?></span></p>
                    <form class="logout" action="logoutHandler.php" method="POST">
                        <button type="submit" class="button logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
                <div class="card resource">
                    <a>Request Study Partner</a>
                    <table id="studyPartnerTable" class="table">
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
                        <tbody>
                            <?php include './CONTROLLER/studyPartnerRequest.php'; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card resource">
                    <a>Rating Partner</a>
                    <table id="ratingPartnerTable" class="table">
                        <thead>
                            <tr>
                                <th>Name Study Group</th>
                                <th>Type</th>
                                <th>Subject Study</th>
                                <th>Description</th>
                                <th>Date and Time</th>
                                <th>Partner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "./showPartnerRate.php";
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['studyGroupName']}</td>
                                            <td>{$row['studyGroupType']}</td>
                                            <td>{$row['subjectName']}</td>
                                            <td>{$row['studyGroupDescription']}</td>
                                            <td>{$row['studyGroupDate']} - {$row['studyGroupTime']}</td>
                                            <td>{$row['stdName']}</td>
                                            <td style='text-align:center;'><button class='rate-button' data-id='{$row['studyGroupID']}' data-partner-id='{$row['studyGroupPartner']}' data-partner-name='{$row['stdName']}'>Rate</button></td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No data found</td></tr>";
                            }
                            $stmt->close();
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card resource">
                    <a>Resource</a>
                    <div class="searchTable">
                        <table>
                            <tr>
                                <td>
                                    <labelD for="searchCategory">Search by topic category:</labelD>
                                    <input type="text" id="searchCategory" name="searchCategory"
                                        placeholder="Enter category to search.." onkeyup="searchByCategory()">
                                </td>
                                <td>
                                    <labelD for="searchCategory">Search by topic name:</labelD>
                                    <input type="text" id="searchTopic" placeholder="Enter topic name"
                                        onkeyup="searchByTopic()">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table id="resourceTable" class="table">
                        <tr>
                            <th>Topic Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>

                        <!-- Table rows will be populated dynamically -->
                        <?php include "./CONTROLLER/showResourceDashboardHandler.php"; ?>
                    </table>
                </div>
            </div>
        </article>
        <!-- Chatbox and Button -->
        <div id="chatboxButton" class="chatbox-button">
            <i class="fas fa-comments"></i>
            <label class="chat-popup">haiiii, buddy</label>
            <div id="chatboxButton" class="chatbox-button">
                <i class="fas fa-comments"></i>
                <label class="chat-popup">haiiii, buddy</label>
                <div id="chatPopup" class="chat-popup">
                    <p class="headerChatbox">How can I assist you, buddy?</p>
                    <button class="buttonOption" onclick="showAnswer('How to upload resource')">How to upload
                        resource?</button>
                    <button class="buttonOption" onclick="showAnswer('How to find partner')">How to find
                        partner?</button>
                    <button class="buttonOption" onclick="showAnswer('How to make study group')">How to make study
                        group?</button>
                    <button class="buttonOption" onclick="showAnswer('How to chat partner')">How to chat
                        partner?</button>
                    <button class="buttonOption" onclick="showAnswer('How to make report')">How to make report?</button>
                </div>
            </div>
            <div id="chatbox" class="chatbox">
                <div class="chatbox-content">
                    <span class="close" onclick="closeChatbox()">&times;</span>
                    <p id="chatboxAnswer"></p>
                    <a id="resourceLink" href="resourceStudent.php" style="display: none;">Go to Upload Resource
                        Page</a>
                    <a id="partnerLink" href="studyPartnerStudent.php" style="display: none;">Go to Study Partner
                        Page</a>
                    <a id="groupLink" href="studyGroupStudent.php" style="display: none;">Go to Study Group Page</a>
                    <a id="chatLink" href="chatPartner.php" style="display: none;">Go to Chat Partner Page</a>
                    <a id="reportLink" href="reportIssueStudent.php" style="display: none;">Go to Report Issue Page</a>
                </div>
            </div>
        </div>
    </section>
    <script src="JS/sidebar.js"></script>
    <script src="JS/dateTime.js"></script>
    <script src="JS/searchByTopicName.js"></script>
    <script src="JS/searchByCategory.js"></script>
    <script src="JS/chatbox.js"></script>
    <script src="JS/updatePartnerRequest.js"></script>
    <script>
        document.querySelectorAll('.rate-button').forEach(button => {
            button.addEventListener('click', function () {
                var studyGroupID = this.getAttribute('data-id');
                var partnerID = this.getAttribute('data-partner-id');
                var partnerName = this.getAttribute('data-partner-name');
                window.location.href = 'partnerRate.php?studyGroupID=' + studyGroupID + '&partnerID=' + partnerID + '&partnerName=' + partnerName;
            });
        });
    </script>
</body>

</html>