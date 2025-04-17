<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body>
    @if($books->isEmpty())
        <h1>No books found</h1>
        
    @else
        <h1>Books</h1>
        
        <ul>
            @foreach ($books as $book)
                <li>
                    <h2>{{ $book->title }}</h2>
                    <h3> {{ $book->synopsis }}</h3>
                    <!-- Assuming the image is stored in a public folder or storage link -->
                    <img src="{{ $book->cover_image_link  }}" alt="Image of {{ $book->title }}" width="200">
                    <a href="{{  route('books.details', ['id' => $book->id]) }}">View Details</a>
                    <a href="{{ route('books.delete', ['id' => $book->id]) }}">Delete Book</a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
