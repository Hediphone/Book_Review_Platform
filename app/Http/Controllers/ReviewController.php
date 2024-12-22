<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\Reply;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



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
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function showRatings($id)
    {
        $book = Book::find($id);
        
        $bookGenre = $book ? $book->genre : 'Unknown';
        
        $bookGenres = explode(',', $bookGenre); // Split the genres into an array
        
        $reviews = Review::where('bookID', $id)
                         ->with('replies') // Load replies for each review
                         ->get();
        
        $ratings = Review::where('bookID', $id)->pluck('rating');
        
        $averageRating = $ratings->avg();
        
        $totalReviews = $ratings->count();
        
        $starRatings = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $ratings->filter(fn($rating) => $rating == $i)->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $starRatings[$i] = round($percentage, 1);
        }
        
        return view('books.book-details', compact('reviews', 'starRatings', 'totalReviews', 'averageRating', 'bookGenres'));
    }
    
    
    
    public function addReply(Request $request, $id, $review_id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
        $review = Review::findOrFail($review_id);
    
        $reply = new Reply();
        $reply->user_id = auth()->id();  // Assuming the user is logged in
        $reply->review_id = $review->reviewID; // Link to the parent review
        $reply->comment = $request->comment;
        $reply->save();
    
        return redirect()->route('books.bookDetail', ['id' => $id]);
    }
    
    


    public function store(Request $request, $book_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        
        $existingReview = Review::where('userID', auth()->id())
                                ->where('bookID', $book_id)
                                ->first();

        if ($existingReview) {
            return redirect()->route('books.bookDetail', ['genre' => $existingReview->book->genre, 'id' => $book_id])
                            ->with('error_title', 'Add Review Error')
                            ->with('error_message', 'You can only submit one review per book.');
        }

        $review = new Review();
        $review->userID = auth()->id();  // Correct column name (userID)
        $review->bookID = $book_id;  // Correct column name (bookID)
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        
        $book = Book::find($book_id);
        $genre = $book ? $book->genre : ''; // Assuming the book has a 'genre' field
        
        return redirect()->route('books.bookDetail', ['genre' => $genre, 'id' => $book_id])
                        ->with('error_title', 'Review Submitted')
                        ->with('error_message', 'Your review has been submitted!');
    }
                     


    public function update(Request $request, $reviewID)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($reviewID);

        if ($review->userID !== Auth::id()) {
            return redirect()->route('books.show', $review->bookID)->with('error', 'You are not authorized to edit this review.');
        }

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $book = Book::find($review->bookID);
        $genre = $book ? $book->genre : ''; // Assuming the book has a 'genre' field

        return redirect()->route('books.bookDetail', ['genre' => $genre, 'id' => $review->bookID])
                        ->with('error_title', 'Review Updated')
                        ->with('error_message', 'Your review has been updated.');
        
    }


    public function delete($reviewID)
    {
        $review = Review::findOrFail($reviewID);

        if ($review->userID !== Auth::id()) {
            return redirect()->route('books.show', $review->bookID)->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        $book = Book::find($review->bookID);
        $genre = $book ? $book->genre : ''; // Assuming the book has a 'genre' field

        return redirect()->route('books.bookDetail', ['genre' => $genre, 'id' => $review->bookID])
                        ->with('success', 'Review deleted successfully.')
                        ->with('error_title', 'Review Deleted Succesfully')
                        ->with('error_message', 'Your review has been removed succesfully.');
        
    }


}
