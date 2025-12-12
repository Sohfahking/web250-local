<?php
include __DIR__ . '/car_db.php';

// GET VIN for display or editing
$vin = $_GET['VIN'] ?? $_POST['vin'] ?? '';

if (!$vin) {
    die("VIN missing.");
}

// Load car from DB
$stmt = $pdo->prepare("SELECT * FROM cars WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    die("Car not found.");
}

// If form submitted, update the car
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $make  = $_POST['make'] ?? '';
    $model = $_POST['model'] ?? '';
    $year  = $_POST['year'] ?? '';
    $color = $_POST['ext_color'] ?? '';
    $price = $_POST['asking_price'] ?? '';

    $update = $pdo->prepare("
        UPDATE cars
        SET make = :make, model = :model, year = :year, ext_color = :color, asking_price = :price
        WHERE vin = :vin
    ");

    $success = $update->execute([
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'color' => $color,
        'price' => $price,
        'vin' => $vin
    ]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
</head>

<body>

<h2>Edit Car: <?= htmlspecialchars($car['make'] . " " . $car['model']) ?></h2>

<?php if (!empty($success)): ?>
    <p style="color:green;">Car updated successfully!</p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="vin" value="<?= htmlspecialchars($car['vin']) ?>">

    <label>Make:
        <input type="text" name="make" value="<?= htmlspecialchars($car['make']) ?>">
    </label><br>

    <label>Model:
        <input type="text" name="model" value="<?= htmlspecialchars($car['model']) ?>">
    </label><br>

    <label>Year:
        <input type="text" name="year" value="<?= htmlspecialchars($car['year']) ?>">
    </label><br>

    <label>Exterior Color:
        <input type="text" name="ext_color" value="<?= htmlspecialchars($car['ext_color']) ?>">
    </label><br>

    <label>Asking Price:
        <input type="text" name="asking_price" value="<?= htmlspecialchars($car['asking_price']) ?>">
    </label><br>

    <button type="submit">Save Changes</button>
</form>

<p><a href="car_inventory.php">Back to Inventory</a></p>

</body>
</html>
