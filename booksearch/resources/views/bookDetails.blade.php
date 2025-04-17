<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>
</head>
<body>
    <h2>Book Title: {{ $book->title }}</h2>
    <h3>Synopsis:</h3>
    <h3>{{ $book->synopsis }}</h3>
    <!-- Assuming the image is stored in a public folder or storage link -->
    <img src="{{ asset($book->cover_image_link)  }}" alt="Image of {{ $book->title }}" width="500">
    <br><br>
    <h3>Author: </h3>
    <a href="{{ route("authors.details", ["id" => $book->author->id]) }}">{{ $book->author->name }}</a><br>
    <a href="{{ route('books.edit', ['id' => $book->id]) }}">Edit Book</a><br>
    <a href="{{ route('books.delete', ['id' => $book->id]) }}">Delete Book</a><br>
    <a href="{{ route('books.index') }}">Back to Books</a>
</body>
</html>
