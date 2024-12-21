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
                                    <img id="profile" src="assets/images/renjun.png" alt="Profile Picture">
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
                                    </p>
                                    @if(is_string($topReviewedBooks))
    <p>{{ $topReviewedBooks }}</p> <!-- If no reviews yet, show message -->
@else
    @foreach ($topReviewedBooks as $book)
        <p>{{ $book->title }} (Your Rating: {{ number_format($book->rating, 1) }})</p>
    @endforeach
@endif

                                </div>
                            </div>
                            <div class="row left_pd">
                                <div class="col-md-12">
                                    <p class="fave_genres"><b>Favorite Books</b></p>
                                    <p class="genres">{{ Auth::user()->favorite_genres }}</p>
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
                <div class="row" id="review-list">
              
                </div>
            </div>
        </section>

        <section class="reviewed_books">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left">My Reviewed Books</h3>
                    <button id="view-all-books" class="view-all-link">View All</button>
                </div>
                <div class="row" id="book-list">

                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    <script>
        document.getElementById('view-all-books').addEventListener('click', function () {
            const books = document.querySelectorAll('.book-item');
            const hiddenBooks = Array.from(books).filter(book => book.classList.contains('hidden'));

            if (hiddenBooks.length > 0) {
                books.forEach(book => book.classList.remove('hidden'));
                this.textContent = 'Show Less';
            } else {
                books.forEach((book, index) => {
                    if (index >= 4) {
                        book.classList.add('hidden');
                    }
                });
                this.textContent = 'View All';
            }
        });

        document.getElementById('view-all-reviews').addEventListener('click', function () {
            const reviewItems = document.querySelectorAll('.review-item');
            const hiddenReviews = Array.from(reviewItems).filter(item => item.style.display === 'none');

            if (hiddenReviews.length > 0) {
                reviewItems.forEach(item => {
                    item.style.display = 'block';
                });
                this.textContent = 'Show Less';
            } else {
                reviewItems.forEach((item, index) => {
                    if (index >= 4) {
                        item.style.display = 'none';
                    }
                });
                this.textContent = 'View All';
            }
        });
    </script>
@endsection
