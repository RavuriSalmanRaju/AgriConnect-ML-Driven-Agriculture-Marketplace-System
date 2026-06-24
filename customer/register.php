<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Register | AgriConnect</title>

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
      <a class="small-link" href="login.php">Customer Login</a>
    </div>
  </div>
</nav>

<div class="page-wrap">
  <div class="container">
    <div class="row g-4 align-items-stretch">

      <div class="col-lg-7">
        <div class="agri-card">
          <div class="agri-card-header">
            <h2 class="agri-title">Customer Registration</h2>
            <p class="agri-subtitle">Create account to buy crops directly from farmers.</p>
          </div>

          <div class="p-4">
            <form action="register_process.php" method="POST" autocomplete="off">

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Phone Number</label>
                  <input type="text" name="phone" class="form-control" placeholder="10-digit mobile number" required>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control" rows="3" placeholder="Enter delivery address" required></textarea>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Create a secure password" required>
                </div>
              </div>

              <button type="submit" class="btn btn-agri w-100 mt-4">
                Create Account ✅
              </button>

              <div class="text-center mt-3">
                <span class="text-muted">Already registered?</span>
                <a class="small-link" href="login.php">Login here</a>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="side-panel h-100">
          <span class="badge-pill">Customer Benefits</span>
          <h5 class="fw-bold mt-3 mb-2">Fresh Crops 🥬</h5>
          <p class="tip">Buy directly from farmers with best prices and quality.</p>

          <img class="login-img" src="../assets/images/login-farmer.png" alt="Customer Image">

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
