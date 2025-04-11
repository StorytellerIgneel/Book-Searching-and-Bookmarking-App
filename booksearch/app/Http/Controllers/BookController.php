<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rating;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(){
        // Fetch all books from the database
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->paginate(24);

        // Return the books to the view
        return view('books.index', [
            'books' => $books,
        ]);
    }

    public function show(Book $book){
        $book->loadCount(['ratings', 'favourites'])
            ->loadAvg('ratings', 'score');

        // Get the authenticated user's rating for this book (if exists)
        $userRating = Auth::check() 
            ? Rating::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->value('score')
            : null;

        // Check if the book is favorited by the authenticated user
        $isFavourite = Auth::check() 
            ? Favourite::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->exists()
            : false;

        // Get similar books (example by same author)
        $similarBooks = Book::where('author_id', $book->author_id)
            ->where('id', '!=', $book->id)
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->take(4)
            ->get();

        return view('books.show', [
            'book' => $book,
            'userRating' => $userRating,
            'isFavourite' => $isFavourite,
            'similarBooks' => $similarBooks,
        ]);
    }
}
