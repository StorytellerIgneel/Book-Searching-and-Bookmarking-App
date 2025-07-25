<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'score' => ['required', 'integer', 'between:0,5'],
        ]);
        
        // Handle rating removal is score is 0
        if ($validated['score'] == 0) {
            return $this->destroy($request);
        }

        // Update or create the rating
        Rating::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'book_id' => $validated['book_id']
            ],
            ['score' => $validated['score']]
        );

        return back()->with('success_message', 'Rating saved successfully!');
    }

    public function destroy(Request $request){
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        Rating::where([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id']
        ])->delete();

        return back()->with('success_message', 'Rating removed successfully!');
    }
}
