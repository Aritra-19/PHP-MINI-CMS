<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Invalid request";
    exit;
}

$id = $_GET['id'];

// Handle update form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}

// Fetch the post
$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found!";
    exit;
}
?>

<form method="POST">
    <h2>Edit Post</h2>
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
    <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea><br>
    <button type="submit">Update</button>
</form>
