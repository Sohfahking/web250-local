<?php
include __DIR__ . '/car_db.php';

// Handle Add Car form submission
$addMsg = '';
if (isset($_POST['add_car'])) {
    $vin   = $_POST['VIN'] ?? '';
    $make  = $_POST['Make'] ?? '';
    $model = $_POST['Model'] ?? '';
    $year  = $_POST['Year'] ?? null;
    $ext_color = $_POST['Ext_Color'] ?? '';
    $price = $_POST['Asking_Price'] ?? 0;

    $stmt = $pdo->prepare("
        INSERT INTO inventory 
        (VIN, Make, Model, Year, Ext_Color, Asking_Price) 
        VALUES (:vin, :make, :model, :year, :ext_color, :price)
    ");

    if ($stmt->execute([
        'vin' => $vin,
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'ext_color' => $ext_color,
        'price' => $price
    ])) {
        $addMsg = "Vehicle $make $model added successfully!";
    } else {
        $addMsg = "Error adding vehicle $make $model.";
    }
}

// Handle Delete
if (isset($_GET['delete_vin'])) {
    $vin = $_GET['delete_vin'];
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE VIN = :vin");
    $stmt->execute(['vin' => $vin]);
}

// Handle Update
$editMsg = '';
if (isset($_POST['edit_car'])) {
    $vin   = $_POST['VIN'] ?? '';
    $make  = $_POST['Make'] ?? '';
    $model = $_POST['Model'] ?? '';
    $year  = $_POST['Year'] ?? null;
    $ext_color = $_POST['Ext_Color'] ?? '';
    $price = $_POST['Asking_Price'] ?? 0;

    $stmt = $pdo->prepare("
        UPDATE inventory SET 
        Make = :make, Model = :model, Year = :year,
        Ext_Color = :ext_color, Asking_Price = :price
        WHERE VIN = :vin
    ");

    if ($stmt->execute([
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'ext_color' => $ext_color,
        'price' => $price,
        'vin' => $vin
    ])) {
        $editMsg = "Vehicle $make $model updated successfully!";
    } else {
        $editMsg = "Error updating vehicle $make $model.";
    }
}

// Fetch all cars
$stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make, Model");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Daring Tiger's Cars Inventory</h2>

<?php if ($addMsg): ?>
    <p style="color:green; font-weight:bold;"><?= htmlspecialchars($addMsg) ?></p>
<?php endif; ?>
<?php if ($editMsg): ?>
    <p style="color:blue; font-weight:bold;"><?= htmlspecialchars($editMsg) ?></p>
<?php endif; ?>

<h3>Add New Car</h3>
<form method="post">
    VIN: <input name="VIN" required><br>
    Make: <input name="Make" required><br>
    Model: <input name="Model" required><br>
    Year: <input name="Year"><br>
    Ext Color: <input name="Ext_Color"><br>
    Asking Price: <input name="Asking_Price"><br>
    <input type="submit" name="add_car" value="Add Car">
</form>

<h3>Current Inventory</h3>
<table id="Grid" style="width: 90%">
    <tr>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Ext Color</th>
        <th>Asking Price</th>
        <th>Actions</th>
    </tr>
    <?php
    $class = "odd";
    foreach ($cars as $car):
        $vin = htmlspecialchars($car['VIN'] ?? $car['vin']);
        $make = htmlspecialchars($car['Make'] ?? $car['make']);
        $model = htmlspecialchars($car['Model'] ?? $car['model']);
        $year = htmlspecialchars($car['Year'] ?? $car['year']);
        $ext_color = htmlspecialchars($car['Ext_Color'] ?? $car['ext_color']);
        $price = htmlspecialchars($car['Asking_Price'] ?? $car['asking_price']);
    ?>
        <tr class="<?= $class ?>">
            <td><?= $vin ?></td>
            <td><?= $make ?></td>
            <td><?= $model ?></td>
            <td><?= $year ?></td>
            <td><?= $ext_color ?></td>
            <td>$<?= $price ?></td>
            <td>
                <a href="?edit_vin=<?= $vin ?>">Edit</a> |
                <a href="?delete_vin=<?= $vin ?>" onclick="return confirm('Delete this car?');">Delete</a> |
                <a href="?upload_vin=<?= $vin ?>">Add Image</a>
            </td>
        </tr>
    <?php
        $class = ($class === "odd") ? "even" : "odd";
    endforeach;
    ?>
</table>

<?php
// Show edit form if edit_vin is set
if (isset($_GET['edit_vin'])):
    $vin = $_GET['edit_vin'];
    $stmt = $pdo->prepare("SELECT * FROM inventory WHERE VIN = :vin");
    $stmt->execute(['vin' => $vin]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <h3>Edit Car: <?= htmlspecialchars($car['Make'] . ' ' . $car['Model']) ?></h3>
    <form method="post">
        <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>">
        Make: <input name="Make" value="<?= htmlspecialchars($car['Make']) ?>"><br>
        Model: <input name="Model" value="<?= htmlspecialchars($car['Model']) ?>"><br>
        Year: <input name="Year" value="<?= htmlspecialchars($car['Year']) ?>"><br>
        Ext Color: <input name="Ext_Color" value="<?= htmlspecialchars($car['Ext_Color']) ?>"><br>
        Asking Price: <input name="Asking_Price" value="<?= htmlspecialchars($car['Asking_Price']) ?>"><br>
        <input type="submit" name="edit_car" value="Save Changes">
    </form>
<?php endif; ?>

<?php
// Show image upload form if upload_vin is set
if (isset($_GET['upload_vin'])):
    $vin = $_GET['upload_vin'];
    ?>
    <h3>Upload Image for VIN <?= htmlspecialchars($vin) ?></h3>
    <form action="/carapp/car_addPic.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">
        <label for="file">Select image:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="upload_image" value="Upload Image">
    </form>
<?php endif; ?>

