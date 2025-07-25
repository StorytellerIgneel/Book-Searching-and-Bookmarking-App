<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;


class AuthorController extends Controller
{
    use AuthorizesRequests;

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
    
    public function create(){
        $this->authorize('create', Author::class); 

        return view("authors.create");
    }
    
    public function store(Request $request){
        $this->authorize('create', Author::class); 

        $validated = $request->validate([
            "name" => "required|max:191",
            "bio" => "required|string|max:1000",
            "image"=> ["required", File::image()->min('1kb')->max('10mb'),
                Rule::dimensions()->maxHeight(4000)->maxWidth(4000)],
        ],);

        $imageUrl = 'storage/' . $request->file("image")->store("images/authors", "public");

        //store author data mass assignmebt
        $author = Author::create([
            "name" => $validated['name'],
            "bio" => $validated['bio'],
            "image_link" => $imageUrl,
        ]);

        return redirect()->route('authors.show', $author)->with("success_message", "Author created successfully");
    }

    public function edit(Author $author){
        $this->authorize('update', $author);

        return view('authors.edit', ["author" => $author]);
    }

    public function update(Author $author, Request $request){  
        $this->authorize('update', $author);

        $validated = $request->validate([
            "name" => "required|max:191",
            "bio" => "required|string|max:1000",
            "image"=> ["nullable", File::image()->min('1kb')->max('10mb'),
                Rule::dimensions()->maxHeight(4000)->maxWidth(4000)],
        ]);

        $author->update([
            "name" => $validated['name'],
            "bio" => $validated['bio'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $oldImagePath = str_replace('storage/', '', $author->image_link);
            if ($author->image_link && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
            
            $author->image_link = 'storage/' . $request->file('image')->store('images/authors', 'public');
            $author->save();
        }
        
        return redirect()->route('authors.show', $author)->with("success_message", "Author updated successfully");
    }

    public function destroy(Author $author){
        $this->authorize('delete', $author);

        // Delete old image if exists
        $oldImagePath = str_replace('storage/', '', $author->image_link);
        if ($author->image_link && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }

        $author->delete();
        
        return redirect("authors")->with("success_message", "Author deleted successfully");
    }
}
