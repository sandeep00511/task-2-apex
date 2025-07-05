<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: posts/index.php");
    exit();
}
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GadgetGyan Blog | Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .card { border-radius: 15px; }
  </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
    <h2 class="text-center mb-4 text-primary">Welcome to <strong>GadgetGyan Blog</strong></h2>

    <!-- 🔁 Login/Register Tabs -->
    <ul class="nav nav-pills nav-fill mb-3" id="authTabs" role="tablist">
      <li class="nav-item">
        <button class="nav-link <?= $tab === 'login' ? 'active' : '' ?>" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button">Login</button>
      </li>
      <li class="nav-item">
        <button class="nav-link <?= $tab === 'register' ? 'active' : '' ?>" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button">Register</button>
      </li>
    </ul>

    <div class="tab-content" id="authTabsContent">
      <!-- 🔐 Login Tab -->
      <div class="tab-pane fade <?= $tab === 'login' ? 'show active' : '' ?>" id="login" role="tabpanel">
        <form method="post" action="auth/login.php">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="index.php?tab=register">Register here</a></p>
      </div>

      <!-- 📝 Register Tab -->
      <div class="tab-pane fade <?= $tab === 'register' ? 'show active' : '' ?>" id="register" role="tabpanel">
        <form method="post" action="auth/register.php">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="index.php?tab=login">Login here</a></p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
