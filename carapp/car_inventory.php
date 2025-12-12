<?php
include __DIR__ . '/car_db.php';

// Handle Add Car form submission
$addMsg = '';
if (isset($_POST['add_car'])) {
    $vin   = $_POST['VIN'] ?? '';
    $make  = $_POST['Make'] ?? '';
    $model = $_POST['Model'] ?? '';
    $year  = $_POST['Year'] ?? null;
    $trim  = $_POST['Trim'] ?? '';
    $ext_color = $_POST['Ext_Color'] ?? '';
    $int_color = $_POST['Int_Color'] ?? '';
    $mileage = $_POST['Mileage'] ?? null;
    $transmission = $_POST['Transmission'] ?? '';
    $price = $_POST['Asking_Price'] ?? 0;

    $stmt = $pdo->prepare("
        INSERT INTO inventory 
        (VIN, Make, Model, Year, Trim, Ext_Color, Int_Color, Mileage, Transmission, Asking_Price) 
        VALUES (:vin, :make, :model, :year, :trim, :ext_color, :int_color, :mileage, :transmission, :price)
    ");

    if ($stmt->execute([
        'vin' => $vin,
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'trim' => $trim,
        'ext_color' => $ext_color,
        'int_color' => $int_color,
        'mileage' => $mileage,
        'transmission' => $transmission,
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
    $trim  = $_POST['Trim'] ?? '';
    $ext_color = $_POST['Ext_Color'] ?? '';
    $int_color = $_POST['Int_Color'] ?? '';
    $mileage = $_POST['Mileage'] ?? null;
    $transmission = $_POST['Transmission'] ?? '';
    $price = $_POST['Asking_Price'] ?? 0;

    $stmt = $pdo->prepare("
        UPDATE inventory SET 
        Make = :make, Model = :model, Year = :year, Trim = :trim,
        Ext_Color = :ext_color, Int_Color = :int_color, Mileage = :mileage,
        Transmission = :transmission, Asking_Price = :price
        WHERE VIN = :vin
    ");

    if ($stmt->execute([
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'trim' => $trim,
        'ext_color' => $ext_color,
        'int_color' => $int_color,
        'mileage' => $mileage,
        'transmission' => $transmission,
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
    Trim: <input name="Trim"><br>
    Ext Color: <input name="Ext_Color"><br>
    Int Color: <input name="Int_Color"><br>
    Mileage: <input name="Mileage"><br>
    Transmission: <input name="Transmission"><br>
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
        <th>Trim</th>
        <th>Ext Color</th>
        <th>Int Color</th>
        <th>Mileage</th>
        <th>Transmission</th>
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
        $trim = htmlspecialchars($car['Trim'] ?? $car['trim']);
        $ext_color = htmlspecialchars($car['Ext_Color'] ?? $car['ext_color']);
        $int_color = htmlspecialchars($car['Int_Color'] ?? $car['int_color']);
        $mileage = htmlspecialchars($car['Mileage'] ?? $car['mileage']);
        $transmission = htmlspecialchars($car['Transmission'] ?? $car['transmission']);
        $price = htmlspecialchars($car['Asking_Price'] ?? $car['asking_price']);
    ?>
        <tr class="<?= $class ?>">
            <td><?= $vin ?></td>
            <td><?= $make ?></td>
            <td><?= $model ?></td>
            <td><?= $year ?></td>
            <td><?= $trim ?></td>
            <td><?= $ext_color ?></td>
            <td><?= $int_color ?></td>
            <td><?= $mileage ?></td>
            <td><?= $transmission ?></td>
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
        Trim: <input name="Trim" value="<?= htmlspecialchars($car['Trim']) ?>"><br>
        Ext Color: <input name="Ext_Color" value="<?= htmlspecialchars($car['Ext_Color']) ?>"><br>
        Int Color: <input name="Int_Color" value="<?= htmlspecialchars($car['Int_Color']) ?>"><br>
        Mileage: <input name="Mileage" value="<?= htmlspecialchars($car['Mileage']) ?>"><br>
        Transmission: <input name="Transmission" value="<?= htmlspecialchars($car['Transmission']) ?>"><br>
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

