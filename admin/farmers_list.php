<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// ✅ Search text
$search = $_GET['search'] ?? "";
$searchSafe = $conn->real_escape_string($search);

// ✅ SHOW ONLY ACTIVE FARMERS + SEARCH (name/phone)
$sql = "SELECT * FROM farmers
        WHERE status='ACTIVE'
        AND (name LIKE '%$searchSafe%' OR phone LIKE '%$searchSafe%')
        ORDER BY farmer_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmers List | Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-dashboard">

<nav class="navbar agri-navbar py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php" style="color:#198754;">🛠 Admin</a>
    <a href="dashboard.php" class="btn btn-outline-success" style="border-radius:12px;">⬅ Back</a>
  </div>
</nav>

<div class="container my-5">

  <div class="dash-card mb-4">
    <h3 class="fw-bold mb-1">👨‍🌾 Farmers List</h3>
    <p class="text-muted mb-0">Active farmers only</p>
  </div>

  <!-- ✅ SEARCH BOX -->
  <div class="dash-card mb-3">
    <form class="d-flex" method="GET">
      <input type="text" name="search" class="form-control"
             placeholder="Search farmer name / phone"
             value="<?php echo htmlspecialchars($search); ?>">
      <button class="btn btn-success ms-2">Search</button>
      <a href="farmers_list.php" class="btn btn-outline-dark ms-2">Reset</a>
    </form>
  </div>

  <div class="dash-card">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-success">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Created At</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($result && $result->num_rows > 0) { ?>
            <?php while($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $row['farmer_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="5" class="text-center text-muted">
                No active farmers found ❌
              </td>
            </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>
  </div>

</div>

</body>
</html>
