<x-layout>
    <x-header>Book Details</x-header>
    <h2> {{ $book->name }}</h2>

    {{-- Rating Form --}}
    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <select name="rating" onchange="this.form.submit()">
            <option value="1" {{ $userRating == 1 ? 'selected' : '' }}>1 Star</option>
            <option value="2" {{ $userRating == 2 ? 'selected' : '' }}>2 Stars</option>
            <option value="3" {{ $userRating == 3 ? 'selected' : '' }}>3 Stars</option>
            <option value="4" {{ $userRating == 4 ? 'selected' : '' }}>4 Stars</option>
            <option value="5" {{ $userRating == 5 ? 'selected' : '' }}>5 Stars</option>
        </select>
    </form>

    {{-- Favourite Button --}}
    @if($isFavourite)
        <form action="{{ route('favourites.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit">❤️ Remove Favourite</button>
        </form>
    @else
        <form action="{{ route('favourites.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit">♡ Add Favourite</button>
        </form>
    @endif
</x-layout>