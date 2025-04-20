<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', HomeController::class)->name('home');

// Search
Route::get('/search', SearchController::class)->name('search');

//User Management route
Route::get('/users', [AdminUserController::class, 'viewUsers'])->name('users.index');
Route::patch('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])
    ->name('users.toggle-admin');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');  

// Book routes
Route::controller(BookController::class)->group(function () {
    // GET
    Route::get('/books', 'index')->name('books.index'); 
    Route::get('/books/create', 'create')->name('books.create');
    Route::get('/books/{book}', 'show')->name('books.show');
    Route::get('/books/{book}/edit', 'edit')->name('books.edit');

    // WRITE 
    Route::post('/books', 'store')->name('books.store'); 
    Route::put("/books/{book}", 'update')->name('books.update');
    Route::delete("/books/{book}", "destroy")->name('books.destroy');
});

// Author routes
Route::controller(AuthorController::class)->group(function () {
    // GET
    Route::get('/authors', 'index')->name('authors.index');
    Route::get('/authors/create', 'create')->name('authors.create');
    Route::get('/authors/{author}', 'show')->name('authors.show');
    Route::get("/authors/{author}/edit", "edit")->name("authors.edit");

    // WRITE
    Route::post('/authors', 'store')->name('authors.store');
    Route::put("/authors/{author}", 'update')->name('authors.update');
    Route::delete("/authors/{author}", "destroy")->name('authors.destroy');
});

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rating routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

    // Favourite routes
    Route::post('/favourites', [FavouriteController::class, 'store'])->name('favourites.store');
    Route::delete('/favourites', [FavouriteController::class, 'destroy'])->name('favourites.destroy');
    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites.index');
});