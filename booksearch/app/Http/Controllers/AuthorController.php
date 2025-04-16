<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::query()
            ->with(['books' => function($query) {
                $query->withAvg('ratings', 'score')
                    ->limit(3); 
            }])
            ->withCount('books')
            ->paginate(24);

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    public function show(Author $author){
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->where('author_id', $author->id)
            ->withAvg('ratings', 'score')
            ->withCount(['ratings', 'favourites'])
            ->orderByDesc('ratings_avg_score')
            ->paginate(12);

        return view('authors.show', [
            'author' => $author,
            'books' => $books,
        ]);
    }
}
