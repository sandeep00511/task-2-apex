<?php
require '../includes/auth.php';
require '../config/db.php';

// 🔍 Handle search and date
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$date = isset($_GET['date']) ? trim($_GET['date']) : '';

if ($search || $date) {
    $sql = "SELECT * FROM posts WHERE 1=1";
    $params = [];

    if ($search) {
        $sql .= " AND title LIKE :search";
        $params['search'] = "%$search%";
    }
    if ($date) {
        $sql .= " AND DATE(created_at) = :date";
        $params['date'] = $date;
    }

    $sql .= " ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
} else {
    $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
}

$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog Posts | GadgetGyan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- 🔝 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid px-4">
    <span class="navbar-brand">GadgetGyan Blog</span>
    <div class="d-flex">
      <span class="text-white me-3 mt-2">Welcome, <?= $_SESSION['user'] ?></span>
      <a href="../logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>

<!-- 📝 Main Content -->
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Blog Posts</h2>
    <a class="btn btn-success" href="create.php">+ Add New Post</a>
  </div>

  <!-- 🔍 Search + Date Filter Form -->
  <form method="get" class="mb-3">
    <div class="row g-2">
      <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Search by title..." value="<?= htmlspecialchars($search) ?>">
      </div>
      <div class="col-md-4">
        <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>">
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100" type="submit">Filter</button>
      </div>
    </div>
  </form>

  <!-- 📋 Table -->
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php if (count($posts) === 0): ?>
      <tr><td colspan="3" class="text-center text-muted">No posts found.</td></tr>
    <?php else: ?>
      <?php foreach ($posts as $post): ?>
      <tr>
        <td><?= htmlspecialchars($post['title']) ?></td>
        <td><?= $post['created_at'] ?></td>
        <td>
          <a class="btn btn-sm btn-warning" href="edit.php?id=<?= $post['id'] ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $post['id'] ?>">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
