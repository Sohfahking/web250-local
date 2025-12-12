<?php
// --- Start PHP before any HTML to avoid accidental output ---
include 'db.php';

// Validate VIN exists
$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    die("<p>Error: VIN not provided.</p>");
}

// Sanitize value for output and SQL
$vin_safe = htmlspecialchars($vin);
$vin_db = $mysqli->real_escape_string($vin);

// Fetch vehicle details
$query = "SELECT * FROM INVENTORY WHERE VIN='$vin_db'";

if (!$result = $mysqli->query($query)) {
    die("<p>Sorry, a vehicle with VIN $vin_safe cannot be found. Error: " . $mysqli->error . "</p>");
}

// Default values to avoid undefined index warnings
$year = $make = $model = $trim = $color = $interior = $mileage = $transmission = $price = "Not available";

// Pull record if it exists
if ($result_ar = mysqli_fetch_assoc($result)) {
    $year         = htmlspecialchars($result_ar['YEAR'] ?? "");
    $make         = htmlspecialchars($result_ar['Make'] ?? "");
    $model        = htmlspecialchars($result_ar['Model'] ?? "");
    $trim         = htmlspecialchars($result_ar['TRIM'] ?? "");
    $color        = htmlspecialchars($result_ar['EXT_COLOR'] ?? "");
    $interior     = htmlspecialchars($result_ar['INT_COLOR'] ?? "");
    $mileage      = htmlspecialchars($result_ar['MILEAGE'] ?? "");
    $transmission = htmlspecialchars($result_ar['TRANSMISSION'] ?? "");
    $price        = htmlspecialchars($result_ar['ASKING_PRICE'] ?? "");
}
?>

<html>
<head>
<title>Sam's Used Cars - Image Upload</title>
</head>
<body background="bg.jpg">
<h1>Sam's Used Cars</h1>
<h3>Add Image</h3>

<?php
echo "<p>$color $year $make $model <br>VIN: $vin_safe</p>";

if (is_numeric($price)) {
    echo "<p>Asking Price: $" . number_format($price, 0) . "</p>";
} else {
    echo "<p>Asking Price: Not available</p>";
}
?>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file"><br>

    <input name="VIN" type="hidden" value="<?php echo $vin_safe; ?>" />

    <input type="submit" name="submit" value="Submit">
</form>

<br/><br/>

<?php
// Fetch images
$query = "SELECT * FROM images WHERE VIN='$vin_db'";

if ($result = $mysqli->query($query)) {
    while ($result_ar = mysqli_fetch_assoc($result)) {
        $image = htmlspecialchars($result_ar['FILENAME'] ?? "");

        if ($image) {
            echo "<img src='uploads/$image' width='250'> ";
        }
    }
}

$mysqli->close();
include 'footer.php';
?>

</body>
</html>
