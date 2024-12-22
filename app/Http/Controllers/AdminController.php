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

}
