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

    <a href="car_add.php?">Add Car</a>

    <?php
    include __DIR__ . '/car_db.php';

    // Capture form values
    $vin   = $_POST['VIN'] ?? '';
    $make  = $_POST['Make'] ?? '';
    $model = $_POST['Model'] ?? '';
    $price = $_POST['Asking_Price'] ?? '';

    if (!$vin) {
        die("VIN missing.");
    }

    $stmt = $pdo->prepare("
    UPDATE inventory 
    SET make = :make, model = :model, asking_price = :price
    WHERE vin = :vin
");

    $success = $stmt->execute([
        'make'  => $make,
        'model' => $model,
        'price' => $price,
        'vin'   => $vin,
    ]);

    ?>

    <?php if ($success): ?>
        <p><strong><?= htmlspecialchars("$make $model") ?></strong> was updated successfully.</p>
    <?php else: ?>
        <p>There was an error saving the vehicle.</p>
    <?php endif; ?>

    <p><a href="https://web250-local.onrender.com/carapp/car_inventory.php">Back to Inventory</a></p>

    <footer><?php include("components/footer250.php"); ?></footer>

</body>

</html>