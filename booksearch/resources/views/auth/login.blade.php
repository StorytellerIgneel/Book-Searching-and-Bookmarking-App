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
              <!-- Remember Me -->
              <x-forms.checkbox name="remember_me" label="Remember me" />
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4 md:col-span-2">
            <x-forms.submit-button>Sign In</x-forms.submit-button>
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