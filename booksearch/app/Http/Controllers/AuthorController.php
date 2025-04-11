<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function showCreateAuthorForm(){
        return view("createAuthorForm");
    }
    
    public function createAuthor(Request $request){
        $request->validate([
            "name" => "required | max: 191",
            "bio" => "required",
            "image"=>"required"
        ]);

        //store image link
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $imageUrl = $request->file("image")->store("storage/app/public/images/authors");

        //store author data mass assignmebt
        Author::create([
            "name" => $request->name,
            "bio" => $request->bio,
            "image_url" => $imageUrl, // $imageName
        ]);

        return response()->json([
            "message" => "Author created successfully"
        ], 201);
    }

    public function showAuthorDetails($id){
        $author = Author::find($id);
        return view("authorDetails", compact("author"));
    }

    public function index(){
        $authors = Author::all();
        print($authors);
        return view("authors", compact("authors"));
    }
}
