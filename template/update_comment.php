<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $content = $_POST['content'];
    $topic_id = intval($_POST['topic_id']);

    // pastikan user adalah pemilik komentar
    $check = $conn->prepare("SELECT user_id FROM comments WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();
    $row = $result->fetch_assoc();

    if ($_SESSION['user_id'] != $row['user_id']) {
        die("Akses ditolak.");
    }

    $stmt = $conn->prepare("UPDATE comments SET content = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("si", $content, $id);
    $stmt->execute();

    header("Location: discussion.php?id=$topic_id");
}
