<?php
include 'config_db.php';

// --- Handle form submission (Insert / Update) ---
$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vin   = trim($_POST['vin']);
    $make  = trim($_POST['make']);
    $model = trim($_POST['model']);
    $year  = trim($_POST['year'] ?? '');
    $trimf = trim($_POST['trim'] ?? '');
    $ext_color = trim($_POST['ext_color'] ?? '');
    $int_color = trim($_POST['int_color'] ?? '');
    $mileage   = trim($_POST['mileage'] ?? 0);
    $transmission = trim($_POST['transmission'] ?? '');
    $asking_price = trim($_POST['asking_price'] ?? 0);

    try {
        if (!empty($_POST['update'])) {
            // Update existing car
            $stmt = $pdo->prepare("
                UPDATE inventory
                SET make=:make, model=:model, year=:year, trim=:trim, ext_color=:ext_color, 
                    int_color=:int_color, mileage=:mileage, transmission=:transmission, asking_price=:asking_price
                WHERE vin=:vin
            ");
            $stmt->execute(compact('vin','make','model','year','trim','ext_color','int_color','mileage','transmission','asking_price'));
            $feedback = "<h3 style='color:green;'>Car $vin updated successfully.</h3>";
        } else {
            // Insert new car
            $stmt = $pdo->prepare("
                INSERT INTO inventory (vin, make, model, year, trim, ext_color, int_color, mileage, transmission, asking_price)
                VALUES (:vin, :make, :model, :year, :trim, :ext_color, :int_color, :mileage, :transmission, :asking_price)
            ");
            $stmt->execute(compact('vin','make','model','year','trim','ext_color','int_color','mileage','transmission','asking_price'));
            $feedback = "<h3 style='color:green;'>Car $vin added successfully.</h3>";
        }
    } catch (PDOException $e) {
        $feedback = "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
    }
}

// --- Handle deletion ---
if (isset($_GET['delete'])) {
    $vin = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE vin = :vin");
    $stmt->execute(['vin' => $vin]);
    $feedback = "<h3 style='color:red;'>Car $vin deleted successfully.</h3>";
}

// --- Handle edit request ---
$editCar = null;
if (isset($_GET['edit'])) {
    $vin = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM inventory WHERE vin = :vin");
    $stmt->execute(['vin'=>$vin]);
    $editCar = $stmt->fetch(PDO::FETCH_ASSOC);
}

// --- Fetch all cars ---
$stmt = $pdo->query("SELECT * FROM inventory ORDER BY make, model");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dapper Viper's Used Cars</title>
<link rel="stylesheet" href="styles/style.css">
<style>
#Grid { font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; width:80%; border-collapse:collapse; margin:auto; }
#Grid td, #Grid th { border:1px solid #61ADD7; padding:5px; }
#Grid th { background-color:#C2D9FE; }
#Grid tr.odd { background-color:#F2F5A9; }
#Grid tr.even { background-color:white; }
</style>
</head>
<body>
<h1>Dapper Viper's Used Cars</h1>

<!-- Feedback message -->
<div><?= $feedback ?></div>

<!-- Add / Edit Form -->
<h2><?= $editCar ? "Edit Car $editCar[vin]" : "Add New Car" ?></h2>
<form method="post" style="margin-bottom:30px;">
    <input type="hidden" name="vin" value="<?= htmlspecialchars($editCar['vin'] ?? '') ?>">
    Make: <input name="make" value="<?= htmlspecialchars($editCar['make'] ?? '') ?>"><br>
    Model: <input name="model" value="<?= htmlspecialchars($editCar['model'] ?? '') ?>"><br>
    Year: <input name="year" value="<?= htmlspecialchars($editCar['year'] ?? '') ?>"><br>
    Trim: <input name="trim" value="<?= htmlspecialchars($editCar['trim'] ?? '') ?>"><br>
    Exterior Color: <input name="ext_color" value="<?= htmlspecialchars($editCar['ext_color'] ?? '') ?>"><br>
    Interior Color: <input name="int_color" value="<?= htmlspecialchars($editCar['int_color'] ?? '') ?>"><br>
    Mileage: <input name="mileage" type="number" value="<?= htmlspecialchars($editCar['mileage'] ?? '') ?>"><br>
    Transmission: <input name="transmission" value="<?= htmlspecialchars($editCar['transmission'] ?? '') ?>"><br>
    Asking Price: <input name="asking_price" value="<?= htmlspecialchars($editCar['asking_price'] ?? '') ?>"><br>
    <button type="submit" name="<?= $editCar ? 'update' : 'insert' ?>">
        <?= $editCar ? 'Update Car' : 'Add Car' ?>
    </button>
</form>

<!-- Car Table -->
<h2>Current Inventory</h2>
<table id="Grid">
<tr>
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
$class = 'odd';
foreach ($cars as $car): ?>
<tr class="<?= $class ?>">
    <td><?= htmlspecialchars($car['make']) ?></td>
    <td><?= htmlspecialchars($car['model']) ?></td>
    <td><?= htmlspecialchars($car['year']) ?></td>
    <td><?= htmlspecialchars($car['trim']) ?></td>
    <td><?= htmlspecialchars($car['ext_color']) ?></td>
    <td><?= htmlspecialchars($car['int_color']) ?></td>
    <td><?= htmlspecialchars($car['mileage']) ?></td>
    <td><?= htmlspecialchars($car['transmission']) ?></td>
    <td>$<?= number_format($car['asking_price'],2) ?></td>
    <td>
        <a href="?edit=<?= urlencode($car['vin']) ?>">Edit</a> | 
        <a href="?delete=<?= urlencode($car['vin']) ?>" style="color:red;">Delete</a>
    </td>
</tr>
<?php 
$class = ($class=='odd') ? 'even' : 'odd';
endforeach; 
?>
</table>

<?php include 'components/footer250.php'; ?>
</body>
</html>
