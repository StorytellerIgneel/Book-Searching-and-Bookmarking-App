<x-layout>
    <x-header>Create Book</x-header>
    <div class="max-w-xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
        <form action="/books" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <!-- Title -->
            <div>
                <x-forms.input 
                    name="title" 
                    label="Book Title" 
                    placeholder="Type book's title" 
                    value="{{ old('title') }}"
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
                    >{{ old('synopsis') }}</textarea>
                    <x-forms.error name="synopsis" />
                </div>
            </div>
            
            <!-- Author ID -->
            <div>
                <x-forms.input 
                    type="number"
                    name="author_id" 
                    label="Author ID" 
                    placeholder="Type author's ID" 
                    value="{{ old('author_id') }}"
                />
            </div>
            
            <!-- Cover Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Book Cover</label>
                <div class="mt-2 flex items-center gap-4">
                    <!-- Image Preview Container -->
                    <div class="flex-shrink-0 relative">
                        <span class="inline-block h-32 w-24 overflow-hidden bg-gray-100 rounded-md">
                            <!-- Book-themed SVG placeholder -->
                            <svg id="book-placeholder-svg" class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                            </svg>
                            <!-- Actual image will be shown here when selected -->
                            <img id="book-cover-preview" src="" alt="Book cover preview" class="hidden h-full w-full object-cover rounded-md">
                        </span>
                        <!-- Loading indicator (hidden by default) -->
                        <div id="book-loading-indicator" class="hidden absolute inset-0 items-center justify-center bg-black bg-opacity-30 rounded-md">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>  
                
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <!-- File Input Button -->
                        <label for="cover" class="cursor-pointer rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Upload Cover
                        </label>
                        
                        <!-- Remove Button -->
                        <button 
                            type="button" 
                            onclick="resetBookCover()"
                            class="rounded-md border border-transparent py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-600">
                            Remove
                        </button>
                        
                        <!-- Hidden File Input -->
                        <input 
                            type="file" 
                            id="cover" 
                            name="cover" 
                            accept="image/*" 
                            class="sr-only"
                            onchange="previewBookCover(this)"
                            required>
                    </div>
                </div>
                <x-forms.error name="cover" />
            </div>
            
            <!-- Submit Button -->
            <x-forms.submit-button>Create Book</x-forms.submit-button>
        </form>
    </div>

    <script>
        function previewBookCover(input) {
            const preview = document.getElementById('book-cover-preview');
            const placeholder = document.getElementById('book-placeholder-svg');
            const loading = document.getElementById('book-loading-indicator');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                loading.classList.remove('hidden');
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    loading.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function resetBookCover() {
            const preview = document.getElementById('book-cover-preview');
            const placeholder = document.getElementById('book-placeholder-svg');
            const fileInput = document.getElementById('cover');
            
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            fileInput.value = '';
        }
    </script>
</x-layout>