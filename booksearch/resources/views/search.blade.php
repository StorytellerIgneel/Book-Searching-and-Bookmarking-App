<x-layout>
    <x-header>Search Results For: "{{ $query }}" </x-header>
        @if ( isset($errorMessage))
            <div class="text-center p-6 bg-white rounded-lg shadow-lg max-w-2xl mx-auto border-l-4 border-red-500">
                <div class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-red-600 mb-3">Search Error</h1>
                <p class="text-red-500 bg-red-50 px-4 py-2 rounded-md inline-block">
                    {{ $errorMessage }}
                </p>
            </div>
        @else
            <div class="max-w-2xl mx-auto mt-6">
                @if ($books->isEmpty())
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg border-l-4 border-yellow-500">
                        <h1 class="text-2xl font-bold text-yellow-600 mb-3">No Results Found</h1>
                        <p class="text-yellow-500">Sorry, we couldn't find any books matching your search.</p>
                    </div>
                @else
                    <ul class="space-y-4">
                        @foreach ($books as $book)
                            <li class="bg-white shadow-md rounded-lg p-4">
                                <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                                <p class="text-gray-700">{{ $book->author }}</p>
                                <p class="text-gray-500">{{ $book->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

</x-layout>