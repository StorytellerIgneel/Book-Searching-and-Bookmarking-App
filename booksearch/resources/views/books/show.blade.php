<x-layout>
    <x-header>Book Details</x-header>
    
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Book Cover Column -->
            <div class="md:w-1/3">
                @if($book->cover_image_link)
                    <img src="{{ asset('storage/' . $book->cover_image_link) }}" 
                         alt="{{ $book->name }} cover" 
                         class="w-full rounded-lg shadow-md mb-4">
                @else
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                @endif
                
                <!-- Rating and Favourite Actions -->
                <div class="space-y-4 mt-6">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Your Rating</h3>
                            @if($userRating)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Current: {{ $userRating }} ⭐
                                </span>
                            @endif
                        </div>
                        
                        <form action="{{ route('ratings.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            
                            <div class="relative">
                                <select name="score" onchange="this.form.submit()"
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none">
                                    @if($userRating)
                                        <option value="0">🚫 Remove my rating</option>
                                    @else
                                        <option value="" selected disabled>👉 Select your rating</option>
                                    @endif
                                    <option value="1" {{ $userRating == 1 ? 'selected' : '' }}>⭐ (1 star) </option>
                                    <option value="2" {{ $userRating == 2 ? 'selected' : '' }}>⭐⭐ (2 stars) </option>
                                    <option value="3" {{ $userRating == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 stars) </option>
                                    <option value="4" {{ $userRating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 stars) </option>
                                    <option value="5" {{ $userRating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 stars) </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            
                            @if($userRating)
                                <p class="text-xs text-gray-500 text-center">
                                    Changing your selection will update your rating
                                </p>
                            @endif
                        </form>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        @if($isFavourite)
                            <form action="{{ route('favourites.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="w-full flex items-center justify-center space-x-2 text-red-500 hover:text-red-700">
                                    <span class="text-xl">❤️</span>
                                    <span>Remove from Favourites</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favourites.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="w-full flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800">
                                    <span class="text-xl">♡</span>
                                    <span>Add to Favourites</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Book Details Column -->
            <div class="md:w-2/3">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->name }}</h1>
                    
                    <div class="flex items-center text-gray-600 mb-4">
                        <span>By 
                            <a href="{{ route('authors.show', $book->author) }}" class="text-blue-800 hover:text-blue-600">
                                {{ $book->author->name }}
                            </a>
                        </span>
                        <span class="mx-2">•</span>
                        <span>⭐ {{ number_format($book->ratings_avg_score, 2) ?? '0' }} / 5.0 ({{ $book->ratings_count ?? 0 }} ratings)</span>
                        <span class="mx-2">•</span>
                        <span>❤️ {{ $book->favourites_count ?? 0 }} favourites</span>
                    </div>
                    
                    <div class="prose max-w-none text-gray-700 mb-6">
                        <p class="whitespace-pre-line">{{ $book->summary ?? 'No summary available.'}}</p>
                    </div>
                    
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="font-medium text-gray-800 mb-2">Details</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">Published:</span>
                                <span>{{ $book->published_date?->format('Y') ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Pages:</span>
                                <span>{{ $book->pages ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Genre:</span>
                                <span>{{ $book->genre ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="font-medium">ISBN:</span>
                                <span>{{ $book->isbn ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Similar Books Section -->
                @if($similarBooks->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">More by {{ $book->author->name }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($similarBooks as $similarBook)
                                <x-book-card :book="$similarBook" />
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>