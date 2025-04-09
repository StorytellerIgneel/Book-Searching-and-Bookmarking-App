<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        // Fetch all authors from the database
        $authors = Author::query()
            ->with(['books' => function($query) {
                $query->withAvg('ratings', 'score')
                    ->limit(3); // Get top 3 books per author
            }])
            ->paginate(24);

        // Return the authors to the view
        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    public function show(Author $author)
    {
        // Fetch the author with their books and ratings
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->where('author_id', $author->id)
            ->withAvg('ratings', 'score')
            ->withCount('ratings')
            ->withCount('favourites')
            ->orderByDesc('ratings_avg_score')
            ->paginate(12);

        // Return the author to the view
        return view('authors.show', [
            'author' => $author,
            'books' => $books,
        ]);
    }
}
