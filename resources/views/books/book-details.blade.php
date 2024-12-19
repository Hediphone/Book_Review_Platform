@extends('Components.Layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <x-navbar/>

    <section class="book-details-section">
        <div class="container">
            <div class="row" id="card-style">
                <!-- Book Image -->
                <div class="col-md-3">
                    <img src="{{ asset($book['cover']) }}" class="book-details-image" alt="Book Cover">
                    <!-- Buttons Section -->
                    <div class="mt-3">
                        <button class="btn btn-primary btn-block mb-2" id="book-btn1">Add to Favorites</button>
                        <button class="btn btn-secondary btn-block" id="book-btn2">Rate this Book</button>
                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-8">
                    <h2 class="book-title">{{ $book['title'] }}</h2>
                    <h4 class="book-author-h">by {{ $book['author'] }}</h4>
                    
                    <p class="book-descrip"><span id="syn">Synopsis:</span><br>{!! nl2br(e($book['description'])) !!}</p>

                    <p class="book-genres">
                        <span id="genres-title">Genres:</span>
                        @php
                            $genres = is_string($book['genre']) ? explode(',', $book['genre']) : $book['genre'];
                        @endphp

                        @foreach ($genres as $genre)
                            <a href="{{ route('books.browse.genre', ['genre' => trim($genre)]) }}" class="genre-itemm">{{ $genre }}</a>
                            @if (!$loop->last)
                                &nbsp;
                            @endif
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="book-review-section">
    <div class="container mt-5" id="card-style">
        <!-- Reviews Section Header -->
        <h3 class="mb-4 text-center">Ratings & Reviews</h3>

        <!-- Total Reviews -->
        <div class="mb-4">
            <p class="total-reviews" style="padding:15px;">Total Reviews: {{ $totalReviews }}</p>
        </div>

        <!-- Star Rating Bar Graph -->
        <div class="star-rating-graph mb-4">
            @foreach ($starRatings as $stars => $percentage)
                <div class="row align-items-center mb-2">
                    <div class="col-1">{{ $stars }} <i class="bi bi-star-fill text-warning"></i></div>
                    <div class="col-10">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $percentage }}%;" 
                                 aria-valuenow="{{ $percentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-1 text-end">{{ $percentage }}%</div>
                </div>
            @endforeach
        </div>
    </div>

   

    <div class="review-item mb-4 p-3 border-top border-bottom rounded">
    @foreach ($reviews as $review)
        <div class="d-flex align-items-start">
            <img src="{{ asset('asset/images/renjun.png') }}" alt="User" class="rounded-circle me-3" style="width: 32px; height: 32px;">
            <div>
                <h6 class="mb-1" id="username-review">
                    {{ $review->user->name }} <i id="star" class="bi bi-star-fill text-warning me-1"></i> {{ $review->rating }}
                </h6>
                <p class="mb-2 review-content">{{ $review->comment }}</p>
                <small class="text-muted">Published on {{ $review->created_at->format('F d, Y') }}</small>

                <!-- Display Replies -->
                @foreach ($review->replies as $reply)
                    <div class="reply-item ms-10 mt-3 p-3">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('asset/images/front.png') }}" alt="User" class="rounded-circle me-3" style="width: 32px; height: 32px;">
                            <div>
                                <h6 class="mb-1" id="username-review">{{ $reply->user->name }}</h6>
                                <p class="mb-2 review-content">{{ $reply->comment }}</p>
                                <small class="text-muted">Published on {{ $reply->created_at->format('F d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Reply Form -->
                <form action="{{ route('reviews.reply', ['genre' => $genre, 'id' => $id, 'review_id' => $review->reviewID]) }}" method="POST">
                    @csrf
                    <textarea name="comment" rows="3" class="form-control" placeholder="Write your reply here..."></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Reply</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

   <!-- Add Review Form -->
<div class="add-review">
    <h5 class="mb-3">Add a Review</h5>
    <form action="{{ route('reviews.store', ['id' => $book->bookID]) }}" method="POST">

    @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Your Rating:</label>
            <select id="rating" name="rating" class="form-select">
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
        </div>
        <div class="mb-3">
            <textarea id="review-text" name="comment" class="form-control" rows="4" placeholder="Write your review here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary" id="submit">Submit Review</button>
    </form>
</div>



</section>

@endsection
