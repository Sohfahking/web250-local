<?php
// car_db.php
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

try {
    // Connect to PostgreSQL using PDO
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // === INVENTORY TABLE ===
    $stmt = $pdo->query("SELECT to_regclass('public.inventory')");
    $inventoryExists = $stmt->fetchColumn();

    if (!$inventoryExists) {
        $createInventory = "
            CREATE TABLE inventory (
                vin VARCHAR(20) PRIMARY KEY,
                make VARCHAR(50) NOT NULL,
                model VARCHAR(50) NOT NULL,
                asking_price NUMERIC(10,2) NOT NULL
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                
            );
        ";
        $pdo->exec($createInventory);
        echo "Table 'inventory' created successfully.<br>";
    }

    // === IMAGES TABLE ===
    $stmt = $pdo->query("SELECT to_regclass('public.images')");
    $imagesExists = $stmt->fetchColumn();

    if (!$imagesExists) {
        $createImages = "
            CREATE TABLE images (
                ImageID SERIAL PRIMARY KEY,
                vin VARCHAR(20) REFERENCES inventory(VIN) ON DELETE CASCADE,
                filename VARCHAR(255) NOT NULL
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