<?php
session_start();
include './MODEL/connect.php';

$sessionID = $_SESSION['stdID'];
$partnerWith = $_GET['partnerID'];

// Fetch partner details
$sql = "SELECT stdName, stdOnline FROM student WHERE stdID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $partnerWith);
$stmt->execute();
$result = $stmt->get_result();
$partner = $result->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Chat with <?php echo $partner['stdName']; ?></title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
        .chat-container {
            width: 50%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .messages {
            height: 400px;
            overflow-y: scroll;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .message {
            padding: 5px;
            margin: 5px 0;
        }

        .message.self {
            text-align: right;
            background-color: #e0ffe0;
        }

        .message.other {
            text-align: left;
            background-color: #ffe0e0;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
        }

        .input-container input {
            width: 80%;
            padding: 5px;
        }

        .input-container button {
            padding: 5px;
        }

        .status {
            margin-bottom: 10px;
        }

        .online {
            color: green;
        }

        .offline {
            color: red;
        }
    </style>
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
        <article class="content">
            <div class="padding-container">
                <div class="card">
                    <h2>Chat with <?php echo $partner['stdName']; ?></h2>
                    <div class="status">
                        <span class="<?php echo strtolower($partner['stdOnline']); ?>"><?php echo $partner['stdOnline']; ?></span>
                    </div>
                    <div class="messages" id="messages"></div>
                    <div class="input-container">
                        <input type="text" id="messageInput" placeholder="Type a message...">
                        <button onclick="sendMessage()"><i class='fas fa-paper-plane'></i>Send</button>
                    </div>
                </div>
            </div>
        </article>

        <script>
            var sessionID = <?php echo $sessionID; ?>;
            var partnerWith = <?php echo $partnerWith; ?>;

            function sendMessage() {
                var message = document.getElementById('messageInput').value;
                if (message.trim() !== '') {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'sendMessage.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            document.getElementById('messageInput').value = '';
                            loadMessages();
                        }
                    };
                    xhr.send('sender=' + sessionID + '&receiver=' + partnerWith + '&message=' + message);
                }
            }

            function loadMessages() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'getMessages.php?partnerID=' + partnerWith, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        document.getElementById('messages').innerHTML = xhr.responseText;
                        scrollMessagesToBottom();
                    }
                };
                xhr.send();
            }

            function scrollMessagesToBottom() {
                var messagesDiv = document.getElementById('messages');
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }

            setInterval(loadMessages, 2000); // Refresh messages every 2 seconds
        </script>
    </section>
    <script src="JS/sidebar.js"></script>
</body>

</html>
