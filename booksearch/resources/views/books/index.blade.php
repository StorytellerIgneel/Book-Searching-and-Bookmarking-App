<x-layout>
    <x-header>Books List</x-header>
    <div class="max-w-5xl mx-auto mt-6">
        @if ($books->isEmpty())
            <div class="text-center p-6 bg-white rounded-lg shadow-lg border-l-4 border-yellow-500">
                <h1 class="text-2xl font-bold text-yellow-600 mb-3">No Books Found</h1>
                <p class="text-yellow-500">Sorry, we couldn't find any books.</p>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
            <div class="mt-6">
                {{ $books->links() }}
            </div>
        @endif
</x-layout>