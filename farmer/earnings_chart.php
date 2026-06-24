<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$fid = $_SESSION['farmer_id'];

$mode = $_GET['mode'] ?? "daily";
$mode = ($mode == "monthly") ? "monthly" : "daily";

if($mode == "monthly"){

    $sql = "
    SELECT DATE_FORMAT(o.created_at, '%Y-%m') AS label,
           IFNULL(SUM(o.total_amount),0) AS total
    FROM orders o
    JOIN crops cr ON o.crop_id = cr.crop_id
    WHERE cr.farmer_id = $fid
      AND o.status='DELIVERED'
    GROUP BY DATE_FORMAT(o.created_at, '%Y-%m')
    ORDER BY label ASC
    ";

    $chartTitle = "Monthly Earnings Chart (Delivered Orders)";

} else {

    $sql = "
    SELECT DATE(o.created_at) AS label,
           IFNULL(SUM(o.total_amount),0) AS total
    FROM orders o
    JOIN crops cr ON o.crop_id = cr.crop_id
    WHERE cr.farmer_id = $fid
      AND o.status='DELIVERED'
    GROUP BY DATE(o.created_at)
    ORDER BY label ASC
    ";

    $chartTitle = "Daily Earnings Chart (Delivered Orders)";
}

$res = $conn->query($sql);

$labels = [];
$values = [];

if($res){
    while($r = $res->fetch_assoc()){
        $labels[] = $r['label'];
        $values[] = $r['total'];
    }
}
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>Earnings Chart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-light">

<div class="container my-4">

<h4 class="fw-bold"><?php echo $chartTitle; ?></h4>

<div class="d-flex gap-2 mb-3">

<a href="earnings_chart.php?mode=daily"
class="btn btn-sm <?php echo ($mode=="daily") ? "btn-success" : "btn-outline-success"; ?>">
Daily </a>

<a href="earnings_chart.php?mode=monthly"
class="btn btn-sm <?php echo ($mode=="monthly") ? "btn-success" : "btn-outline-success"; ?>">
Monthly </a>

</div>

<div class="card shadow-sm">
<div class="card-body">
<canvas id="earnChart" height="100"></canvas>
</div>
</div>

<a href="dashboard.php" class="btn btn-secondary mt-3">Back</a>

</div>

<script>

const ctx = document.getElementById('earnChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Earnings',
            data: <?php echo json_encode($values); ?>,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

</body>
</html>
