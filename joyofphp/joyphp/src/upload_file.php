<?php
include 'db.php';

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
echo "VIN: " . $vin . "<br>";
echo "Stored temporarily as: " . $_FILES["file"]["tmp_name"] . "<br><br>";

// Ensure uploads folder exists
$upload_dir = __DIR__ . "/uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true); // create folder if missing
}

$target_path = $upload_dir . basename($_FILES['file']['name']);
$imagename = "uploads/" . basename($_FILES['file']['name']);

echo "This script is running in: " . getcwd() . "<br>";
echo "The uploaded file will be stored in the folder: " . $upload_dir . "<br>";
echo "The full file name of the uploaded file is '" . $target_path . "'<br>";
echo "The relative name of the file for use in IMG tag is " . $imagename . "<br><br>";

// Move uploaded file
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "The file " . basename($_FILES['file']['name']) . " has been uploaded<br>";

    // Insert into database
    $file_name = $_FILES["file"]["name"];
    $query = "INSERT INTO images (VIN, FILENAME) VALUES ('$vin', '$file_name')";

    if ($mysqli->query($query)) {
        echo "<p>You have successfully entered $file_name into the database.</p>";
    } else {
        echo "Error entering $file_name into database: " . $mysqli->error . "<br>";
    }

    $mysqli->close();

    echo "<img src='$imagename' width='150'><br>";
    echo "<a href='AddImage.php?VIN=$vin'>Add another image for this car</a>";
} else {
    echo "There was an error uploading the file, please try again!";
}

include 'footer.php';
?>
