<?php
require '../includes/auth.php';
require '../config/db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
?>