document.addEventListener("DOMContentLoaded", function () {
  fetchStudyGroupStatistics();
});

function fetchStudyGroupStatistics() {
  fetch("fetchData4.php")
    .then((response) => response.json())
    .then((data) => {
      const types = data.map((item) => item.studyGroupType);
      const counts = data.map((item) => item.totalGroups);

      const ctx = document.getElementById("studyGroupChart").getContext("2d");
      new Chart(ctx, {
        type: "line",
        data: {
          labels: types,
          datasets: [
            {
              label: "Total Study Groups",
              data: counts,
              borderColor: "#3e95cd",
              fill: false,
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
