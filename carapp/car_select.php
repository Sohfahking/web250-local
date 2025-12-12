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

    <title> Dajabre Torain's Daring Tiger | WEB250 | Home</title>

    <!-- Accumulus Validator -->
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>

</head>

<body>
    <header><?php include("components/header250.php"); ?></header>

    <main>

        <?php
        include 'config_db.php';

        // Get VIN from query string safely
        $vin = $_GET['VIN'] ?? '';

        if (!$vin) {
            echo "<p>No VIN specified.</p>";
            exit();
        }

        try {
            // Prepare and execute query
            $stmt = $pdo->prepare("SELECT * FROM cars WHERE vin = :vin");
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
            $color = $car['ext_color'] ?? '';
            $price = $car['asking_price'] ?? '';

            echo "<p>$year " . htmlspecialchars($make) . " " . htmlspecialchars($model) . "</p>";
            echo "<p>Asking Price: $" . number_format($price, 2) . "</p>";
            echo "<p>Exterior Color: " . htmlspecialchars($color) . "</p>";
        } catch (PDOException $e) {
            echo "<p>Error fetching car: " . $e->getMessage() . "</p>";
        }

        ?>

    </main>
    <h2><a href="car_inventory.php">Back to Inventory</a></h2>

</body>

</html>