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
Route::get("createAuthor", [AuthorController::class, 'showCreateAuthorForm']);
Route::post("createAuthor", [AuthorController::class, 'createAuthor']);

Route::get("createBook", [AuthorController::class, 'showCreateBookForm']);
Route::post("createAuthor", [AuthorController::class, 'createAuthor']);

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get("/authors", [AuthorController::class, 'index'])->name('authors.index');