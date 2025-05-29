<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
require '../config/db.php';
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<a href="create.php">Create New Post</a>
<h2>All Posts</h2>
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
    </div>
<?php endwhile; ?>
