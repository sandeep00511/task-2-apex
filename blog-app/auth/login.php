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
session_start();
require '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: ../index.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid login!</div>";
    }
}
?>
<h2>Login</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</body>
</html>