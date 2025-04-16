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
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->paginate(24);

        return view('books.index', [
            'books' => $books,
        ]);
    }

    public function show(Request $request, Book $book){
        //Cookie for recently browsed books
        $recentlyBrowsedIds = $request->cookie('recently_browsed') 
        ? json_decode($request->cookie('recently_browsed'), true) 
        : [];

        $updatedIds = $this->updateRecentlyBrowsed($book->id, $recentlyBrowsedIds);

        $book->loadCount(['ratings', 'favourites'])
            ->loadAvg('ratings', 'score');

        $userRating = Auth::check() 
            ? Rating::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->value('score')
            : null;

        $isFavourite = Auth::check() 
            ? Favourite::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->exists()
            : false;

        $similarBooks = Book::where('author_id', $book->author_id)
            ->where('id', '!=', $book->id)
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->take(4)
            ->get();

        return response()->view('books.show', [
            'book' => $book,
            'userRating' => $userRating,
            'isFavourite' => $isFavourite,
            'similarBooks' => $similarBooks,
        ])->cookie('recently_browsed', json_encode($updatedIds), 60 * 24 * 30);
    }

    private function updateRecentlyBrowsed($bookId, $currentIds){
        $currentIds = array_diff($currentIds, [$bookId]);
        array_unshift($currentIds, $bookId);
        return array_slice($currentIds, 0, 10);
    }
}
