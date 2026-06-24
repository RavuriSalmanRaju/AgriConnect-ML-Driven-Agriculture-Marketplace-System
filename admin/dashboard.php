<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/*
✅ orders table lo farmer_id ledu
So: orders.crop_id -> crops.crop_id -> crops.farmer_id
Also: ACTIVE customers + ACTIVE farmers only count
*/

// ✅ TOTAL ORDERS (ACTIVE customer + ACTIVE farmer)
$totalOrders = $conn->query("
    SELECT COUNT(*) AS c
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE cu.status='ACTIVE' AND fa.status='ACTIVE'
")->fetch_assoc()['c'];

// ✅ TOTAL SALES (DELIVERED ONLY) (ACTIVE customer + ACTIVE farmer)
$totalSales = $conn->query("
    SELECT IFNULL(SUM(o.total_amount),0) AS s
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE o.status='DELIVERED'
    AND cu.status='ACTIVE'
    AND fa.status='ACTIVE'
")->fetch_assoc()['s'];

// ✅ PENDING ORDERS (PLACED / ACCEPTED)
$pendingOrders = $conn->query("
    SELECT COUNT(*) AS c
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE o.status IN ('PLACED','ACCEPTED')
    AND cu.status='ACTIVE'
    AND fa.status='ACTIVE'
")->fetch_assoc()['c'];

// ✅ DELIVERED
$deliveredOrders = $conn->query("
    SELECT COUNT(*) AS c
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE o.status='DELIVERED'
    AND cu.status='ACTIVE'
    AND fa.status='ACTIVE'
")->fetch_assoc()['c'];

// ✅ CANCELLED
$cancelledOrders = $conn->query("
    SELECT COUNT(*) AS c
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE o.status='CANCELLED'
    AND cu.status='ACTIVE'
    AND fa.status='ACTIVE'
")->fetch_assoc()['c'];


// ✅ NEW ORDER BADGE COUNT (Placed orders only) - ACTIVE users only
$newOrders = $conn->query("
    SELECT COUNT(*) AS c
    FROM orders o
    JOIN customers cu ON o.customer_id = cu.customer_id
    JOIN crops cr ON o.crop_id = cr.crop_id
    JOIN farmers fa ON cr.farmer_id = fa.farmer_id
    WHERE o.status='PLACED'
    AND cu.status='ACTIVE'
    AND fa.status='ACTIVE'
")->fetch_assoc()['c'];


// ✅ NEW SUPPORT TICKETS BADGE COUNT
// NOTE: status value may be 'PENDING' or 'OPEN' in your table.
// Default PENDING, if not working change to OPEN.
$newTickets = 0;
$checkTicketTable = $conn->query("SHOW TABLES LIKE 'support_tickets'");
if($checkTicketTable && $checkTicketTable->num_rows > 0){
    $newTickets = $conn->query("SELECT COUNT(*) AS c FROM support_tickets WHERE status='PENDING'")->fetch_assoc()['c'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-3">
  <span class="navbar-brand fw-bold">🛠 Admin Dashboard</span>
  <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
</nav>

<div class="container my-4">

  <div class="row g-4">

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6>Total Orders</h6>
          <h2><?php echo $totalOrders; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6>Total Sales</h6>
          <h2>₹<?php echo $totalSales; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6>Pending Orders</h6>
          <h2><?php echo $pendingOrders; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6>Delivered</h6>
          <h2><?php echo $deliveredOrders; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6>Cancelled</h6>
          <h2><?php echo $cancelledOrders; ?></h2>
        </div>
      </div>
    </div>

  </div>

  <hr class="my-4">

  <div class="d-flex gap-2 flex-wrap">

    <!-- ✅ Orders button with badge -->
    <a href="orders_list.php" class="btn btn-success position-relative">
      📦 View All Orders
      <?php if($newOrders > 0){ ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo $newOrders; ?>
        </span>
      <?php } ?>
    </a>

    <a href="customers_list.php" class="btn btn-outline-success">
      👤 Customers List
    </a>

    <a href="farmers_list.php" class="btn btn-outline-success">
      👨‍🌾 Farmers List
    </a>

    <a href="deleted_customers.php" class="btn btn-outline-danger">
      🗑 Deleted Customers
    </a>

    <a href="deleted_farmers.php" class="btn btn-outline-danger">
      🗑 Deleted Farmers
    </a>

    <!-- ✅ Support Tickets button with badge -->
    <a href="support_tickets.php" class="btn btn-outline-dark position-relative">
      💬 Support Tickets
      <?php if($newTickets > 0){ ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo $newTickets; ?>
        </span>
      <?php } ?>
    </a>

  </div>

</div>

</body>
</html>
