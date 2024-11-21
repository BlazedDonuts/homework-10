<?php
require_once "../app/models/Model.php";
require_once "../app/models/User.php";
require_once "../app/models/Post.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/PostController.php";

//set our env variables
$env = parse_ini_file('../.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

use app\controllers\UserController;

//get uri without query strings
$uri = strtok($_SERVER["REQUEST_URI"], '?');

//get uri pieces
$uriArray = explode("/", $uri);
//0 = ""
//1 = users
//2 = 1


//get all or a single user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    //only id
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $userController = new UserController();

    if ($id) {
        $userController->getUserByID($id);
    } else {
        $userController->getAllUsers();
    }
}

//get all/single posts
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $postController = new PostController($db); 
    if ($id) {
        $postController->getPostByID($id);  
    } else {
        $postController->getAllPosts();  
    }
}

//save user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $userController->saveUser();
}

//save new post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController = new PostController($db); 
    $postController->savePost(); 
}

//update user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $userController = new UserController();
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $userController->updateUser($id);
}

//update post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $postController = new PostController($db);
    $postController->updatePost($id); 
}

//delete user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $userController = new UserController();
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $userController->deleteUser($id);
}

//delete post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $postController = new PostController($db); 
    $postController->deletePost($id);  
}

//views


if ($uri === '/users-add' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController = new UserController();
    $userController->usersAddView();
}

if ($uriArray[1] === 'users-update' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController = new UserController();
    $userController->usersUpdateView();
}

if ($uriArray[1] === 'users-delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController = new UserController();
    $userController->usersDeleteView();
}

if ($uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController = new UserController();
    $userController->usersView();
}

//view for adding new post
if ($uri === '/posts-add' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController($db); 
    $postController->postsAddView();  
}

// View for updating post
if ($uriArray[1] === 'posts-update' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController($db); 
    $postController->postsUpdateView(); 
}

// View for deleting post
if ($uriArray[1] === 'posts-delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController($db);
    $postController->postsDeleteView();  
}

// View for displaying posts
if ($uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController($db); // Pass DB connection
    $postController->postsView();  
}

include '../public/assets/views/notFound.html';
exit();



