<x-layout>
    <x-header>
        <div class="flex justify-between items-center w-full">
            <a href="{{ route('authors.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back to Authors
            </a>
            <span>Author Details</span>
            <div class="w-24"></div> <!-- Spacer for alignment -->
        </div>
    </x-header>

    <div class="max-w-5xl mx-auto mt-6">
        {{-- Author Info Card --}}
        <div
            class="mb-8 bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:shadow-lg">
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    {{-- Author Avatar/Initial --}}
                    <div class="flex-shrink-0">
                        @if ($author->image_link && file_exists(public_path($author->image_link)))
                            <img src="{{ asset($author->image_link) }}" alt="{{ $author->name }}"
                                class="w-12 h-12 rounded-full"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @else
                            <div class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-semibold"
                                {{ isset($author->image_link) && file_exists(public_path($author->image_link)) ? 'style="display: none;"' : '' }}>
                                {{ strtoupper(substr($author->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Author Details --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $author->name }}</h2>
                    </div>
                </div>


                {{-- Bio --}}
                @if ($author->bio)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-700 leading-relaxed">{{ $author->bio }}</p>
                    </div>
                @endif

                {{-- Action Buttons --}}
                @can('access-admin')
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('authors.edit', $author->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Author
                        </a>

                        <form action="{{ route('authors.destroy', $author) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this author? All associated books will also be deleted.')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Author
                            </button>
                        </form>
                    </div>
                @endcan

                {{-- Additional Metadata --}}
                <div class="mt-4 flex flex-wrap gap-2">
                    @if ($books->total() > 0)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ $books->total() }} {{ Str::plural('book', $books->total()) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Books Grid --}}
        @if ($books->count() > 0)
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
