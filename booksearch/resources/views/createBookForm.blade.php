<h1>Add book</h1>
<form action="addBook" method="post">
    @csrf
    <input type="text" name="name" placeholder="Type book name"><br><br>
    <textarea name="synopsis" placeholder="Type book synopsis" rows="5" cols="50"></textarea>
    <input type="file" name="image" required placeholder="Upload book cover page">
    <button type="submit">Add</button>
</form>