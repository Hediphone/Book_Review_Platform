<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Middleware\LogOutOnLandingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-books-dashboard', [AdminController::class, 'showBooksDashboard'])->name('admin.books.dashboard');


Route::get('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
Route::delete('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::post('/admin/review/{userID}/violation', [AdminController::class, 'incrementViolation'])->name('admin.reviews.violation');

Route::get('/admin/users/search', [AdminController::class, 'adminUserSearch'])->name('admin.users.search');
Route::get('/admin/reviews/search', [AdminController::class, 'adminReviewSearch'])->name('admin.reviews.search');
Route::post('/admin/reviews/delete', [AdminController::class, 'adminDeleteReviews'])->name('admin.reviews.delete');

Route::get('/admin/admin-users-dashboard', [AdminController::class, 'showUsersDashboard'])->name('admin.users.dashboard');
Route::get('/admin/admin-reviews-dashboard', [AdminController::class, 'showReviewsDashboard'])->name('admin.reviews.dashboard');

// Route for searching by title
Route::get('/admin/books/search', [AdminController::class, 'adminBookSearch'])->name('admin.books.search');

// Route for searching by genre
Route::get('/admin/books/search/genre', [AdminController::class, 'adminSearchByGenre'])->name(name: 'adminSearchByGenre');

// Route to show the edit form (AJAX request)
Route::get('/books/edit/{bookID}', action: [AdminController::class, 'edit'])->name('books.edit');

// Route to update the book details
Route::put('/books/update/{book}', [AdminController::class, 'update'])->name('books.update');

//ok 
Route::post('/books/add', [AdminController::class, 'store'])->name('books.add');
Route::get('/books/add', [AdminController::class, 'addBookSucess'])->name('books.index');
Route::post('/books/delete', action: [AdminController::class, 'deleteBooks'])->name('books.delete');
});

// Route for searching books (users)
Route::get('/search', [BooksController::class, 'search'])->name('books.search');


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

    Route::get('/browse-books/view-all/{genre}', [BooksController::class, 'viewAllByGenre'])->name('view-all.genre.show');

    Route::get('/browse/books/view-all/release-date/{genre}', [BooksController::class, 'showbyReleaseDate'])->name('view-all.latest-release.show');
    // nakabased to sa released at column sa books since latest books siya, see logic sa method niya

    Route::get('/browse/books/view-all/rating/{genre}', [BooksController::class, 'showByRating'])->name('view-all.rating.show'); //Second
    
    Route::get('/browse-books/book-detail/{id}', [BooksController::class, 'showBookDetail'])->name('books.bookDetail');

    Route::post('/browse-books/{id}/reply/{review_id}', [ReviewController::class, 'addReply'])->name('reviews.reply');

    Route::post('/book/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');

    Route::put('/reviews/{reviewID}/update', [ReviewController::class, 'update'])->name('reviews.update');

    Route::delete('/reviews/{reviewID}', [ReviewController::class, 'delete'])->name('reviews.delete');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

    Route::post('/favorite/{bookId}/toggle', [BooksController::class, 'toggleFavorite'])->name('favorite.toggle');


});