<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showBookDetails($id){
        $book = Book::find($id);
        return view("bookDetails", compact("book"));
    }

    public function index(){
        $books = Book::all();
        return view("books", compact("books"));
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
        $data = Book::find($req->id);
        
        // $data->name = $req->name;
        // $data->email = $req->email;
        // $data->password = $req->password;
        // $data->save();

        $data->update($req->all());
        $data->image_link = "storage/" . $req->file("cover")->store("images/book_covers", "public");
        return redirect("books")->with("success_message", "Book updated successfully");
    }

    function deleteBook($id){
        $data = Book::find($id);
        $data->delete();
        return redirect("books")->with("success_message", "Book deleted successfully");
    }

}
