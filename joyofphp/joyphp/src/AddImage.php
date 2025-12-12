<?php
require_once __DIR__ . '/db.php'; // MUST create $pdo

$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    die("VIN not provided.");
}

// Fetch car details
$stmt = $pdo->prepare("SELECT * FROM inventory WHERE VIN = :vin");
$stmt->execute(['vin' => $vin]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    die("Sorry, a vehicle with VIN of $vin cannot be found.");
}

$year = $car['YEAR'];
$make = $car['Make'];
$model = $car['Model'];
$trim = $car['TRIM'];
$color = $car['EXT_COLOR'];
$interior = $car['INT_COLOR'];
$mileage = $car['MILEAGE'];
$transmission = $car['TRANSMISSION'];
$price = $car['ASKING_PRICE'];
?>
<html>
<head>
<title>Sam's Used Cars - Image Upload</title>
</head>
<body background="bg.jpg">
<h1>Sam's Used Cars</h1>
<h3>Add Image</h3>

<p>
    <?= htmlspecialchars("$color $year $make $model") ?><br>
    VIN: <?= htmlspecialchars($vin) ?>
</p>
<p>
    Asking Price: $<?= number_format($price, 0) ?>
</p>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file"><br>
    <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">
    <input type="submit" name="submit" value="Submit">
</form>

<br><br>

<?php
// Load existing images
$stmt = $pdo->prepare("SELECT * FROM images WHERE VIN = :vin");
$stmt->execute(['vin' => $vin]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($images as $img) {
    $file = htmlspecialchars($img['FILENAME']);
    echo "<img src='uploads/$file' width='250'> ";
}

include 'footer.php';
?>
</body>
</html>

