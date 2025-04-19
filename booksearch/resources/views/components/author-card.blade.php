@props(['author'])

<div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-200 transform hover:scale-[1.02] h-full flex flex-col">
    <a href="{{ route('authors.show', $author->id) }}" class="block p-5 group flex-grow">
        <div class="flex items-start space-x-4">
            <!-- Author Avatar -->
            <div class="flex-shrink-0 h-12 w-12 rounded-full overflow-hidden">
                @if($author->image_link && file_exists(public_path($author->image_link)))
                    <img src="{{ asset($author->image_link) }}" alt="{{ $author->name }}" class="h-12 w-12 rounded-full">
                @else
                    <div class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-semibold">
                        {{ strtoupper(substr($author->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors mb-1">
                    {{ $author->name }}
                </h3>
                <p class="text-sm text-gray-600 line-clamp-3">
                    {{ $author->bio ?? "No biography available" }}
                </p>
            </div>
        </div>
    </a>
    
    <div class="border-t border-gray-100 p-5">
        <h4 class="text-xs font-medium uppercase tracking-wider text-gray-500 mb-3 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            TOP BOOKS
        </h4>
        
        @if ($author->books->isEmpty())
            <p class="text-sm text-gray-400 italic">No books available</p>
        @else
            <ul class="space-y-2">
                @foreach ($author->books->sortByDesc('ratings_avg_score')->take(3) as $book)
                    <li class="flex items-center justify-between">
                        <a href="{{ route('books.show' , $book->id) }}" class="text-sm font-medium text-gray-700 truncate pr-2 hover:text-blue-600 transition-colors flex-grow">
                            {{ $book->name }}
                        </a>
                        <x-rating :$book />
                    </li>
                @endforeach
            </ul>
        @endif
        
        @if($author->books_count > 3)
            <div class="mt-3 text-right">
                <a href="{{ route('authors.show', $author->id) }}" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">
                    View all {{ $author->books_count }} books →
                </a>
            </div>
        @endif
    </div>
</div>