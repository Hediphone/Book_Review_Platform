<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user(); // Get the currently authenticated user
    
        $favoriteGenres = $this->favoriteGenre(); // Get the favorite genres
        $topReviewedBooks = $this->topReviewedBooks(); // Get the top reviewed books
        $topFavoriteBooks = $this->topFavoriteBooks(); // Get the top 5 most recently added favorite books
        $reviewedBooksWithAvgRating = $this->getReviewedBooks($user);
        $favoriteBooks = $this->getFavoriteBooks($user); // Get the favorite books

    
        $reviews = $user->reviews()->with('book')->latest()->get(); // Get the latest 5 reviews with associated books
    
        return view('profile', [
            'favoriteGenres' => $favoriteGenres,
            'topReviewedBooks' => $topReviewedBooks,
            'topFavoriteBooks' => $topFavoriteBooks, // Add the top 5 favorite books to the view
            'reviews' => $reviews, // Pass the reviews data to the view
            'reviewedBooksWithAvgRating' => $reviewedBooksWithAvgRating, // Pass all reviewed books to the view
            'favoriteBooks' => $favoriteBooks, // Pass favorite books to the view


        ]);
    }
    
    public function favoriteGenre()
    {
        $user = auth()->user(); // Get the currently authenticated user
        Log::debug('Authenticated User', ['UserID' => $user->id, 'UserName' => $user->name]);

        $userReviews = $user->reviews;
        Log::debug('User Reviews', ['ReviewsCount' => $userReviews->count()]);

        if ($userReviews->isEmpty()) {
            Log::warning('User has no reviews');
            return ['No reviews yet'];
        }

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

        $genreCount = array_count_values($genres);
        Log::debug('Genre Count', ['GenreCount' => $genreCount]);

        arsort($genreCount);
        Log::debug('Sorted Genre Count', ['SortedGenreCount' => $genreCount]);

        $topGenres = array_slice($genreCount, 0, 6, true); // Get the top 6 genres

        if (count($topGenres) < 4) {
            Log::warning('Not enough genres, returning at least 4');
            $topGenres = array_pad($topGenres, 4, 'No genres available');
        }

        return array_keys($topGenres); // Return the top genres as an array
    }

    public function topReviewedBooks()
    {
        $user = auth()->user(); // Get the currently authenticated user
        Log::debug('Authenticated User', ['UserID' => $user->id, 'UserName' => $user->name]);
    
        $userReviews = $user->reviews; // Fetch all reviews made by the user
        Log::debug('User Reviews', ['ReviewsCount' => $userReviews->count()]);
    
        if ($userReviews->isEmpty()) {
            Log::warning('User has no reviews');
            return ['No reviews yet']; // Return a default message
        }
    
        $bookIds = $userReviews->pluck('bookID'); // Get the list of book IDs reviewed by the user
        Log::debug('User Reviewed Book IDs', ['BookIDs' => $bookIds]);
    
        $topReviewedBooks = Book::join('reviews', 'books.bookID', '=', 'reviews.bookID')
        ->where('reviews.userID', $user->id)  // Filter reviews to include only those made by the user

        ->orderByDesc('reviews.rating')  // Order by the user's review rating
            ->take(5)  // Limit to the top 5 books
            ->get(['books.title', 'reviews.rating']);  // Select only the book title and review rating
    
        Log::debug('Top Reviewed Books by User', ['TopBooks' => $topReviewedBooks->toArray()]);
    
        return $topReviewedBooks; // Return the collection of top-reviewed books
    }

    public function topFavoriteBooks()
    {
        $user = auth()->user(); // Get the currently authenticated user

        $topFavoriteBooks = $user->favoriteBooks()
                                ->orderBy('pivot_created_at', 'desc') // Order by pivot table's created_at
                                ->take(5) // Limit to the first 5
                                ->get(); // Retrieve the books

        return $topFavoriteBooks;
    }

    public function getReviewedBooks($user)
    {
        $userReviews = $user->reviews()->with('book')->get();

        $reviewedBooks = $userReviews->pluck('book'); // Get all the books from the reviews
        
        $reviewedBooksWithAvgRating = $reviewedBooks->map(function($book) {
            // Calculate the average rating for each book based on its reviews
            $averageRating = $book->reviews->avg('rating');  // Calculate the average of the 'rating' attribute
            
            // Add the average rating to the book object
            $book->average_rating = $averageRating;
            
            return $book;
        });

        return $reviewedBooksWithAvgRating;
    }

    public function getFavoriteBooks($user)
    {
        $favoriteBooks = $user->favoriteBooks()
                            ->orderBy('pivot_created_at', 'desc') // Order by the pivot table's created_at
                            ->take(5) // Limit to the first 5
                            ->get();

        $favoriteBooksWithAvgRating = $favoriteBooks->map(function($book) {
            $averageRating = $book->reviews->avg('rating');
            $book->average_rating = $averageRating;
            return $book;
        });

        return $favoriteBooksWithAvgRating;
    }

}