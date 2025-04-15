<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BookController;

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');  

//not yet implement middleware for auth

//books CRUD
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get("createBook", [BookController::class, 'showCreateBookForm'])->name("books.createForm");
Route::post("createBook", [BookController::class, 'createBook'])->name("books.create");
Route::get("/editBook/{id}", [BookController::class, "showEditBookForm"])->name("books.editForm");
Route::post("/editBook/{id}", [BookController::class, 'editBook'])->name('books.edit');
Route::get("deleteBook/{id}", [BookController::class, "deleteBook"])->name('books.delete');


//author CRUD
Route::get("/authors", [AuthorController::class, 'index'])->name('authors.index');
Route::get("createAuthor", [AuthorController::class, 'showCreateAuthorForm']);
Route::post("createAuthor", [AuthorController::class, 'createAuthor'])->name("authors.create");
Route::get("/editAuthor/{id}", [AuthorController::class, "showEditAuthorForm"])->name("authors.editForm");
Route::post("/editAuthor/{id}", [AuthorController::class, 'editAuthor'])->name('authors.edit');
Route::get("deleteAuthor/{id}", [AuthorController::class, "deleteAuthor"])->name('authors.delete');

//delete user
Route::get("deleteBook/{id}", [BookController::class, "deleteBook"]);

//show edituser form, then main func for edit user
Route::get("editUser/{id}", [BookController::class, "showEditUserForm"]);
Route::post("editUser/{id}", [BookController::class, "editUser"]);

//delete user
// Route::get("deleteAuthor/{id}", [AuthorController::class, "deleteAuthor"]);
Route::get("deleteBook/{id}", [BookController::class, "deleteBook"]);

//show edituser form, then main func for edit user
Route::get("editUser/{id}", [BookController::class, "showEditUserForm"]);
Route::post("editUser/{id}", [BookController::class, "editUser"]);