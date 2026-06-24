<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM farmers WHERE status='INACTIVE' ORDER BY farmer_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deleted Farmers | Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php" style="color:#198754;">🛠 Admin</a>
    <a href="dashboard.php" class="btn btn-outline-success" style="border-radius:12px;">⬅ Back</a>
  </div>
</nav>

<div class="container my-5">
  <div class="dash-card mb-4">
    <h3 class="fw-bold mb-1">🗑 Deleted Farmers</h3>
    <p class="text-muted mb-0">Inactive (deleted) farmers list</p>
  </div>

  <div class="dash-card">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-danger">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Created At</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($result && $result->num_rows > 0) { ?>
            <?php while($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $row['farmer_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="5" class="text-center text-muted">No deleted farmers found ✅</td>
            </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

</body>
</html>
