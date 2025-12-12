<?php
// DB connection variables
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_DATABASE') ?: 'cars';
$user = getenv('DB_USERNAME') ?: 'postgres';
$pass = getenv('DB_PASSWORD') ?: '';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: initialize table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS inventory (
            vin VARCHAR(50) PRIMARY KEY,
            make VARCHAR(50),
            model VARCHAR(50),
            year VARCHAR(4),
            trim VARCHAR(50),
            ext_color VARCHAR(50),
            int_color VARCHAR(50),
            mileage INTEGER,
            transmission VARCHAR(20),
            asking_price NUMERIC(10,2)
        );
    ");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
