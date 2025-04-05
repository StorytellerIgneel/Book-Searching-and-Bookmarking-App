<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string',
            'type' => 'nullable|string',
            'per_page' => 'nullable|integer',
        ]);

        $query = $request->input('query', '');
        
        // Early return if query is too short
        if (!empty($query) && strlen($query) < 3) {
            return view('search', [
                'query' => $query,
                'errorMessage' => 'Search keyword must be at least 3 characters long.'
            ]);
        }

        $books = Book::query()
            ->with(['author', 'ratings'])
            ->where('name', 'LIKE', '%'.$query.'%')
            ->where('summary', 'LIKE', '%'.$query.'%')
            ->get();

        // $books = $books->map(function ($book) {
        //     return $book->only(['id', 'name', 'summary']);
        // });
        // dd($books);

        // Return the search results
        return view('search', [
            'query' => $query,
            'books' => $books,
        ]);
    }
}
