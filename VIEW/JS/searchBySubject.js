function searchSubjects() {
  const input = document.getElementById("subjectSearch").value.trim().toLowerCase();
  const rows = document.querySelectorAll("table tr:not(:first-child)");

  rows.forEach((row) => {
    const subject = row.querySelector("td").textContent.toLowerCase();
    row.style.display = subject.includes(input) ? "" : "none";
  });
}
