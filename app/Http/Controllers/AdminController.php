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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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

    public function showBooksDashboard(Request $request)
    {
        // Check if the logged-in user is authenticated
        // if (auth()->check()) {
        //     $user = auth()->user();

        //     // Verify that the user is an admin and password is correct (if needed)
        //     // Replace with your actual check for the admin
        //     if ($user->email == 'admin@example.com') {
        //         // Fetch all books
        $books = Book::all();

        // Return the view with books data and set the active sidebar
        return view('admin-books-dashboard', [
            'activeSidebar' => 'books',
            'books' => $books
        ]);
        //     } else {
        //         // If the user is not an admin, redirect them to home page
        //         return redirect('/home');
        //     }
        // } else {
        //     // If the user is not authenticated, redirect to login page
        //     return redirect('/login');
        // }
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

        // Set the session message
        return redirect()->back()->with('deleteUser', 'User has been successfully deleted!');
    }


    //REVIEWS
    public function showReviewsDashboard()
    {
        // Define an array of bad words
        $badWords = [
            'unique',
            'deeply ',
            'offensiveword1',
            'offensiveword2'  // Add your list of bad words here
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

        // Redirect or return a response
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

        // Save the updated user record
        $user->save();

        // Return a JSON response indicating success
        return redirect()->back()->with('violation', 'Violation count incremented successfully.');
    }



















}
