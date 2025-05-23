<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic_id = $_POST['topic_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];
    $parent_id = isset($_POST['parent_comment_id']) ? $_POST['parent_comment_id'] : NULL;

    $stmt = $conn->prepare("INSERT INTO comments (topic_id, user_id, parent_comment_id, content, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $topic_id, $user_id, $parent_id, $comment);
    $stmt->execute();

    header("Location: ../views/discussion.php?id=$topic_id");
}
?>
