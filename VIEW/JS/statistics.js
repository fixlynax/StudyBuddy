document.addEventListener("DOMContentLoaded", function () {
  fetchUserStatistics();
});

function fetchUserStatistics() {
  fetch("fetchData.php")
    .then((response) => response.json())
    .then((data) => {
      const ctx = document.getElementById("userChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Online", "Offline", "Active", "Deactivated"],
          datasets: [
            {
              label: "User Statistics",
              data: [data.online, data.offline, data.active, data.deactivated],
              backgroundColor: [
                "rgba(75, 192, 192, 0.2)",
                "rgba(255, 159, 64, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 99, 132, 0.2)",
              ],
              borderColor: [
                "rgba(75, 192, 192, 1)",
                "rgba(255, 159, 64, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 99, 132, 1)",
              ],
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

