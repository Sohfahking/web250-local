
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Index/Home">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Dajabre Torain">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Link to CSS file(s) -->
    <link rel="stylesheet" href="styles/styles.css">

    <title> Dajabre Torain's Daring Tiger | WEB250 | Edit Car</title>

    <!-- Accumulus Validator -->
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>
    <header><?php include("components/header250.php"); ?></header>

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

    <p><a href="https://web250-local.onrender.com/carapp/car_inventory.php">Back to Inventory</a></p>

    <footer><?php include("components/footer250.php"); ?></footer>

</body>

</html>