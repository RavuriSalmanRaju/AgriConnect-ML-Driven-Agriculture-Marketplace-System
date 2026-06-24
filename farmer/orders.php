<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

$sql = "SELECT orders.*, 
               crops.crop_name, crops.crop_image,
               customers.name AS customer_name
        FROM orders
        JOIN crops ON orders.crop_id = crops.crop_id
        JOIN customers ON orders.customer_id = customers.customer_id
        WHERE crops.farmer_id = $farmer_id
        ORDER BY orders.order_id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Farmer Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-4">
<h4>📦 Orders Received</h4>

<table class="table table-bordered table-hover">
<thead class="table-success">
<tr>
<th>ID</th>
<th>Customer</th>
<th>Crop</th>
<th>Qty</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td>#<?php echo $row['order_id']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td><?php echo $row['crop_name']; ?></td>
<td><?php echo $row['quantity']; ?> Kg</td>
<td>₹<?php echo $row['total_amount']; ?></td>

<td>
<span class="badge bg-<?php
if($row['status']=="PLACED") echo "warning";
elseif($row['status']=="ACCEPTED") echo "primary";
elseif($row['status']=="DELIVERED") echo "success";
elseif($row['status']=="CANCELLED") echo "danger";
?>">
<?php echo $row['status']; ?>
</span>
</td>

<td class="d-flex gap-1">

<?php if($row['status']=="PLACED"){ ?>
<a href="update_order_status.php?id=<?php echo $row['order_id']; ?>&status=ACCEPTED"
   class="btn btn-primary btn-sm">
Accept
</a>
<?php } ?>

<?php if($row['status']=="ACCEPTED"){ ?>
<a href="update_order_status.php?id=<?php echo $row['order_id']; ?>&status=DELIVERED"
   class="btn btn-success btn-sm">
Delivered
</a>
<?php } ?>

<!-- 🧾 INVOICE BUTTON -->
<a href="invoice.php?id=<?php echo $row['order_id']; ?>"
   class="btn btn-outline-dark btn-sm">
Invoice
</a>

</td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
</div>

</body>
</html>
