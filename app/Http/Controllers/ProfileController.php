<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function favoriteGenre()
    {
        // Step 1: Get the genres from the books associated with the user's reviews
        $user = auth()->user(); // Get the currently authenticated user
    
        // Fetch all reviews made by the user
        $userReviews = $user->reviews; 
    
        // Collect the genres of the books reviewed by the user
        $genres = [];
        foreach ($userReviews as $review) {
            $bookGenres = explode(',', $review->book->genre); // Get genres from the related book
            foreach ($bookGenres as $genre) {
                $trimmedGenre = trim($genre);
                if (!empty($trimmedGenre)) {
                    $genres[] = $trimmedGenre;
                }
            }
        }
    
        // Step 2: Count the frequency of each genre
        $genreCount = array_count_values($genres);
    
        // Step 3: Sort genres by frequency in descending order
        arsort($genreCount);
    
        // Step 4: Get the most frequent genre (the user's favorite)
        $favoriteGenre = key($genreCount); // The genre with the highest frequency
    
        // Log for debugging
        Log::debug('User favorite genre', ['FavoriteGenre' => $favoriteGenre]);
    
        return view('dashboard', compact('favoriteGenre'));
    }
}
