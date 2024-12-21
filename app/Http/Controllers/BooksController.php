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
        // return view('modals.add-book');
        $books = Book::all(); // Retrieve all books from the database

        return view('/admin-dash', compact('books')); // Pass the books variable to the view
    }

    public function indexforadd()
    {
        return view('modals.success-prompt');
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
    // public function store(Request $request)
    // {
    //     //
    // }

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
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

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
        $booksByGenre = Book::where(function ($query) use ($genreList) {
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
     */
    public function search(Request $request)
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

    public function adminBookSearch(Request $request)
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

        // If it's an AJAX request, return only the table rows
        if ($request->ajax()) {
            return view('admin.search-results', compact('books'));
        }

        // Return the full results view
        return view('admin.search-results', compact('books', 'query'));
    }

    public function adminSearchbyGenre(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('genre') && $request->genre !== 'All') {
            $query->where('genre', $request->genre);
        }

        $books = $query->get();

        return view('admin.search-results', compact('books'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBooks(Request $request)
    {
        $selectedBooks = $request->input('selectedBooks'); // Get the book IDs as a comma-separated string
        $bookIDs = explode(',', $selectedBooks); // Convert to an array

        // Perform the deletion
        Book::whereIn('bookID', $bookIDs)->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Selected books have been deleted successfully.');
    }


    public function showDetails($genre, $id)
    {
        // Retrieve the book by ID using Eloquent's find() method
        $book = Book::find($id);
        // If the book is not found or genre mismatches, return error
        if (!$book || $book->genre !== $genre) {
            return response()->json(['error' => 'Book not found or genre mismatch'], 404);
        }
        // Return book details as JSON
        return response()->json([
            'title' => $book->title,
            'author' => $book->author,
            'genre' => $book->genre,
            'description' => $book->description,
            'cover' => $book->cover
        ]);
    }

    public function getBookDetails($bookID)
    {
        $book = Book::find($bookID);
        if ($book) {
            return response()->json([
                'bookID' => $book->bookID,
                'cover' => $book->cover,
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'description' => $book->description,
            ]);
        }
        return response()->json(null); // Return null if book not found
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

        dd($request->file('editCoverImage'));


        // $book = Book::findOrFail($bookID); // Find the book to update

        // // Handle the file upload if a new file is provided
        // if ($request->hasFile('editCoverImage') && $request->file('editCoverImage')->isValid()) {
        //     $image = $request->file('editCoverImage');
        //     $destinationPath = public_path('assets\\covers');

        //     if (!file_exists($destinationPath)) {
        //         mkdir($destinationPath, 0777, true);
        //     }

        //     $image->move($destinationPath, $image->getClientOriginalName());
        //     $coverImagePath = 'assets\\covers\\' . $image->getClientOriginalName();
        // } else {
        //     $coverImagePath = $book->cover; // Keep the existing cover if no new file is uploaded
        // }




        // // Update the book data
        // $book->title = $validatedData['title'];
        // $book->author = $validatedData['author'];
        // $book->genre = $validatedData['genres'];
        // $book->description = $validatedData['descriptionInput'];
        // $book->cover = $coverImagePath; // Update the cover path

        // // Save the updated book
        // $book->save();

        // return redirect()->back()->with('success', 'Book updated successfully!');
    }


    public function getBookData($bookID)
    {
        // Retrieve the book data from the database by bookID
        $book = Book::find($bookID);

        // Check if the book exists
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        // Return the book data as a JSON response
        return response()->json([
            'bookID' => $book->bookID,
            'title' => $book->title,
            'author' => $book->author,
            'genre' => $book->genre,
            'cover' => $book->cover,
            'description' => $book->description,
        ]);
    }

}