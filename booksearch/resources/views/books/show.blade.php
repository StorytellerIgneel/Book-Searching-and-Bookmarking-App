<x-layout>
    <x-header>
        <div class="flex justify-between items-center max-w-6xl max-auto px-4">
            <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back to Books
            </a>
            <span>Book Details</span>
            <div class="w-24"></div>
        </div>
    </x-header>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Book Cover Column -->
            <div class="md:w-1/3">
                @if ($book->cover_image_link && file_exists(public_path($book->cover_image_link)))
                    <img src="{{ asset($book->cover_image_link) }}" alt="{{ $book->title }} cover"
                        class="w-full rounded-lg shadow-md mb-4">
                @else
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                @endif

                <!-- Rating and Favourite Actions -->
                <div class="space-y-4 mt-6">
                    <div
                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Your Rating</h3>
                            @if ($userRating)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
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
                                    @if ($userRating)
                                        <option value="0">🚫 Remove my rating</option>
                                    @else
                                        <option value="" selected disabled>👉 Select your rating</option>
                                    @endif
                                    <option value="1" {{ $userRating == 1 ? 'selected' : '' }}>⭐ (1 star) </option>
                                    <option value="2" {{ $userRating == 2 ? 'selected' : '' }}>⭐⭐ (2 stars)
                                    </option>
                                    <option value="3" {{ $userRating == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 stars)
                                    </option>
                                    <option value="4" {{ $userRating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 stars)
                                    </option>
                                    <option value="5" {{ $userRating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 stars)
                                    </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            @if ($userRating)
                                <p class="text-xs text-gray-500 text-center">
                                    Changing your selection will update your rating
                                </p>
                            @endif
                        </form>
                    </div>

                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        @if ($isFavourite)
                            <form action="{{ route('favourites.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                    class="w-full flex items-center justify-center space-x-2 text-red-500 hover:text-red-700">
                                    <span class="text-xl">❤️</span>
                                    <span>Remove from Favourites</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favourites.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                    class="w-full flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800">
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
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>

                    <div class="flex items-center text-gray-600 mb-4">
                        <span>By
                            <a href="{{ route('authors.show', $book->author) }}"
                                class="text-blue-800 hover:text-blue-600">
                                {{ $book->author->name }}
                            </a>
                        </span>
                        <span class="mx-2">•</span>
                        <span>⭐ {{ number_format($book->ratings_avg_score, 2) ?? '0' }} / 5.0
                            ({{ $book->ratings_count ?? 0 }} ratings)</span>
                        <span class="mx-2">•</span>
                        <span>❤️ {{ $book->favourites_count ?? 0 }} favourites</span>
                    </div>

                    <div class="prose max-w-none text-gray-700 mb-6">
                        <p class="whitespace-pre-line">{{ $book->synopsis ?? 'No synopsis available.' }}</p>
                    </div>

                    @can('access-admin')
                        <div class="flex space-x-4 mt-8">
                            <a href="{{ route('books.edit', $book) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Book
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Book
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <!-- Similar Books Section -->
                @if ($similarBooks->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">More by {{ $book->author->name }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($similarBooks as $similarBook)
                                <x-book-card :book="$similarBook" />
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
