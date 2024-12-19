@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="assets/css/style.css">
@endsection

@section('content')
<section class="results">
    <div class="container">
        <div class="results_container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Search Results</h3>
            </div>

            @if ($books->isEmpty())
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="noResult_container">
                            <p>No books found matching your search criteria.</p>
                        </div>
                    </div>
                </div>
            @else

                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <img src="{{ $book->cover }}" class="card-img-top" alt="Book Cover">
                                    <div class="card-body">
                                        <h5 class="book-title">{{ $book->title }}</h5>
                                        <h6 class="book-author">{{ $book->author }}</h6>
                                        <div class="star-rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
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