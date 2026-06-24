<?php
session_start();
include("../config/db.php");

$result = $conn->query("
SELECT *
FROM market_prices
ORDER BY crop_name ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Market Prices</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-4">

<h2 class="mb-4">📈 Today's Market Prices</h2>

<table class="table table-bordered table-striped">

<thead class="table-success">
<tr>
<th>Crop</th>
<th>Market Price (₹/Kg)</th>
<th>Date</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
<td><?php echo $row['crop_name']; ?></td>
<td>₹<?php echo $row['market_price']; ?></td>
<td><?php echo $row['price_date']; ?></td>
</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">
⬅ Back
</a>

</div>

</body>
</html>