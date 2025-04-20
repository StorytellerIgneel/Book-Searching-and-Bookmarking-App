<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    use AuthorizesRequests;

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

    public function create(){
        $this->authorize('create', Book::class);
        return view('books.create');
    }
    
    public function store(Request $request){
        $this->authorize('create', Book::class);

        $validated = $request->validate([
            "title" => "required|string|max:191|unique:books",
            "synopsis" => "required|string|max:1000",
            "cover"=> ["required", File::image()->min('1kb')->max('10mb'),
                Rule::dimensions()->maxHeight(4000)->maxWidth(4000),
            ],
            "author_id" => "required|integer|exists:authors,id"
        ]);

        $imageUrl = 'storage/' . $request->file("cover")->store("images/book_covers", "public");

        //store book data mass assignmebt
        $book = Book::create([
                "title" => $validated['title'],
                "synopsis" => $validated['synopsis'],
                "cover_image_link" => $imageUrl,
                "author_id" => $validated['author_id'],
        ]);

        return redirect()->route('books.show', $book)->with("success_message", "Book created successfully");
    }

    public function edit(Book $book){
        $this->authorize('update', $book);

        return view("books.edit", ["book" => $book]);
    }

    public function update(Book $book, Request $request){
        $this->authorize('update', $book);

        $validated = $request->validate([
            "title" => ["required", "string", "max:191", 
                Rule::unique('books')->ignore($book->id)],
            "synopsis" => "required|string|max:1000",
            "author_id" => "required|integer|exists:authors,id",
            "cover" => ["nullable", 
                File::image()->min('1kb')->max('10mb'),
                Rule::dimensions()->maxHeight(4000)->maxWidth(4000),
            ],
        ]);

        $book->update([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'author_id' => $validated['author_id']
        ]);

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($book->cover_image_link && Storage::disk('public')->exists($book->cover_image_link)) {
                Storage::disk('public')->delete($book->cover_image_link);
            }
            
            $book->cover_image_link = 'storage/' . $request->file('cover')->store('images/books', 'public');
            $book->save();
        }

        return redirect()->route('books.show', $book)->with("success_message", "Book updated successfully");
    }

    public function destroy(Book $book){
        $this->authorize('delete', $book);

        $book->delete();
        return redirect("books")->with("success_message", "Book deleted successfully");
    }

    private function updateRecentlyBrowsed($bookId, $currentIds){
        $currentIds = array_diff($currentIds, [$bookId]);
        array_unshift($currentIds, $bookId);
        return array_slice($currentIds, 0, 10);
    }
}
