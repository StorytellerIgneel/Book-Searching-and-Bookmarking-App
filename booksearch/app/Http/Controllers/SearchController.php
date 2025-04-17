<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string',
            'per_page' => 'nullable|integer',
            'bookPage' => 'nullable|integer',
            'authorPage' => 'nullable|integer',
        ]);

        $query = $request->input('query', ''); // Get the 'query' parameter from the request
        $perPage = $request->input('per_page', 12); // Get the 'per_page' value or default to 12
        $bookPage = $request->input('bookPage', 1); // Get the 'bookPage' query parameter (default to 1)
        $authorPage = $request->input('authorPage', 1); // Get the 'authorPage' query parameter (default to 1)


        // Early return if query is too short
        if (!empty($query) && strlen($query) < 3) {
            return view('search', [
                'query' => $query,
                'errorMessage' => 'Search keyword must be at least 3 characters long.'
            ]);
        }

        
        $books = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount('ratings')
            ->withAvg('ratings', 'score')
            ->withCount('favourites')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->paginate($request->input('per_page', 12), ['*'], 'bookPage');

        $authors = Author::query()
            ->where('name', 'LIKE', '%'.$query.'%')
            ->with(['books' => function($query) {
                $query->withAvg('ratings', 'score')
                      ->limit(3); // Get top 3 books per author
            }])
            ->withCount('books')
            ->paginate($request->input('per_page', 12), ['*'], 'authorPage');

        $books->appends([
            'query' => $query, 
            'bookPage' => $bookPage, 
            'authorPage' => $authorPage,
            'per_page' => $perPage
        ]);
        
        $authors->appends([
            'query' => $query, 
            'bookPage' => $bookPage, 
            'authorPage' => $authorPage,
            'per_page' => $perPage
        ]);            

        // Return the search results
        return view('search', [
            'query' => $query,
            'books' => $books,
            'authors' => $authors,
        ]);
    }
}
