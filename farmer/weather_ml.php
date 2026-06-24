<?php
session_start();

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$resultCrop = "";
$errorMsg = "";

if(isset($_POST['predict'])){

    $temp = floatval($_POST['temp']);
    $humidity = floatval($_POST['humidity']);
    $rainfall = floatval($_POST['rainfall']);

    // ✅ Your correct python path
    $pythonPath = "C:\\Python314\\python.exe";

    // ✅ predict.py absolute path
    $scriptPath = realpath(__DIR__ . "/../ml/predict.py");

    if(!$scriptPath){
        $errorMsg = "❌ predict.py file not found. Check: AgriConnect/ml/predict.py";
    } else {

        // ✅ run python (no debug shown)
        $cmd = "\"$pythonPath\" \"$scriptPath\" $temp $humidity $rainfall 2>&1";

        $output = shell_exec($cmd);

        if($output === NULL){
            $errorMsg = "❌ Python execution failed. Check python setup.";
        } else {
            $resultCrop = trim($output);

            // if python prints any error
            if(stripos($resultCrop, "Traceback") !== false || stripos($resultCrop, "Error") !== false){
                $errorMsg = "❌ Python Error: " . $resultCrop;
                $resultCrop = "";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ML Weather Crop Suggestion</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-3 text-end">
  <a href="dashboard.php" class="btn btn-outline-success">⬅ Back</a>
</div>

<div class="container my-4">
  <h4 class="fw-bold">🤖 ML Weather Based Crop Suggestion</h4>
  <p class="text-muted">Enter weather data and ML model will suggest best crop.</p>

  <div class="card shadow-sm">
    <div class="card-body">

      <form method="POST" class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Temperature (°C)</label>
          <input type="number" step="0.1" name="temp" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label">Humidity (%)</label>
          <input type="number" step="0.1" name="humidity" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label">Rainfall (mm)</label>
          <input type="number" step="0.1" name="rainfall" class="form-control" required>
        </div>

        <div class="col-12">
          <button name="predict" class="btn btn-success w-100">🔍 Predict Best Crop</button>
        </div>
      </form>

      <?php if($resultCrop!=""){ ?>
        <div class="alert alert-success mt-4">
          ✅ <b>Recommended Crop:</b> <?php echo htmlspecialchars($resultCrop); ?>
        </div>
      <?php } ?>

      <?php if($errorMsg!=""){ ?>
        <div class="alert alert-danger mt-4">
          <?php echo $errorMsg; ?>
        </div>
      <?php } ?>

    </div>
  </div>

</div>

</body>
</html>
