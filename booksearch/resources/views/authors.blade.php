<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>

    <h1>List of Authors</h1>
    @if(session('success_message'))
        <div style="color: green;">
            {{ session('success_message') }}
        </div>
    @elseif (session("error_message"))
        <div style="color: red;">
            {{ session('error_message') }}
        </div>
    @endif
    @if($authors->isEmpty())
        <p>No authors found.</p>
    @else
        <ul>
            @foreach($authors as $author)
                <br>
                    <strong>{{ $author->name }}</strong><br>
                    Bio: {{ $author->bio }}<br>
                    <img src="{{ $author->image_link }}" alt="{{ $author->name }}" width="100">
                    <br><a href="{{ route("authors.delete", ["id" => $author->id]) }}">Delete Author</a>
                    <br><a href="/editAuthor/{{$author->id }}">Edit</a>
                </li>
            @endforeach
        </ul>
    @endif
    <br><a href="{{ route('authors.create') }}">Create Author</a></br>

</body>
</html>
