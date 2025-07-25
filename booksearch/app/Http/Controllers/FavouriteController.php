<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    // Show all favourite books by the user
    public function index(Request $request)
    {
        $favourites = Favourite::where('user_id', $request->user()->id)
            ->with([
                'book' => function ($query) {
                    $query->withAvg('ratings', 'score'); 
                }
            ])
            ->get();

        return view('favourites', ['favourites' => $favourites]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);
    
        Favourite::firstOrCreate([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id']
        ]);
    
        return back()->with('success_message', 'Added to favourites!');
    }
    
    public function destroy(Request $request){
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        Favourite::where('user_id', $request->user()->id)
                ->where('book_id', $validated['book_id'])
                ->delete();

        return back()->with('success_message', 'Removed from favourites!');
    }
}
