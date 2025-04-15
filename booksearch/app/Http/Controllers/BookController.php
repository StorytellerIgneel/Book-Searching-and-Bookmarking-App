<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function showAuthorDetails($id){
    //     $author = Book::find($id);
    //     return view("authorDetails", compact("author"));
    // }

    public function index(){
        $authors = Book::all();
        return view("authors", compact("authors"));
    }

    public function showCreateBookForm(){
        return view("createBookForm");
    }
    
    public function createBook(Request $request){
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
            "cover_image_path" => $imageUrl, // $imageName
            "author_id" => $request->author_id,
        ]);

        return redirect("books")->with("success_message", "Book created successfully");
    }

}
