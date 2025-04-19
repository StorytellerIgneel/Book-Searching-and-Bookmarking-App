<x-layout>
    <x-header>Authors List</x-header>
    <div class="max-w-5xl mx-auto mt-6">
        @if(session('success_message'))
        <div style="color: green;">
            {{ session('success_message') }}
        </div>
        @elseif (session("error_message"))
            <div style="color: red;">
                {{ session('error_message') }}
            </div>
        @endif
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