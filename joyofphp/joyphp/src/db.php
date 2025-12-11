<?php
// Check if we are on localhost or live server
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Local XAMPP settings
    $host = "localhost";
    $user = "root";
    $pass = "";          //local XAMPP password
    $db   = "Cars";      //local database name
} else {
    // InfinityFree live settings
    $host = getenv('DB_HOST');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');
    $db   = getenv('DB_DATABASE'); 
}

$dsn = "pgsql:host=$host;dbname=$db;user=$user;password=$pass";
try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Create connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Optional: set charset
$mysqli->set_charset("utf8");
?>


