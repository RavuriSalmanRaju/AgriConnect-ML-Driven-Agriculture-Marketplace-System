<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cid = $_SESSION['customer_id'];

$sql = "SELECT orders.*, crops.crop_name, crops.crop_image
        FROM orders 
        JOIN crops ON orders.crop_id = crops.crop_id
        WHERE orders.customer_id = $cid
        ORDER BY orders.order_id DESC";

$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3 text-end">
  <a href="dashboard.php" class="btn btn-outline-success">⬅ Back</a>
</div>

<div class="container my-4">
<h4>📦 My Orders</h4>

<div class="row g-4">
<?php while($row = $res->fetch_assoc()){
$status = strtoupper(trim($row['status']));
?>

<div class="col-md-6">
<div class="card shadow-sm h-100">

<!-- ✅ IMAGE (WORKING PATH) -->
<img src="../uploads/<?php echo $row['crop_image']; ?>"
     class="card-img-top"
     style="height:200px;object-fit:cover;">

<div class="card-body d-flex flex-column">

<h5><?php echo $row['crop_name']; ?></h5>
<p>Quantity: <?php echo $row['quantity']; ?> Kg</p>
<p>Total: ₹<?php echo $row['total_amount']; ?></p>

<span class="badge bg-<?php
if($status=="PLACED") echo "warning";
elseif($status=="ACCEPTED") echo "primary";
elseif($status=="DELIVERED") echo "success";
elseif($status=="CANCELLED") echo "danger";
?>">
<?php echo $status; ?>
</span>

<!-- ✅ ACTION BUTTONS -->
<div class="mt-3 d-flex gap-2">

<!-- 🧾 INVOICE BUTTON (FIXED) -->
<a href="invoice.php?id=<?php echo $row['order_id']; ?>"
   class="btn btn-outline-dark btn-sm">
🧾 Invoice
</a>

<!-- ❌ CANCEL ONLY IF PLACED -->
<?php if($status=="PLACED"){ ?>
<a href="cancel_order.php?id=<?php echo $row['order_id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Cancel this order?');">
Cancel
</a>
<?php } ?>

</div>

</div>
</div>
</div>

<?php } ?>
</div>
</div>

</body>
</html>
