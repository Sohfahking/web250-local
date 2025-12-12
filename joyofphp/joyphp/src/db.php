<?php
// Determine environment
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Local XAMPP MySQL
    $db_type = "mysql";
    $host    = "localhost";
    $db      = "Cars";
    $user    = "root";
    $pass    = "";
    $port    = 3306;
} else {
    // Live Render PostgreSQL
    $db_type = "pgsql";
    $host    = getenv('DB_HOST');      // e.g., dpg-xxx.render.com
    $db      = getenv('DB_DATABASE');  // your Render database name
    $user    = getenv('DB_USERNAME');  // your Render DB user
    $pass    = getenv('DB_PASSWORD');  // your Render DB password
    $port    = getenv('DB_PORT') ?: 5432;
}

// Build DSN for PDO
if ($db_type == "mysql") {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
} else { // pgsql
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

// Example: how to use $pdo in pages
// $stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make");
// $rows = $stmt->fetchAll();
?>

