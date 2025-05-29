<?php
session_start();
require 'config/db.php';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mini CMS - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
<a href="auth/logout.php">Logout</a>

<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <h2><?= htmlspecialchars($row['title']) ?></h2>
        <p><?= substr(htmlspecialchars($row['content']), 0, 100) ?>...</p>
        <a href="view.php?id=<?= $row['id'] ?>">Read More</a>
    </div>
<?php endwhile; ?>

</body>
</html>
