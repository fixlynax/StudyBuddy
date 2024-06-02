function updateTime() {
  var currentTime = new Date();
  var hours = currentTime.getHours();
  var minutes = currentTime.getMinutes();
  var seconds = currentTime.getSeconds();
  var day = currentTime.getDate();
  var monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  var month = monthNames[currentTime.getMonth()];
  var year = currentTime.getFullYear();

  // Add leading zeros if needed
  hours = hours < 10 ? "0" + hours : hours;
  minutes = minutes < 10 ? "0" + minutes : minutes;
  seconds = seconds < 10 ? "0" + seconds : seconds;
  day = day < 10 ? "0" + day : day;

  var formattedTime =
    day +
    " / " +
    month +
    " / " +
    year +
    " | " +
    hours +
    " : " +
    minutes +
    " : " +
    seconds;

  document.getElementById("currentTime").textContent = formattedTime;
}

// Update time initially
updateTime();

// Update time every second
setInterval(updateTime, 1000);
