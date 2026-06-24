<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard | AgriConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php" style="color:#198754;">
      🌾 AgriConnect
    </a>

    <div class="d-flex gap-3 align-items-center">
      <span class="fw-semibold text-success">
        👤 <?php echo $_SESSION['customer_name']; ?>
      </span>
      <a href="logout.php" class="btn btn-sm btn-danger" style="border-radius:12px;">
        Logout
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <div class="dash-card mb-4">
    <h3 class="fw-bold mb-1">Customer Dashboard ✅</h3>
    <p class="text-muted mb-0">Buy crops directly from farmers.</p>
  </div>

  <div class="row g-4">

    <!-- ✅ Buy Crops -->
    <div class="col-md-6">
      <div class="dash-card">
        <h5 class="fw-bold">🛒 Buy Crops</h5>
        <p class="text-muted">View available crops and place orders.</p>
        <a href="buy_crops.php" class="btn btn-success w-100 dash-btn">Browse Crops</a>
      </div>
    </div>

    <!-- ✅ My Orders -->
    <div class="col-md-6">
      <div class="dash-card">
        <h5 class="fw-bold">📦 My Orders</h5>
        <p class="text-muted">View your complete order history.</p>
        <a href="my_orders.php" class="btn btn-outline-dark w-100 dash-btn">View Orders</a>
      </div>
    </div>

    <!-- ✅ Chat Support -->
    <div class="col-md-6">
      <div class="dash-card">
        <h5 class="fw-bold">💬 Chat Support</h5>
        <p class="text-muted">Send your issue to admin and get reply.</p>
        <a href="chatbot.php" class="btn btn-outline-dark w-100 dash-btn">
          💬 Chat Support
        </a>
      </div>
    </div>

    <!-- ✅ Delete Account -->
    <div class="col-md-6">
      <div class="dash-card">
        <h5 class="fw-bold text-danger">🗑 Delete Account</h5>
        <p class="text-muted">Deactivate your account permanently.</p>
        <a href="delete_account.php" class="btn btn-danger w-100 dash-btn">
          🗑 Delete Account
        </a>
      </div>
    </div>

  </div>

</div>

</body>
</html>
