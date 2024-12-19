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
    <a href="#" class="genre-itemm">{{ $genre }}</a>
    @if (!$loop->last)
        &nbsp;
    @endif
@endforeach

                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
