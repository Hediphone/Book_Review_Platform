@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="asset/css/dashboard.css">
@endsection

@section('content')
<main>
    <!-- <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div> -->
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3 rf_margin">
                <div class="profile_container">
                    <div class="profile_pic">
                        <img src="asset/images/profile.png">
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
                <div class="row g-0" style="background-color:teal">
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
                            <img src=asset/images/storm_and_silence.png>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="recent_reviews">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left">Recent Reviews</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="reviews">
                            <p class="book_title">The Shank </p>
                            <p class="text">Love this book!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="reviews">
                            <p class="book_title">Lucid Dream</p>
                            <p class="text">A masterpiece!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="reviews">
                            <p class="book_title">Death Delayed</p>
                            <p class="text">Plot twist is 0.0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="reviews">
                            <p class="book_title">The Wallflower's Revenge</p>
                            <p class="text">10/10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="reviewed_books">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Reviewed Books</h3>
                <a href="" class="view-all-link">View All</a>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="asset/images/cruel_prince.png" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="book-title">The Cruel Prince</h5>
                            <h6 class="book-author">Holly Black</h6>
                            <div class="star-rating">
                                @php
                                    $stars = 4;
                                  @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="last-reader mt-3">
                                <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                    height="24" alt="Reader's Profile Picture">
                                <span class="reader">Renato Jr.</span>
                                <span class="time">5 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="asset/images/storm_and_silence.png" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="book-title">Storm and Silence</h5>
                            <h6 class="book-author">Robert Thier</h6>
                            <div class="star-rating">
                                @php
                                    $stars = 4;
                                  @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="last-reader mt-3">
                                <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                    height="24" alt="Reader's Profile Picture">
                                <span class="reader">Renato Jr.</span>
                                <span class="time">5 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="asset/images/waves_of_memories.png" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="book-title">Waves of Memories</h5>
                            <h6 class="book-author">Jonaxx Stories</h6>
                            <div class="star-rating">
                                @php
                                    $stars = 4;
                                  @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="last-reader mt-3">
                                <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                    height="24" alt="Reader's Profile Picture">
                                <span class="reader">Renato Jr.</span>
                                <span class="time">5 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('asset/images/invisible_girl.png') }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="book-title">The Invisible Girl</h5>
                            <h6 class="book-author">Alexisse Rose</h6>
                            <div class="star-rating">
                                @php
                                    $stars = 4;
                                  @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $stars ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="last-reader mt-3">
                                <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                    height="24" alt="Reader's Profile Picture">
                                <span class="reader">Renato Jr.</span>
                                <span class="time">5 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection