<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = $this->db->query("SELECT * FROM posts");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostByID($id) {
        $query = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addPost($title, $content, $userId) {
        $query = $this->db->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");
        return $query->execute(['title' => $title, 'content' => $content, 'user_id' => $userId]);
    }

    public function updatePost($id, $title, $content) {
        $query = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        return $query->execute(['id' => $id, 'title' => $title, 'content' => $content]);
    }

    public function deletePost($id) {
        $query = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}