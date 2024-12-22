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

    public function showUsersDashboard()
    {
        $users = User::all();

        return view('admin.admin-users-dashboard', [
            'activeSidebar' => 'users',
            'users' => $users
        ]);
    }

    public function showReviewsDashboard()
    {
        // Fetch all reviews along with the book and user information
        $reviews = Review::with(['book', 'user'])->get();

        return view('admin.admin-reviews-dashboard', [
            'activeSidebar' => 'reviews',
            'reviews' => $reviews
        ]);
    }

    public function adminUserSearch(Request $request)
    {
        $query = $request->input('search');
        $query = strtolower($query);

        // Parse the query to check if it's a valid date
        $isDate = false;
        try {
            $parsedDate = date('Y-m-d', strtotime($query)); // Convert to Y-m-d format
            $isDate = true;
        } catch (\Exception $e) {
            $isDate = false;
        }

        // Perform the search
        $users = User::whereRaw('LOWER(name) like ?', ['%' . $query . '%'])
            ->orWhereRaw('LOWER(email) like ?', ['%' . $query . '%']);

        if ($isDate) {
            $users = $users->orWhereDate('created_at', $parsedDate)
                ->orWhereDate('updated_at', $parsedDate);
        }

        $users = $users->get();

        // Return the HTML for the table rows as a response
        $html = view('admin.users-search-results', compact('users'))->render();
        return response()->json($html);
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















}
