function updatePartnerRequest(studyPartnerID, action) {
  fetch("updatePartnerRequest.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ studyPartnerID: studyPartnerID, action: action }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert(data.message);
        window.location.reload();
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
