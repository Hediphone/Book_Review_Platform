<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Book;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user(); // Get the currently authenticated user

        // Call different methods for different tasks
        $favoriteGenres = $this->favoriteGenre(); // Get the favorite genres
        $topReviewedBooks = $this->topReviewedBooks(); // Get the top reviewed books

        // Pass all the data to the view
        return view('profile', [
            'favoriteGenres' => $favoriteGenres,
            'topReviewedBooks' => $topReviewedBooks,
        ]);
    }

    public function favoriteGenre()
    {
        $user = auth()->user(); // Get the currently authenticated user
        Log::debug('Authenticated User', ['UserID' => $user->id, 'UserName' => $user->name]);

        // Fetch all reviews made by the user
        $userReviews = $user->reviews;
        Log::debug('User Reviews', ['ReviewsCount' => $userReviews->count()]);

        // Handle case where the user has no reviews
        if ($userReviews->isEmpty()) {
            Log::warning('User has no reviews');
            return ['No reviews yet'];
        }

        // Collect the genres of the books reviewed by the user
        $genres = [];
        foreach ($userReviews as $review) {
            $bookGenres = explode(',', $review->book->genre); // Get genres from the related book
            Log::debug('Processing Review', ['ReviewID' => $review->reviewID, 'BookGenres' => $bookGenres]);

            foreach ($bookGenres as $genre) {
                $trimmedGenre = trim($genre); // Trim whitespace
                if (!empty($trimmedGenre)) {
                    $genres[] = $trimmedGenre; // Add non-empty genres to the list
                    Log::debug('Genre Added', ['Genre' => $trimmedGenre]);
                } else {
                    Log::warning('Skipping Empty Genre', ['RawGenre' => $genre]);
                }
            }
        }

        // Step 2: Count the frequency of each genre
        $genreCount = array_count_values($genres);
        Log::debug('Genre Count', ['GenreCount' => $genreCount]);

        // Step 3: Sort genres by frequency in descending order
        arsort($genreCount);
        Log::debug('Sorted Genre Count', ['SortedGenreCount' => $genreCount]);

        // Step 4: Get the top 4-6 genres (based on count)
        $topGenres = array_slice($genreCount, 0, 6, true); // Get the top 6 genres

        // If fewer than 4 genres exist, ensure we return at least 4 genres.
        if (count($topGenres) < 4) {
            Log::warning('Not enough genres, returning at least 4');
            $topGenres = array_pad($topGenres, 4, 'No genres available');
        }

        // Extract only the genre names (keys of the array)
        return array_keys($topGenres); // Return the top genres as an array
    }

    public function topReviewedBooks()
    {
        // Step 1: Get the authenticated user
        $user = auth()->user(); // Get the currently authenticated user
        Log::debug('Authenticated User', ['UserID' => $user->id, 'UserName' => $user->name]);
    
        // Step 2: Fetch the user's reviews and the related books
        $userReviews = $user->reviews; // Fetch all reviews made by the user
        Log::debug('User Reviews', ['ReviewsCount' => $userReviews->count()]);
    
        // Handle case where the user has no reviews
        if ($userReviews->isEmpty()) {
            Log::warning('User has no reviews');
            return ['No reviews yet']; // Return a default message
        }
    
        // Step 3: Check the values in the reviews to see if we have valid book_ids
        $bookIds = $userReviews->pluck('bookID'); // Get the list of book IDs reviewed by the user
        Log::debug('User Reviewed Book IDs', ['BookIDs' => $bookIds]);
    
        // Step 4: Fetch books with their ratings based on the user's reviews
        $topReviewedBooks = Book::join('reviews', 'books.bookID', '=', 'reviews.bookID')
        ->where('reviews.userID', $user->id)  // Filter reviews to include only those made by the user

        ->orderByDesc('reviews.rating')  // Order by the user's review rating
            ->take(5)  // Limit to the top 5 books
            ->get(['books.title', 'reviews.rating']);  // Select only the book title and review rating
    
        // Log the fetched books (only titles and ratings)
        Log::debug('Top Reviewed Books by User', ['TopBooks' => $topReviewedBooks->toArray()]);
    
        // Step 5: Return the books collection
        return $topReviewedBooks; // Return the collection of top-reviewed books
    }
    

}
