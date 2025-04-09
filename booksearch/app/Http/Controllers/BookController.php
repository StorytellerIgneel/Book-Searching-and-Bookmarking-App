<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        // Fetch all books from the database
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount('ratings')
            ->withAvg('ratings', 'score')
            ->withCount('favourites')
            ->paginate(24);

        // Return the books to the view
        return view('books.index', [
            'books' => $books,
        ]);
    }

    public function show(Book $book)
    {
        // Fetch the book with its author, ratings, and favourites
        $book->load(['author', 'ratings', 'favourites']);

        // Return the book to the view
        return view('books.show', [
            'book' => $book,
        ]);

    }
}
