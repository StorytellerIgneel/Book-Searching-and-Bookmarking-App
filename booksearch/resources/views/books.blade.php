<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body>
    <h1>Books</h1>
    
    <ul>
        @foreach ($books as $book)
            <li>
                <h2>{{ $book->name }}</h2>
                <!-- Assuming the image is stored in a public folder or storage link -->
                <img src="{{ asset('storage/' . $book->image) }}" alt="Image of {{ $book->name }}" width="200">
            </li>
        @endforeach
    </ul>
</body>
</html>
