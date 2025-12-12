<?php
include __DIR__ . '/car_db.php';

$vin = trim($_POST['VIN']);

// Check for upload errors
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
    exit();
}

// Debug info
echo "Upload: " . $_FILES["file"]["name"] . "<br>";
echo "Type: " . $_FILES["file"]["type"] . "<br>";
echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "VIN: " . htmlspecialchars($vin) . "<br>";
echo "Stored temporarily as: " . $_FILES["file"]["tmp_name"] . "<br><br>";

// Ensure uploads folder exists
$upload_dir = __DIR__ . "/uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true); // create folder if missing
}

$filename = basename($_FILES['file']['name']);
$target_path = $upload_dir . $filename;
$imagename = "uploads/" . $filename; // relative path for IMG tag

echo "This script is running in: " . getcwd() . "<br>";
echo "The uploaded file will be stored in the folder: " . $upload_dir . "<br>";
echo "The full file name of the uploaded file is '" . $target_path . "'<br>";
echo "The relative name of the file for use in IMG tag is " . $imagename . "<br><br>";

// Move uploaded file
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "The file " . $filename . " has been uploaded<br>";

    // Insert into database using PDO prepared statement
    try {
        $stmt = $pdo->prepare("INSERT INTO images (vin, filename) VALUES (:vin, :filename)");
        $stmt->execute([
            ':vin' => $vin,
            ':filename' => $filename
        ]);

        echo "<p>You have successfully entered $filename into the database.</p>";
    } catch (PDOException $e) {
        echo "Error entering $filename into database: " . $e->getMessage() . "<br>";
    }

    echo "<img src='$imagename' width='150'><br>";
    echo "<a href='AddImage.php?VIN=" . urlencode($vin) . "'>Add another image for this car</a>";
} else {
    echo "There was an error uploading the file, please try again!";
}


?>

<h2><a href="car_inventory.php">Back to Inventory</a></h2>
