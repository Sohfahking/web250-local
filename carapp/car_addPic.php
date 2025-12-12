<?php
// car_addPic.php
include __DIR__ . '/car_db.php'; // supplies $pdo

// Get VIN from POST or GET
$vin = $_POST['VIN'] ?? $_GET['VIN'] ?? '';

if (!$vin) {
    echo "<p style='color:red;'>Error: VIN is missing.</p>";
    return;
}

// Handle file upload if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "<p style='color:red;'>Upload error: " . $file['error'] . "</p>";
    } else {
        $upload_dir = __DIR__ . '/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $filename = basename($file['name']);
        $target_path = $upload_dir . $filename;
        $relative_path = "carapp/uploads/" . $filename;

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO images (vin, filename) VALUES (:vin, :filename)");
            $stmt->execute(['vin' => $vin, 'filename' => $filename]);

            echo "<p style='color:green;'>File '$filename' uploaded successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error moving uploaded file.</p>";
        }
    }
}

// Fetch all images for this car
$stmt = $pdo->prepare("SELECT filename FROM images WHERE vin = :vin");
$stmt->execute(['vin' => $vin]);
$images = $stmt->fetchAll();

?>

<h2>Add Image for Car VIN: <?= htmlspecialchars($vin) ?></h2>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">
    <label for="file">Choose an image:</label>
    <input type="file" name="file" id="file" required>
    <button type="submit">Upload</button>
</form>

<?php if ($images): ?>
    <h3>Current Images:</h3>
    <div style="display:flex; flex-wrap: wrap; gap: 10px;">
        <?php foreach ($images as $img): ?>
            <div>
                <img src="<?= "carapp/uploads/" . htmlspecialchars($img['filename']) ?>" 
                     alt="Car Image" style="width:150px; height:auto; border:1px solid #ccc; border-radius:5px;">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<p><a href="index.php?page=car_inventory">Return to Inventory</a></p>
