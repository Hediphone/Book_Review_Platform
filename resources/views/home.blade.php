@extends('Components.Layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <x-navbar />
    <x-carousel />

    <section class="popular-now-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Top Rated & Popular Now</h3>
                <a href="{{ route('view-all.rating.show', ['genre' => 'popular']) }}" class="view-all-link">View All</a>
            </div>

            <div class="row">
                @foreach ($popularNow as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a href="{{ route('books.bookDetail', ['genre' => $book->genre, 'id' => $book->bookID]) }}">
                                <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                <div class="card-body">
                                    <h5 class="book-title">{{ $book->title }}</h5>
                                    <h6 class="book-author">{{ $book->author }}</h6>
                                    <div class="star-rating">
                                        <span>{{ number_format($book->reviews_avg_rating, 1) }}</span>
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < floor($book->reviews_avg_rating))
                                                <i class="bi bi-star-fill filled"></i> 
                                            @elseif ($i == floor($book->reviews_avg_rating) && $book->reviews_avg_rating - floor($book->reviews_avg_rating) >= 0.5)
                                                <i class="bi bi-star-half"></i>
                                            @else
                                                <i class="bi bi-star"></i> 
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="latest-books-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Latest Books</h3>
                <a href="{{ route('view-all.latest-release.show', ['genre' => 'latest']) }}" class="view-all-link">View All</a>
            </div>
            <div class="row">
                @foreach ($latestBooks as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a href="{{ route('books.bookDetail', ['genre' => $book->genre, 'id' => $book->bookID]) }}">
                                <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                                <div class="card-body">
                                    <h5 class="book-title">{{ $book->title }}</h5>
                                    <h6 class="book-author">{{ $book->author }}</h6>
                                    <div class="star-rating">
                                        <span>{{ number_format($book->reviews_avg_rating, 1) }}</span>
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < floor($book->reviews_avg_rating))
                                                <i class="bi bi-star-fill filled"></i> <!-- Full star -->
                                            @elseif ($i == floor($book->reviews_avg_rating) && $book->reviews_avg_rating - floor($book->reviews_avg_rating) >= 0.5)
                                                <i class="bi bi-star-half"></i> <!-- Half star -->
                                            @else
                                                <i class="bi bi-star"></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection