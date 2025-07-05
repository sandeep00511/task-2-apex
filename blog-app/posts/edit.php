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
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$_POST['title'], $_POST['content'], $id]);
    header("Location: index.php");
}
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
?>
<h2>Edit Post</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" value="<?= $post['title'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required><?= $post['content'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
</body>
</html>