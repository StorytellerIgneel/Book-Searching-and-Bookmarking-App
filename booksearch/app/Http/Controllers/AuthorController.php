<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function showAuthorDetails($id){
        $author = Author::find($id);
        return view("authorDetails", compact("author"));
    }

    public function index(){
        $authors = Author::all();
        return view("authors", compact("authors"));
    }
    
    public function showCreateAuthorForm(){
        return view("createAuthorForm");
    }
    
    public function createAuthor(Request $request){
        print($request);
        $request->validate([ //validate, redirect if fail, then run if ok
            "name" => "required | max: 191",
            "bio" => "required|string",
            "image"=>"required | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
        ]);

        //store image link
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $imageUrl = $request->file("image")->store("images/authors", "public");
        // $imageUrl = "storage/app/public/images/authors/".$imageName;

        //store author data mass assignmebt
        Author::create([
            "name" => $request->name,
            "bio" => $request->bio,
            "image_link" => ("storage/". $imageUrl), // $imageName
        ]);

        return redirect("authors")->with("success_message", "Author created successfully");
    }

    public function showEditAuthorForm($id){
        $author = Author::find($id);
        if (!$author) {
            return redirect()->route('authors.index')->with('error_message', 'Author not found.');
        }
        return view("editAuthorForm", ["author"=>$author]);
    }

    public function editAuthor(Request $req){
        $data = Author::find($req->id);
        
        // $data->name = $req->name;
        // $data->email = $req->email;
        // $data->password = $req->password;
        // $data->save();

        $data->update($req->all());
        $data->image_link = "storage/" . $req->file("image")->store("images/authors", "public");
        return redirect("authors")->with("success_message", "Author updated successfully");
    }

    function deleteAuthor($id){
        $data = Author::find($id);
        $data->delete();
        return redirect("authors")->with("success_message", "Author deleted successfully");
    }
    public function index2(){
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
}
