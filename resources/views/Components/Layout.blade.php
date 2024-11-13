<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Landing Page</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('asset/css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/styleguide.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    @yield('styles')
</head>

<body>
<!-- Header -->
<header class="container-fluid py-3">
        <div class="row align-items-center justify-content-between">
            <!-- Logo/Title -->
            <div class="col-md-3">
                <h1 class="h4">
                    <span class="text-pri">Book</span><span class="text-sec">Bayarn!</span>
                </h1>
            </div>

            <!-- Search Form -->
            <form class="col-md-5 d-flex justify-content-center" action="your_search_action_url" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" id="custom-input" placeholder="Find the book you are looking for..." aria-label="Search">
                    <button type="submit" class="btn input-group-text">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <!-- Top Navigation Icons -->
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <button class="custom-btn2">Sign In</button>
                <button class="custom-btn">Create an Account</button>
            </div>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    
    <!-- Footer -->
    <footer class="">
        <div class="container">
            <div class="row text-center text-md-left">
                <!-- About Section -->
                <div class="col-md-6 mb-4">
                    <h1 class="h4">
                        <span class="text-pri">Book</span><span class="text-sec">Bayarn!</span>
                        <p class="cust">Find your next favorite read!</p>
                    </h1>
                </div>

                <!-- Navigation Links -->
                <div class="col-md-2 mb-4">
                    <h6 style="font-size: 15px;">Quick Links</h6>
                    <ul class="list-unstyled cm">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <!-- Contact and Social Media -->
                <div class="col-md-4 mb-4">
                    <h6 style="font-size: 15px;">About</h6>
                    <p class="cm">Developed by 3rd Year IT students of Bicol University</p>
                    <p class="cm">bookbayarn!@gmail.com</p>
                </div>
            </div>

            <div class="text-left mt-3 cust">
                <p>&copy; 2024 BookBayarn! All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>