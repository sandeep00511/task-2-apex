<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<?php
require '../includes/auth.php';
require '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$_POST['title'], $_POST['content']]);
    header("Location: index.php");
}
?>
<h2>Add New Post</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Post</button>
</form>
</div>
</body>
</html>