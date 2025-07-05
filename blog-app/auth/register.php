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
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 🔐 Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        // 🚫 User already exists
        header("Location: ../index.php?tab=register&error=exists");
        exit();
    }

    // 🔑 Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);

    // 🎯 Redirect to login tab with success flag
    header("Location: ../index.php?tab=login&registered=1");
    exit();
}
?>

<h2>Register</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Register</button>
</form>
</div>
</body>
</html>