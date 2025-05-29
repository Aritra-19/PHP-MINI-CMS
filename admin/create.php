<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<form method="POST">
    <h2>Create Post</h2>
    <input type="text" name="title" required><br>
    <textarea name="content" required></textarea><br>
    <button type="submit">Save</button>
</form>
