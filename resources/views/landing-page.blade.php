@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
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
                                    <span class="">{{ number_format($book->reviews_avg_rating, 1) }}</span>
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
                                @if (isset($post['last_reader']))
                                    <div class="last-reader mt-3">
                                        <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24" height="24" alt="Reader's Profile Picture">
                                        <span class="reader">{{ $post['last_reader']['name'] }}</span>
                                        <span class="time">{{ $post['last_reader']['time_ago'] }}</span>
                                    </div>
                                @endif
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
            <a href="{{ route('view-all.genre.show', ['genre' => 'latest']) }}" class="view-all-link">View All</a>
        </div>
        <div class="row">
            @foreach ($latestBooks as $book)
                <div class="col-6 col-md-3 mb-4">
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
@endsection