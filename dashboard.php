<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffeef2;
      font-family: 'Comic Sans MS', cursive;
    }
    .card-box {
      max-width: 500px;
      margin: 60px auto;
      background-color: #fff0f5;
      border: 2px solid #f8bbd0;
      border-radius: 15px;
      padding: 30px;
      text-align: center;
    }
    .btn-pink {
      background-color: #ff69b4;
      color: white;
      border: none;
    }
    .btn-pink:hover {
      background-color: #ff85c1;
    }
    .btn-outline-pink {
      border: 2px solid #ff69b4;
      color: #ff69b4;
      background-color: transparent;
    }
    .btn-outline-pink:hover {
      background-color: #ffebf0;
    }
  </style>
</head>
<body>
  <div class="card-box">
    <h2 class="text-danger">Welcome, <?= ucfirst($_SESSION['role']) ?></h2>
    <a href="index.php" class="btn btn-outline-pink mb-3">🏠 Go to Home</a><br>
    <?php if ($_SESSION["role"] == "admin"): ?>
      <a href="admin_users.php" class="btn btn-pink mb-2">Manage Users</a><br>
      <a href="reports.php" class="btn btn-pink mb-2">View Reports</a>
    <?php elseif ($_SESSION["role"] == "seller"): ?>
      <a href="add_product.php" class="btn btn-pink mb-2">Add Product</a><br>
      <a href="inventory.php" class="btn btn-outline-pink mb-2">Manage Inventory</a>
    <?php endif; ?>
    <br><a href="logout.php" class="btn btn-pink mt-3">Logout</a>
  </div>
</body>
</html>