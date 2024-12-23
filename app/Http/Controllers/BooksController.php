<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class BooksController extends Controller
{

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            abort(404);
        }

        // Split the genre string into an array to handle multiple genres
        $bookGenres = explode(',', $book->genre);  // Split the stored genre string into an array

        return view('books.book-details', compact('book', 'bookGenres'));
    }


    public function showByRating()
    {
        $booksByRating = Book::withAvg('reviews', 'rating') // Calculate average rating
            ->orderByDesc('reviews_avg_rating') // Order by rating
            ->get();

        return view('books.show-books-by-rating', compact('booksByRating'));
    }


    public function showBookDetail($id)
    {
        // Retrieve book details from BooksController
        $bookDetails = $this->show($id);

        // Retrieve reviews from ReviewController
        $reviewController = new ReviewController();
        $ratings = $reviewController->showRatings($id);

        // Retrieve recommended books
        $recommendedBooks = $this->recommendBooks($id)->take(4)->toArray();  // Convert to array and limit to 4 books


        return view('books.book-details', array_merge(
            $bookDetails->getData(),  // Pass book details as array
            $ratings->getData(),  // Pass ratings as array
            ['id' => $id],  // Pass the book id
            ['recommendedBooks' => $recommendedBooks]  // Pass recommended books as array
        ));
    }


    public function recommendBooks($bookId)
    {
        // Fetch the current book details
        $currentBook = Book::findOrFail($bookId);

        // Split the genres of the current book
        $currentGenres = explode(',', $currentBook->genre);
        $currentGenres = array_map('trim', $currentGenres);

        $recommendedBooks = collect();

        foreach ($currentGenres as $genre) {
            if (empty($genre))
                continue;

            // Fetch books matching the genre, excluding the current book
            $books = Book::where('bookID', '!=', $bookId)
                ->where('genre', 'like', '%' . $genre . '%')
                ->withAvg('reviews', 'rating') // Include average rating
                ->take(4) // Limit recommendations per genre
                ->get();

            $recommendedBooks = $recommendedBooks->merge($books)->unique('id');
        }

        return $recommendedBooks;
    }


    public function loadBooks()
    {
        return Book::all()->toArray(); // Convert collection to array
    }


    public function browse()
    {
        return view('books.browse');
    }


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

                $books = Book::where('genre', 'like', '%' . $trimmedGenre . '%')
                    ->withAvg('reviews', 'rating') // Calculate average rating
                    ->take(4) // Limit to 4 books
                    ->get(); // Eloquent Collection


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

    public function showGenre($genre)
    {
        Log::debug('Requested Genre:', ['genre' => $genre]);

        $genreList = explode(',', $genre);

        Log::debug('Genre List:', ['genreList' => $genreList]);

        $booksByGenre = Book::where(function ($query) use ($genreList) {
            foreach ($genreList as $singleGenre) {
                // Use "like" for partial matching, you may adjust it as needed
                $query->orWhere('genre', 'like', '%' . trim($singleGenre) . '%');
            }
        })
            ->withAvg('reviews', 'rating') // Calculate average rating
            ->get();
        return view('books.show-books-by-genre', compact('booksByGenre', 'genre'));
    }

    public function viewAllByGenre($genre)
    {
        $genre = trim($genre);

        Log::info('Genre being passed to viewAllByGenre:', ['genre' => $genre]);

        $booksByGenre = Book::where('genre', 'like', '%' . $genre . '%')
            ->withAvg('reviews', 'rating') // Calculate average rating
            ->get();

        return view('books.show-books-by-genre', compact('booksByGenre', 'genre'));
    }

    public function showByReleaseDate()
    {
        $latestBooks = Book::withAvg('reviews', 'rating') // Calculate average rating
            ->orderBy('release_date', 'desc') // Order by release date
            ->get();

        return view('books.show-books-by-release', compact('latestBooks'));
    }

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

    public function toggleFavorite($bookID)
    {
        $user = Auth::user();
        $book = Book::findOrFail($bookID);

        // Log the action of toggling favorite for the given book
        Log::info('User ' . $user->id . ' is toggling favorite for Book ' . $book->bookID);

        // Check if the user already has this book in their favorites
        if ($user->favoriteBooks->contains($book->bookID)) {
            // Log the removal of the book from favorites
            Log::info('User ' . $user->id . ' is removing Book ' . $book->bookID . ' from favorites.');
            $user->favoriteBooks()->detach($book->bookID); // Remove the book from favorites
        } else {
            // Log the addition of the book to favorites
            Log::info('User ' . $user->id . ' is adding Book ' . $book->bookID . ' to favorites.');
            $user->favoriteBooks()->attach($book->bookID); // Add the book to favorites
        }

        // Log the result of the action (after adding/removing the book)
        Log::info('Favorite status for Book ' . $book->bookID . ' has been toggled by User ' . $user->id);

        return redirect()->back(); // Redirect back to the previous page after the action
    }
}