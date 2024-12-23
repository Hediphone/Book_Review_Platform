<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showBooksDashboard(Request $request)
    {
        $books = Book::all();

        // Return the view with books data and set the active sidebar
        return view('admin-books-dashboard', [
            'activeSidebar' => 'books',
            'books' => $books
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genres' => 'required|string',
            'descriptionInput' => 'required|string',
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
        ]);

        // Handle the file upload
        if ($request->hasFile('coverImage') && $request->file('coverImage')->isValid()) {
            $image = $request->file('coverImage');

            // Define the path where the file should be stored directly in the public directory
            $destinationPath = public_path('assets\\covers');

            // Create the directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Creates directories recursively
            }

            // Move the file to the desired location
            $image->move($destinationPath, $image->getClientOriginalName());

            // Get the relative path to store in the DB
            $coverImagePath = 'assets\\covers\\' . $image->getClientOriginalName();
        }

        // Save the other data to the database along with the cover image path
        $book = new Book([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'genre' => $validatedData['genres'],
            'description' => $validatedData['descriptionInput'],
            'cover' => $coverImagePath,  // Save the image path
        ]);

        // Save the book to the database
        $book->save();

        // Redirect or return success message
        return redirect()->back()->with('success', 'Book added successfully!');
    }

    public function addBookSucess()
    {
        return view('modals.success-prompt');
    }

    public function adminBookSearch(Request $request)
    {
        $query = $request->input('search');

        // Convert the query to lowercase
        $query = strtolower($query);

        // Perform the search
        $books = Book::whereRaw('LOWER(title) like ?', ['%' . $query . '%'])
            ->orWhereRaw('LOWER(author) like ?', ['%' . $query . '%'])
            ->orWhereRaw('LOWER(genre) like ?', ['%' . $query . '%'])
            ->withAvg('reviews', 'rating')
            ->get();

        // Return the view with the search results
        return view('admin.search-results', compact('books', 'query'));
    }

    public function adminSearchByGenre(Request $request)
    {
        $genre = $request->input('genre');

        // Ensure the genre is not empty
        if (!$genre) {
            return redirect()->route('admin.books.search'); // Redirect to the search page if genre is not set
        }

        // If "All" is selected, show all books
        if ($genre == 'All') {
            $books = Book::withAvg('reviews', 'rating')->get();
        } else {
            // Use `like` to check if the genre is part of the genres stored in the database
            $books = Book::where('genre', 'like', '%' . $genre . '%')
                ->withAvg('reviews', 'rating')
                ->get();
        }

        // Check if books are found
        if ($books->isEmpty()) {
            return view('admin.search-results', ['message' => 'No books found for this genre.']);
        }

        // If it's an AJAX request, return only the table rows
        if ($request->ajax()) {
            return view('admin.search-results', compact('books'));
        }

        // Return the full results view
        return view('admin.search-results', compact('books', 'genre'));
    }

    public function edit($bookID)
    {
        Log::debug('Book ID received: ' . $bookID);

        $book = Book::findOrFail($bookID); // Find the book by ID

        return response()->json($book); // Return the book details as JSON for the front-end to use
    }

    // Update the book details
    public function update(Request $request, $bookID)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genres' => 'required|string',
            'descriptionInput' => 'required|string',
        ]);

        $book = Book::findOrFail($bookID); // Find the book to update

        // Handle the file upload if a new file is provided
        if ($request->hasFile('editCoverImage') && $request->file('editCoverImage')->isValid()) {
            $image = $request->file('editCoverImage');
            $destinationPath = public_path('assets\\covers');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $image->getClientOriginalName());
            $coverImagePath = 'assets\\covers\\' . $image->getClientOriginalName();
        } else {
            $coverImagePath = $book->cover; // Keep the existing cover if no new file is uploaded
        }

        // Update the book data
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->genre = $validatedData['genres'];
        $book->description = $validatedData['descriptionInput'];
        $book->cover = $coverImagePath; // Update the cover path

        // Save the updated book
        $book->save();

        return redirect()->back()->with('success', 'Book updated successfully!');
    }

    public function deleteBooks(Request $request)
    {
        $selectedBooks = $request->input('selectedBooks'); // Get the book IDs as a comma-separated string
        $bookIDs = explode(',', $selectedBooks); // Convert to an array

        // Perform the deletion
        Book::whereIn('bookID', $bookIDs)->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Selected book(s) have been deleted successfully.');
    }

    //USERS

    public function showUsersDashboard()
    {
        $users = User::all();

        return view('admin.admin-users-dashboard', [
            'activeSidebar' => 'users',
            'users' => $users
        ]);
    }

    public function adminUserSearch(Request $request)
    {
        $query = $request->input('search');
        $queryLower = strtolower($query ?? '');

        // Perform the search query
        $usersQuery = User::query();

        if (!empty($query)) {
            $usersQuery->whereRaw('LOWER(name) like ?', ['%' . $queryLower . '%'])
                ->orWhereRaw('LOWER(email) like ?', ['%' . $queryLower . '%'])
                ->orWhereRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") like ?', ['%' . $query . '%'])
                ->orWhereRaw('DATE_FORMAT(updated_at, "%Y-%m-%d %H:%i:%s") like ?', ['%' . $query . '%']);
        }

        $users = $usersQuery->get();

        // Check if there are no users
        $noResults = $users->isEmpty();

        // Highlight matches in the users' name and email
        foreach ($users as $user) {
            if (!empty($query)) {
                $user->highlighted_name = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $user->name
                );
                $user->highlighted_email = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $user->email
                );
                $user->highlighted_created_at = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $user->created_at->format('Y-m-d H:i:s')
                );
                $user->highlighted_updated_at = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $user->updated_at->format('Y-m-d H:i:s')
                );
            } else {
                // No highlights
                $user->highlighted_name = $user->name;
                $user->highlighted_email = $user->email;
                $user->highlighted_created_at = $user->created_at->format('Y-m-d H:i:s');
                $user->highlighted_updated_at = $user->updated_at->format('Y-m-d H:i:s');
            }
        }

        // Return the HTML for the table rows and the noResults flag
        $html = view('admin.users-search-results', compact('users', 'noResults', 'query'))->render();
        return response()->json($html);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('deleteUser', 'User has been successfully deleted!');
    }


    //REVIEWS
    public function showReviewsDashboard()
    {
        // Define an array of bad words
        $badWords = [
            'fuck',
            'shit',
            'ass',
            'bitch',
            'damn',
            'dick',
            'bastard',
            'piss',
            'crap',
            'cunt',
            'hell',
            'kike',
            'nigger',
            'slut',
            'whore',
            'kill',
            'murder',
            'bomb',
            'terrorist',
            'stab',
            'rape',
            'assault',
            'die',
            'retard',
            'moron',
            'idiot',
            'imbecile',
            'scum'
        ];

        // Fetch all reviews along with the book and user information
        $reviews = Review::with(['book', 'user'])->get();

        // Iterate through reviews and highlight bad words in comments
        foreach ($reviews as $review) {
            $review->highlighted_comment = $this->highlightBadWords($review->comment, $badWords);
        }

        return view('admin.admin-reviews-dashboard', [
            'activeSidebar' => 'reviews',
            'reviews' => $reviews
        ]);
    }

    // Helper Method to Highlight Bad Words and Wrap Entire Comment
    private function highlightBadWords($text, $badWords)
    {
        // Check if any bad word exists in the comment
        foreach ($badWords as $badWord) {
            $escapedWord = preg_quote($badWord, '/');
            // If a bad word is found, wrap the entire comment in a red container
            if (preg_match('/\b' . $escapedWord . '\b/i', $text)) {
                return '<div class="highlight-bad-comment">' . e($text) . '</div>';
            }
        }
        // If no bad word is found, return the text as is
        return e($text);
    }

    public function showNegativeComments(Request $request)
    {
        $query = Review::query();

        // Search functionality
        if ($request->has('search')) {
            $query->where('comment', 'like', '%' . $request->search . '%');
        }

        // Rating functionality
        if ($request->has('rating') && $request->rating != 'All') {
            $query->where('rating', $request->rating);
        }

        // Filter by highlighted comments if 'showNegativeComments' is set
        if ($request->has('showNegativeComments') && $request->showNegativeComments == 'true') {
            $query->where('highlighted_comment', '!=', ''); // Assuming this field holds highlighted comments
        }

        $reviews = $query->get();

        return view('admin.reviews-dashboard', compact('reviews'));
    }

    public function adminReviewSearch(Request $request)
    {
        $query = $request->input('search');
        $rating = $request->input('rating');
        $queryLower = strtolower($query ?? '');

        $reviewsQuery = Review::query();

        if (!empty($query)) {
            $reviewsQuery->whereRaw('LOWER(comment) like ?', ['%' . $queryLower . '%'])
                ->orWhereHas('book', function ($q) use ($queryLower) {
                    $q->whereRaw('LOWER(title) like ?', ['%' . $queryLower . '%']);
                })
                ->orWhereHas('user', function ($q) use ($queryLower) {
                    $q->whereRaw('LOWER(name) like ?', ['%' . $queryLower . '%']);
                })
                ->orWhereRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") like ?', ['%' . $query . '%'])
                ->orWhereRaw('DATE_FORMAT(updated_at, "%Y-%m-%d %H:%i:%s") like ?', ['%' . $query . '%']);
        }

        if (!empty($rating) && $rating !== 'All') {
            $reviewsQuery->where('rating', '=', $rating);
        }

        $reviews = $reviewsQuery->with(['book', 'user'])->get();

        // Highlight matches
        foreach ($reviews as $review) {
            if (!empty($query)) {
                $review->highlighted_comment = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $review->comment
                );
                $review->book->highlighted_title = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $review->book->title
                );
                $review->user->highlighted_name = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $review->user->name
                );
                $review->highlighted_created_at = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $review->created_at->format('Y-m-d H:i:s')
                );
                $review->highlighted_updated_at = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    $review->updated_at->format('Y-m-d H:i:s')
                );
            } else {
                // No highlights
                $review->highlighted_comment = $review->comment;
                $review->book->highlighted_title = $review->book->title;
                $review->user->highlighted_name = $review->user->name;
                $review->highlighted_created_at = $review->created_at->format('Y-m-d H:i:s');
                $review->highlighted_updated_at = $review->updated_at->format('Y-m-d H:i:s');
            }
        }

        return view('admin.reviews-search-results', [
            'reviews' => $reviews,
            'query' => $query ?? '',
            'rating' => $rating ?? 'All',
        ])->render();
    }


    public function adminDeleteReviews(Request $request)
    {

        $selectedReviews = $request->input('selectedReviews'); // Get the review IDs as a comma-separated string
        $reviewIDs = explode(',', $selectedReviews); // Convert to an array

        // Perform the deletion
        Review::whereIn('reviewID', $reviewIDs)->delete();

        return redirect()->back()->with('success', 'Selected review(s) have been deleted successfully.');
    }

    public function incrementViolation($userID)
    {
        // Retrieve the user by user_id
        $user = User::find($userID);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Increment the violations count for the user
        $user->violations += 1;

        $user->save();

        return redirect()->back()->with('violation', 'Violation count incremented successfully.');
    }
}
