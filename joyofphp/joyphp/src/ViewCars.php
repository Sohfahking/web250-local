<?php
include 'db.php';

try {
    $stmt = $pdo->query("SELECT * FROM inventory ORDER BY make");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red'>Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
    $rows = []; // fallback so foreach won't fail
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>

<table id="Grid" style="width: 80%;">
    <thead>
        <tr>
            <th style="width: 50px">Make</th>
            <th style="width: 50px">Model</th>
            <th style="width: 50px">Asking Price</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $class = "odd";
        foreach ($rows as $row): 
            $make  = htmlspecialchars($row['make'] ?? '');
            $model = htmlspecialchars($row['model'] ?? '');
            $price = number_format($row['asking_price'] ?? 0, 2);
        ?>
        <tr class="<?= $class ?>">
            <td><?= $make ?></td>
            <td><?= $model ?></td>
            <td>$<?= $price ?></td>
        </tr>
        <?php 
        $class = ($class == "odd") ? "even" : "odd";
        endforeach; 
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
</body>
</html>


