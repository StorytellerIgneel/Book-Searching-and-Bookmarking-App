<h1>Create Author</h1>
<form action="createAuthor" method="post">
    @csrf
    <input type="text" name="name" placeholder="Type author's name"><br><br>
    <textarea name="bio" placeholder="Type author bio" rows="5" cols="50"></textarea>
    <input type="file" name="image" required placeholder="Upload author photo">
    <button type="submit">Create</button>
</form>