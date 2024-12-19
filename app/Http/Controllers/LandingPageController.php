<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BooksController;
use Illuminate\Http\Request;
use App\Models\Book;


class LandingPageController extends Controller
{
    public function index()
    {
        // Fetch popular books based on average rating
        $popularNow = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
            ->orderByDesc('reviews_avg_rating')  // Sort by the average rating in descending order
            ->take(4)  // Limit to 4 books
            ->get();
    
        // Fetch the latest books based on release_date
        $latestBooks = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
            ->orderBy('release_date', 'desc')  // Order by release_date (newest first)
            ->take(4)  // Get the 4 most recent books
            ->get();
    
        // Pass data to the view
        return view('landing-page', compact('popularNow', 'latestBooks'));
    }
}
