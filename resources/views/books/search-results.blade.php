@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="assets/css/style.css">
@endsection

@section('content')

<x-navbar />

<section class="search-section">
    <div class="container">
        <div class="results_container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Search Results for <i>"{{ $query }}"</i></h3>
            </div>

            @if ($books->isEmpty())
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="noResult_container">
                <p class="text-bg-danger text-center">No books found matching <i>{{ $query }}"</i>.</p>
                        </div>
                    </div>
                </div>
            @else

                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <a href="{{ route('books.bookDetail', ['genre' => $book->genre, 'id' => $book->bookID]) }}">
                                        <img src="{{ $book->cover }}" class="card-img-top" alt="Book Cover">
                                        <div class="card-body">
                                            <h5 class="book-title">{{ $book->title }}</h5>
                                            <h6 class="book-author">{{ $book->author }}</h6>
                                            <div class="star-rating">
                                                <span class="">{{ number_format($book->reviews_avg_rating, 1) }}</span>
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
            @endif
        </div>
    </div>
</section>
@endsection