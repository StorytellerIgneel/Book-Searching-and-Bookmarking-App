<!DOCTYPE html>
    <body>
        <meta charset="UTF-8">

        <div class="max-w-4xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Your Favourite Books</h1>

            @if($favourites->isEmpty())
                <p>You have no favourite books yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach($favourites as $favourite)
                        <li class="p-4 bg-white shadow rounded">
                            <p class="text-gray-600">Book ID: {{ $favourite->book->id }}</p>
                            <p class="text-gray-600">Title: {{ $favourite->book->title ?? 'Unknown Title' }}</p>
                            <p class="text-gray-600">Summary: {{ $favourite->book->synopsis ?? 'Undefined' }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </body>