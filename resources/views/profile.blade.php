@extends('Components.Layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('content')

    <x-navbar />

    <main>
        <section class="dashboard">
            <div class="container">
                <div class="dashboard_container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile_container">
                                <div class="profile_pic">
                                    <img id="profile" src="{{ asset(Auth::user()->profile_picture ?? 'assets/user/default-profile.png') }}" alt="Profile Picture">
                                </div>
                                <div class="username">
                                    <p class="username text-center"><b>{{ Auth::user()->name }}</b></p>
                                    <p class="register_date">Joined in {{ Auth::user()->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md rf_margin">
                            <div class="row left_pd">
                                <div class="col-md-12">
                                    <p class="fave_genres"><b>Favorite Genres:</b></p>
                                    <p>
                                        @forelse ($favoriteGenres as $index => $genre)
                                            {{ $genre }}@if(!$loop->last), @endif
                                        @empty
                                            No favorite genres available.
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                            <div class="row left_pd">
                                <div class="col-md-12">
                                    <p class="fave_genres"><b>Top Reviewed Books:</b></p>
                                    @if(empty($topReviewedBooks) || is_string($topReviewedBooks))
                                        <p>No reviews yet.</p>
                                    @else
                                        @foreach ($topReviewedBooks as $book)
                                            @if(is_object($book) && isset($book->title))
                                                <p>{{ $book->title }} (Your Rating: {{ number_format($book->rating, 1) }})</p>
                                            @else
                                                <p>No reviewed books available. Review books first.</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row left_pd">
                                <div class="col-md-12">
                                    <p class="fave_genres"><b>Recently Added Favorite Books</b></p>
                                    @if($topFavoriteBooks->count() == 0)
                                        <p>No favorite books added yet.</p>
                                    @else
                                        @foreach ($topFavoriteBooks as $book)
                                            <p>{{ $book->title }} by {{ $book->author }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="recent_reviews">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left">My Recent Reviews</h3>
                    <button id="view-all-reviews" class="view-all-link">View All</button>
                </div>

                @if ($reviews->isEmpty())
                    <p>No reviews yet. Start reviewing your books!</p>
                @else
                    <div class="row" id="review-list">
                        @foreach ($reviews->take(4) as $review)
                            <div class="col-md-3 mb-4 review-item book-item">
                                <div class="card">
                                    <div class="reviews">
                                        <h5 class="book_title" style="font-style: italic;">"{{ $review->comment }}"</h5>
                                        <p class="review_comment">{{ $review->book->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($reviews->skip(4) as $review)
                            <div class="col-md-3 mb-4 review-item" style="display: none;">
                                <div class="card">
                                    <div class="reviews">
                                        <h5 class="book_title" style="font-style: italic;">"{{ $review->comment }}"</h5>
                                        <p class="review_comment">{{ $review->book->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="reviewed_books">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left">My Reviewed Books</h3>
                    <button id="view-all-books" class="view-all-link">View All</button>
                </div>

                @if ($reviewedBooksWithAvgRating->isEmpty())
                    <p>You haven't reviewed any books yet.</p>
                @else
                    <div class="row" id="book-list">
                        @foreach ($reviewedBooksWithAvgRating->take(4) as $book)
                            <div class="col-md-3 mb-4 book-item">
                                <div class="card">
                                    <a href="{{ route('books.bookDetail', ['id' => $book->bookID]) }}">
                                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="book-title">{{ $book->title }}</h5>
                                        <h6 class="book-author">{{ $book->author }}</h6>
                                        <div class="star-rating">
                                            <span>{{ number_format($book->average_rating, 1) }}</span>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($book->average_rating))
                                                    <i class="bi bi-star-fill filled"></i>
                                                @elseif ($i == floor($book->average_rating) && $book->average_rating - floor($book->average_rating) >= 0.5)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($reviewedBooksWithAvgRating->skip(4) as $book)
                            <div class="col-md-3 mb-4 book-item" style="display: none;">
                                <div class="card">
                                    <a href="{{ route('books.bookDetail', ['id' => $book->bookID]) }}">
                                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="book-title">{{ $book->title }}</h5>
                                        <h6 class="book-author">{{ $book->author }}</h6>
                                        <div class="star-rating">
                                            <span>{{ number_format($book->average_rating, 1) }}</span>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($book->average_rating))
                                                    <i class="bi bi-star-fill filled"></i>
                                                @elseif ($i == floor($book->average_rating) && $book->average_rating - floor($book->average_rating) >= 0.5)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="favorite_books">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left">My Favorite Books</h3>
                    <button id="view-all-books" class="view-all-link">View All</button>
                </div>

                @if ($favoriteBooks->isEmpty())
                    <p>You haven't added any books to your favorites yet.</p>
                @else
                    <div class="row" id="book-list">
                        @foreach ($favoriteBooks->take(4) as $book)
                            <div class="col-md-3 mb-4 book-item">
                                <div class="card">
                                    <a href="{{ route('books.bookDetail', ['id' => $book->bookID]) }}">
                                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="book-title">{{ $book->title }}</h5>
                                        <h6 class="book-author">{{ $book->author }}</h6>
                                        <div class="star-rating">
                                            <span>{{ number_format($book->average_rating, 1) }}</span>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($book->average_rating))
                                                    <i class="bi bi-star-fill filled"></i>
                                                @elseif ($i == floor($book->average_rating) && $book->average_rating - floor($book->average_rating) >= 0.5)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($favoriteBooks->skip(4) as $book)
                            <div class="col-md-3 mb-4 book-item" style="display: none;">
                                <div class="card">
                                    <a href="{{ route('books.bookDetail', ['id' => $book->bookID]) }}">
                                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="book-title">{{ $book->title }}</h5>
                                        <h6 class="book-author">{{ $book->author }}</h6>
                                        <div class="star-rating">
                                            <span>{{ number_format($book->average_rating, 1) }}</span>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($book->average_rating))
                                                    <i class="bi bi-star-fill filled"></i>
                                                @elseif ($i == floor($book->average_rating) && $book->average_rating - floor($book->average_rating) >= 0.5)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>


    </main>
@endsection

@section('scripts')
    <script>
        document.getElementById('view-all-books').addEventListener('click', function () {
            const bookItems = document.querySelectorAll('.book-item');
            const viewAllButton = document.getElementById('view-all-books');
            bookItems.forEach(item => item.style.display = 'block');
            viewAllButton.style.display = 'none'; // Hide "View All" button after expanding
        });

        document.getElementById('view-all-reviews').addEventListener('click', function () {
            const reviewItems = document.querySelectorAll('.review-item');
            const viewAllButton = document.getElementById('view-all-reviews');
            reviewItems.forEach(item => item.style.display = 'block');
            viewAllButton.style.display = 'none'; // Hide "View All" button after expanding
        });
    </script>
@endsection
