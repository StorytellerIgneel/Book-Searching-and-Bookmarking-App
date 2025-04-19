<h1>Create Author</h1>
<form action="{{ route('authors.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Type author's name" value="{{ old('name') }}"><br>
    <span style="color: red">@error('name'){{ $message }}@enderror</span><br><br>

    <textarea name="bio" placeholder="Type author bio" rows="5" cols="50">{{ old('bio') }}</textarea><br>
    <span style="color: red">@error('bio'){{ $message }}@enderror</span><br><br>

    <input type="file" name="image" required placeholder="Upload author photo"><br><br>
    <span style="color: red">@error('image'){{ $message }}@enderror</span><br>

    <button type="submit">Create</button>
</form>