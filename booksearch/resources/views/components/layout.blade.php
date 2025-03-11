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
                <div class="flex items-center space-x-4">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                            Logout
                        </button>
                    </form>
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