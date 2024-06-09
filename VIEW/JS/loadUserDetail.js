

function loadUserDetails() {
  const userID = document.getElementById("select-user").value;
  if (!userID) return;

  fetch(`getUserDetails.php?stdID=${userID}`)
    .then((response) => response.json())
    .then((data) => {
      const userDetails = document.getElementById("user-details");
      userDetails.innerHTML = `
                            <div class="form-group">
                                <labelE for="name">Name</labelE>
                                <input type="text" id="name" name="name" value="${data.stdName}">
                            </div>
                            <div class="form-group">
                                <labelE for="matric">Matric</labelE>
                                <input type="text" id="matric" name="matric" value="${data.stdMatric}">
                            </div>
                            <div class="form-group">
                                <labelE for="email">Email</labelE>
                                <input type="email" id="email" name="email" value="${data.stdEmail}">
                            </div>
                            <div class="form-group">
                                <labelE for="password">Password</labelE>
                                <input type="text" id="password" name="password" value="${data.stdPassword}">
                            </div>
                            <div class="form-group">
                                <labelE for="course">Course</labelE>
                                <input type="text" id="course" name="course" value="${data.stdCourse}">
                            </div>
                            <div class="form-group">
                                <labelE for="major">Major</labelE>
                                <input type="text" id="major" name="major" value="${data.stdMajor}">
                            </div>
                            <div class="form-group">
                                <labelE for="cgpa">CGPA</labelE>
                                <input type="text" id="cgpa" name="cgpa" value="${data.stdCGPA}">
                            </div>
                        `;
    });
}

function submitUserDetails() {
  const userID = document.getElementById("select-user").value;
  const name = document.getElementById("name").value;
  const matric = document.getElementById("matric").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const major = document.getElementById("major").value;
  const course = document.getElementById("course").value;
  const cgpa = document.getElementById("cgpa").value;

  fetch("updateUserDetails.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      stdID: userID,
      stdName: name,
      stdMatric: matric,
      stdEmail: email,
      stdPassword: password,
      stdMajor: major,
      stdCourse: course,
      stdCGPA: cgpa,
    }),
  }).then((response) => {
    if (response.ok) {
      alert("User details updated successfully");
      location.reload(); // Reload the page
    } else {
      alert("Failed to update user details");
    }
  });
}
