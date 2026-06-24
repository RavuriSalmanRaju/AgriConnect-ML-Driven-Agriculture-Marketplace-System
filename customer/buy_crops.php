```php
<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT crops.*,
               farmers.name AS farmer_name,
               market_prices.market_price
        FROM crops
        JOIN farmers
             ON crops.farmer_id = farmers.farmer_id
        LEFT JOIN market_prices
             ON crops.crop_name = market_prices.crop_name
        WHERE crops.status='AVAILABLE'
        ORDER BY crops.crop_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Buy Crops</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.crop-img{
    height:200px;
    object-fit:cover;
}
</style>

</head>

<body class="bg-light">

<div class="container mt-3 text-end">
    <a href="dashboard.php" class="btn btn-outline-success">
        ⬅ Back
    </a>
</div>

<div class="container my-4">

<h3 class="fw-bold mb-4">
    🛒 Buy Crops
</h3>

<div class="row g-4">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="col-md-4">

<div class="card shadow-sm h-100">

<img src="../uploads/<?php echo $row['crop_image']; ?>"
     class="card-img-top crop-img">

<div class="card-body d-flex flex-column">

<h5 class="fw-bold">
    <?php echo $row['crop_name']; ?>
</h5>

<p>
    <b>Farmer:</b>
    <?php echo $row['farmer_name']; ?>
</p>

<p>
    <b>Farmer Price:</b>
    ₹<?php echo $row['price_per_kg']; ?>/Kg
</p>

<p>
    <b>Market Price:</b>
    <span class="text-primary fw-bold">
        ₹<?php echo $row['market_price']; ?>/Kg
    </span>
</p>

<?php

$marketPrice = floatval($row['market_price']);
$farmerPrice = floatval($row['price_per_kg']);

if($marketPrice > 0){

    if($farmerPrice > $marketPrice){

        echo '<div class="alert alert-danger p-2">
                🔴 Above Market Price
              </div>';

    }
    elseif($farmerPrice < $marketPrice){

        echo '<div class="alert alert-success p-2">
                🟢 Best Deal
              </div>';

    }
    else{

        echo '<div class="alert alert-warning p-2">
                🟡 Market Price
              </div>';
    }
}
?>

<p>
    <b>Available:</b>
    <?php echo $row['quantity']; ?> Kg
</p>

<?php if($row['quantity'] > 0){ ?>

<form action="buy_process.php"
      method="POST"
      class="mt-auto">

<input type="hidden"
       name="crop_id"
       value="<?php echo $row['crop_id']; ?>">

<input type="number"
       name="buy_qty"
       min="1"
       max="<?php echo $row['quantity']; ?>"
       class="form-control mb-2"
       required>

<button class="btn btn-success w-100">
    Buy Now
</button>

</form>

<?php } else { ?>

<span class="badge bg-danger">
    Out of Stock
</span>

<button class="btn btn-secondary w-100 mt-2" disabled>
    Not Available
</button>

<?php } ?>

</div>
</div>
</div>

<?php } ?>

</div>
</div>

</body>
</html>
```
