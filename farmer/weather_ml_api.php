<?php
session_start();

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$resultCrop = "";
$errorMsg = "";
$weatherInfo = "";

// ✅ Your python path
$pythonPath = "C:\\Python314\\python.exe";

// ✅ predict.py absolute path
$scriptPath = realpath(__DIR__ . "/../ml/predict.py");

// ✅ YOUR WORKING OPENWEATHER API KEY (DEFAULT KEY)
$API_KEY = "72618b49ddca91411ca19698f9504561";

if(isset($_POST['predict'])){

    $city = trim($_POST['city']);

    if($city==""){
        $errorMsg = "❌ Please enter city name";
    } else {

        $url = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($city)."&appid=".$API_KEY."&units=metric";

        $response = @file_get_contents($url);

        if($response === FALSE){
            $errorMsg = "❌ Weather API not working (Check Internet / API Key / Email verification)";
        } else {

            $data = json_decode($response, true);

            if(isset($data["cod"]) && $data["cod"] != 200){
                $errorMsg = "❌ City not found OR API key not active. API says: ".$data["message"];
            } else {

                $temp = $data["main"]["temp"];
                $humidity = $data["main"]["humidity"];

                // Rainfall optional
                $rainfall = 50;
                if(isset($data["rain"]["1h"])) $rainfall = $data["rain"]["1h"];
                if(isset($data["rain"]["3h"])) $rainfall = $data["rain"]["3h"];

                $weatherInfo = "🌡 Temp: $temp °C | 💧 Humidity: $humidity% | 🌧 Rainfall: $rainfall mm";

                if(!$scriptPath){
                    $errorMsg = "❌ predict.py not found. Check: AgriConnect/ml/predict.py";
                } else {

                    $cmd = "\"$pythonPath\" \"$scriptPath\" $temp $humidity $rainfall 2>&1";
                    $output = shell_exec($cmd);

                    if($output === NULL){
                        $errorMsg = "❌ Python execution failed.";
                    } else {
                        $resultCrop = trim($output);

                        if(stripos($resultCrop, "Traceback") !== false){
                            $errorMsg = "❌ Python Error: " . $resultCrop;
                            $resultCrop = "";
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Auto Weather + ML Crop Suggestion</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
  <h4 class="fw-bold">🌍 Auto Weather + ML Crop Suggestion</h4>
  <p class="text-muted">Enter City → Weather auto fetch → ML predicts crop.</p>

  <div class="card shadow-sm">
    <div class="card-body">

      <form method="POST" class="row g-3">
        <div class="col-md-12">
          <label class="form-label">Enter City</label>
          <input type="text" name="city" class="form-control" placeholder="Example: Hyderabad" required>
        </div>

        <div class="col-12">
          <button name="predict" class="btn btn-success w-100">🔍 Auto Predict Crop</button>
        </div>
      </form>

      <?php if($weatherInfo!=""){ ?>
        <div class="alert alert-info mt-4">
          <b>Weather Data:</b> <?php echo $weatherInfo; ?>
        </div>
      <?php } ?>

      <?php if($resultCrop!=""){ ?>
        <div class="alert alert-success mt-3">
          ✅ <b>Recommended Crop:</b> <?php echo htmlspecialchars($resultCrop); ?>
        </div>
      <?php } ?>

      <?php if($errorMsg!=""){ ?>
        <div class="alert alert-danger mt-3">
          <?php echo $errorMsg; ?>
        </div>
      <?php } ?>

      <a href="dashboard.php" class="btn btn-secondary mt-2">⬅ Back</a>

    </div>
  </div>

</div>

</body>
</html>
