<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>SA C-2-C E-Commerce Platform</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffeef2;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .navbar {
      background-color: #ffc0cb !important;
    }
    .product-card {
      background-color: #fff0f5;
      border: 2px solid #f8bbd0;
      border-radius: 12px;
      margin-bottom: 20px;
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
      background: transparent;
    }
    .btn-outline-pink:hover {
      background-color: #ffebf0;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SA E-Commerce</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="cart.php">🛒 Basket (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)</a></li>
        <?php if (!isset($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<header class="text-white text-center py-5" style="background-color:#ff85c1;">
  <div class="container">
    <h1>Buy and Sell with Ease in South Africa</h1>
    <p class="lead">Empowering informal traders with digital access</p>
  </div>
</header>

<!-- Search -->
<div class="container mt-4">
  <form class="d-flex mb-4" method="GET" action="index.php">
    <input type="text" class="form-control me-2" name="search" placeholder="Search products..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button class="btn btn-outline-pink me-2" type="submit">Search</button>
    <a href="index.php" class="btn btn-outline-danger">Clear</a>
  </form>
</div>

<!-- Products -->
<div class="container">
  <div class="row">
    <?php
      include 'db.php';

      $search = $_GET['search'] ?? '';
      $limit = 6;
      $page = $_GET['page'] ?? 1;
      $offset = ($page - 1) * $limit;

      $query = "SELECT * FROM products WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die("Query failed: " . mysqli_error($conn));
      }

      $count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products WHERE name LIKE '%$search%'");
      $count_data = mysqli_fetch_assoc($count_result);
      $total_pages = ceil($count_data['total'] / $limit);

      while ($row = mysqli_fetch_assoc($result)):
    ?>
    <div class="col-md-4">
      <div class="card product-card">
        <img src="uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
          <p class="card-text">R <?= number_format($row['price'], 2) ?></p>

          <!-- Add to Basket -->
          <form method="POST" action="cart.php?action=add" class="d-inline">
            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
            <input type="hidden" name="name" value="<?= $row['name'] ?>">
            <input type="hidden" name="price" value="<?= $row['price'] ?>">
            <button type="submit" class="btn btn-pink btn-sm">🛒 Add to Basket</button>
          </form>

          <!-- View -->
          <a href="product.php?id=<?= $row['product_id'] ?>" class="btn btn-outline-pink btn-sm">View</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <!-- Pagination -->
  <div class="text-center mt-4">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="btn btn-outline-secondary mx-1"><?= $i ?></a>
    <?php endfor; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 SA C-2-C E-Commerce. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
