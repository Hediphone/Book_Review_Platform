<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); 
    }

    public function showBook($book_id)
    {
        // Dummy book data
        $books = [
            1 => [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'review' => 'A fascinating story of the Jazz Age.',
                'rating' => 5
            ],
            2 => [
                'title' => '1984',
                'author' => 'George Orwell',
                'review' => 'A dystopian novel about totalitarianism.',
                'rating' => 4
            ]
        ];

        // Check if the book exists in the dummy data
        if (!isset($books[$book_id])) {
            abort(404, 'Book not found');
        }

        // Return the view with the book details
        return view('book', ['book' => $books[$book_id]]);
    }


}


