<?php 
include __DIR__ . '/car_db.php';

// Get VIN from query string safely
$vin = $_GET['VIN'] ?? '';

if (!$vin) {
    echo "<p>No VIN specified.</p>";
    exit();
}

try {
    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT * FROM inventory WHERE vin = :vin");
    $stmt->execute([':vin' => $vin]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        echo "<p>Sorry, a vehicle with VIN $vin cannot be found.</p>";
        exit();
    }

    // Display car info
    $year = $car['year'] ?? '';
    $make = $car['make'] ?? '';
    $model = $car['model'] ?? '';
    $trim = $car['trim'] ?? '';
    $color = $car['ext_color'] ?? '';
    $interior = $car['int_color'] ?? '';
    $mileage = $car['mileage'] ?? '';
    $transmission = $car['transmission'] ?? '';
    $price = $car['asking_price'] ?? '';

    echo "<p>$year " . htmlspecialchars($make) . " " . htmlspecialchars($model) . "</p>";
    echo "<p>Asking Price: $" . number_format($price, 2) . "</p>";
    echo "<p>Exterior Color: " . htmlspecialchars($color) . "</p>";
    echo "<p>Interior Color: " . htmlspecialchars($interior) . "</p>";

} catch (PDOException $e) {
    echo "<p>Error fetching car: " . $e->getMessage() . "</p>";
}

?>