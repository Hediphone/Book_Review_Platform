@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="asset/css/dashboard.css">
@endsection

@section('content')

<x-navbar />

<main>
    <section class="dashboard">
        <div class="dashboard_container">
            <div class="row">
                <div class="col-md-3 rf_margin">
                    <div class="profile_container">
                        <div class="profile_pic">
                            <img src="asset/images/renjun.png">
                        </div>
                        <div class="username">
                            <p class="username"><b>{{ Auth::user()->name }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rf_margin">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="profile_details">
                                    <p class="numbers"><b>100</b></p>
                                    <p class="txt">Books</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile_details">
                                    <p class="numbers"><b>1, 245</b></p>
                                    <p class="txt">Friends</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile_details">
                                <p class="numbers"><b>8</b></p>
                                <p class="txt">Following</p>                  
                            </div>
                        </div>
                    </div>
                    <hr color="B4D51E">
                    <div class="row left_pd">
                        <div class="col-md-12">
                            <p class="register_date">Joined in November 1, 2024</p>
                            <p class="fave_genres">Favorite Genres</p>
                            <p class="genres">Romance, Mystery/Thriller, Fantasy, Science Fiction, +5 More</p>
                        </div>
                    </div>
                    <div class="row g-0">
                        <p class="mybookshelves"><b>My Bookshelves</b></p>
                        <div class="w-100"></div>
                        <div class="col-md-4 justify_right">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p class="text">Reviewed (01)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 justify_left">
                            <div class="profile_details">
                                <div class="rectangle">
                                    <p class="text">Favorites (01)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 rf_margin">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fave_book_container">
                                <img src=asset/images/dashboard/storm_and_silence.png>
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
                <h3 class="text-left">Recent Reviews</h3>
                <button id="view-all-reviews" class="view-all-link">View All</button>
            </div>
            <div class="row" id="review-list">
                @foreach (array_slice($posts, 0, 4) as $post)
                    <div class="col-md-3 mb-4 review-item">
                        <div class="card">
                            <div class="reviews">
                                <h5 class="book_title">{{ $post['title'] }}</h5>
                                @foreach ($post['comments'] as $comment)
                                    <span class="text">"{{ $comment['text'] }}"</span>
                                    <span class="time">{{ $comment['time'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Hidden reviews that will be shown when the "View All" button is clicked -->
                @foreach (array_slice($posts, 4) as $post)
                    <div class="col-md-3 mb-4 review-item" style="display: none;">
                        <div class="card">
                            <div class="reviews">
                                <h5 class="book_title">{{ $post['title'] }}</h5>
                                @foreach ($post['comments'] as $comment)
                                    <span class="text">"{{ $comment['text'] }}"</span>
                                    <span class="time">{{ $comment['time'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="reviewed_books">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Reviewed Books</h3>
                <button id="view-all-books" class="view-all-link">View All</button>
            </div>
            <div class="row" id="book-list">
                @php
                    usort($posts, function ($a, $b) {
                        return $b['rating'] <=> $a['rating'];
                    });
                @endphp

                @foreach (array_slice($posts, 0, 4) as $post)
                    <div class="col-md-3 mb-4 book-item">
                        <div class="card">
                            <img src="{{ $post['cover'] }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="book-title">{{ $post['title'] }}</h5>
                                <h6 class="book-author">{{ $post['author'] }}</h6>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $post['rating'] ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                @foreach ($post['comments'] as $comment)
                                    <div class="last-reader mt-3">
                                        <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                            height="24" alt="Reader's Profile Picture">
                                        <span class="reader">{{ $comment['reader'] }}</span>
                                        <span class="time">{{ $comment['time'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Hidden books that will be shown when the "View All" button is clicked -->
                @foreach (array_slice($posts, 4) as $post)
                    <div class="col-md-3 mb-4 book-item hidden">
                        <div class="card">
                            <img src="{{ $post['cover'] }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="book-title">{{ $post['title'] }}</h5>
                                <h6 class="book-author">{{ $post['author'] }}</h6>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $post['rating'] ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                @foreach ($post['comments'] as $comment)
                                    <div class="last-reader mt-3">
                                        <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                            height="24" alt="Reader's Profile Picture">
                                        <span class="reader">{{ $comment['reader'] }}</span>
                                        <span class="time">{{ $comment['time'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

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