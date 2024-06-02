function showAnswer(option) {
  let answer = "";
  document.getElementById("resourceLink").style.display = "none";
  document.getElementById("partnerLink").style.display = "none";
  document.getElementById("groupLink").style.display = "none";
  document.getElementById("chatLink").style.display = "none";
  document.getElementById("reportLink").style.display = "none";

  switch (option) {
    case "How to upload resource":
      answer =
        'You need to go to the upload resource page by clicking "Resource" on the sidebar. This will open the page and after the resource page opens, you need to enter the details or you can go to the page directly by clicking this button:';
      document.getElementById("resourceLink").style.display = "block";
      break;
    case "How to find partner":
      answer =
        'You need to go to the study partner page first on the sidebar. After that, you need to add a subject by clicking the "Add Subject" button on the study partner page and fill in the details of the "Add Subject Study" form. Then in the dropdown, select the subject name you filled in and click the "Find Partner" button. This will show students who want to study the same subject, and you can choose a partner by clicking the "Request" button. If the partner accepts you, they will appear on the show partner page (you can click the "Show Partner" button on the study partner page).';
      document.getElementById("partnerLink").style.display = "block";
      break;
    case "How to make study group":
      answer =
        'You need to go to the study group page first on the sidebar and you must have a partner that has already accepted. After going to the study group page, fill in the details on the "Create Study Group" form. After filling it in, you can see the details on the "Show Study Group" page by clicking the "Show Study Group" button.';
      document.getElementById("groupLink").style.display = "block";
      break;
    case "How to chat partner":
      answer =
        'You need to go to the chat partner page first on the sidebar and you must have a partner that has already accepted. After going to the chat partner page, you can choose the partner to chat with by clicking the "Chat" button in the row of the partner you want to chat with.';
      document.getElementById("chatLink").style.display = "block";
      break;
    case "How to make report":
      answer =
        'You need to go to the report issue page first on the sidebar. After that, you can fill in the "Report Issue" form to make a report and see the progress of the report on the same page in the "List Report Issue" table.';
      document.getElementById("reportLink").style.display = "block";
      break;
  }

  document.getElementById("chatboxAnswer").innerText = answer;
  openChatbox();
}

function openChatbox() {
  document.getElementById("chatbox").style.display = "block";
}

function closeChatbox() {
  document.getElementById("chatbox").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("chatboxButton")
    .addEventListener("click", function () {
      let popup = document.getElementById("chatPopup");
      popup.style.display = popup.style.display === "block" ? "none" : "block";
    });
});
