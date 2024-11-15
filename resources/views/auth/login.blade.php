<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="asset/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="dashboard_container">
        <div class="row">
            <p class="login">Welcome Back</p>
            <p class="sign">Login to Continue</p>

            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{ session()->get("success") }}
                </div>
            @endif
            @if(session()->has("error"))
                    <div class="alert alert-success">
                        {{ session()->get("error") }}
                    </div>
            @endif
           
            <form class="login_form" method="POST" action="{{route("login.post")}}">
                @csrf
                <div class="input_container">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="email" placeholder="Enter Email" class="input_field" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input_container">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Enter Password" class="input_field password_field" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
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
                    <img src="{{ asset('asset/images/login/x.svg') }}" alt="Profile" class="x-logo"></i>
                </a>
            </div>
            <div class="row">
                <div class="left-image-container">
                    <img src="{{ asset('asset/images/login/front.svg') }}" alt="Profile" class="left-image">
                </div>
            </div>
            <p class="acc">New User?<a href="{{route("register")}}" style="text-decoration: none"> Sign Up</a></p>
        </div>
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