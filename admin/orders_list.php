<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$filter = $_GET['status'] ?? "ALL";
$search = $_GET['search'] ?? "";
$searchSafe = $conn->real_escape_string($search);

$whereArr = [];

// ✅ Status filter
if($filter != "ALL"){
    $safeStatus = $conn->real_escape_string($filter);
    $whereArr[] = "o.status='$safeStatus'";
}

// ✅ Search filter (Order ID OR Customer Phone)
if($searchSafe != ""){
    $whereArr[] = "(o.order_id LIKE '%$searchSafe%' OR cu.phone LIKE '%$searchSafe%')";
}

$where = "";
if(count($whereArr) > 0){
    $where = "WHERE " . implode(" AND ", $whereArr);
}

// ✅ Orders query
$sql = "
SELECT o.*, cu.name AS customer_name, cu.phone AS customer_phone, cr.crop_name
FROM orders o
JOIN customers cu ON o.customer_id = cu.customer_id
JOIN crops cr ON o.crop_id = cr.crop_id
$where
ORDER BY o.order_id DESC
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Orders List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container my-4">

  <h4 class="fw-bold">📦 Orders List</h4>

  <!-- ✅ Status Filter Buttons -->
  <div class="d-flex gap-2 flex-wrap my-2">
    <a href="orders_list.php?status=ALL" class="btn btn-dark btn-sm">All</a>
    <a href="orders_list.php?status=PLACED" class="btn btn-warning btn-sm">Placed</a>
    <a href="orders_list.php?status=ACCEPTED" class="btn btn-info btn-sm">Accepted</a>
    <a href="orders_list.php?status=DELIVERED" class="btn btn-success btn-sm">Delivered</a>
    <a href="orders_list.php?status=CANCELLED" class="btn btn-danger btn-sm">Cancelled</a>
  </div>

  <!-- ✅ Search Bar -->
  <form method="GET" class="d-flex gap-2 my-3">
    <input type="hidden" name="status" value="<?php echo htmlspecialchars($filter); ?>">
    <input type="text" name="search" class="form-control"
           placeholder="Search Order ID / Customer Phone"
           value="<?php echo htmlspecialchars($search); ?>">
    <button class="btn btn-success">Search</button>
    <a href="orders_list.php" class="btn btn-outline-dark">Reset</a>
  </form>

  <!-- ✅ Orders Table -->
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-success">
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Crop</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Invoice</th>
      </tr>
    </thead>

    <tbody>
      <?php if($result && $result->num_rows > 0){ ?>
        <?php while($row = $result->fetch_assoc()){ ?>
          <tr>
            <td>#<?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_name']; ?> (<?php echo $row['customer_phone']; ?>)</td>
            <td><?php echo $row['crop_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>₹<?php echo $row['total_amount']; ?></td>
            <td><b><?php echo $row['status']; ?></b></td>
            <td><?php echo $row['ordered_at']; ?></td>
            <td>
              <a href="invoice.php?id=<?php echo $row['order_id']; ?>" class="btn btn-sm btn-outline-success">
                Invoice
              </a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="8" class="text-center text-muted">No orders found</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>

</div>
</body>
</html>
