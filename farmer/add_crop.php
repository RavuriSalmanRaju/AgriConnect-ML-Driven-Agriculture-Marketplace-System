<?php
session_start();

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Crop | AgriConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">

    <a class="navbar-brand fw-bold"
       href="dashboard.php"
       style="color:#198754;">
       🌾 AgriConnect
    </a>

    <a href="dashboard.php"
       class="btn btn-outline-success"
       style="border-radius:12px;">
       ⬅ Back
    </a>

  </div>
</nav>

<div class="container my-5">

  <div class="agri-card">

    <div class="agri-card-header">
      <h2 class="agri-title">Add Crop</h2>
      <p class="agri-subtitle">
        Post your crop to sell directly to customers.
      </p>
    </div>

    <div class="p-4">

      <form action="add_crop_process.php"
            method="POST"
            enctype="multipart/form-data">

        <div class="row g-3">

          <!-- Crop Name -->
          <div class="col-md-6">

            <label class="form-label">
              Crop Name
            </label>

            <select name="crop_name"
                    id="crop_name"
                    class="form-control"
                    required>

              <option value="">
                Select Crop
              </option>

              <?php
              $cropList = $conn->query("
                  SELECT crop_name
                  FROM crop_master
                  ORDER BY crop_name ASC
              ");

              while($crop = $cropList->fetch_assoc()){
              ?>

              <option value="<?php echo $crop['crop_name']; ?>">
                <?php echo $crop['crop_name']; ?>
              </option>

              <?php } ?>

            </select>

          </div>

          <!-- Quantity -->
          <div class="col-md-6">

            <label class="form-label">
              Quantity (Kg)
            </label>

            <input type="number"
                   name="quantity"
                   class="form-control"
                   placeholder="e.g. 100"
                   required>

          </div>

          <!-- Price -->
          <div class="col-md-12">

            <label class="form-label">
              Price per Kg (₹)
            </label>

            <input type="number"
                   step="0.01"
                   name="price_per_kg"
                   id="price_per_kg"
                   class="form-control"
                   placeholder="e.g. 45"
                   required>

            <div class="alert alert-info mt-2"
                 id="marketBox"
                 style="display:none;">

              Today's Market Price:
              <strong>
                ₹<span id="marketPrice">0</span>/Kg
              </strong>

            </div>

          </div>

          <!-- Image -->
          <div class="col-md-12">

            <label class="form-label">
              Crop Image
            </label>

            <input type="file"
                   name="crop_image"
                   class="form-control"
                   accept="image/*"
                   required>

          </div>

        </div>

        <button type="submit"
                class="btn btn-agri w-100 mt-4">

          Publish Crop ✅

        </button>

      </form>

    </div>

  </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const cropSelect = document.getElementById("crop_name");
    const marketBox = document.getElementById("marketBox");
    const marketPrice = document.getElementById("marketPrice");

    cropSelect.addEventListener("change", function(){

        let crop = this.value;

        if(crop === ""){
            marketBox.style.display = "none";
            return;
        }

        fetch("get_market_price.php?crop=" + encodeURIComponent(crop))

        .then(response => response.text())

        .then(price => {

            marketPrice.innerHTML = price;
            marketBox.style.display = "block";

        })

        .catch(error => {

            console.log(error);
            marketBox.style.display = "none";

        });

    });

});

</script>

</body>
</html>