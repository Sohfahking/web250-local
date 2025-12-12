<?php
include 'db.php';

$vin = $_GET['VIN'] ?? '';

if (!$vin) {
    die("No VIN provided.");
}

$stmt = $pdo->prepare("DELETE FROM inventory WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);

$deleted = $stmt->rowCount() > 0;
?>

<!DOCTYPE html>
<html>
<head><title>Delete Car</title></head>
<body>

<h1>Sam's Used Cars</h1>

<?php if ($deleted): ?>
    <p>The vehicle with VIN <strong><?= htmlspecialchars($vin) ?></strong> has been deleted.</p>
<?php else: ?>
    <p>No vehicle found with VIN <strong><?= htmlspecialchars($vin) ?></strong>.</p>
<?php endif; ?>

<p><a href="ViewCarsWithStyle2.php">Return to Inventory</a></p>

</body>
</html>
