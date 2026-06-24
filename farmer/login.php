<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Login | AgriConnect</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-farm">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php" style="color:#198754;">
      🌾 AgriConnect
    </a>
    <div>
      <a class="small-link" href="register.php">Farmer Register</a>
    </div>
  </div>
</nav>

<div class="page-wrap">
  <div class="container">
    <div class="row g-4 align-items-stretch">

      <!-- ✅ Left Login Card -->
      <div class="col-lg-7">
        <div class="agri-card">
          <div class="agri-card-header">
            <h2 class="agri-title">Farmer Login</h2>
            <p class="agri-subtitle">Login to manage your crops and sales.</p>
          </div>

          <div class="p-4">
            <form action="login_process.php" method="POST" autocomplete="off">

              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
              </div>

              <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
              </div>

              <!-- ✅ Forgot Password Link (ADDED ✅) -->
              <div class="text-end mb-3">
                <a class="small-link" href="forgot_password.php">Forgot Password?</a>
              </div>

              <button type="submit" class="btn btn-agri w-100 mt-1">
                Login ✅
              </button>

              <div class="text-center mt-3">
                <span class="text-muted">New Farmer?</span>
                <a class="small-link" href="register.php">Create account</a>
              </div>

            </form>
          </div>
        </div>
      </div>

      <!-- ✅ Right Panel -->
      <div class="col-lg-5">
        <div class="side-panel h-100">
          <span class="badge-pill">Farmer Support</span>

          <h5 class="fw-bold mt-3 mb-2">Welcome Back 👋</h5>
          <p class="tip">
            Login to sell crops directly and get smart recommendations for better farming.
          </p>

          <img class="login-img" src="../assets/images/login-farmer.png" alt="Farmer Illustration">

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
