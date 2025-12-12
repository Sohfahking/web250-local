<?php
include 'db.php'; // provides $pdo

// Get VIN safely
$vin = $_GET['VIN'] ?? '';

if (!$vin) {
    die("No VIN provided.");
}

// Fetch car using prepared statement
$stmt = $pdo->prepare("SELECT * FROM inventory WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);

$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    die("No vehicle found with VIN: " . htmlspecialchars($vin));
}

// Normalize column names for Postgres (lowercase) or MySQL (uppercase)
$VIN    = $car['vin']   ?? $car['VIN']   ?? '';
$make   = $car['make']  ?? $car['Make']  ?? '';
$model  = $car['model'] ?? $car['Model'] ?? '';
$price  = $car['asking_price'] ?? $car['ASKING_PRICE'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Vehicle</title>
</head>

<body>
<h1>Sam's Used Cars</h1>
<h3>Editing VIN: <?= htmlspecialchars($VIN) ?></h3>

<form action="EditCar.php" method="post">

    <input type="hidden" name="VIN" value="<?= htmlspecialchars($VIN) ?>"/>

    <p>
        Make:<br>
        <input name="Make" type="text" value="<?= htmlspecialchars($make) ?>"/>
    </p>

    <p>
        Model:<br>
        <input name="Model" type="text" value="<?= htmlspecialchars($model) ?>"/>
    </p>

    <p>
        Asking Price:<br>
        <input name="Asking_Price" type="text" value="<?= htmlspecialchars($price) ?>"/>
    </p>

    <p>
        <input type="submit" value="Save Changes"/>
    </p>

</form>

</body>
</html>
