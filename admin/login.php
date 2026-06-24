<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | AgriConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-farm">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php" style="color:#198754;">
      🌾 AgriConnect
    </a>
    <a class="small-link" href="../index.php">Home</a>
  </div>
</nav>

<div class="page-wrap">
  <div class="container">
    <div class="row g-4 align-items-stretch">

      <div class="col-lg-7">
        <div class="agri-card">
          <div class="agri-card-header">
            <h2 class="agri-title">Admin Login</h2>
            <p class="agri-subtitle">Login to manage Farmers, Customers and Orders.</p>
          </div>

          <div class="p-4">
            <form action="login_process.php" method="POST">

              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
              </div>

              <button class="btn btn-agri w-100 mt-2" type="submit">
                Login ✅
              </button>

              <div class="text-center mt-3">
                <small class="text-muted">Default: admin / admin123</small>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="side-panel h-100">
          <span class="badge-pill">Admin Panel</span>
          <h5 class="fw-bold mt-3 mb-2">Portal Control ⚙️</h5>
          <p class="tip">Manage all users and orders from one place.</p>

          <img class="login-img" src="../assets/images/login-farmer.png" alt="Admin">

          <a href="../index.php" class="btn btn-outline-success w-100 mt-3" style="border-radius:12px;">
            ⬅ Back to Home
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
