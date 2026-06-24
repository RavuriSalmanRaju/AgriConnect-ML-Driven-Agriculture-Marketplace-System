```php
<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_name = $_SESSION['farmer_name'] ?? "Farmer";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Farmer Dashboard | AgriConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

<style>

body{
    background:url('../assets/images/farmer-bg.jpg') no-repeat center center;
    background-size:cover;
    min-height:100vh;
}

.dash-card{
    background:#fff;
    border-radius:16px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    height:100%;
}

.dashboard-box{
    background:rgba(255,255,255,0.88);
    padding:25px;
    border-radius:20px;
    backdrop-filter:blur(3px);
}

</style>

</head>
<body>

<nav class="navbar agri-navbar py-3">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#" style="color:#198754;">
            🌾 AgriConnect
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold">
                👨‍🌾 <?php echo htmlspecialchars($farmer_name); ?>
            </span>

            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>

    </div>
</nav>

<div class="container my-5">

<div class="dashboard-box">

    <div class="mb-4">
        <h2 class="fw-bold">
            Farmer Dashboard ✅
        </h2>

        <p class="text-muted">
            Manage your crops, orders, earnings and crop suggestions.
        </p>
    </div>

    <div class="row g-4">

        <!-- ADD CROPS -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">➕ Add Crops</h5>
                <p class="text-muted">Upload new crops for sale</p>

                <a href="add_crop.php" class="btn btn-success w-100">
                    Add Crop
                </a>
            </div>
        </div>

        <!-- MY CROPS -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">🌱 My Crop Listings</h5>
                <p class="text-muted">View & manage your crops</p>

                <a href="my_crops.php" class="btn btn-outline-success w-100">
                    View Crops
                </a>
            </div>
        </div>

        <!-- ORDERS -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">📦 Orders</h5>
                <p class="text-muted">Accept & deliver orders</p>

                <a href="orders.php" class="btn btn-outline-dark w-100">
                    View Orders
                </a>
            </div>
        </div>

        <!-- EARNINGS -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">💰 Earnings</h5>
                <p class="text-muted">Total income & sold quantity</p>

                <a href="earnings.php" class="btn btn-success w-100">
                    View Earnings
                </a>
            </div>
        </div>

        <!-- EARNINGS CHART -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">📊 Earnings Chart</h5>
                <p class="text-muted">View daily earnings graph</p>

                <a href="earnings_chart.php" class="btn btn-outline-success w-100">
                    View Chart
                </a>
            </div>
        </div>

        <!-- AUTO WEATHER + ML -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">🌍 Auto Weather + ML</h5>

                <p class="text-muted">
                    City → Weather → Crop Prediction
                </p>

                <a href="weather_ml_api.php" class="btn btn-outline-success w-100">
                    Auto Predict
                </a>
            </div>
        </div>

<!-- MARKET PRICES -->
<div class="col-md-4">
    <div class="dash-card text-center">
        <h5 class="fw-bold">📈 Market Prices</h5>

        <p class="text-muted">
            View today's market crop prices
        </p>

        <a href="market_prices.php" class="btn btn-warning w-100">
            View Prices
        </a>
    </div>
</div>
        <!-- CHAT SUPPORT -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold">💬 Chat Support</h5>
                <p class="text-muted">Send your queries to Admin</p>

                <a href="chatbot.php" class="btn btn-outline-dark w-100">
                    Open Chat Support
                </a>
            </div>
        </div>

        <!-- DELETE ACCOUNT -->
        <div class="col-md-4">
            <div class="dash-card text-center">
                <h5 class="fw-bold text-danger">
                    🗑 Delete Account
                </h5>

                <p class="text-muted">
                    Deactivate your account permanently
                </p>

                <a href="delete_account.php" class="btn btn-danger w-100">
                    Delete Account
                </a>
            </div>
        </div>

    </div>

</div>

</div>

</body>
</html>
```
