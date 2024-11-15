@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="asset/css/style.css">
@endsection

@section('content')

       
    <x-navbar />
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
@endsection