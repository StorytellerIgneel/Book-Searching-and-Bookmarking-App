<a href="{{ 'books/' . $book->id }}" class="block bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-200 transform hover:scale-[1.02] group flex flex-col h-full">
    <div class="p-5 flex-grow">
        <!-- Header with title and rating -->
        <div class="flex justify-between items-start mb-3">
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2">
                {{ $book->name }}
            </h3>
            <span class="flex-shrink-0 text-xs font-semibold px-2 py-1 rounded-full 
                      @if($book->ratings_avg_score >= 4) bg-green-50 text-green-700
                      @elseif($book->ratings_avg_score >= 3) bg-yellow-50 text-yellow-700
                      @else bg-red-50 text-red-700 @endif">
                ★ {{ number_format($book->ratings_avg_score ?? 0, 1) }}
            </span>
        </div>

        <!-- Author -->
        <p class="text-sm text-gray-600 mb-3 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="truncate">{{ $book->author->name }}</span>
        </p>

        <!-- Summary -->
        <p class="text-sm text-gray-700 line-clamp-3">
            {{ $book->summary ?? "No summary available" }}
        </p>
    </div>

    <!-- Fixed footer with stats -->
    <div class="border-t border-gray-100 bg-gray-50 p-3">
        <div class="flex justify-between text-xs text-gray-600">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                {{ $book->ratings_count }} reviews
            </span>
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $book->favourites_count }} favourites
            </span>
        </div>
    </div>
</a>