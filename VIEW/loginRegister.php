
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login/Register</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="registerHandler.php"  method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" name="name" required/>
                <input type="email" placeholder="Email" name="email" required/>
                <input type="password" placeholder="Password" name="password" required/>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="loginHandler.php" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email"  required/>
                <input type="password" placeholder="Password" name="password" required/>
                <a class="forgotpassword" href="./forgoPassword.php">Forgot your password?</a>
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>
            Created with <i>StuddyBuddy</i> by
            <a target="_blank" href="https://www.umpsa.edu.my/">Yapish</a>
            - Final Year Project
            <a target="_blank" href="https://www.umpsa.edu.my/">UMPSA</a>.
        </p>
    </footer>
    <script src="JS/loginRegister.js" defer></script>
</body>

</html>