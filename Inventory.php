<?php
session_start();
include 'db.php';
if ($_SESSION["role"] !== "seller") {
  echo "Access denied!";
  exit;
}
$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT * FROM products WHERE seller_id = $user_id");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Inventory</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#ffeef2; font-family:'Comic Sans MS', cursive;">
  <div class="container mt-5">
    <a href="dashboard.php" class="btn btn-outline-secondary mb-3">← Back to Dashboard</a>
    <h2>Your Inventory</h2>
    <table class="table table-bordered">
      <thead>
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['product_id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td>R <?= $row['price'] ?></td>
          <td>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $row['product_id'] ?>">
              Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="confirmDelete<?= $row['product_id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" action="delete_product.php">
                    <div class="modal-header">
                      <h5 class="modal-title">Confirm Delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete <strong><?= $row['name'] ?></strong>?
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="id" value="<?= $row['product_id'] ?>">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
