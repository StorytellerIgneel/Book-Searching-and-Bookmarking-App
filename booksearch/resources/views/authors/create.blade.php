<x-layout>
    <x-header>Create Author</x-header>
    <div class="max-w-xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
        <form action="{{ route('authors.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Name -->
            <div>
                <x-forms.input 
                    name="name" 
                    label="Author Name" 
                    placeholder="Type author's name" 
                    value="{{ old('name') }}"
                />
            </div>
            
            <!-- Bio -->
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700">Author Bio</label>
                <div class="mt-1">
                    <textarea 
                        name="bio" 
                        id="bio" 
                        rows="5" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border @error('bio') border-red-500 @enderror"
                        placeholder="Type author bio"
                    >{{ old('bio') }}</textarea>
                    <x-forms.error name="bio" />
                </div>
            </div>
            
            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Author Photo</label>
                <div class="mt-2 flex items-center gap-4">
                    <!-- Image Preview Container -->
                    <div class="flex-shrink-0 relative">
                        <span class="inline-block h-20 w-20 overflow-hidden rounded-full bg-gray-100">
                            <!-- Default SVG placeholder -->
                            <svg id="author-placeholder-svg" class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Actual image will be shown here when selected -->
                            <img id="author-image-preview" src="" alt="Author preview" class="hidden h-full w-full object-cover rounded-full">
                        </span>
                        <!-- Loading indicator (hidden by default) -->
                        <div id="author-loading-indicator" class="hidden absolute inset-0 items-center justify-center bg-black bg-opacity-30 rounded-full">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>  
                
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <!-- File Input Button -->
                        <label for="image" class="cursor-pointer rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Upload Photo
                        </label>
                        
                        <!-- Remove Button -->
                        <button 
                            type="button" 
                            onclick="resetAuthorImage()"
                            class="rounded-md border border-transparent py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-600">
                            Remove
                        </button>
                        
                        <!-- Hidden File Input -->
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            accept="image/*" 
                            class="sr-only"
                            onchange="previewAuthorImage(this)"
                            required>
                    </div>
                </div>
                <x-forms.error name="image" />
            </div>
            
            <!-- Submit Button -->
            <div class="pt-4">
                <x-forms.submit-button>Create Author</x-forms.submit-button>
            </div>
        </form>
    </div>

    <script>
        function previewAuthorImage(input) {
            const preview = document.getElementById('author-image-preview');
            const placeholder = document.getElementById('author-placeholder-svg');
            const loading = document.getElementById('author-loading-indicator');
            
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
        
        function resetAuthorImage() {
            const preview = document.getElementById('author-image-preview');
            const placeholder = document.getElementById('author-placeholder-svg');
            const fileInput = document.getElementById('image');
            
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            fileInput.value = '';
        }
    </script>
</x-layout>