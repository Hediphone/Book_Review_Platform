@extends('Components.Layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <x-navbar/>

    <!-- Book Details Section -->
    <section class="book-details-section">
        <div class="container">
            <div class="row" id="card-style">
                <!-- Book Image and Buttons -->
                <div class="col-md-3">
                    <img src="{{ asset($book['cover']) }}" class="book-details-image" alt="Book Cover">
                    
                    <div class="mt-3">
                        <button class="btn btn-primary btn-block mb-2" id="book-btn1">Add to Favorites</button>
                        <button class="btn btn-secondary btn-block" id="book-btn2" onclick="scrollToReviewForm()">Rate this Book</button>

                    </div>
                </div>

                <!-- Empty Space between Image and Text -->
                <div class="col-md-1"></div>

                <!-- Book Details -->
                <div class="col-md-8">
                    <h2 class="book-title">{{ $book['title'] }}</h2>
                    <h4 class="book-author-h">by {{ $book['author'] }}</h4>
                    
                    <p class="book-descrip">
                        <span id="syn">Synopsis:</span><br>{!! nl2br(e($book['description'])) !!}
                    </p>

                    <p class="book-genres">
                        <span id="genres-title">Genres:</span>
                        @php
                            $genres = is_array($bookGenres) ? $bookGenres : explode(',', $book['genre']);
                        @endphp

                        @foreach ($genres as $genre)
                            <a href="{{ route('books.browse.genre', ['genre' => trim($genre)]) }}" class="genre-itemm">{{ trim($genre) }}</a>
                            @if (!$loop->last) &nbsp; @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Reviews Section -->
    <section class="book-review-section" id="card-style">
        <div class="container mt-5">
            <h3 class="mb-4 text-center">Ratings & Reviews</h3>

            <div class="mb-4">
                <p class="total-reviews" style="padding: 15px;">Total Reviews: {{ $totalReviews }}</p>
            </div>

            <!-- Star Rating Bar Graph -->
            <div class="star-rating-graph mb-4">
                @foreach ($starRatings as $stars => $percentage)
                    <div class="row align-items-center mb-2">
                        <div class="col-1">{{ $stars }} <i class="bi bi-star-fill text-warning"></i></div>
                        <div class="col-10">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-1 text-end">{{ $percentage }}%</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="reviews-container">
            @foreach ($reviews as $review)
                <div id="review-item" class="review-item mb-4 border-top">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('asset/images/renjun.png') }}" alt="User" class="rounded-circle me-3" style="width: 32px; height: 32px;">
                        <div>
                            <h6 class="mb-1" id="username-review">
                                {{ $review->user->name }} 
                                <i id="star" class="bi bi-star-fill text-warning me-1"></i>
                                {{ $review->rating }}
                            </h6>
                            <p class="review-content">{{ $review->comment }}</p>
                            <small class="text-muted">Published on {{ $review->created_at->format('F d, Y') }}</small>

                            <!-- Display Replies -->
                            @foreach ($review->replies as $reply)
                                <div class="reply-item ms-10 p-3 border-top border-secondary">
                                    <div class="d-flex align-items-start">
                                        <img src="{{ asset('asset/images/front.png') }}" alt="User" class="rounded-circle me-3" style="width: 32px; height: 32px;">
                                        <div>
                                            <h6 class="mb-1" id="username-review">{{ $reply->user->name }}</h6>
                                            <p class="review-content">{{ $reply->comment }}</p>
                                            <small class="text-muted">Published on {{ $reply->created_at->format('F d, Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if (auth()->id() === $review->userID)
                                <button class="btn btn-sm btn-secondary mt-2" id="cust-bt1" onclick="toggleEditForm({{ $review->reviewID }})">
                                    <i class="fa-regular fa-pen-to-square me-2"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger mt-2" id="cust-bt2" onclick="toggleDeleteForm({{ $review->reviewID }})">
                                    <i class="fa-solid fa-trash me-2"></i> Delete
                                </button>

                                <!-- Edit Form -->
                                <form id="edit-form-{{ $review->reviewID }}" action="{{ route('reviews.update', ['reviewID' => $review->reviewID]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="comment" id="review-text-area" rows="3" class="form-control mt-5" placeholder="Edit your review...">{{ $review->comment }}</textarea>
                                    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}" class="form-control mt-4" placeholder="Rating (1-5)">
                                    <button type="submit" id="custom-button" class="btn mt-3"><i class="fa-solid fa-pen"></i> Update</button>
                                </form>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $review->reviewID }}" action="{{ route('reviews.delete', ['reviewID' => $review->reviewID]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                    <button id="cust-bt3" type="submit" class="btn btn-sm btn-danger mt-2">Confirm Delete?</button>
                                </form>
                            @endif

                            <!-- Reply Form -->
                            <form action="{{ route('reviews.reply', ['genre' => $genre, 'id' => $id, 'review_id' => $review->reviewID]) }}" method="POST">
                                @csrf
                                <textarea id="review-text-area" name="comment" rows="3" class="form-control mt-5" placeholder="Write your reply here..."></textarea>
                                <button type="submit" id="reply" class="btn btn-primary mt-2"><i class="fa-solid fa-reply"></i> Reply</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Review Form -->
        <div class="add-review" id="add-review-form">
            <h5 class="mb-3">Add a Review</h5>
            <form action="{{ route('reviews.store', ['id' => $book->bookID]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Your Rating:</label>
                    <select name="rating" class="form-select">
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
                <button id="submit" type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </section>

    <!-- Modal for Errors -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="errorModalLabel">
                    {{ session('error_title') ?? 'Error' }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>  
            </div>
            <div class="modal-body">
                <p id="errorMessage">{{ session('error_message') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <script>
        function toggleEditForm(reviewID) {
            const editForm = document.getElementById('edit-form-' + reviewID);
            editForm.style.display = (editForm.style.display === 'none' || editForm.style.display === '') ? 'block' : 'none';
        }

        function toggleDeleteForm(reviewID) {
            const deleteForm = document.getElementById('delete-form-' + reviewID);
            deleteForm.style.display = (deleteForm.style.display === 'none' || deleteForm.style.display === '') ? 'block' : 'none';
        }

    document.addEventListener('DOMContentLoaded', function () {
        @if(session('error_message'))
            $('#errorModal').modal('show');
        @endif
    });
    function scrollToReviewForm() {
        const reviewForm = document.getElementById('add-review-form');
        if (reviewForm) {
            reviewForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

   

    </script>
@endsection
