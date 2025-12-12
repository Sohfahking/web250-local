<?php
include __DIR__ . '/car_db.php';

// Query all cars
$stmt = $pdo->query("SELECT * FROM inventory ORDER BY make, model");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Start the table
echo "<table id='Grid' style='width: 80%'>";
echo "<tr>";
echo "<th>Make</th>";
echo "<th>Model</th>";
echo "<th>Asking Price</th>";
echo "<th>Action</th>";
echo "</tr>";

$class = "odd";

// Loop through rows
foreach ($cars as $car) {

    // Support both lowercase and uppercase column names
    $vin   = htmlspecialchars($car['vin']   ?? $car['VIN']   ?? '');
    $make  = htmlspecialchars($car['make']  ?? $car['Make']  ?? '');
    $model = htmlspecialchars($car['model'] ?? $car['Model'] ?? '');
    $price = htmlspecialchars($car['asking_price'] ?? $car['ASKING_PRICE'] ?? '');

    echo "<tr class='$class'>";
    echo "<td><a href='selectCar.php?VIN=$vin'>$make</a></td>";
    echo "<td>$model</td>";
    echo "<td>$$price</td>";

    echo "<td>
            <a href='FormEdit.php?VIN=$vin'>Edit</a> |
            <a href='deletecar.php?VIN=$vin' onclick=\"return confirm('Delete this car?');\">Delete</a>
          </td>";
    echo "</tr>";

    // Flip row style
    $class = ($class === "odd") ? "even" : "odd";
}

echo "</table>";

?>
