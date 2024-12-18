@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
<x-carousel />

<section class="popular-now-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-left">Popular Now</h3>
            <a href="" class="view-all-link">View All</a>
        </div>

        <div class="row">
            @foreach (array_slice($posts, 0, 4) as $post)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="{{ route('books.show', $post['bookID']) }}">
                            <img src="{{ asset($post['cover']) }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="book-title">{{ $post['title'] }}</h5>
                                <h6 class="book-author">{{ $post['author'] }}</h6>
                                <!-- <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    
                                                @endfor
                                            </div> -->
                                <div class="star-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                @if (isset($post['last_reader']))
                                    <div class="last-reader mt-3">
                                        <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                            height="24" alt="Reader's Profile Picture">
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
            <a href="" class="view-all-link">View All</a>
        </div>

        <div class="row">
            @foreach (array_slice($posts, 4, 4) as $post)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="{{ route('books.show', $post['bookID']) }}">
                            <img src="{{ asset($post['cover']) }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="book-title">{{ $post['title'] }}</h5>
                                <h6 class="book-author">{{ $post['author'] }}</h6>
                                <div class="star-rating">
                                    <!-- @for ($i = 1; $i <= 5; $i++)
                                            @endfor -->
                                    <div class="star-rating">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                </div>
                                @if (isset($post['last_reader']))
                                    <div class="last-reader mt-3">
                                        <img src="{{ asset('asset/images/renjun.png') }}" class="rounded-circle" width="24"
                                            height="24" alt="Reader's Profile Picture">
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
@endsection