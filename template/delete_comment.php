<?php
session_start();
require_once 'config.php';

if (!isset($_GET['id']) || !isset($_GET['topic'])) {
    die("Data tidak lengkap.");
}

$comment_id = intval($_GET['id']);
$topic_id = intval($_GET['topic']);

// pastikan user adalah pemilik komentar
$check = $conn->prepare("SELECT user_id FROM comments WHERE id = ?");
$check->bind_param("i", $comment_id);
$check->execute();
$result = $check->get_result();
$row = $result->fetch_assoc();

if ($_SESSION['user_id'] != $row['user_id']) {
    die("Akses ditolak.");
}

$stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();

header("Location: discussion.php?id=$topic_id");
