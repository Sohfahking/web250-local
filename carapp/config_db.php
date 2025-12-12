<?php
// config_db.php
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Check if inventory exists
    $stmt = $pdo->query("SELECT to_regclass('public.cars')");
    $carsExists = $stmt->fetchColumn();

    if (!$carsExists) {
        $createCars = "
            CREATE TABLE cars (
                vin VARCHAR(20) PRIMARY KEY,
                make VARCHAR(50) NOT NULL,
                model VARCHAR(50) NOT NULL,
                year VARCHAR(4),
                ext_color VARCHAR(30),
                asking_price NUMERIC(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->exec($createCars);
        echo "Table 'cars' created successfully.<br>";
    }

    // Images table
    $stmt = $pdo->query("SELECT to_regclass('public.images')");
    $imagesExists = $stmt->fetchColumn();

    if (!$imagesExists) {
        $createImages = "
            CREATE TABLE images (
                imageid SERIAL PRIMARY KEY,
                vin VARCHAR(20) REFERENCES inventory(vin) ON DELETE CASCADE,
                filename VARCHAR(255) NOT NULL,
                uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->exec($createImages);
        echo "Table 'images' created successfully.<br>";
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
