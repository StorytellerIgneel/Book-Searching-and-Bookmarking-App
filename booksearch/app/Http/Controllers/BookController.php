<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showCreateBookForm(){
        return view("createBookForm");
    }
    
    public function createBook(Request $request){
        $request->validate([
            "name" => "required | max: 191",
            "synopsis" => "required",
            "cover_image_link"=>"required"
        ]);

        //store image link
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $imageUrl = null;

        //store author data mass assignmebt
        Book::create([
            "name" => $request->name,
            "bio" => $request->bio,
            "image_url" => $imageUrl, // $imageName
        ]);

        return response()->json([
            "message" => "Author created successfully"
        ], 201);
    }

    public function index(){
        $books = Book::all();
        print($books);
        return view("books", compact("books"));
    }
}
