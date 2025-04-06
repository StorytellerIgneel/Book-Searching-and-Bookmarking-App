<x-layout>
    <x-header>Search Results For: "{{ $query }}" </x-header>
        @if ( isset($errorMessage))
            {{-- Error Message if query is too short --}}
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
            {{-- Search Results --}}
            <div class="max-w-5xl mx-auto mt-6">
                {{-- Book Search Results --}}
                <h1 class="text-2xl font-bold mb-4">Books</h1>
                <x-divider />
                @if ($books->isEmpty())
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg border-l-4 border-yellow-500">
                        <h1 class="text-2xl font-bold text-yellow-600 mb-3">No Results Found</h1>
                        <p class="text-yellow-500">Sorry, we couldn't find any books matching your search.</p>
                    </div>
                @else
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($books as $book)
                            <x-book-card :book="$book" />
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                @endif

                {{-- Author Search Results --}}
                <h1 class="text-2xl font-bold my-4">Authors</h1>
                <x-divider />
                @if ($authors->isEmpty())
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg border-l-4 border-yellow-500">
                        <h1 class="text-2xl font-bold text-yellow-600 mb-3">No Results Found</h1>
                        <p class="text-yellow-500">Sorry, we couldn't find any authors matching your search.</p>
                    </div>
                @else
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($authors as $author)
                            <x-author-card :author="$author" />
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $authors->links() }}
                    </div>
                @endif
            </div>
        @endif

</x-layout>