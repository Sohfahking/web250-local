<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make");
$rows = $stmt->fetchAll();
?>

<table>
<?php foreach ($rows as $row): ?>
<tr>
    <td><?= htmlspecialchars($row['Make']) ?></td>
    <td><?= htmlspecialchars($row['Model']) ?></td>
    <td>$<?= number_format($row['ASKING_PRICE'], 2) ?></td>
</tr>
<?php endforeach; ?>
</table>


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
        while ($row = $result->fetch_assoc()) {
            echo "<tr class=\"$class\">";
            echo "<td>" . htmlspecialchars($row['Make']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Model']) . "</td>";
            echo "<td>$" . number_format($row['ASKING_PRICE'], 2) . "</td>";
            echo "</tr>\n";

            $class = ($class == "odd") ? "even" : "odd";
        }
        ?>
    </tbody>
</table>

<?php
// Free result set and close connection
$result->free();
$mysqli->close();
include 'footer.php'
?>

</body>
</html>
