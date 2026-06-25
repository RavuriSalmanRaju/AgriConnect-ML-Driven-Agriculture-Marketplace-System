<?php
session_start();
include("../config/db.php");

/*
==================================================
AUTO UPDATE MARKET PRICES ONCE EVERY DAY
==================================================
*/

$today = date("Y-m-d");

// Check if today's prices already exist
$check = $conn->query("
SELECT COUNT(*) AS total
FROM market_prices
WHERE price_date='$today'
");

$row = $check->fetch_assoc();

if($row['total'] == 0){

    // Generate new prices for all crops
    $result = $conn->query("
    SELECT crop_name
    FROM crop_master
    ORDER BY crop_name ASC
    ");

    while($crop = $result->fetch_assoc()){

        $crop_name = $crop['crop_name'];

        // Random price between ₹30 and ₹100
        $price = rand(3000,10000)/100;

        $conn->query("
        UPDATE market_prices
        SET
            market_price='$price',
            price_date='$today'
        WHERE crop_name='$crop_name'
        ");

    }

}

/*
==================================================
SHOW MARKET PRICES
==================================================
*/

$result = $conn->query("
SELECT *
FROM market_prices
ORDER BY crop_name ASC
");
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Today's Market Prices</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h2 class="mb-4">
📈 Today's Market Prices
</h2>

<table class="table table-bordered table-striped">

<thead class="table-success">

<tr>

<th>Crop</th>

<th>Market Price (₹/Kg)</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['crop_name']; ?></td>

<td>
₹<?php echo number_format($row['market_price'],2); ?>
</td>

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