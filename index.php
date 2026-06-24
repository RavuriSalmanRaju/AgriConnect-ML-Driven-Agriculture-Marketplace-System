<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgriConnect | Farmer to Customer Marketplace</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    .hero{
      padding: 70px 0;
    }

    .hero-title{
      font-weight: 900;
      font-size: 46px;
      line-height: 1.1;
      color: #0f5132;
    }

    .hero-sub{
      color: #495057;
      font-size: 16px;
      margin-top: 12px;
      max-width: 560px;
    }

    .hero-card{
      border-radius: 22px;
      background: rgba(255,255,255,0.92);
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 14px 35px rgba(0,0,0,0.10);
      padding: 22px;
    }

    .role-card{
      border-radius: 18px;
      background: rgba(255,255,255,0.95);
      border: 1px solid rgba(0,0,0,0.08);
      box-shadow: 0 12px 30px rgba(0,0,0,0.08);
      padding: 18px;
      height: 100%;
      transition: .2s ease-in-out;
    }
    .role-card:hover{
      transform: translateY(-4px);
    }

    .role-title{
      font-size: 18px;
      font-weight: 800;
      margin-bottom: 8px;
    }

    .mini-text{
      color: #6c757d;
      font-size: 14px;
    }

    .section-title{
      font-weight: 900;
      font-size: 28px;
      color: #0f5132;
    }

    .feature-card{
      border-radius: 18px;
      background: rgba(255,255,255,0.95);
      border: 1px solid rgba(0,0,0,0.08);
      box-shadow: 0 12px 30px rgba(0,0,0,0.08);
      padding: 18px;
      height: 100%;
    }

    .footer{
      padding: 28px 0;
      border-top: 1px solid rgba(0,0,0,0.08);
      background: rgba(255,255,255,0.75);
      backdrop-filter: blur(10px);
    }
  </style>
</head>

<body class="bg-farm">

<!-- ✅ Navbar -->
<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php" style="color:#198754;">
      🌾 AgriConnect
    </a>

    <div class="d-flex gap-3">
      <a class="small-link" href="#roles">Login</a>
      <a class="small-link" href="#features">Features</a>
      <a class="small-link" href="#about">About</a>
    </div>
  </div>
</nav>

<!-- ✅ Hero Section -->
<section class="hero">
  <div class="container">
    <div class="row g-4 align-items-center">

      <div class="col-lg-7">
        <div class="hero-card">
          <h1 class="hero-title">
            Direct Farmer-to-Customer
            <span style="color:#198754;">Crop Marketplace</span>
          </h1>
          <p class="hero-sub">
            AgriConnect helps farmers sell crops directly to customers with better pricing,
            transparency, and fast local availability.
          </p>

          <div class="d-flex gap-3 mt-4 flex-wrap">
            <a href="#roles" class="btn btn-success" style="border-radius:14px; font-weight:800; padding:12px 16px;">
              🚀 Get Started
            </a>
            <a href="#features" class="btn btn-outline-success" style="border-radius:14px; font-weight:800; padding:12px 16px;">
              ✅ Explore Features
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="side-panel h-100">
          <span class="badge-pill">Secure ✅</span>
          <h5 class="fw-bold mt-3 mb-2">Smart Farming Support</h5>
          <p class="tip">
            Farmers can manage crops, customers can buy easily, and admin can monitor everything.
          </p>

          <img class="login-img" src="assets/images/login-farmer.png" alt="AgriConnect">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ✅ Roles Section -->
<section id="roles" class="pb-5">
  <div class="container">
    <h2 class="section-title mb-3">Choose Your Role</h2>
    <p class="mini-text mb-4">Login or Register based on your role</p>

    <div class="row g-4">

      <!-- Farmer -->
      <div class="col-md-4">
        <div class="role-card">
          <div class="role-title">👨‍🌾 Farmer</div>
          <p class="mini-text mb-3">Add crops, manage listings and view customer orders.</p>

          <div class="d-grid gap-2">
            <a href="farmer/login.php" class="btn btn-success" style="border-radius:12px; font-weight:800;">
              Farmer Login
            </a>
            <a href="farmer/register.php" class="btn btn-outline-success" style="border-radius:12px; font-weight:800;">
              Farmer Register
            </a>
          </div>
        </div>
      </div>

      <!-- Customer -->
      <div class="col-md-4">
        <div class="role-card">
          <div class="role-title">👤 Customer</div>
          <p class="mini-text mb-3">Browse crops, buy directly from farmers and track orders.</p>

          <div class="d-grid gap-2">
            <a href="customer/login.php" class="btn btn-success" style="border-radius:12px; font-weight:800;">
              Customer Login
            </a>
            <a href="customer/register.php" class="btn btn-outline-success" style="border-radius:12px; font-weight:800;">
              Customer Register
            </a>
          </div>
        </div>
      </div>

      <!-- Admin -->
      <div class="col-md-4">
        <div class="role-card">
          <div class="role-title">🛠 Admin</div>
          <p class="mini-text mb-3">Monitor farmers, customers and orders across the portal.</p>

          <div class="d-grid gap-2">
            <a href="admin/login.php" class="btn btn-dark" style="border-radius:12px; font-weight:800;">
              Admin Login
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ✅ Features -->
<section id="features" class="pb-5">
  <div class="container">
    <h2 class="section-title mb-3">Platform Features</h2>
    <p class="mini-text mb-4">A complete crop buying & selling system</p>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="feature-card">
          <h5 class="fw-bold">🌾 Crop Management</h5>
          <p class="mini-text mb-0">Farmers can add, editOptional enhancements—search/filter, analytics, delivery tracking, OTP login—can be added later.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card">
          <h5 class="fw-bold">🛒 Easy Buying</h5>
          <p class="mini-text mb-0">Customers can browse crop listings with images and place orders instantly.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card">
          <h5 class="fw-bold">📦 Orders Tracking</h5>
          <p class="mini-text mb-0">Both customer and farmer can view order history in real time.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ✅ About -->
<section id="about" class="pb-5">
  <div class="container">
    <h2 class="section-title mb-3">About AgriConnect</h2>
    <div class="dash-card">
      <p class="mb-2">
        AgriConnect is designed to connect farmers directly with customers to remove middlemen,
        increase profits for farmers, and provide fresh crops to customers at better prices.
      </p>
      <p class="mb-0 text-muted">
        Technology used: PHP, MySQL (XAMPP), HTML, CSS, Bootstrap, JavaScript.
      </p>
    </div>
  </div>
</section>

<!-- ✅ Footer -->
<footer class="footer">
  <div class="container text-center">
    <div class="fw-bold" style="color:#0f5132;">🌾 AgriConnect</div>
    <div class="mini-text">© <?php echo date("Y"); ?> AgriConnect | Project by Salman</div>
  </div>
</footer>

</body>
</html>
