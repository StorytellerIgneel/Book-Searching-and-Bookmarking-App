<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');  

// Search
Route::get('/search', SearchController::class)->name('search');

// Author routes
Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index')->name('authors.index');
    Route::get('/authors/{author}', 'show')->name('authors.show');
});


// Book routes
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books.index');
    Route::get('/books/{book}', 'show')->name('books.show');
});

// Ratings and favourites
Route::middleware(['auth'])->group(function () {
    // Rating routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('/favourites', [RatingController::class, 'destroy'])->name('ratings.destroy');

    // Favourite routes
    Route::post('/favourites', [FavouriteController::class, 'store'])->name('favourites.store');
    Route::delete('/favourites', [FavouriteController::class, 'destroy'])->name('favourites.destroy');
});