<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cid = $_SESSION['customer_id'];

if(isset($_POST['delete'])){

    // ✅ Deactivate customer (Soft delete)
    $conn->query("UPDATE customers SET status='INACTIVE' WHERE customer_id=$cid");

    // ✅ Logout
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Delete Account</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
<div class="card shadow-sm">
<div class="card-body text-center">

<h4 class="text-danger fw-bold">⚠ Delete / Deactivate Account</h4>
<p class="text-muted">
This will deactivate your account. You will not be able to login again.
</p>

<form method="POST">
    <button type="submit" name="delete" class="btn btn-danger">
        ✅ Yes, Deactivate My Account
    </button>
    <a href="dashboard.php" class="btn btn-secondary">
        ❌ Cancel
    </a>
</form>

</div>
</div>
</div>

</body>
</html>
