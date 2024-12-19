<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\Reply;
use Illuminate\Support\Facades\Log;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function showRatings($genre, $id)
    {
        // Retrieve the book and its genre
        $book = Book::find($id);
        $bookGenre = $book ? $book->genre : 'Unknown'; // Default to 'Unknown' if the book is not found
    
        // Retrieve all reviews for the specified book
        $reviews = Review::where('bookID', $id)
                         ->with('replies') // Load replies for each review
                         ->get();
    
        // Retrieve all ratings for the specified book
        $ratings = Review::where('bookID', $id)->pluck('rating');
    
        // Calculate the average rating
        $averageRating = $ratings->avg();
        
        // Count total number of reviews
        $totalReviews = $ratings->count();
        
        // Prepare an array to hold the star percentages
        $starRatings = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $ratings->filter(fn($rating) => $rating == $i)->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $starRatings[$i] = round($percentage, 1);
        }
    
        // Pass data to the view
        return view('books.book-details', compact('reviews', 'starRatings', 'totalReviews', 'averageRating', 'bookGenre'));
    }
    
    
   





    public function addReply(Request $request, $genre, $id, $review_id)
    {
        // Validate the reply content
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
        // Find the parent review
        $review = Review::findOrFail($review_id);
    
        // Create a new reply
        $reply = new Reply();
        $reply->user_id = auth()->id();  // Assuming the user is logged in
        $reply->review_id = $review->reviewID; // Link to the parent review
        $reply->comment = $request->comment;
        $reply->save();
    
        // Redirect back to the book details page with the genre and book id
        return redirect()->route('books.bookDetail', ['genre' => $genre, 'id' => $id]);
    }
    

    public function store(Request $request, $book_id)
    {
        // Validate the input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        
        // Create a new review
        $review = new Review();
        $review->userID = auth()->id();  // Correct column name (userID)
        $review->bookID = $book_id;  // Correct column name (bookID)
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        
        // Get the genre for the book (if available)
        $book = Book::find($book_id);
        $genre = $book ? $book->genre : ''; // Assuming the book has a 'genre' field
        
        // Redirect to the book's details page with genre and id
        return redirect()->route('books.bookDetail', ['genre' => $genre, 'id' => $book_id])
                         ->with('success', 'Your review has been submitted!');
    }
    
    

        

    }
