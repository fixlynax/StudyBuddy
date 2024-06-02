<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Resource</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/resourceStudent.css">
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
            <form action="uploadResourceHandler.php" method="POST" enctype="multipart/form-data">
                <div class="upload-card">
                    <h2>Upload Resource</h2>
                    <div class="card">
                        <labelR for="topicName">Topic Name</labelR>
                        <input type="text" id="topicName" name="topicName" placeholder="Enter the topic name.." required>

                        <labelR for="category">Category</labelR>
                        <select id="category" name="category" required>
                        <option style="font-style: italic;" value="">Select Category..</option>
                                <?php
                                include './MODEL/connect.php';
                                $sql = "SELECT subjectMajor, subjectName FROM subject";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["subjectName"] . '">' . $row["subjectName"] . ' ( ' . $row["subjectMajor"] . ' ) ' . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No subjects available</option>';
                                }
                                $conn->close();
                                ?>
                            </select>
                        <!-- <input type="text" id="category" name="category" required> -->

                        <labelR for="file" class="upload-label">Upload file</labelR>
                        <div class="file-input-container">
                            <input type="file" id="file" name="file" accept=".pdf,.docx,.xlsx" required>
                            <label for="file" class="upload-icon"><i class="fas fa-upload"></i></label>
                        </div>

                        <labelR for="description" class="des-label">Description</labelR>
                        <textarea id="description" name="description" rows="4" placeholder="Enter the description.." required></textarea>

                        <input type="submit" name="upload" value="Upload" class="upload-button">
                        <button class="show-resource-button"><a href="showResource.php">Show Resources</a></button>
                    </div>
                </div>
            </form>
        </div>
    </article>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>