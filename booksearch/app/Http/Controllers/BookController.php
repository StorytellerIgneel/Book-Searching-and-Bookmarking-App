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
}
