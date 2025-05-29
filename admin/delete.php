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

$stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>