<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>List Partner</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/chatPartner.css">
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
                <?php include './CONTROLLER/sidebarNav.php'; ?>
            </ul>
            <div class="media_icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </aside>
        <?php
        include 'getPartnerStatus.php'
            ?>
        <article class="content">
            <div class="padding-container">
                <div class="card">
                    <h2>List Partner</h2>
                    <button id="refreshButton" style="margin-bottom: 10px;"><i class='fas fa-redo'></i>Refresh</button>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th colspan='2'>Chat</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if (!in_array($row['stdID'], $uniquePartners)) {
                                    $uniquePartners[] = $row['stdID'];
                                    $statusClass = strtolower($row['stdOnline']);
                                    echo "<tr>
                                            <td>{$row['stdName']}</td>
                                            <td class='{$statusClass}'>{$row['stdOnline']}</td>
                                            <td style='width:120px;'><button class='chat-button' onclick='startChat({$row['stdID']})'><i class='fas fa-comment'></i> Chat</button></td>
                                          </tr>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan='3'>No partners found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </article>
        <script>
            function startChat(partnerID) {
                window.location.href = 'chat.php?partnerID=' + partnerID;
            }

            function refreshTable() {
                location.reload();
            }

            // Auto-refresh every 5 seconds
            setInterval(refreshTable, 5000);

            // Button click event
            document.getElementById('refreshButton').addEventListener('click', refreshTable);
        </script>
        <?php
        $stmt->close();
        mysqli_close($conn);
        ?>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>
