function searchByCategory() {
  var input = document
    .getElementById("searchCategory")
    .value.trim()
    .toLowerCase();
  var rows = document.querySelectorAll("table tr:not(:first-child)");

  rows.forEach((row) => {
    var category = row.cells[1].textContent.trim().toLowerCase();
    if (category.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
