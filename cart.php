<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
  $item = [
    'product_id' => $_POST['product_id'],
    'name' => $_POST['name'],
    'price' => $_POST['price']
  ];
  $_SESSION['cart'][] = $item;
  header("Location: cart.php");
  exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['index'])) {
  unset($_SESSION['cart'][$_GET['index']]);
  $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
  header("Location: cart.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Basket</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffeef2;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .btn-pink-1 {
      background-color: #ff69b4;
      color: white;
      border: none;
    }
    .btn-pink-1:hover {
      background-color: #ff85c1;
    }
    .btn-pink-2 {
      background-color: #ffc0cb;
      color: black;
      border: none;
    }
    .btn-pink-2:hover {
      background-color: #ffb6c1;
    }
    .btn-pink-3 {
      background-color: #f8bbd0;
      color: #fff;
      border: none;
    }
    .btn-pink-3:hover {
      background-color: #f48fb1;
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
  <div class="container mt-5">
    <h2 class="mb-4">🛒 Your Basket</h2>
    <table class="table table-bordered bg-white">
      <thead class="table-light">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        if (!empty($_SESSION['cart'])):
          foreach ($_SESSION['cart'] as $index => $item):
            $total += $item['price'];
        ?>
        <tr>
          <td><?= htmlspecialchars($item['name']) ?></td>
          <td>R <?= number_format($item['price'], 2) ?></td>
          <td>
            <a href="cart.php?action=delete&index=<?= $index ?>" class="btn btn-pink-3 btn-sm">Remove</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td><strong>Total</strong></td>
          <td colspan="2">R <?= number_format($total, 2) ?></td>
        </tr>
        <?php else: ?>
        <tr>
          <td colspan="3">Your basket is empty.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?php if ($total > 0): ?>
      <form method="POST" action="checkout_success.php">
        <button class="btn btn-pink-1 mb-3">💳 Pay Now</button>
      </form>
    <?php endif; ?>

    <a href="index.php" class="btn btn-outline-pink">← Back to Home</a>
  </div>
</body>
</html>
