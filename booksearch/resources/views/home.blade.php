<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Best Rated Section -->
        <section class="mb-12" x-data="carousel('bestRated')">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Top Rated Books</h2>
                <div class="flex space-x-2">
                    <button @click="scrollLeft()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollLeft()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollLeft()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="scrollRight()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollRight()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollRight()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="relative">
                <div id="bestRated" 
                     class="flex overflow-x-auto pb-4 space-x-4 scrollbar-hide">
                    @foreach($bestRated as $book)
                        <div class="flex-shrink-0 w-48">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>   

        <!-- Most Popoular Section -->
        <section class="mb-12" x-data="carousel('mostPopular')">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Most Popular</h2>
                <div class="flex space-x-2">
                    <button @click="scrollLeft()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollLeft()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollLeft()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="scrollRight()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollRight()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollRight()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="relative">
                <div id="mostPopular" 
                     class="flex overflow-x-auto pb-4 space-x-4 scrollbar-hide">
                    @foreach($mostPopular as $book)
                        <div class="flex-shrink-0 w-48">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>   
        
        <!-- Recently Added Section -->
        <section class="mb-12" x-data="carousel('recentlyAdded')">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Recently Added</h2>
                <div class="flex space-x-2">
                    <button @click="scrollLeft()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollLeft()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollLeft()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="scrollRight()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollRight()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollRight()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="relative">
                <div id="recentlyAdded" 
                        class="flex overflow-x-auto pb-4 space-x-4 scrollbar-hide">
                    @foreach($recentlyAdded as $book)
                        <div class="flex-shrink-0 w-48">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>   
                
        <!-- Recently Browsed -->
        <section class="mb-12" x-data="carousel('recentlyBrowsed')">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Recently Browsed</h2>
                <div class="flex space-x-2">
                    <button @click="scrollLeft()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollLeft()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollLeft()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="scrollRight()" 
                            :class="{'opacity-50 cursor-not-allowed': !canScrollRight()}" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition"
                            :disabled="!canScrollRight()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="relative">
                <div id="recentlyBrowsed" 
                        class="flex overflow-x-auto pb-4 space-x-4 scrollbar-hide">
                    @foreach($recentlyBrowsed as $book)
                        <div class="flex-shrink-0 w-48">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>   
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('carousel', (containerId) => ({
                container: null,
                
                init() {
                    this.container = document.getElementById(containerId);
                    this.container.addEventListener('wheel', (e) => {
                        if (e.deltaY !== 0) {
                            e.preventDefault();
                            this.container.scrollLeft += e.deltaY;
                        }
                    });
                },
        
                scrollLeft() {
                    this.container.scrollBy({ 
                        left: -300, 
                        behavior: 'smooth' 
                    });
                },
        
                scrollRight() {
                    this.container.scrollBy({ 
                        left: 300, 
                        behavior: 'smooth' 
                    });
                },
        
                canScrollLeft() {
                    return true;
                },
        
                canScrollRight() {
                    return this.container.scrollLeft < (this.container.scrollWidth - this.container.clientWidth - 1);
                }
            }));
        });
    </script>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            height: 6px;
        }
        .scrollbar-hide::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }
        .scrollbar-hide::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
    </style>
</x-layout>