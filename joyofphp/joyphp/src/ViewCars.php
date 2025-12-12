<?php
include 'db.php';

try {
    // Fetch all cars from inventory ordered by Make
    $stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make");
    $rows = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching cars: " . $e->getMessage());
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
        if ($rows) {
            foreach ($rows as $row):
        ?>
            <tr class="<?= $class ?>">
                <td><?= htmlspecialchars($row['Make']) ?></td>
                <td><?= htmlspecialchars($row['Model']) ?></td>
                <td>$<?= number_format($row['ASKING_PRICE'], 2) ?></td>
            </tr>
        <?php
                $class = ($class == "odd") ? "even" : "odd";
            endforeach;
        } else {
            echo "<tr><td colspan='3'>No cars in inventory.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
</body>
</html>

