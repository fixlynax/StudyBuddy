document.addEventListener("DOMContentLoaded", function () {
  fetchSubjectStatistics();
});

function fetchSubjectStatistics() {
  fetch("fetchData3.php")
    .then((response) => response.json())
    .then((data) => {
      const subjects = data.map((item) => item.subjectName);
      const counts = data.map((item) => item.totalSubjects);

      const ctx = document.getElementById("subjectChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: subjects,
          datasets: [
            {
              label: "Total Subjects",
              data: counts,
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    })
    .catch((error) => console.error("Error:", error));
}
