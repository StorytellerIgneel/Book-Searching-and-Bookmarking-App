<h1>Edit Book</h1>
<form action = "editAuthor" method="post" enctype="multipart/form-data">
    @csrf
    <input type = "hidden" name="id" value="{{ $book->id }}"><br><br>
    <input type = "text" name="title" value="{{ $book->title }}"><br><br>
    <span style="color: red">@error('name'){{ $message }}@enderror</span><br><br>

    <textarea name="synopsis" placeholder="Type author bio" rows="5" cols="50">{{ $book->synopsis }}</textarea><br>
    <span style="color: red">@error('bio'){{ $message }}@enderror</span><br><br>

    <input type="number" name="author_id" placeholder="Type book author's id" value="{{ $book->author_id }}"><br>
    <span style="color: red">@error('author_id'){{ $message }}@enderror</span><br><br>

    <input type="file" name="cover" required placeholder="Upload book cover"><br><br>
    <span style="color: red">@error('cover'){{ $message }}@enderror</span><br>
    <button type = "submit">Edit</button>
</form>