<?php
include 'db.php'; // this should define $pdo

// Capture POSTed values
$VIN = trim($_POST['VIN']);
$Make = trim($_POST['Make']);
$Model = trim($_POST['Model']);
$Price = $_POST['Asking_Price'];

// Build the SQL query using placeholders to prevent SQL injection
$sql = "INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE) 
        VALUES (:vin, :make, :model, :price)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':vin'   => $VIN,
        ':make'  => $Make,
        ':model' => $Model,
        ':price' => $Price
    ]);

    echo "<p>You have successfully entered $Make $Model into the database.</p>";
} catch (PDOException $e) {
    echo "Error entering car: " . $e->getMessage();
}
?>

<p><a href="ViewCars.php">View All Cars</a></p>

<?php include 'footer.php'; ?>
