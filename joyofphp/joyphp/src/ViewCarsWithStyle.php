<?php
// Include database connection
include 'db.php'; // This file should create a $pdo PDO instance

// Fetch all cars
try {
    $stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching cars: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sam's Used Cars</title>
    <style>
        #Grid {
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
            width:50%;
            border-collapse:collapse;
            margin-left: auto;
            margin-right: auto;
        }
        #Grid td, #Grid th {
            font-size:1em;
            border:1px solid #61ADD7;
            padding:3px 7px 2px 7px;
        }
        #Grid th {
            font-size:1.1em;
            text-align:left;
            padding-top:5px;
            padding-bottom:4px;
            background-color:#C2D9FE;
            color: lightslategray;
        }
        #Grid tr.odd td {
            color:#000000;
            background-color: #F2F5A9;
        }
        #Grid tr.even td {
            color:#000000;
            background-color: white;
        }
        .auto-style1 {
            text-align: center;
        }
    </style>
</head>
<body background="bg.jpg">
<h1>Sam's Used Cars</h1>
<h3>Current Inventory</h3>
<div class="auto-style1">

<table id="Grid">
    <tr>
        <th style="width: 15px">Make</th>
        <th style="width: 30px">Model</th>
        <th style="width: 50px">Action</th>
    </tr>
    <?php
    $class = "odd";
    foreach ($cars as $car) {
        echo "<tr class=\"$class\">";
        echo "<td><a href='viewcar.php?VIN=" . htmlspecialchars($car['VIN']) . "'>" . htmlspecialchars($car['Make']) . "</a></td>";
        echo "<td>" . htmlspecialchars($car['Model']) . "</td>";
        echo "<td><a href='AddImage.php?VIN=" . htmlspecialchars($car['VIN']) . "'>Add Image</a></td>";
        echo "</tr>\n";
        $class = ($class == "odd") ? "even" : "odd";
    }
    ?>
</table>

<?php include 'footer.php'; ?>
</div>
</body>
</html>
