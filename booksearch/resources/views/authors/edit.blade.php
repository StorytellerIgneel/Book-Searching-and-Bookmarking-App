<h1>Edit Author</h1>
<form action="{{ route('authors.update', $author ) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type = "hidden" name="id" value="{{ $author->id }}"><br><br>
    <input type = "text" name="name" value="{{ $author->name }}"><br><br>
    <span style="color: red">@error('name'){{ $message }}@enderror</span><br><br>

    <textarea name="bio" placeholder="Type author bio" rows="5" cols="50">{{ $author->bio }}</textarea><br>
    <span style="color: red">@error('bio'){{ $message }}@enderror</span><br><br>

    <input type="file" name="image" required placeholder="Upload author photo"><br><br>
    <span style="color: red">@error('image'){{ $message }}@enderror</span><br>
    <button type = "submit">Edit</button>
</form>