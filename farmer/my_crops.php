<?php
session_start();
include("../config/db.php");

// hide warnings in production
ini_set('display_errors', 0);

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

$sql = "SELECT * FROM crops WHERE farmer_id='$farmer_id' ORDER BY crop_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Crops | AgriConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">

  <style>
    .crop-card{
      border-radius:18px;
      overflow:hidden;
      background:#fff;
      border:1px solid rgba(0,0,0,0.08);
      box-shadow:0 12px 30px rgba(0,0,0,0.08);
      transition:.2s;
      height:100%;
      display:flex;
      flex-direction:column;
    }
    .crop-card:hover{ transform:translateY(-4px); }
    .crop-img{
      width:100%;
      height:180px;
      object-fit:cover;
      background:#f2f2f2;
    }
    .crop-body{
      padding:16px;
      flex:1;
      display:flex;
      flex-direction:column;
    }
    .crop-title{
      font-size:18px;
      font-weight:800;
      margin-bottom:10px;
      text-transform:capitalize;
    }
    .crop-meta{
      font-size:14px;
      margin-bottom:6px;
    }
    .crop-price{
      font-size:15px;
      font-weight:700;
      color:#198754;
    }
    .btn-action{
      border-radius:12px;
      font-weight:700;
      padding:10px;
      width:100%;
    }
  </style>
</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php" style="color:#198754;">🌾 AgriConnect</a>
    <div class="d-flex gap-2">
      <a href="add_crop.php" class="btn btn-success" style="border-radius:12px;">➕ Add Crop</a>
      <a href="dashboard.php" class="btn btn-outline-success" style="border-radius:12px;">⬅ Dashboard</a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <div class="mb-4">
    <h3 class="fw-bold">My Crops</h3>
    <p class="text-muted mb-0">Here are your crop listings with images.</p>
  </div>

  <div class="row g-4">

<?php if ($result && $result->num_rows > 0) { ?>
<?php while($row = $result->fetch_assoc()) { 
      $status = $row['status'] ?? 'Available'; // 🔥 warning fix
?>
  <div class="col-md-4">
    <div class="crop-card">

      <!-- ✅ Crop Image (FIXED PATH) -->
      <?php if (!empty($row['crop_image'])) { ?>
        <img src="../uploads/<?php echo $row['crop_image']; ?>" class="crop-img" alt="Crop Image">
      <?php } else { ?>
        <img src="../assets/images/default-crop.jpg" class="crop-img" alt="Default Crop">
      <?php } ?>

      <div class="crop-body">
        <div class="crop-title">🌿 <?php echo htmlspecialchars($row['crop_name']); ?></div>

        <div class="crop-meta"><b>Quantity:</b> <?php echo $row['quantity']; ?> Kg</div>
        <div class="crop-meta">
          <b>Price:</b> <span class="crop-price">₹<?php echo $row['price_per_kg']; ?> / Kg</span>
        </div>

        <div class="mt-2">
          <span class="badge bg-success"><?php echo $status; ?></span>
        </div>

        <div class="mt-3 d-flex flex-column gap-2">
          <a href="edit_crop.php?id=<?php echo $row['crop_id']; ?>" class="btn btn-outline-success btn-action">✏️ Edit Crop</a>
          <a href="delete_crop.php?id=<?php echo $row['crop_id']; ?>" 
             class="btn btn-danger btn-action"
             onclick="return confirm('Are you sure you want to delete this crop?');">
             🗑 Delete Crop
          </a>
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php } else { ?>

  <div class="col-12">
    <div class="text-center p-4 bg-white rounded shadow-sm">
      <h5 class="fw-bold">No Crops Added Yet ❌</h5>
      <p class="text-muted">Click below to add your first crop.</p>
      <a href="add_crop.php" class="btn btn-success" style="border-radius:12px;">➕ Add Crop</a>
    </div>
  </div>

<?php } ?>

  </div>
</div>
</body>
</html>
