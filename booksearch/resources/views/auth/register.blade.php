<x-layout>
    <h2 class="text-2xl font-semibold text-gray-900 text-center my-2">User Registration</h2>
    <div class="max-w-2xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
        <form method="POST" action="/register" class="space-y-6" enctype="multipart/form-data">
        @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Username -->
            <div class="md:col-span-2">
                <x-forms.input 
                    name="username" 
                    label="Username" 
                    placeholder="Enter your username" 
                    maxlength="30"
                />
            </div>
      
            <!-- Password -->
            <div>
                <x-forms.input 
                    type="password"
                    name="password"  
                    label="Password"
                    placeholder="••••••••" 
                    maxlength="30"
                />
            </div>
      
            <!-- Password Confirmation -->
            <div>
                <x-forms.input 
                    type="password"
                    name="password_confirmation"  
                    label="Password Confirmation"
                    placeholder="••••••••" 
                    maxlength="30"
                />
            </div>
      
            <!-- Email -->
            <div class="md:col-span-2">
                <x-forms.input 
                    type="email"
                    name="email"  
                    label="Email"
                    placeholder="name@gmail.com" 
                    maxlength="100"
                />
            </div>
      
            <!-- Profile Picture -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <div class="mt-2 flex items-center gap-4">
                <!-- Image Preview Container -->
                <div class="flex-shrink-0 relative">
                    <span class="inline-block h-20 w-20 overflow-hidden rounded-full bg-gray-100">
                    <!-- Default SVG placeholder -->
                    <svg id="placeholder-svg" class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Actual image will be shown here when selected -->
                    <img id="image-preview" src="" alt="Profile preview" class="hidden h-full w-full object-cover rounded-full">
                    </span>
                    <!-- Loading indicator (hidden by default) -->
                    <div id="loading-indicator" class="hidden absolute inset-0 items-center justify-center bg-black bg-opacity-30 rounded-full">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    </div>
                </div>  
            
                <!-- Buttons -->
                <div class="flex gap-3">
                    <!-- File Input Button -->
                    <label for="profile_picture" class="cursor-pointer rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                    Upload Photo
                    </label>
                    
                    <!-- Remove Button -->
                    <button 
                    type="button" 
                    onclick="resetImage()"
                    class="rounded-md border border-transparent py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-600">
                    Remove
                    </button>
                    
                    <!-- Hidden File Input -->
                    <input 
                    type="file" 
                    id="profile_picture" 
                    name="profile_picture" 
                    accept="image/*" 
                    class="sr-only"
                    onchange="previewImage(this)">
                </div>
                </div>
            </div>
            
            <!-- Minimal JavaScript for preview functionality -->
            <script>
                function previewImage(input) {
                    const preview = document.getElementById('image-preview');
                    const placeholder = document.getElementById('placeholder-svg');
                    const loading = document.getElementById('loading-indicator');
                    
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
                
                function resetImage() {
                    const preview = document.getElementById('image-preview');
                    const placeholder = document.getElementById('placeholder-svg');
                    const fileInput = document.getElementById('profile_picture');
                    
                    preview.src = '';
                    preview.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    fileInput.value = '';
                }
            </script>
      
            <!-- Date of Birth -->
            <div>
                <x-forms.input 
                    type="date"
                    name="date_of_birth"
                    label="Date of Birth"
                />
            </div>
      
            <!-- Phone -->
            <div>
                <x-forms.input 
                    type="tel"
                    name="phone"
                    label="Phone (Optional)"
                    placeholder="+1 (555) 123-4567"
                    :required="false"
                />
            </div>
          </div>
      
          <!-- Submit Button -->
          <div class="pt-4 md:col-span-2">
            <button 
              type="submit" 
              class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
              Register
            </button>
          </div>
        </form>
      </div>
</x-layout>