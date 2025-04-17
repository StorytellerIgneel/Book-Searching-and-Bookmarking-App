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
use Illuminate\Support\Facades\Route;

// Public Routes
// Home Page
Route::get('/', HomeController::class)->name('home');

// Search
Route::get('/search', SearchController::class)->name('search');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');  

//not yet implement middleware for auth

//books CRUD
// Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/bookDetails/{id}', [BookController::class, 'showBookDetails'])->name('books.details');
Route::get("createBook", [BookController::class, 'showCreateBookForm'])->name("books.createForm");
Route::post("createBook", [BookController::class, 'createBook'])->name("books.create");
Route::get("/editBook/{id}", [BookController::class, "showEditBookForm"])->name("books.editForm");
Route::post("/editBook/{id}", [BookController::class, 'editBook'])->name('books.edit');
Route::get("deleteBook/{id}", [BookController::class, "deleteBook"])->name('books.delete');


//author CRUD
Route::get("/authors", [AuthorController::class, 'index'])->name('authors.index');
Route::get("/authorDetails/{id}", [AuthorController::class, 'showAuthorDetails'])->name('authors.details');
Route::get("createAuthor", [AuthorController::class, 'showCreateAuthorForm'])->name("authors.createForm");
Route::post("createAuthor", [AuthorController::class, 'createAuthor'])->name("authors.create");
Route::get("/editAuthor/{id}", [AuthorController::class, "showEditAuthorForm"])->name("authors.editForm");
Route::post("/editAuthor/{id}", [AuthorController::class, 'editAuthor'])->name('authors.edit');
Route::get("deleteAuthor/{id}", [AuthorController::class, "deleteAuthor"])->name('authors.delete');

//delete user
// Route::get("delete/{id}", [BookController::class, "deleteBook"]);

//show edituser form, then main func for edit user
Route::get("editUser/{id}", [BookController::class, "showEditUserForm"]);
Route::post("editUser/{id}", [BookController::class, "editUser"]);

//delete user
// Route::get("deleteAuthor/{id}", [AuthorController::class, "deleteAuthor"]);
// Route::get("deleteBook/{id}", [BookController::class, "deleteBook"]);

//show edituser form, then main func for edit user
Route::get("editUser/{id}", [BookController::class, "showEditUserForm"]);
Route::post("editUser/{id}", [BookController::class, "editUser"]);

// Author routes
Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index')->name('authors.index');
    Route::get('/authors/{author}', 'show')->name('authors.show');

    // Route::get('/authors/create', 'create')->name('authors.create');
    // Route::post('/authors', 'store')->name('authors.store');
});


// Book routes
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books.index');
    Route::get('/books/{book}', 'show')->name('books.show');

    // Route::get('/books/create', 'create')->name('books.create');
    // Route::post('/books', 'store')->name('books.store'); 
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