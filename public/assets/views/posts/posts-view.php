<h1>Posts</h1>
<a href="/posts/add">Add New Post</a>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <?= htmlspecialchars($post['title']) ?>
            <a href="/posts/edit/<?= $post['id'] ?>">Edit</a>
            <a href="/posts/delete/<?= $post['id'] ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>