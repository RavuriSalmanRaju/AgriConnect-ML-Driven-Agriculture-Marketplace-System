<?php
session_start();
include("../config/db.php");

$sql = "SELECT crops.*, farmers.name AS farmer_name
        FROM crops
        JOIN farmers ON crops.farmer_id = farmers.farmer_id
        WHERE crops.quantity > 0
        ORDER BY crops.crop_id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Available Crops</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
  <h3 class="fw-bold mb-3">🛒 Available Crops</h3>

  <div class="row g-4">
<?php while($row = $result->fetch_assoc()) { ?>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">

        <!-- ✅ IMAGE FIX (THIS IS THE KEY LINE) -->
        

             <img 
  src="../uploads/<?php echo $row['crop_image']; ?>" 
  alt="Crop Image"
  style="width:100%; height:200px; object-fit:cover;"
>

        <div class="card-body">
          <h5 class="fw-bold"><?php echo $row['crop_name']; ?></h5>
          <p><b>Farmer:</b> <?php echo $row['farmer_name']; ?></p>
          <p><b>Available:</b> <?php echo $row['quantity']; ?> Kg</p>
          <p class="text-success fw-bold">₹<?php echo $row['price_per_kg']; ?> / Kg</p>

          <form action="buy_process.php" method="POST">
            <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>">
            <input type="number" name="quantity"
                   class="form-control mb-2"
                   min="1"
                   max="<?php echo $row['quantity']; ?>"
                   placeholder="Enter quantity (Kg)"
                   required>
            <button class="btn btn-success w-100">Buy Now</button>
          </form>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</div>

</body>
</html>
