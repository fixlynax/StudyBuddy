<?php
include './MODEL/connect.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Profie</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/partnerRate.css">
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
                <h2>Rate Partner</h2>
                <p1>Partner Name : <span1 id="partnerName"><?= htmlspecialchars($_GET['partnerName']) ?></span1></p1>
                <form id="rateForm" action="partnerRateHandler.php" method="POST">
                    <input type="hidden" name="studyGroupID" id="studyGroupID" value="<?= htmlspecialchars($_GET['studyGroupID']) ?>">
                    <input type="hidden" name="partnerID" id="partnerID" value="<?= htmlspecialchars($_GET['partnerID']) ?>">
                    <labelR for="rating">Rating:</labelR>
                    <div class="rating">
                        <labelS for="rating">5 : </labelR>
                        <input style="text-align: left;" type="radio" name="star" value="5" id="star1"><label for="star1" class="fa fa-star"></label>
                        <labelS for="rating">4 : </labelR>
                        <input type="radio" name="star" value="4" id="star2"><label for="star2" class="fa fa-star"></label>
                        <labelS for="rating">3 : </labelR>
                        <input type="radio" name="star" value="3" id="star3"><label for="star3" class="fa fa-star"></label>
                        <labelS for="rating">2 : </labelR>
                        <input type="radio" name="star" value="2" id="star4"><label for="star4" class="fa fa-star"></label>
                        <labelS for="rating">1 : </labelR>
                        <input type="radio" name="star" value="1" id="star5"><label for="star5" class="fa fa-star"></label>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </article>
    </section>
    <script src="JS/sidebar.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("rateForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        
        fetch("partnerRateHandler.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                alert("Your rating for partner <?=$_GET['partnerName']?> is successful");
                window.location.href = "dashboardStudent.php"; // Redirect to dashboardStudent.php on success
            } else {
                alert("Your rating for partner <?=$_GET['partnerName']?> is unsuccessful. Please try again");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again");
        });
    });
});
</script>

</body>

</html>