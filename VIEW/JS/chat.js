

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