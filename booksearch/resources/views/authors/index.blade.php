<x-layout>
    <x-header>
        <div class="flex justify-between items-center max-w-5xl mx-auto">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back
            </a>
            <span class="flex-1">Authors List</span>
            @can('access-admin')
                <a href="{{ route('authors.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-200 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Author
                </a>
            @else
                <div class="w-24"></div>
            @endcan
        </div>
    </x-header>
    <div class="max-w-5xl mx-auto mt-6">
        @if ($authors->isEmpty())
            <div class="text-center p-6 bg-white rounded-lg shadow-lg border-l-4 border-yellow-500">
                <h1 class="text-2xl font-bold text-yellow-600 mb-3">No Authors Found</h1>
                <p class="text-yellow-500">Sorry, we couldn't find any authors.</p>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($authors as $author)
                    <x-author-card :author="$author" />
                @endforeach
            </div>
            <div class="mt-6">
                {{ $authors->links() }}
            </div>
        @endif
    </div>
</x-layout>
