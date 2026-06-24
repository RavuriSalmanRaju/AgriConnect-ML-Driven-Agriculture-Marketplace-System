<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration | AgriConnect</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-farm">

<!-- Navbar -->
<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php" style="color:#198754;">
      🌾 AgriConnect
    </a>
    <div>
      <a class="small-link" href="login.php">Farmer Login</a>
    </div>
  </div>
</nav>

<div class="page-wrap">
  <div class="container">
    <div class="row g-4 align-items-stretch">

      <!-- Left: Registration Card -->
      <div class="col-lg-7">
        <div class="agri-card">
          <div class="agri-card-header">
            <h2 class="agri-title">Farmer Registration</h2>
            <p class="agri-subtitle">Create your account to sell crops & get smart farming support.</p>
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
                  <label class="form-label">Location</label>
                  <input type="text" name="location" class="form-control" placeholder="Village / City" required>
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

      <!-- Right: Extra Info -->
      <div class="col-lg-5">
        <div class="side-panel h-100">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="badge-pill">Why AgriConnect?</span>
            <span class="badge-pill">Secure ✅</span>
          </div>

          <h5 class="fw-bold mb-2">Smart Farming Tools</h5>
          <p class="tip mb-3">
            Get crop recommendations, yield insights, and weather support to make better farming decisions.
          </p>

          <hr>

          <h6 class="fw-bold mb-2">Features for Farmers</h6>
          <ul class="tip">
            <li>Sell crops directly to customers</li>
            <li>Crop & fertilizer guidance</li>
            <li>Weather updates (future scope)</li>
            <li>Better profits (no middlemen)</li>
          </ul>

          <div class="mt-4">
            <a href="../index.php" class="btn btn-outline-success w-100" style="border-radius:12px;">
              ⬅ Back to Home
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
