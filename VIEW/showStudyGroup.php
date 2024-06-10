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
                    <input type="text" id="searchType" class="input-field" placeholder="Enter status to search..."
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
                            <?php include './CONTROLLER/showStudyGroup2.php'; ?>
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