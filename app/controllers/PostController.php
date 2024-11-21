<?php

class PostController {
    private $postModel;

    public function __construct($db) {
        $this->postModel = new Post($db);
    }

    public function listPosts() {
        $posts = $this->postModel->getAllPosts();
        require __DIR__ . "/../../public/assets/views/post/posts-view.php";
    }

    public function addPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $this->postModel->addPost($title, $content);
            header("Location: /posts");
        } else {
            require __DIR__ . "/../../public/assets/views/post/posts-add.php";
        }
    }

    public function updatePost($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $this->postModel->updatePost($id, $title, $content);
            header("Location: /posts");
        } else {
            $post = $this->postModel->getPostByID($id);
            require __DIR__ . "/../../public/assets/views/post/posts-update.php";
        }
    }

    public function deletePost($id) {
        $this->postModel->deletePost($id);
        header("Location: /posts");
    }

    
    public function postsAddView() {
        require __DIR__ . "/../../public/assets/views/post/posts-add.php"; // Load the add post view
    }

    public function postsUpdateView() {
        require __DIR__ . "/../../public/assets/views/post/posts-update.php"; // Load the update post view
    }

    public function postsDeleteView() {
        require __DIR__ . "/../../public/assets/views/post/posts-delete.php"; // Load the delete post view
    }

    public function postsView() {
        require __DIR__ . "/../../public/assets/views/post/posts-view.php"; // Load the view that displays all posts
    }

    public function getPostByID($id) {
        $post = $this->postModel->getPostByID($id); // Call the model's getPostByID method
        require __DIR__ . "/../../public/assets/views/post/posts-view-single.php"; // Display the single post view
    }

    // Define getAllPosts method
    public function getAllPosts() {
        $posts = $this->postModel->getAllPosts(); // Call the model's getAllPosts method
        require __DIR__ . "/../../public/assets/views/post/posts-view.php"; // Display the all posts view
    }

    // Define savePost method
    public function savePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve POST data
            $title = $_POST['title'] ?? null;
            $content = $_POST['content'] ?? null;
            $userId = $_POST['userId'] ?? null;
    
            // Validate input
            if (!$title || !$content || !$userId) {
                http_response_code(400);
                echo json_encode(['error' => 'All fields (title, content, userId) are required.']);
                exit();
            }
    
            // Use the model's addPost method to save the data
            $postId = $this->postModel->addPost($title, $content, $userId); // Ensure `addPost` supports userId
    
            if ($postId) {
                // Respond with the new post ID
                http_response_code(201);
                echo json_encode(['id' => $postId]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to create post.']);
            }
            exit();
        } else {
            // Show the add post view if the request method is not POST
            $this->postsAddView();
        }
    }
    
}
