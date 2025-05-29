<?php
require 'config/db.php';

if (!isset($_GET['id'])) {
    echo "Invalid post.";
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found.";
    exit;
}
?>

<h1><?= htmlspecialchars($post['title']) ?></h1>
<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
<a href="index.php">Back to Home</a>
