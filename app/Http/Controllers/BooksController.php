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
        // return view('modals.add-book');
        $books = Book::all(); // Retrieve all books from the database

        return view('admin-dash', compact('books')); // Pass the books variable to the view
    }

    public function indexforadd()
    {
        return view('modals.add-book');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'synopsis' => $book->description,
            'coverImage' => asset('storage/' . $book->coverImage)
        ]);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if ($request->hasFile('coverImage')) {
        //     dd('File is being uploaded!');
        // } else {
        //     dd('No file uploaded');
        // }
        
        // return response('Entering store method');
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genres' => 'required|string',
            'descriptionInput' => 'required|string',
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
        ]);

    //     // Debug the validated data
    // dd($validatedData);

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
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function updateBook(Request $request, $bookId)
{
    // Validate and update the book
    $request->validate([
        'titleInput' => 'required|string|max:255',
        'authorInput' => 'nullable|string|max:255',
        'genresInput' => 'nullable|string|max:255',
        'descriptionInput' => 'required|string',
        'coverImage' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    $book = Book::find($bookId);

    if ($book) {
        $book->title = $request->titleInput;
        $book->author = $request->authorInput;
        $book->genre = $request->genresInput;
        $book->synopsis = $request->descriptionInput;

        // Handle file upload if a new cover image is provided
        if ($request->hasFile('coverImage')) {
            $coverPath = $request->file('coverImage')->store('covers', 'public');
            $book->cover = $coverPath;
        }

        $book->save();

        return redirect()->route('admin.books')->with('success', 'Book updated successfully!');
    }

    return back()->with('error', 'Book not found!');
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

}