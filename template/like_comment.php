<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id']) || !isset($_GET['topic'])) {
    die("Akses tidak valid.");
}

$comment_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];
$topic_id = intval($_GET['topic']);

// Cek apakah user sudah like komentar ini
$cek = $conn->prepare("SELECT id FROM likes WHERE comment_id = ? AND user_id = ?");
$cek->bind_param("ii", $comment_id, $user_id);
$cek->execute();
$cek->store_result();

if ($cek->num_rows === 0) {
    // Tambahkan like
    $like = $conn->prepare("INSERT INTO likes (comment_id, user_id) VALUES (?, ?)");
    $like->bind_param("ii", $comment_id, $user_id);
    $like->execute();
}

// Redirect kembali ke halaman diskusi
header("Location: discussion.php?id=$topic_id");
exit;
