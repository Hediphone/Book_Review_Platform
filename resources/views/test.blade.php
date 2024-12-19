@extends('Components.Layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Test Book Ratings & Reviews</h1>

        <!-- Display average rating -->
        <div class="mb-4">
            <h3>Average Rating: {{ number_format($averageRating, 1) }} / 5</h3>
        </div>

        <!-- Display total number of reviews -->
        <div class="mb-4">
            <h4>Total Reviews: {{ $totalReviews }}</h4>
        </div>

   <!-- Display the star rating percentages -->
   <div class="star-rating-graph mb-4">
            <h4>Star Ratings Breakdown:</h4>
            @if(!empty($starRatings))
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
            @else
                <p>No ratings available for this book.</p>
            @endif
            
        </div>
    </div>
@endsection
