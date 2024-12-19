<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function show($genre, $id)
    {
        // Retrieve the book by ID using Eloquent's find() method
        $book = Book::find($id);
    
        // If the book is not found, return 404
        if (!$book) {
            abort(404);
        }
    
        // Validate that the book belongs to the given genre
        if ($book->genre !== $genre) {
            abort(404, 'Genre mismatch');
        }
    
        // Pass the book and genre to the view
        return view('books.book-details', compact('book', 'genre'));
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

    public function loadBooks()
    {
        $posts = Book::all()->toArray(); // Convert collection to array
        // $slicedPosts = array_slice($posts, 0, 5); // Slice first 5 records
        return $posts;
    }
    

    public function browse()
    {
            return view('books.browse');
    }
    
    public function showByGenre()
    {
        $genres = Book::select('genre')->distinct()->get(); // This fetches unique genres
        
        // Group books by genre and include the average rating for each book
        $booksByGenre = [];
        foreach ($genres as $genre) {
            // Fetch books by genre and calculate the average rating
            $booksByGenre[$genre->genre] = Book::where('genre', $genre->genre)
                ->withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
                ->take(4)  // Limit to the first 4 books
            ->get();
    }
        // Return the view with both genres and books grouped by genre
        return view('books.browse', compact('booksByGenre', 'genres'));
    }

    
    public function showGenre($genre)
    {
        // Fetch books based on the genre and calculate the average rating for each book
        $booksByGenre = Book::where('genre', $genre)
            ->withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
            ->get();

            // Pass the genre and books to the view
            return view('books.show-books-by-genre', compact('booksByGenre', 'genre'));
    }


    public function showByRating()
    {
            // Fetch books based on average rating, ordered by the rating in descending order
            $booksByRating = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
                ->orderByDesc('reviews_avg_rating')  // Sort by average rating in descending order
                ->get();  // Get the books

            // Pass the books to the view
            return view('books.show-books-by-rating', compact('booksByRating'));
    }

    public function showByReleaseDate()
    {
            // Fetch the latest books based on release_date
            $latestBooks = Book::withAvg('reviews', 'rating')  // Calculate the average rating from the 'reviews' relationship
                ->orderBy('release_date', 'desc')  // Order by release_date (newest first)
                ->get();  // Get all books

            // Pass the books to the view
            return view('books.show-books-by-release', compact('latestBooks'));
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('search');

        // If a search query is provided, filter the books based on the title or author
        $books = Book::where('title', 'like', '%' . $query . '%')
                     ->orWhere('author', 'like', '%' . $query . '%')
                     ->orWhere('genre', 'LIKE', '%' . $query . '%')
                     ->withAvg('reviews', 'rating') // Fetch the average rating
                     ->get();

        // Return the search results to a view (you can customize this view)
        return view('books.search-results', compact('books'));
    }

}