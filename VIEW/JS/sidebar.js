const checkbox = document.getElementById("check");
const sideBar = document.querySelector(".side_bar");

checkbox.addEventListener("change", () => {
  if (checkbox.checked) {
    sideBar.style.left = "0";
  } else {
    sideBar.style.left = "-100%";
  }
});
