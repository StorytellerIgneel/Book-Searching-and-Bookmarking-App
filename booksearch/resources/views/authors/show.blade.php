<x-layout>
    <x-header>Author Details</x-header>
    
    <div class="max-w-5xl mx-auto mt-6">
        {{-- Author Info Card --}}
        <div class="mb-8 bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:shadow-lg">
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    {{-- Author Avatar/Initial --}}
                    <div class="flex-shrink-0 bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-semibold">
                        {{ strtoupper(substr($author->name, 0, 1)) }}
                    </div>
                    
                    {{-- Author Details --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $author->name }}</h2>
                        @if($author->birth_date)
                            <p class="text-sm text-gray-500">
                                Born {{ $author->birth_date->format('F j, Y') }}
                                @if($author->death_date)
                                    - Died {{ $author->death_date->format('F j, Y') }}
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
                
                {{-- Bio --}}
                @if($author->bio)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-700 leading-relaxed">{{ $author->bio }}</p>
                    </div>
                @endif
                
                {{-- Additional Metadata --}}
                <div class="mt-4 flex flex-wrap gap-2">
                    @if($author->nationality)
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                            {{ $author->nationality }}
                        </span>
                    @endif
                    @if($books->total() > 0)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ $books->total() }} {{ Str::plural('book', $books->total()) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Books Grid --}}
        @if($books->count() > 0)
            <h3 class="text-xl font-semibold mb-4 text-gray-800">{{ $author->name }}'s Books</h3>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $books->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-6 text-center text-gray-500">
                No books found for this author.
            </div>
        @endif
    </div>
</x-layout>