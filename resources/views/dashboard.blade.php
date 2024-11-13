<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <input type="text" class="form-control" id="custom-input"
                        placeholder="Find the book you are looking for..." aria-label="Search">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Category</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Community</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="dashboard_container">
            <div class="row">
                <div class="col-md-3 rf_margin">
                    <div class="profile_container">
                        <div class="profile_pic">
                            <img src="img/profile.png">
                        </div>
                        <div class="username">
                            <p>Yoohan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rf_margin">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p class="numbers">100</p>
                                    <p class="txt">Books</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p class="numbers">1, 245</p>
                                    <p class="txt">Friends</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p class="numbers">8</p>
                                    <p class="txt">Following</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row left_pd">
                        <div class="col-md-12">
                            <p>Joined in November 1, 2024</p>
                            <p class="fave_genres">Favorite Genres</p>
                            <p class="genres">Romance, Mystery/Thriller, Fantasy, Science Fiction, +5 More</p>
                        </div>
                    </div>
                    <div class="row g-0">
                        <p class="mybookshelves">My Bookshelves</p>
                        <div class="col-md-4 justify_right">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p>Reviewed</p>
                                    <p class="txt">(01)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 justify_left">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p>Favorites</p>
                                    <p class="txt">(01)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 rf_margin">
                    <div class="row">
                        <p class="myfavebooks">My Favorite Book</p>
                        <div class="col-md-12">
                            <div class="fave_book_container">
                                <img src=img/storm_and_silence.png>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="recent_reviews">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <h1>Recent Reviews</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="reviews">
                            <p class="book_title">The Shank </p>
                            <p class="text">Love this book!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="reviews">
                            <p class="book_title">Lucid Dream</p>
                            <p class="text">A masterpiece!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="reviews">
                            <p class="book_title">Death Delayed</p>
                            <p class="text">Plot twist is 0.0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="reviews">
                            <p class="book_title">The Wallflower's Revenge</p>
                            <p class="text">10/10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reviewed_books">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <h1>Reviewed Books</h1>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/cruel_prince.png">
                            </div>
                            <p class="book_title">The Cruel Prince</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-regular.svg" class="svg">
                            </div>
                            <p class="author">Holly Black</p>
                            <p class="date">1 week ago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/storm_and_silence.png">
                            </div>
                            <p class="book_title">Storm and Silence</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                            </div>
                            <p class="author">Robert Thier</p>
                            <p class="date">1 week ago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/waves_of_memories.png">
                            </div>
                            <p class="book_title">Waves of Memories</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                            </div>
                            <p class="author">Jonaxx</p>
                            <p class="date">1 week ago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/invisible_girl.png">
                            </div>
                            <p class="book_title">The Invisible Girl</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-half-stroke-regular.svg" class="svg">
                            </div>
                            <p class="author">Alexisse Rose</p>
                            <p class="date">2 weeks ago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/saa.png">
                            </div>
                            <p class="book_title">Stay Awake, Agatha</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-half-stroke-regular.svg" class="svg">
                            </div>
                            <p class="author">Serialsleeper</p>
                            <p class="date">2 weeks ago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container-fluid">
                        <div class="books_container">
                            <div class="img_container">
                                <img src="img/twr.png">
                            </div>
                            <p class="book_title">The Wallflower's Revenge</p>
                            <div class="star_container">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-solid.svg" class="svg">
                                <img src="img/star-half-stroke-regular.svg" class="svg">
                            </div>
                            <p class="author">Sweetblunch</p>
                            <p class="date">2 weeks ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>