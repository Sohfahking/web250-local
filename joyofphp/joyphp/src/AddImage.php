<?php
include 'db.php'; // Provides $pdo

$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    die("No VIN provided.");
}

// Fetch car record
$stmt = $pdo->prepare("SELECT * FROM inventory WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    die("Sorry, a vehicle with VIN $vin cannot be found.");
}

// Assign existing fields safely
$make  = $car['make'];
$model = $car['model'];
$price = $car['asking_price'];

// Optional fields — use defaults if missing
$year         = $car['year']         ?? "";
$trim         = $car['trim']         ?? "";
$color        = $car['ext_color']    ?? "";
$interior     = $car['int_color']    ?? "";
$mileage      = $car['mileage']      ?? "";
$transmission = $car['transmission'] ?? "";
?>
<html>
<head>
<title>Sam's Used Cars - Image Upload</title>
</head>
<body background="bg.jpg">

<h1>Sam's Used Cars</h1>
<h3>Add Image</h3>

<p>
    <?= htmlspecialchars($color) ?> 
    <?= htmlspecialchars($year) ?> 
    <?= htmlspecialchars($make) ?> 
    <?= htmlspecialchars($model) ?><br>
    VIN: <?= htmlspecialchars($vin) ?>
</p>

<p>Asking Price: $<?= number_format((float)$price, 2) ?></p>


<!-- Upload Form -->
<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file"><br><br>

    <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">

    <input type="submit" name="submit" value="Submit">
</form>

<br><br>

<?php
// Fetch images for this vehicle
$stmt = $pdo->prepare("SELECT * FROM images WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($images as $img) {
    $filename = htmlspecialchars($img['filename']);
    echo "<img src='uploads/$filename' width='250' style='margin:10px;'>";
}

include 'footer.php';
?>

</body>
</html>


