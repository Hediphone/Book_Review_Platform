<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard_container">
        <div class="row">
            <p class="login">Welcome Back</p>
            <p class="sign">Login to Continue</p>
        
            <form class="login_form" method="POST" action="/homepage">
                <div class="input_container">
                    <i class="fas fa-user icon"></i>
                    <input type="text" placeholder="Enter Username" class="input_field" required>
                </div>
                <div class="input_container">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" placeholder="Enter Password" class="input_field password_field" required>
                </div>
                <button type="submit" class="login_button">Login</button>
            </form>
           
            <a class="forgot" href="#">Forgot Password</a>
            <p class="login1">Login with</p>

            <div class="social-icons text-center mt-3">
                <a href="https://accounts.google.com/v3/signin/identifier?authuser=0&continue=https%3A%2F%2Fwww.google.com%2F&ec=GAlAmgQ&hl=en&flowName=GlifWebSignIn&flowEntry=AddSession&dsh=S-920004606%3A1731464646265211&ddm=1" class="mx-3" style="text-decoration: none" target="_blank">
                    <i class="fab fa-google fa-2x"></i>
                </a>
                <a href="https://www.facebook.com/" class="mx-3" style="text-decoration: none" target="_blank">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="#" class="mx-3">
                    <img src="{{ asset('img/login/x.svg') }}" alt="Profile" class="x-logo"></i>
                </a>
            </div>
            
            <div class="row">
                <div class="left-image-container">
                    <img src="{{ asset('img/login/front.svg') }}" alt="Profile" class="left-image">
                </div>
            </div>
        </div>

        <p class="acc">New User?<a class="acc" href="/signup" style="text-decoration: none"> Sign Up</a></p>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.querySelector('.password_field');
            const toggleIcon = document.querySelector('.toggle_password');
    
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
    </script>

</body>

</html>