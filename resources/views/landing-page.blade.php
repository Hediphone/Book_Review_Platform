<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Landing Page</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/styleguide.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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


    <!-- Carousel Section -->
    <section class="carousel-section" style="margin-top: 10px;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="center-image" src="{{ asset('asset/images/slide1.png') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="center-image" src="{{ asset('asset/images/slide2.png') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="center-image" src="{{ asset('asset/images/slide3.png') }}" alt="Third slide">
                    </div>
                </div>

                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                </ol>
            </div>
    </section>


    <section class="popular-now-section">
          <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-4">
                  <h3 class="text-left">Popular Now</h3>
                  <a href="" class="view-all-link">View All</a>
              </div>

              <div class="row">
                  <!-- Card 1 -->
                  <div class="col-md-3 mb-4">
                      <div class="card">
                          <img src="{{ asset('asset/images/orv.jpg') }}" class="card-img-top" alt="Book Cover">
                          <div class="card-body">
                              <h5 class="book-title">Omniscient Reader's Viewpoint</h5>
                              <h6 class="book-author">Sing Shong</h6>
                              <div class="star-rating">
                                  @php
                                      $stars = 4;
                                  @endphp
                                  @for ($i = 1; $i <= 5; $i++)
                                      <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                  @endfor
                              </div>
                              <div class="last-reader mt-3">
                                  <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                                  <span class="reader">Renato Jr.</span>
                                  <span class="time">5 days ago</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Card 2 -->
                  <div class="col-md-3 mb-4">
                      <div class="card">
                          <img src="{{ asset('asset/images/lotm.jpg') }}" class="card-img-top" alt="Book Cover">
                          <div class="card-body">
                              <h5 class="book-title">Lord of the Mysteries</h5>
                              <h6 class="book-author">Yuan Ye</h6>
                              <div class="star-rating">
                                  @php
                                      $stars = 4;
                                  @endphp
                                  @for ($i = 1; $i <= 5; $i++)
                                      <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                  @endfor
                              </div>
                              <div class="last-reader mt-3">
                                  <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                                  <span class="reader">Renato Jr.</span>
                                  <span class="time">12 days ago</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Card 3 -->
                  <div class="col-md-3 mb-4">
                      <div class="card">
                          <img src="{{ asset('asset/images/gentle-reminder.jpg') }}" class="card-img-top" alt="Book Cover">
                          <div class="card-body">
                              <h5 class="book-title">A Gentle Reminder</h5>
                              <h6 class="book-author">Bianca Sparacino</h6>
                              <div class="star-rating">
                                  @php
                                      $stars = 2.1;
                                  @endphp
                                  @for ($i = 1; $i <= 5; $i++)
                                      <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                  @endfor
                              </div>
                              <div class="last-reader mt-3">
                                  <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                                  <span class="reader">Renato Jr.</span>
                                  <span class="time">12 days ago</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Card 4 -->
                  <div class="col-md-3 mb-4">
                      <div class="card">
                          <img src="{{ asset('asset/images/pride-prejudice.jpg') }}" class="card-img-top" alt="Book Cover">
                          <div class="card-body">
                              <h5 class="book-title">Pride and Prejudice</h5>
                              <h6 class="book-author">Jane Austen</h6>
                              <div class="star-rating">
                                  @php
                                      $stars = 3;
                                  @endphp
                                  @for ($i = 1; $i <= 5; $i++)
                                      <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                  @endfor
                              </div>
                              <div class="last-reader mt-3">
                                  <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                                  <span class="reader">Renato Jr.</span>
                                  <span class="time">12 days ago</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </section>


    <section class="latest-books-section">
      <div class="container">
          <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="text-left">Latest Books</h3>
              <a href="" class="view-all-link">View All</a>
          </div>

          <div class="row">
              <!-- Book 1 -->
              <div class="col-md-3 mb-4">
                  <div class="card">
                      <img src="{{ asset('asset/images/first-lie-wins.jpg') }}" class="card-img-top" alt="Book Cover">
                      <div class="card-body">
                          <h5 class="book-title">First Lie Wins</h5>
                          <h6 class="book-author">Ashley Elston</h6>
                          <div class="star-rating">
                              @php $stars = 4; @endphp
                              @for ($i = 1; $i <= 5; $i++)
                                  <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                              @endfor
                          </div>
                          <div class="last-reader mt-3">
                              <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                              <span class="reader">Renato Jr.</span>
                              <span class="time">5 days ago</span>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Book 2 -->
              <div class="col-md-3 mb-4">
                  <div class="card">
                      <img src="{{ asset('asset/images/funny-story.jpg') }}" class="card-img-top" alt="Book Cover">
                      <div class="card-body">
                          <h5 class="book-title">Funny Story</h5>
                          <h6 class="book-author">Emily Henry</h6>
                          <div class="star-rating">
                              @php $stars = 4; @endphp
                              @for ($i = 1; $i <= 5; $i++)
                                  <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                              @endfor
                          </div>
                          <div class="last-reader mt-3">
                              <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                              <span class="reader">Renato Jr.</span>
                              <span class="time">12 days ago</span>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Book 3 -->
              <div class="col-md-3 mb-4">
                  <div class="card">
                      <img src="{{ asset('asset/images/the-women.jpg') }}" class="card-img-top" alt="Book Cover">
                      <div class="card-body">
                          <h5 class="book-title">The Women</h5>
                          <h6 class="book-author">Kristin Hannah</h6>
                          <div class="star-rating">
                              @php $stars = 2.1; @endphp
                              @for ($i = 1; $i <= 5; $i++)
                                  <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                              @endfor
                          </div>
                          <div class="last-reader mt-3">
                              <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                              <span class="reader">Renato Jr.</span>
                              <span class="time">12 days ago</span>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Book 4 -->
              <div class="col-md-3 mb-4">
                  <div class="card">
                      <img src="{{ asset('asset/images/the-teacher.jpg') }}" class="card-img-top" alt="Book Cover">
                      <div class="card-body">
                          <h5 class="book-title">The Teacher</h5>
                          <h6 class="book-author">Freida McFadden</h6>
                          <div class="star-rating">
                              @php $stars = 5; @endphp
                              @for ($i = 1; $i <= 5; $i++)
                                  <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                              @endfor
                          </div>
                          <div class="last-reader mt-3">
                              <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                              <span class="reader">Renato Jr.</span>
                              <span class="time">12 days ago</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

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