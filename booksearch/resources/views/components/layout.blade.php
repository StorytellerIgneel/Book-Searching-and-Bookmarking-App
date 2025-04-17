<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Book Search</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gray-100">
        <!-- Header -->
        <header class="bg-gray-900 text-white shadow-md">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <!-- Sidebar Toggle Button -->
                    <button id="sidebarToggle" class="flex items-center p-1 navbar-burger text-primary-600 dark:text-primary-500">
                        <svg class="block w-6 h-6 fill-current md:h-6 md:w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                        </svg>
                    </button>

                    <!-- Logo with click handler -->
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-10 w-auto" alt="Logo">
                        <span class="text-lg font-bold">Book Search</span>
                    </a>
                </div>
                
                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4">
                    <form action="/search" method="GET" class="relative">
                        <div class="relative max-w-lg mx-auto">
                            <div class="flex items-center border border-gray-300 rounded-full bg-white overflow-hidden shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 transition-all">
                                <input
                                    type="search"
                                    name="query"
                                    class="w-full py-2.5 pl-5 pr-12 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0"
                                    placeholder="Search books..."
                                    aria-label="Search books"
                                    autocomplete="off"
                                />
                                <button type="submit" class="absolute right-4 text-gray-500 hover:text-indigo-600 transition-transform transform hover:scale-125">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            </div>
                        </div>                        
                    </form>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex-shrink-0">
                    @guest
                    <div class="flex space-x-2 sm:space-x-3">
                        <x-nav.button href="/register" :isActive="request()->is('register')" >
                            Register
                        </x-nav.button>
                        <x-nav.button href="/login" :isActive="request()->is('login')" >
                            Login
                        </x-nav.button>
                    </div>
                    @endguest

                    @auth
                    <div class="relative group">
                        <button 
                            type="button" 
                            class="relative flex items-center justify-center h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                            aria-expanded="false" 
                            aria-haspopup="true"
                        >
                            <span class="absolute inset-0 rounded-full"></span>
                            <span class="relative inline-flex h-full w-full overflow-hidden rounded-full bg-gray-100">
                                @if( auth()->user()->profile_image_link )
                                <img 
                                    class="h-full w-full object-cover" 
                                    src="{{ asset(Auth::user()->profile_image_link) }}" 
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
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
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
            </div>
        </header>

        <!-- Sidebar -->
        <div class="flex flex-1">
            <aside id="sidebar" class="w-64 bg-gray-800 text-white transform -translate-x-full transition-all duration-300 ease-in-out opacity-0 invisible">
                <div class="py-3 text-xl uppercase text-center tracking-widest bg-gray-900 border-b border-gray-700">
                    <a href="/" class="text-white">Menu</a>
                </div>
                <nav class="text-sm text-gray-300">
                    <ul class="flex flex-col">
                        <!-- sidebar navigations starts from here -->
                        <!-- Sidebar Button to Your Profile -->
                        <x-nav.item href="/profile" :active="request()->is('profile')" >
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </x-slot:icon>
                            Your Profile
                        </x-nav.item>

                        <!-- Sidebar Button to Book List -->
                        <x-nav.item href="/books" :active="request()->is('books')">
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </x-slot:icon>
                            Book List
                        </x-nav.item>

                        <!-- Sidebar Button to Author List -->
                        <x-nav.item href="/authors" :active="request()->is('authors')">
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </x-slot:icon>
                            Author List
                        </x-nav.item>

                        <!-- Sidebar Button to Favourite -->
                        <x-nav.item href="/favourites" :active="request()->is('favourite')">
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 7.5a5.25 5.25 0 00-9-3.75 5.25 5.25 0 00-9 3.75c0 5.25 9 11.25 9 11.25s9-6 9-11.25z" />
                                </svg>
                            </x-slot:icon>
                            Favourite Books
                        </x-nav.item>


                        <x-nav.header>USER MANAGEMENT</x-nav.header>

                        <x-nav.item href="user" :active="request()->is('user')" >
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                              </svg>
                            </x-slot:icon>
                            User List
                        </x-nav.item>

                        <x-nav.header>ADMIN PAGES</x-nav.header>

                        <x-nav.header>BOOK MANAGEMENT</x-nav.header>

                    </ul>
                </nav>
            </aside>

            <!-- Page Content starts from here-->
            <main class="flex-1 px-4 md:p-6 lg:p-8 pt-0 overflow-auto mr-64">
                {{ $slot }}
            </main>
        </div>
        
        <!-- Footer part-->
        <footer class="bg-gray-900 text-gray-400 text-center py-4 text-sm">
            &copy; {{ date('Y') }} Book Search. All Rights Reserved.
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const pageWrapper = document.querySelector('main');

        sidebarToggle.addEventListener('click', function() {
            if (sidebar.classList.contains('invisible')) {
                sidebar.classList.remove('invisible');
                setTimeout(() => {
                    sidebar.classList.remove('-translate-x-full', 'opacity-0');
                    sidebar.classList.add('opacity-100');
                }, 10);
                pageWrapper.classList.remove('mr-64');
            } else {
                sidebar.classList.remove('opacity-100');
                sidebar.classList.add('opacity-0');
                setTimeout(() => {
                    sidebar.classList.add('-translate-x-full', 'invisible');
                }, 300); 
                pageWrapper.classList.add('mr-64');
            }
        });
    });
    </script>
</body>
</html>