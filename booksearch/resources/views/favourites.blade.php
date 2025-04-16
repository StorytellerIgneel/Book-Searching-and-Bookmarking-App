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
                            <h2 class="text-xl font-semibold">{{ $favourite->book->title }}</h2>
                            <p class="text-gray-600">{{ $favourite->book->author ?? 'Unknown Author' }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </body>