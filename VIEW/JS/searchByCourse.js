function searchByCourse() {
    var input = document.getElementById('courseSearch').value.trim().toLowerCase();
    var rows = document.querySelectorAll('table tr:not(:first-child)');

    rows.forEach(row => {
        var course = row.cells[1].textContent.trim().toLowerCase();
        if (course.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}