<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|between:1,5',
        ]);

        $rating = Rating::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'book_id' => $validated['book_id']
            ],
            ['rating' => $validated['rating']]
        );

        return back()->with('success', 'Rating saved successfully!');
    }

    public function destroy(Request $request){
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        Rating::where('user_id', request()->user()->id)
                ->where('book_id', $validated['book_id'])
                ->delete();

        return back()->with('success', 'Rating removed successfully!');
    }
}
