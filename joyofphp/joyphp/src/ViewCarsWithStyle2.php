<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sam's Used Cars</title>

    <style>
        #Grid {
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
            width:80%;
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
            background-color: #F2F5A9;
        }
        #Grid tr.even td {
            background-color: white;
        }
        .auto-style1 {
            text-align: left;
        }
    </style>
</head>

<body background="bg.jpg">
<h1>Sam's Used Cars</h1>
<h3>Current Inventory</h3>

<div class="auto-style1">

<?php
include 'db.php'; // Supplies $pdo (PDO connection)

// Query all cars
$stmt = $pdo->query("SELECT * FROM inventory ORDER BY make, model");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Start the table
echo "<table id='Grid' style='width: 80%'>";
echo "<tr>";
echo "<th>Make</th>";
echo "<th>Model</th>";
echo "<th>Asking Price</th>";
echo "<th>Action</th>";
echo "</tr>";

$class = "odd";

// Loop through rows
foreach ($cars as $car) {

    // Support both lowercase and uppercase column names
    $vin   = htmlspecialchars($car['vin']   ?? $car['VIN']   ?? '');
    $make  = htmlspecialchars($car['make']  ?? $car['Make']  ?? '');
    $model = htmlspecialchars($car['model'] ?? $car['Model'] ?? '');
    $price = htmlspecialchars($car['asking_price'] ?? $car['ASKING_PRICE'] ?? '');

    echo "<tr class='$class'>";
    echo "<td><a href='viewcar.php?VIN=$vin'>$make</a></td>";
    echo "<td>$model</td>";
    echo "<td>$price</td>";

    echo "<td>
            <a href='FormEdit.php?VIN=$vin'>Edit</a> |
            <a href='deletecar.php?VIN=$vin' onclick=\"return confirm('Delete this car?');\">Delete</a>
          </td>";
    echo "</tr>";

    // Flip row style
    $class = ($class === "odd") ? "even" : "odd";
}

echo "</table>";

include 'footer.php';
?>

</div>
</body>
</html>
