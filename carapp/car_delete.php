<?php
// car_delete.php
include __DIR__ . '/car_db.php';

$vin = $_GET['VIN'] ?? '';
if (!$vin) die("VIN missing.");

// Delete the car (images cascade)
$stmt = $pdo->prepare("DELETE FROM inventory WHERE vin = :vin");
$deleted = $stmt->execute(['vin'=>$vin]);

?>

<h2>Delete Car</h2>
<?php if ($deleted): ?>
    <p>Car with VIN <?= htmlspecialchars($vin) ?> deleted successfully.</p>
<?php else: ?>
    <p>There was an error deleting the car.</p>
<?php endif; ?>

<p><a href="index.php?page=car_inventory">Back to Inventory</a></p>
