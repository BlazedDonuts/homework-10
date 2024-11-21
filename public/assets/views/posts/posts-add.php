<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container margin-thirty">
        <h2>Add Post</h2>
        <form id="post-form">
            <input type="hidden" id="userId" value="">
            <div class="form-group margin-twenty">
                <label for="postTitle">Title</label>
                <input type="text" class="form-control" id="postTitle" placeholder="Enter Post Title">
            </div>
            <div class="form-group margin-twenty">
                <label for="postContent">Content</label>
                <textarea class="form-control" id="postContent" placeholder="Enter Post Content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary margin-twenty">Submit Post</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Get userId from the query string
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('userId');
            $('#userId').val(userId);

            // Handle form submission
            $('#post-form').on('submit', function (e) {
                e.preventDefault();
                const userId = $('#userId').val();
                const title = $('#postTitle').val();
                const content = $('#postContent').val();

                const data = {
                    userId,
                    title,
                    content,
                };

                $.ajax({
                    url: `http://localhost:8888/api/posts`,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        alert('Post created successfully!');
                        window.location.replace(`/`);
                    },
                    error: function (error) {
                        console.error(error);
                        alert('Failed to create post.');
                    },
                });
            });
        });
    </script>
</body>
</html>
