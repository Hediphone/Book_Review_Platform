<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/', function () {
    return view('landing-page');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');