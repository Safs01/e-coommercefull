<?php
session_start();
include 'db.php';

if ($_SESSION["role"] !== "seller") {
  echo "Access denied!";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $desc = $_POST["description"];
  $price = $_POST["price"];
  $image = $_FILES["image"]["name"];
  $temp = $_FILES["image"]["tmp_name"];

  // Create uploads folder if it doesn't exist
  if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
  }

  // Move uploaded image to the 'uploads/' folder
  move_uploaded_file($temp, "uploads/" . $image);

  $seller = $_SESSION["user_id"];
  $stmt = $conn->prepare("INSERT INTO products (seller_id, name, description, price, image) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("issds", $seller, $name, $desc, $price, $image);
  $stmt->execute();
  $new_id = $conn->insert_id;

  echo "<div class='alert alert-success'>Product added successfully!</div>";
  echo "<a href='index.php' class='btn btn-outline-primary'>✅ Done</a>";
  echo "<a href='product.php?id=$new_id' class='btn btn-outline-secondary ms-2'>👁 View Product</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffeef2;
      font-family: 'Comic Sans MS', cursive;
    }
    .container {
      max-width: 600px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <a href="dashboard.php" class="btn btn-outline-secondary mb-3">← Back to Dashboard</a>
    <h2 class="text-danger text-center">Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <input name="name" class="form-control" placeholder="Product Name" required>
      </div>
      <div class="mb-3">
        <textarea name="description" class="form-control" placeholder="Description" required></textarea>
      </div>
      <div class="mb-3">
        <input name="price" type="number" step="0.01" class="form-control" placeholder="Price" required>
      </div>
      <div class="mb-3">
        <input name="image" type="file" class="form-control" accept="image/*" required>
        <small class="form-text text-muted">Upload a product image (JPEG, PNG, etc.)</small>
      </div>
      <button type="submit" class="btn btn-primary w-100">Add Product</button>
    </form>
  </div>
</body>
</html>
