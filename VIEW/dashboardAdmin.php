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
    <link rel="stylesheet" href="CSS/dashboardAdmin.css">
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
                <div style="text-align:right">
                    <p1>
                        <span1 class="datetime"><?php echo date('l,  Y-m-d | H:i:s'); ?></span1>
                </p1>
                </div>
                <div class="card">
                    <p>Welcome, <span class="name"><?php echo $stdName; ?></span></p>
                    <form class="logout" action="logoutHandler.php" method="POST">
                        <button type="submit" class="button logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
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
                        <?php include "./CONTROLLER/showResourceDashboardHandlerAdmin.php"; ?>

                    </table>
                </div>
            </div>
        </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script src="JS/searchByTopicName.js"></script>
    <script src="JS/searchByCategory.js"></script>
    <script>
        function updatePartnerRequest(studyPartnerID, action) {
            fetch('updatePartnerRequest.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ studyPartnerID: studyPartnerID, action: action }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
</body>

</html>