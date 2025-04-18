<x-layout>
    <x-header>Create Book</x-header>
    <form action="/books" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Type book's title" value="{{ old('title') }}"><br>
        <span style="color: red">@error('title'){{ $message }}@enderror</span><br><br>

        <textarea name="synopsis" placeholder="Type book synopsis" rows="5" cols="50">{{ old('synopsis') }}</textarea><br>
        <span style="color: red">@error('synopsis'){{ $message }}@enderror</span><br><br>

        <input type="number" name="author_id" placeholder="Type book author's id" value="{{ old('author_id') }}"><br>
        <span style="color: red">@error('author_id'){{ $message }}@enderror</span><br><br>

        <input type="file" name="cover" required placeholder="Upload book cover"><br><br>
        <span style="color: red">@error('cover'){{ $message }}@enderror</span><br>

        <button type="submit">Create</button>
    </form>
</x-layout>