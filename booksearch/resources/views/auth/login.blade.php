<x-layout>
  <h2 class="text-2xl font-semibold text-gray-900 text-center my-2">Login to Your Account</h2>
  <div class="max-w-2xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
      <form method="POST" action="/login" class="space-y-6">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mb-0">
            <!-- Email -->
            <div class="md:col-span-3">
                <x-forms.input 
                    name="username"  
                    label="Username"
                    placeholder="Username" 
                    autocomplete="username"
                />
            </div>
          
            <!-- Password -->
            <div class="md:col-span-3">
                <x-forms.input 
                    type="password"
                    name="password"  
                    label="Password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                />
            </div>
            <div class="mt-0 pt-0">
              <div class="flex items-center mt-1">
                <!-- Remember Me -->
                <input 
                  id="remember_me" 
                  name="remember" 
                  type="checkbox" 
                  class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                  Remember me
                </label>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4 md:col-span-2">
              <button 
                  type="submit" 
                  class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                  Sign In
              </button>
          </div>

          <!-- Registration Link -->
          <div class="text-sm text-center pt-2">
              <p class="text-gray-500">
                  Don't have an account? 
                  <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
                      Register here
                  </a>
              </p>
          </div>
      </form>
  </div>
</x-layout>