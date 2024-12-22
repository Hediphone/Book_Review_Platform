@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
<x-navbar />

<section class="genre-list-section">
    <div class="containerr">
        <h3 class="mb-4 mt-6">Genres</h3>
        
        <!-- Dropdown Button -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="genreDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ request()->routeIs('books.browse.genre') ? ucfirst(request()->route()->parameter('genre')) : 'Select Genre' }}
            </button>
            
            <ul class="dropdown-menu" aria-labelledby="genreDropdown">
                @php
                    $uniqueGenres = []; 
                @endphp
                @foreach ($genres as $index => $genre)
                    @php
                        $genreList = explode(',', $genre->genre);
                    @endphp
                    @foreach ($genreList as $singleGenre)
                        @php
                            $trimmedGenre = trim($singleGenre); 
                            if (!in_array($trimmedGenre, $uniqueGenres)) {
                                $uniqueGenres[] = $trimmedGenre;
                            }
                        @endphp
                    @endforeach
                @endforeach

                @foreach ($uniqueGenres as $singleGenre)
                    <li>
                        <a class="dropdown-item" href="{{ route('books.browse.genre', $singleGenre) }}">
                            {{ $singleGenre }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>


<!-- Books by Genre -->
@foreach ($booksByGenre as $genre => $books)
    <section class="genre-section">
        <div class="containerr">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-left">{{ ucfirst($genre) }} Books</h3>
            <a href="{{ route('view-all.genre.show', ['genre' => $genre]) }}" class="view-all-link">View All</a>

        </div>

            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                        <a href="{{ route('books.bookDetail', ['id' => $book->bookID]) }}">
                            <img src="{{ asset($book->cover) }}" class="card-img-top" alt="Book Cover">
                        </a>
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
        </div>
    </section>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script
@endsection
