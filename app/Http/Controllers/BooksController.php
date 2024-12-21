<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Log;


class BooksController extends Controller
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
    public function show($id)
    {
        $book = Book::find($id);
    
        // If the book is not found
        if (!$book) {
            abort(404);
        }
    
        // Split the genre string into an array to handle multiple genres
        $bookGenres = explode(',', $book->genre);  // Split the stored genre string into an array
    
        return view('books.book-details', compact('book', 'bookGenres'));  // Pass both the book and its genres
    }
    

     /**
     * Show books ordered by rating.
     */
    public function showByRating()
    {
        $booksByRating = Book::withAvg('reviews', 'rating') // Calculate average rating
            ->orderByDesc('reviews_avg_rating') // Order by rating
            ->get();

        return view('books.show-books-by-rating', compact('booksByRating'));
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

    /**
     * Load all books as an array.
     */
    public function loadBooks()
    {
        return Book::all()->toArray(); // Convert collection to array
    }

    /**
     * Show the browse page.
     */
    public function browse()
    {
        return view('books.browse');
    }

    /**
     * Show books grouped by genre with average ratings.
     */

     public function showByGenre()
     {
         // Fetch unique genres
         $genres = Book::select('genre')->distinct()->get();
         $booksByGenre = [];

         Log::debug('Unique genres fetched', ['Genres' => $genres->pluck('genre')->toArray()]);

     
         foreach ($genres as $genre) {
             // Split genre string by comma to handle multiple genres per book
             $genreList = explode(',', $genre->genre);
     
             foreach ($genreList as $singleGenre) {
                 $trimmedGenre = trim($singleGenre);

                 if (empty($trimmedGenre)) {
                    Log::warning('Skipping empty genre', ['RawGenre' => $genre->genre]);
                    continue;
                }

                 Log::debug('Individual genre processed', ['TrimmedGenre' => $trimmedGenre]);

                 // Fetch books by genre with a limit of 4, using LIKE for a flexible match
                 $books = Book::where('genre', 'like', '%' . $trimmedGenre . '%')
                     ->withAvg('reviews', 'rating') // Calculate average rating
                     ->take(4) // Limit to 4 books
                     ->get(); // Eloquent Collection
     
     
                 // Ensure it doesn't overwrite if books already exist
                 if (!isset($booksByGenre[$trimmedGenre])) {
                     $booksByGenre[$trimmedGenre] = $books;
                 } else {
                     // Append books to existing genre array without exceeding the limit of 4
                     $booksByGenre[$trimmedGenre] = $booksByGenre[$trimmedGenre]->merge($books)->take(4);
                 }
             }
         }


         return view('books.browse', compact('booksByGenre', 'genres'));
     }
     
    /**
     * Show books for a specific genre with average ratings.
     */



     public function showGenre($genre)
     {
         // Log the requested genre for debugging
         Log::debug('Requested Genre:', ['genre' => $genre]);
     
         // Split the genre into an array if it's a comma-separated list
         $genreList = explode(',', $genre);
     
         // Log the split genre list for debugging
         Log::debug('Genre List:', ['genreList' => $genreList]);
     
         // Fetch books where the genre matches any in the list
         $booksByGenre = Book::where(function($query) use ($genreList) {
             foreach ($genreList as $singleGenre) {
                 // Use "like" for partial matching, you may adjust it as needed
                 $query->orWhere('genre', 'like', '%' . trim($singleGenre) . '%');
             }
         })
         ->withAvg('reviews', 'rating') // Calculate average rating
         ->get();
     
     
         // Return the view with books matching the genres
         return view('books.show-books-by-genre', compact('booksByGenre', 'genre'));

        
     }

     public function viewAllByGenre($genre)
     {
         // Sanitize the genre input
         $genre = trim($genre);
      
         Log::info('Genre being passed to viewAllByGenre:', ['genre' => $genre]);

         // Fetch all books based on the genre
         $booksByGenre = Book::where('genre', 'like', '%' . $genre . '%')
             ->withAvg('reviews', 'rating') // Calculate average rating
             ->get();
      
         // Return the view with the books
         return view('books.show-books-by-genre', compact('booksByGenre', 'genre'));
     }



    /**
     * Show latest books ordered by release date.
     */
    public function showByReleaseDate()
    {
        $latestBooks = Book::withAvg('reviews', 'rating') // Calculate average rating
            ->orderBy('release_date', 'desc') // Order by release date
            ->get();

        return view('books.show-books-by-release', compact('latestBooks'));
    }

    /**
     * Search books based on the query.
     */public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Convert the query to lowercase
        $query = strtolower($query);
        
        // Perform a case-insensitive search on title, author, and genre
        $books = Book::whereRaw('LOWER(title) like ?', ['%' . $query . '%'])
            ->orWhereRaw('LOWER(author) like ?', ['%' . $query . '%'])
            ->orWhereRaw('LOWER(genre) like ?', ['%' . $query . '%'])
            ->withAvg('reviews', 'rating') // Fetch average rating
            ->get();
        
        // Return the results view and pass the books
        return view('books.search-results', compact('books', 'query'));
    }

    
}