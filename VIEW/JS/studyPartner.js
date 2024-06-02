document.addEventListener('DOMContentLoaded', function () {
            const findPartnerButton = document.querySelector('.find-partner-button');
            const subjectSelect = document.querySelector('#subjectName');
            const partnerList = document.querySelector('#partner-list');

            findPartnerButton.addEventListener('click', function () {
                const subjectName = subjectSelect.value;

                if (!subjectName) {
                    alert('Please select a subject.');
                    return;
                }

                // Fetch partners via AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'findPartner.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        partnerList.innerHTML = xhr.responseText;
                        attachRequestHandlers();
                    }
                };
                xhr.send('subjectName=' + encodeURIComponent(subjectName));
            });

            function attachRequestHandlers() {
                const requestButtons = document.querySelectorAll('.action-button');
                requestButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'requestPartner.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                if (xhr.responseText === 'This partner has already been requested.') {
                                    alert(xhr.responseText);
                                } else {
                                    button.textContent = 'Requested';
                                    button.disabled = true;
                                }
                            }
                        };
                    });
                });
            }
        });//asal