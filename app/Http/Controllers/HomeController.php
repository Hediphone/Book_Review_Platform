<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BooksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


class HomeController extends Controller
{
    public function index()
    {
        $popularNow = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
            ->orderByDesc('reviews_avg_rating')  // Sort by the average rating in descending order
            ->take(4)  // Limit to 4 books
            ->get();
    
        $latestBooks = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
            ->orderBy('release_date', 'desc')  // Order by release_date (newest first)
            ->take(4)  // Get the 4 most recent books
            ->get();
    
        return view('home', compact('popularNow', 'latestBooks'));
    }
    
}
