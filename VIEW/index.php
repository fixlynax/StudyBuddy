<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyBuddy</title>

    <link rel="stylesheet" href="CSS/navbar.css">
</head>

<body>
    <section class="et-hero-tabs" style="background-image:url(/VIEW/Images/bg1.jpg)" >
        <h1>STUDY <c>BUDDY</c></h1>
        <b>Connecting To Success</b>
        <div class="button-container">
                <a href="loginRegister.php" class="button">Let's Start</a>
            </div>
        <div class="et-hero-tabs-container">
            <a class="et-hero-tab" href="#tab-es6">About</a>
            <a class="et-hero-tab" href="#tab-flexbox">Join Us</a>
            <a class="et-hero-tab" href="#tab-react">News</a>
            <a class="et-hero-tab" href="#tab-angular">Contact</a>
            <a class="et-hero-tab" href="#tab-other">Person</a>
            <span class="et-hero-tab-slider"></span>
        </div>
    </section>

    <main class="et-main">
        <section class="et-slide" id="tab-es6" style="background-image:url(/VIEW/Images/bg1.jpg)">
            <div class="about-container">
                <h1>Ab<c>out</c></h1>
                <h3>Our platform is designed to revolutionize the way students collaborate and learn together. Whether
                    you're tackling challenging assignments, preparing for exams, or simply seeking a supportive
                    community to enhance your academic journey, our system is here to empower you every step of the way.
                </h3>
            </div>
        </section>

        <section class="et-slide" id="tab-flexbox" style="background-image:url(/VIEW/Images/bg1.jpg)">
            <h1><c>Join</c> Us</h1>
            <h3>Join our StudyBuddy System today and unlock a world of collaborative learning opportunities!</h3>
            <div class="button-container">
                <a href="loginRegister.php" class="button">Let's Start</a>
            </div>
        </section>
        <section class="et-slide" id="tab-react" style="background-image:url(/VIEW/Images/bg1.jpg)">
            <h1><c>New</c>s</h1>
            <h3>Study will keep on update functionility, features and interface</h3>
        </section>
        <section class="et-slide" id="tab-angular" style="background-image:url(/VIEW/Images/bg1.jpg)">
            <h1>C<c>on</c>tact</h1>
            <h3>Anything user can contact our admin by email : studybuddy2024@gmail.com</h3>
        </section>
        <section class="et-slide" id="tab-other" style="background-image:url(/VIEW/Images/bg1.jpg)"> 
            <h1><c>Pers</c>on</h1>
            <h3>Muhammad Hafizuddin Bin Hamsah as important person that involved in build this system</h3>
            <h3>(Project Manager, Developer, UI/UX, Software Tester)</h3>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/navbar.js"></script>
    <script>
        window.addEventListener('load', () => {
            // Scroll to the top of the page on load
            window.scrollTo(0, 0);
        });
    </script>
</body>

</html>