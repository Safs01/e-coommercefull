<?php
session_start();
include 'db.php';
if ($_SESSION["role"] !== "admin") {
  echo "Access denied!";
  exit;
}

$result = $conn->query("SELECT * FROM users");
echo "<h2>User List</h2>";
echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
while ($row = $result->fetch_assoc()) {
  echo "<tr>
          <td>{$row['user_id']}</td>
          <td>{$row['name']}</td>
          <td>{$row['email']}</td>
          <td>{$row['role']}</td>
        </tr>";
}
echo "</table>";
?>
