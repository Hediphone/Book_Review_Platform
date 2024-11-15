<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('landing-page');


// Authentication Routes (only for guests)
Route::middleware('guest')->group(function() {
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "registerPost"])->name("register.post");
});

// Authenticated Routes (for logged-in users)
Route::middleware('auth')->group(function() {
    Route::get('/contact', function () {
        return view('contact');
    });
    
    Route::get('/home', function () {
        return view('home');
    });
    Route::get('/dashboard', action: [DashboardController::class, 'index'])->name('dashboard.show');

    Route::get('/dashboard/book/{book_id}', [DashboardController::class, 'showBook']);

    Route::post('/logout', function () { // Logout Route
        Auth::logout();  // Logs out the user
        return redirect(route("landing-page"));  
    })->name('logout');

});