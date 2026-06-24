<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cid = $_SESSION['customer_id'];

$conn->query("UPDATE notifications SET is_read=1 WHERE customer_id=$cid");

$result = $conn->query("
    SELECT * FROM notifications
    WHERE customer_id=$cid
    ORDER BY notification_id DESC
");
?>
<!DOCTYPE html>
<html>
<head>
<title>Notifications</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-3">
  <span class="navbar-brand">🔔 Notifications</span>
  <a href="dashboard.php" class="btn btn-outline-light btn-sm">⬅ Back</a>
</nav>

<div class="container my-4">
<div class="card">
<div class="card-body">

<?php if($result->num_rows>0){ ?>
<ul class="list-group">
<?php while($n=$result->fetch_assoc()){ ?>
<li class="list-group-item">
  <?php echo $n['message']; ?>
  <small class="text-muted d-block">
    <?php echo $n['created_at']; ?>
  </small>
</li>
<?php } ?>
</ul>
<?php } else { ?>
<p class="text-muted text-center">No notifications</p>
<?php } ?>

</div>
</div>
</div>

</body>
</html>
