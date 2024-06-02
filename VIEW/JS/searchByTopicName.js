function searchByTopic() {
  var input = document.getElementById("searchTopic").value.trim().toLowerCase();
  var rows = document.querySelectorAll('table tr:not(:first-child)');

  rows.forEach((row) => {
    var topicName = row.cells[0].textContent.trim().toLowerCase();
    if (topicName.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
