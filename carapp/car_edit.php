<?php
include 'car_db.php';

// Capture form values
$vin   = $_POST['VIN'] ?? '';
$make  = $_POST['Make'] ?? '';
$model = $_POST['Model'] ?? '';
$price = $_POST['Asking_Price'] ?? '';

if (!$vin) {
    die("VIN missing.");
}

$stmt = $pdo->prepare("
    UPDATE inventory 
    SET make = :make, model = :model, asking_price = :price
    WHERE vin = :vin
");

$success = $stmt->execute([
    'make'  => $make,
    'model' => $model,
    'price' => $price,
    'vin'   => $vin,
]);

?>
<!DOCTYPE html>
<html>
<head><title>Car Updated</title></head>
<body>

<h1>Sam's Used Cars</h1>

<?php if ($success): ?>
    <p><strong><?= htmlspecialchars("$make $model") ?></strong> was updated successfully.</p>
<?php else: ?>
    <p>There was an error saving the vehicle.</p>
<?php endif; ?>

<p><a href="viewCars.php">Return to Inventory</a></p>
