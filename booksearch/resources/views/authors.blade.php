<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>

    <h1>List of Authors</h1>

    @if($authors->isEmpty())
        <p>No authors found.</p>
    @else
        <ul>
            @foreach($authors as $author)
                <li>
                    <strong>{{ $author->name }}</strong><br>
                    Bio: {{ $author->bio }}<br>
                    <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->name }}" width="100">
                </li>
            @endforeach
        </ul>
    @endif

</body>
</html>
