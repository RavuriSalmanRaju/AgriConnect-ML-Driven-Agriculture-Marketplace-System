<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: my_crops.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$crop_id = $_GET['id'];

$sql = "SELECT * FROM crops
        WHERE crop_id='$crop_id'
        AND farmer_id='$farmer_id'";

$result = $conn->query($sql);

if ($result->num_rows != 1) {
    echo "<h3 style='color:red;'>Crop not found or Access Denied ❌</h3>";
    echo "<a href='my_crops.php'>Go Back</a>";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Crop | AgriConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">

```
<a class="navbar-brand fw-bold"
   href="dashboard.php"
   style="color:#198754;">
  🌾 AgriConnect
</a>

<a href="my_crops.php"
   class="btn btn-outline-success"
   style="border-radius:12px;">
   ⬅ Back
</a>
```

  </div>
</nav>

<div class="container my-5">

  <div class="agri-card">

```
<div class="agri-card-header">
  <h2 class="agri-title">Edit Crop</h2>
  <p class="agri-subtitle">
    Update your crop details.
  </p>
</div>

<div class="p-4">

  <form action="edit_crop_process.php" method="POST">

    <input type="hidden"
           name="crop_id"
           value="<?php echo $row['crop_id']; ?>">

    <div class="row g-3">

      <div class="col-md-12">

        <label class="form-label">
          Crop Name
        </label>

        <input type="text"
               name="crop_name"
               class="form-control"
               value="<?php echo $row['crop_name']; ?>"
               readonly>

      </div>

      <div class="col-md-6">

        <label class="form-label">
          Quantity (Kg)
        </label>

        <input type="number"
               name="quantity"
               class="form-control"
               value="<?php echo $row['quantity']; ?>"
               required>

      </div>

      <div class="col-md-6">

        <label class="form-label">
          Price per Kg (₹)
        </label>

        <input type="number"
               step="0.01"
               id="price_per_kg"
               name="price_per_kg"
               class="form-control"
               value="<?php echo $row['price_per_kg']; ?>"
               required>

      </div>

      <div class="col-md-12">

        <div class="alert alert-info">

          Today's Market Price:
          <strong>
            ₹<span id="marketPrice">Loading...</span>/Kg
          </strong>

        </div>

        <div class="alert alert-danger"
             id="warningBox"
             style="display:none;">

          ⚠ Warning!
          You cannot sell above today's market price.

        </div>

      </div>

    </div>

    <button type="submit"
            class="btn btn-agri w-100 mt-4">

      Update Crop ✅

    </button>

  </form>

</div>
```

  </div>

</div>

<script>

let cropName =
"<?php echo $row['crop_name']; ?>";

fetch("get_market_price.php?crop=" +
      encodeURIComponent(cropName))

.then(response => response.text())

.then(price => {

    document.getElementById("marketPrice")
            .innerHTML = price;

    let marketPrice = parseFloat(price);

    function checkPrice(){

        let farmerPrice =
        parseFloat(
            document.getElementById("price_per_kg").value
        );

        if(farmerPrice > marketPrice){

            document.getElementById("warningBox")
                    .style.display = "block";

        }else{

            document.getElementById("warningBox")
                    .style.display = "none";

        }
    }

    checkPrice();

    document.getElementById("price_per_kg")
            .addEventListener("input", checkPrice);

});

</script>

</body>
</html>
