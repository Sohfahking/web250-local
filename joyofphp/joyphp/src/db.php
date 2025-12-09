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
    $host = "sql305.infinityfree.com";
    $user = "if0_40312071";
    $pass = "Yiddies1";
    $db   = "if0_40312071_cars";  
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


