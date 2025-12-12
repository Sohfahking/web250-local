<?php
// car_add.php
include __DIR__ . '/car_db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vin   = trim($_POST['VIN'] ?? '');
    $make  = trim($_POST['Make'] ?? '');
    $model = trim($_POST['Model'] ?? '');
    $year  = trim($_POST['Year'] ?? '');
    $ext   = trim($_POST['Ext_Color'] ?? '');
    $price = trim($_POST['Asking_Price'] ?? '');

    if (!$vin || !$make || !$model || !$price) {
        $errors[] = "VIN, Make, Model, and Asking Price are required.";
    }

    if (!$errors) {
        $stmt = $pdo->prepare("
            INSERT INTO cars (vin, make, model, year, ext_color, asking_price)
            VALUES (:vin, :make, :model, :year, :ext, :price)
        ");
        $successInsert = $stmt->execute([
            'vin' => $vin,
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'ext' => $ext,
            'price' => $price
        ]);

        $success = $successInsert ? "Car $make $model added successfully!" : "Error adding car.";
    }
}
?>

<h2>Add New Car</h2>

<?php if ($errors): ?>
    <div style="color:red;">
        <?php foreach ($errors as $err) echo "<p>$err</p>"; ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div style="color:green;"><p><?= htmlspecialchars($success) ?></p></div>
<?php endif; ?>

<form method="post">
    <label>VIN: <input type="text" name="VIN" required></label><br>
    <label>Make: <input type="text" name="Make" required></label><br>
    <label>Model: <input type="text" name="Model" required></label><br>
    <label>Year: <input type="text" name="Year"></label><br>
    <label>Exterior Color: <input type="text" name="Ext_Color"></label><br>
    <label>Asking Price: <input type="text" name="Asking_Price" required></label><br>
    <button type="submit">Add Car</button>
</form>

<p><a href="index.php?page=car_inventory">Back to Inventory</a></p>
