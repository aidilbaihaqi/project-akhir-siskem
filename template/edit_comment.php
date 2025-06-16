<?php
session_start();
require_once 'config.php'; // karena ada di folder yang sama

if (!isset($_GET['id'])) {
    die("ID komentar tidak ditemukan.");
}

$comment_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Komentar tidak ditemukan.");
}

$comment = $result->fetch_assoc();

if ($_SESSION['user_id'] != $comment['user_id']) {
    die("Akses ditolak.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Komentar</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h3>Edit Komentar</h3>
    <form action="update_comment.php" method="POST">
        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
        <input type="hidden" name="topic_id" value="<?= $comment['topic_id'] ?>">
        <div class="mb-3">
            <label for="content" class="form-label">Komentar</label>
            <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($comment['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="discussion.php?id=<?= $comment['topic_id'] ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
