<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

// Total Earnings
$earnings = $conn->query("
    SELECT IFNULL(SUM(orders.total_amount),0) AS total
    FROM orders
    JOIN crops ON orders.crop_id = crops.crop_id
    WHERE crops.farmer_id = $farmer_id
    AND orders.status='DELIVERED'
")->fetch_assoc();

$total_earnings = $earnings['total'] ?? 0;

// Total Quantity Sold
$qty = $conn->query("
    SELECT IFNULL(SUM(orders.quantity),0) AS qty
    FROM orders
    JOIN crops ON orders.crop_id = crops.crop_id
    WHERE crops.farmer_id = $farmer_id
    AND orders.status='DELIVERED'
")->fetch_assoc();

$total_qty = $qty['qty'] ?? 0;

// Delivered Orders
$orders = $conn->query("
    SELECT
        orders.*,
        crops.crop_name,
        customers.name AS customer_name
    FROM orders
    JOIN crops
        ON orders.crop_id = crops.crop_id
    JOIN customers
        ON orders.customer_id = customers.customer_id
    WHERE crops.farmer_id = $farmer_id
    AND orders.status='DELIVERED'
    ORDER BY orders.order_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Farmer Earnings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fa;
}
.card{
    border:none;
}
</style>

</head>
<body>

<nav class="navbar navbar-dark bg-success">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">
            🌾 Farmer Earnings
        </span>

        <a href="dashboard.php" class="btn btn-outline-light">
            ⬅ Back
        </a>
    </div>
</nav>

<div class="container my-4">

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Total Earnings</h4>
                    <h1 class="text-success">
                        ₹<?php echo number_format($total_earnings,2); ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Total Quantity Sold</h4>
                    <h1>
                        <?php echo $total_qty; ?> Kg
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">

            <h4 class="mb-3">
                📦 Delivered Orders
            </h4>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-success">
                        <tr>
                            <th>Order ID</th>
                            <th>Crop</th>
                            <th>Customer</th>
                            <th>Quantity (Kg)</th>
                            <th>Total (₹)</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if($orders && $orders->num_rows > 0){ ?>

                        <?php while($row = $orders->fetch_assoc()){ ?>

                        <tr>
                            <td>#<?php echo $row['order_id']; ?></td>

                            <td>
                                <?php echo $row['crop_name']; ?>
                            </td>

                            <td>
                                <?php echo $row['customer_name']; ?>
                            </td>

                            <td>
                                <?php echo $row['quantity']; ?>
                            </td>

                            <td>
                                ₹<?php echo $row['total_amount']; ?>
                            </td>

                            <td>
                                <?php echo date("d M Y", strtotime($row['created_at'])); ?>
                            </td>
                        </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Delivered Orders Found
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

</body>
</html>