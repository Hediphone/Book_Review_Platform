<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page')->middleware('logout.home');   // First



//aayuson pa mga ini
Route::get('/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/search', [BooksController::class, 'adminBookSearch'])->name('admin.books.search');
Route::get('/books/search-by-genre', [BooksController::class, 'adminSearchbyGenre'])->name('admin.books.search-by-genre');
Route::get('/modals/add-book', function () {
    return view(view: 'modals.add-book');
});

Route::get('/modals/edit-book', function () {
    return view(view: 'modals.edit-book');
});
Route::get('/admin-dash', [BooksController::class, 'index']);
// Route::get('/admin-dash', function () {
//     return view(view: 'admin-dash');
// });
// Route::post('/admin-dash', [BooksController::class, 'updateBook'])->name('books.updateBook');
Route::post('/admin-dash', [BooksController::class, 'destroySelected'])->name('books.destroySelected');


Route::get('/books/delete', function () {
    return view(view: 'modals.edit-book');
});

Route::post('/admin-dash', action: [BooksController::class, 'deleteBooks'])->name('books.delete');



Route::get('/books/{genre}/{bookId}/json', [BooksController::class, 'showDetails'])->name('books.showDetails.json');

// Route to show the edit form (AJAX request)
Route::get('/books/edit/{bookID}', action: [BooksController::class, 'edit'])->name('books.edit');

// Route to update the book details
Route::put('/books/update/{book}', [BooksController::class, 'update'])->name('books.update');


//
//ok 
Route::post('/books/add', [BooksController::class, 'store'])->name('books.add');
Route::get('/books/add', [BooksController::class, 'indexforadd'])->name('books.index');

Route::post('/books/delete', action: [BooksController::class, 'deleteBooks'])->name('books.delete');

//

// Authentication Routes (only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
});

// Authenticated Routes (for logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/contact', function () {
        return view('contact');
    });

    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    });
    
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/reviews', [ReviewController::class, 'show']);

    Route::post('/logout', function () {
        auth()->logout(); // Logs out the user
        return redirect(route('landing-page'));
    })->name('logout');

    // Content loading routes
    Route::get('/home/content', [BooksController::class, 'loadBooks'])->name('home.books');
    
    
    Route::get('/browse', [BooksController::class, 'showByGenre'])->name('books.byGenre');
    //will trigger the showByGenre method ng BookController, yung showByGenre will fetch all the genres first (parang naka group by para one instance lang per genre)
    //after that it will pass variable sa method niya tas yung unique genres nasa taas parang category (referring sa browse view)
    //then each genre naka loop siya will display the books related dun sa genre (limit 4)


    Route::get('/browse-books/{genre}', [BooksController::class, 'showGenre'])->name('books.browse.genre');
    //yung category sa browse view pag clinick yung genre it will show all the books to that genre (view rendered is show-books-by-genre)




    //Route::get('/browse-books/view-all/{genre}', [BooksController::class, 'showGenre'])->name('view-all.genre.show');
   // Route::get('/browse-books/view-all', [BooksController::class, 'viewAllGenre'])->name('view-all.genre.show');
    Route::get('/browse-books/view-all/{genre}', [BooksController::class, 'viewAllByGenre'])->name('view-all.genre.show');




    //sa browse view , since nakalimit sa 4 ang books per genre pag clinick view all maggashow lahat ng books to that genre


    Route::get('/browse/books/view-all/release-date/{genre}', [BooksController::class, 'showbyReleaseDate'])->name('view-all.latest-release.show');
    // nakabased to sa released at column sa books since latest books siya, see logic sa method niya

    Route::get('/browse/books/view-all/rating/{genre}', [BooksController::class, 'showByRating'])->name('view-all.rating.show'); //Second
// sa home ito since nandun yung popular now, naka based yun sa rating ng user, (averega rating) see logic nalang sa showbyratingmethod

    Route::get('/browse-books/book-detail/{id}', function ($id) {
        // Retrieve book details from BooksController
        $booksController = new BooksController();
        $bookDetails = $booksController->show($id);  
        
        // Retrieve reviews from ReviewController
        $reviewController = new ReviewController();
        $ratings = $reviewController->showRatings($id);  
        
        // Merge data from both controllers and pass to the view
        return view('books.book-details', array_merge($bookDetails->getData(), $ratings->getData(), ['id' => $id]));
    })->name('books.bookDetail');
    

    
    Route::post('/browse-books/{id}/reply/{review_id}', [ReviewController::class, 'addReply'])->name('reviews.reply');

    Route::post('/book/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');


    Route::put('/reviews/{reviewID}/update', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{reviewID}', [ReviewController::class, 'delete'])->name('reviews.delete');

    

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');



});