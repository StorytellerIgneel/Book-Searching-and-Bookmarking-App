<x-layout>
    <x-header>Edit Book</x-header>
    <div class="max-w-xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
        <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $book->id }}">
            
            <!-- Cover Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Book Cover</label>
                <div class="mt-2 flex items-center gap-4">
                    <!-- Image Preview Container -->
                    <div class="flex-shrink-0 relative">
                        <span class="inline-block h-32 w-24 overflow-hidden bg-gray-100 rounded-md">
                            @if($book->cover_image_link && file_exists(public_path($book->cover_image_link)))
                                <!-- Current cover image -->
                                <img id="current-cover" src="{{ asset($book->cover_image_link) }}" alt="Current book cover"
                                    class="h-full w-full object-cover rounded-md">
                                <!-- Book-themed SVG placeholder (hidden when image exists) -->
                                <svg id="book-placeholder-svg" class="hidden h-full w-full text-gray-300" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                                </svg>
                            @else
                                <!-- Show only SVG placeholder if no cover exists -->
                                <svg id="book-placeholder-svg" class="h-full w-full text-gray-300" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                                </svg>
                                <img id="current-cover" src="" class="hidden h-full w-full object-cover rounded-md">
                            @endif
                            <!-- New cover preview (hidden by default) -->
                            <img id="cover-preview" src="" alt="Book cover preview"
                                class="hidden h-full w-full object-cover rounded-md">
                        </span>
                        <!-- Loading indicator (hidden by default) -->
                        <div id="loading-indicator"
                            class="hidden absolute inset-0 items-center justify-center bg-black bg-opacity-30 rounded-md">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <!-- File Input Button -->
                        <label for="cover"
                            class="cursor-pointer rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Change Cover
                        </label>
                        <!-- Remove Button (only shown when there's an existing cover) -->
                        @if($book->cover && file_exists(public_path($book->cover)))
                            <button type="button" onclick="resetCover()"
                                class="rounded-md border border-transparent py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-600">
                                Remove
                            </button>
                        @endif
                        <input type="file" id="cover" name="cover" accept="image/*"
                            class="sr-only" onchange="previewCover(this)">
                    </div>
                </div>
                <x-forms.error name="cover" />
            </div>

            <!-- Title -->
            <div>
                <x-forms.input 
                    name="title" 
                    label="Book Title" 
                    value="{{ old('title', $book->title) }}"
                />
            </div>
            
            <!-- Synopsis -->
            <div>
                <label for="synopsis" class="block text-sm font-medium text-gray-700">Synopsis</label>
                <div class="mt-1">
                    <textarea 
                        name="synopsis" 
                        id="synopsis" 
                        rows="5" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border @error('synopsis') border-red-500 @enderror"
                        placeholder="Type book synopsis"
                    >{{ old('synopsis', $book->synopsis) }}</textarea>
                    <x-forms.error name="synopsis" />
                </div>
            </div>

            <!-- Author ID -->
            <div>
                <x-forms.input 
                    type="number"
                    name="author_id" 
                    label="Author ID" 
                    value="{{ old('author_id', $book->author_id) }}"
                />
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-4 pt-4">
                <button 
                    type="button" 
                    onclick="window.location.href='/books'" 
                    class="inline-flex px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Cancel
                </button>

                <x-forms.submit-button>Update Book</x-forms.submit-button>
            </div>
        </form>
    </div>

    <script>
        function previewCover(input) {
            const preview = document.getElementById('cover-preview');
            const current = document.getElementById('current-cover');
            const placeholder = document.getElementById('book-placeholder-svg');
            const loading = document.getElementById('loading-indicator');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                loading.classList.remove('hidden');
                current.classList.add('hidden');
                placeholder.classList.add('hidden');

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    loading.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetCover() {
            const preview = document.getElementById('cover-preview');
            const current = document.getElementById('current-cover');
            const placeholder = document.getElementById('book-placeholder-svg');
            const fileInput = document.getElementById('cover');

            // Reset any new cover selection
            preview.src = '';
            preview.classList.add('hidden');
            
            // Hide current cover and show placeholder
            current.classList.add('hidden');
            placeholder.classList.remove('hidden');
            
            fileInput.value = '';
        }
    </script>
</x-layout>