<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;


Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');


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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    
    Route::post('/logout', function () {
        auth()->logout(); // Logs out the user
        return redirect(route('landing-page'));
    })->name('logout');

    // Content loading routes
    Route::get('/home/content', [BooksController::class, 'loadBooks'])->name('home.books');
    Route::get('/dashboard/content', [BooksController::class, 'loadBooks'])->name('dashboard.books');
    
    Route::get('/books/{id}', [BooksController::class, 'show'])->name('books.show');

});
