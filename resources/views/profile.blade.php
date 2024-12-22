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
                        @foreach ($reviews as $index => $review)
                            <div class="col-md-3 mb-4 review-item {{ $index >= 4 ? 'hidden' : '' }}">
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
                        @foreach ($reviewedBooksWithAvgRating as $index => $book)
                            <div class="col-md-3 mb-4 book-item {{ $index >= 4 ? 'hidden' : '' }}">
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
                    <button id="view-all-fav-books" class="view-all-link">View All</button>
                </div>

                @if ($favoriteBooks->isEmpty())
                    <p>You haven't added any books to your favorites yet.</p>
                @else
                    <div class="row" id="book-list">
                        @foreach ($favoriteBooks as $index => $book)
                            <div class="col-md-3 mb-4 book-item-fav {{ $index >= 4 ? 'hidden' : '' }}">
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
        const hiddenBooks = Array.from(bookItems).filter(item => item.classList.contains('hidden'));

        if (hiddenBooks.length > 0) {
            bookItems.forEach(item => item.classList.remove('hidden'));
            this.textContent = 'Show Less';
        } else {
            bookItems.forEach((item, index) => {
                if (index >= 4) {
                    item.classList.add('hidden');
                }
            });
            this.textContent = 'View All';
        }
    });

        document.getElementById('view-all-reviews').addEventListener('click', function () {
            const reviewItems = document.querySelectorAll('.review-item');
            const hiddenReviews = Array.from(reviewItems).filter(item => item.classList.contains('hidden'));

            if (hiddenReviews.length > 0) {
                reviewItems.forEach(item => item.classList.remove('hidden'));
                this.textContent = 'Show Less';
            } else {
                reviewItems.forEach((item, index) => {
                    if (index >= 4) {
                        item.classList.add('hidden');
                    }
                });
                this.textContent = 'View All';
            }
        });
        document.getElementById('view-all-fav-books').addEventListener('click', function () {
            const bookfavItems = document.querySelectorAll('.book-item-fav');
            const hiddenBooks = Array.from(bookfavItems).filter(item => item.classList.contains('hidden'));

            if (hiddenBooks.length > 0) {
                bookfavItems.forEach(item => item.classList.remove('hidden'));
                this.textContent = 'Show Less';
            } else {
                bookfavItems.forEach((item, index) => {
                    if (index >= 4) {
                        item.classList.add('hidden');
                    }
                });
                this.textContent = 'View All';
            }
        });
    </script>
@endsection
