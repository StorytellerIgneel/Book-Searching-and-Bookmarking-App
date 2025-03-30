<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Book Search</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased">
    <div class="flex flex-col space-y-2 min-h-screen text-gray-800 bg-gray-100">
        <header class="bg-gray-900 text-white px-4 py-2 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                
                {{-- Logo --}}
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-10 w-auto" alt="Logo">
                    <span class="text-lg font-bold">Book Search</span>
                </a>
        
                {{-- Navigation --}}
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-gray-300 transition">Home</a>
                    <a href="#" class="hover:text-gray-300 transition">Contact</a>
                    <a href="#" class="hover:text-gray-300 transition">Records</a>
                </nav>
        
                {{-- Register/Login --}}
                @guest
                <div class="flex space-x-4">
                    <a href="/register" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                        Register
                    </a>
                    <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                        Log In
                    </a>
                </div>
                @endguest
                {{-- Show Logout if logged in --}}
                @auth
                <div class="relative group">
                    <!-- Button for user menu -->
                    <button 
                        type="button" 
                        class="relative flex items-center justify-center h-9 w-9 rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                        aria-expanded="false" 
                        aria-haspopup="true"
                    >
                    <span class="absolute inset-0 rounded-full"></span>
                    <span class="relative inline-flex h-9 w-9 overflow-hidden rounded-full bg-gray-100">
                        @if( auth()->user()->profile_image_path )
                        <img 
                            class="h-full w-full object-cover" 
                            src="{{ asset(Auth::user()->profile_image_path) }}" 
                            alt="Profile"
                        >
                        @else
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        @endif
                    </span>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none opacity-0 invisible group-focus-within:opacity-100 group-focus-within:visible transition-all duration-200 transform group-focus-within:translate-y-0 translate-y-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                      <!-- Logout -->
                      <form method="POST" action="/logout" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                          Sign out
                        </button>
                      </form>
                    </div>
                  </div>
                @endauth

            </div>
        </header>

        <main class="flex flex-1 flex-col px-4 md:px-8 lg:px-16">
            {{ $slot }}
        </main>        
        
        <footer class="bg-gray-900 text-gray-400 text-center py-4">
            &copy; {{ date('Y') }} Book Search. All Rights Reserved.
        </footer>        
    </div>
</body>
</html>  