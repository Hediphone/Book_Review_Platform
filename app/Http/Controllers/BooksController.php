<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

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
        $posts = $this->loadBooks();

        $book = collect($posts)->firstWhere('id', $id);

        if (!$book) {
            abort(404);
        }

        return view('book-details', compact('book'));
        
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

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('search');

        // If a search query is provided, filter the books based on the title or author
        $books = Book::where('title', 'like', '%' . $query . '%')
                     ->orWhere('author', 'like', '%' . $query . '%')
                     ->orWhere('genre', 'LIKE', '%' . $query . '%')
                     ->get();

        // Return the search results to a view (you can customize this view)
        return view('search-results', compact('books'));
    }

}
