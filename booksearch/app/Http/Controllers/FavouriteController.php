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
            ->with('book.author')
            ->get();

        return view('favourites', ['favourites' => $favourites]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);
    
        $favourite = Favourite::firstOrCreate([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id']
        ]);
    
        return back()->with('success', 'Added to favourites!');
    }
    
    public function destroy(Request $request){
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        Favourite::where('user_id', $request->user()->id)
                ->where('book_id', $validated['book_id'])
                ->delete();

        return back()->with('success', 'Removed from favourites!');
    }
}
