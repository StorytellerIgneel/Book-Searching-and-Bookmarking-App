<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function __invoke(Request $request){
        // Best Rating
        $bestRated = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->having('ratings_avg_score', '>', 3)
            ->having('ratings_count', '>', 3)
            ->orderByDesc('ratings_avg_score')
            ->orderByDesc('ratings_count')
            ->take(15)
            ->get();

        // Most Popular (Most favourites)
        $mostPopular = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->orderByDesc('favourites_count')
            ->orderByDesc('ratings_avg_score')
            ->having('favourites_count', '>=', 5)
            ->take(15)
            ->get();

        // Recently Added book
        $recentlyAdded = Book::query()
            ->with(['author', 'ratings', 'favourites'])
            ->withCount(['ratings', 'favourites'])
            ->withAvg('ratings', 'score')
            ->where('created_at', '>=', now()->subMonths(3))
            ->orderByDesc('created_at')
            ->take(15)
            ->get();

        // Recently browsed
        // Using cookies to store the recently browsed books
        $recentlyBrowsedIds = $request->cookie('recently_browsed') 
            ? json_decode($request->cookie('recently_browsed'), true) 
            : [];
        
        $recentlyBrowsed = count($recentlyBrowsedIds)
            ? Book::with(['author'])
                ->whereIn('id', $recentlyBrowsedIds)
                ->with(['author', 'ratings', 'favourites'])
                ->withCount(['ratings', 'favourites'])
                ->withAvg('ratings', 'score')
                ->orderByRaw('FIELD(id, '.implode(',', $recentlyBrowsedIds).')')
                ->take(6)
                ->get()
            : collect();
        
        $data = [
            'bestRated' => $bestRated,
            'mostPopular' => $mostPopular,
            'recentlyAdded' => $recentlyAdded,
            'recentlyBrowsed' => $recentlyBrowsed,
        ];

        return view('home', $data);
    }
}
