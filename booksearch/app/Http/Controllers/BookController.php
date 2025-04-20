<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use App\Policies\BookPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    public function showBookDetails($id){
        $book = Book::find($id);
        return view("bookDetails", compact("book"));
    }

    // `public function index(){
    //     $books = Book::all();
    //     return view("books", compact("books"));
    // }`

    public function showCreateBookForm(){
        return view("createBookForm");
    }
    
    public function createBook(Request $request){
        $request->validate([
            "title" => "required | max: 191",
            "synopsis" => "required",
            "cover"=>"required",
            "author_id" => "required|integer|　exists:authors,id"
        ]);

        //store image link
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $imageUrl = $request->file("cover")->store("images/book_covers", "public");

        //store author data mass assignmebt
        Book::create([
            "title" => $request->title,
            "synopsis" => $request->synopsis,
            "cover_image_link" => "storage/" . $imageUrl, // $imageName
            "author_id" => $request->author_id,
        ]);

        return redirect("books")->with("success_message", "Book created successfully");
    }

    public function showEditBookForm($id){
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('books.index')->with('error_message', 'Book not found.');
        }
        return view("editBookForm", ["book"=>$book]);
    }

    public function editBook(Request $req){
        $req->validate([
            "title" => "required | max: 191",
            "synopsis" => "required",
            "author_id" => "required|integer| exists:authors,id"
        ]);

        $data = Book::find($req->id);

        $data->title = $req->title;
        $data->synopsis = $req->synopsis;
        $data->author_id = $req->author_id;
        if ($req->file("cover")) {
            $data->cover_image_link = "storage/" . $req->file("cover")->store("images/book_covers", "public");
        }
        $data->save();
        return redirect("books")->with("success_message", "Book updated successfully");
    }

    function deleteBook($id){
        $data = Book::find($id);
        $data->delete();
        return redirect("books")->with("success_message", "Book deleted successfully");
    }

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

        $request->validate([
            "title" => "required | max: 191",
            "synopsis" => "required",
            "cover"=>"required",
            "author_id" => "required"
        ]);

        //store image link
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $imageUrl = $request->file("cover")->store("images/book_covers", "public");

        //store author data mass assignmebt
        Book::create([
            "title" => $request->title,
            "synopsis" => $request->synopsis,
            "cover_image_link" => "storage/" . $imageUrl, // $imageName
            "author_id" => $request->author_id,
        ]);

        return redirect("books")->with("success_message", "Book created successfully");
    }

    public function edit(Book $book){
        
        $this->authorize('update', $book);

        if (!$book) {
            return redirect()->route('books.index')->with('error_message', 'Book not found.');
        }
        return view("books.edit", ["book" => $book]);
    }

    public function update(Book $book, Request $req){
        $req->validate([
            "title" => "required | max: 191",
            "synopsis" => "required",
            "author_id" => "required|integer| exists:authors,id"
        ]);

        $data = Book::find($req->id);

        $data->title = $req->title;
        $data->synopsis = $req->synopsis;
        $data->author_id = $req->author_id;
        if ($req->file("cover")) {
            $data->cover_image_link = "storage/" . $req->file("cover")->store("images/book_covers", "public");
        }
        $data->save();
        return redirect("books")->with("success_message", "Book updated successfully");
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
