<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT orders.*, 
               crops.crop_name, crops.crop_image,
               customers.name AS customer_name
        FROM orders
        JOIN crops ON orders.crop_id = crops.crop_id
        JOIN customers ON orders.customer_id = customers.customer_id
        WHERE orders.order_id = $id";

$res = $conn->query($sql);
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Farmer Invoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@media print { button,a{display:none;} }
</style>
</head>

<body class="bg-light">

<div class="container my-4">
<div class="card">
<div class="card-body">

<h4 class="text-center mb-3">🧾 AgriConnect – Farmer Invoice</h4>

<!-- ✅ IMAGE (SAME WORKING PATH) -->
<img src="../uploads/<?php echo $row['crop_image']; ?>"
     style="width:100%;height:220px;object-fit:cover;"
     class="mb-3">

<p><b>Order ID:</b> <?php echo $row['order_id']; ?></p>
<p><b>Customer:</b> <?php echo $row['customer_name']; ?></p>
<p><b>Crop:</b> <?php echo $row['crop_name']; ?></p>
<p><b>Quantity:</b> <?php echo $row['quantity']; ?> Kg</p>
<p><b>Total:</b> ₹<?php echo $row['total_amount']; ?></p>
<p><b>Status:</b> <?php echo $row['status']; ?></p>
<p><b>Date:</b> <?php echo $row['order_date']; ?></p>

<hr>

<button onclick="window.print()" class="btn btn-success">
🖨 Print Invoice
</button>

<a href="orders.php" class="btn btn-secondary">
⬅ Back
</a>

</div>
</div>
</div>

</body>
</html>
