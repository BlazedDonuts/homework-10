<h1>Edit Post</h1>
<form method="POST" action="/posts/edit/<?= $post['id'] ?>">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    <br>
    <label>Content:</label>
    <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
    <br>
    <button type="submit">Update Post</button>
</form>
