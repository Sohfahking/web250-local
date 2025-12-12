<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Index/Home">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Dajabre Torain">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--  Link to CSS file(s) -->
  <link rel="stylesheet" href="styles/styles.css">

  <title> Dajabre Torain's Daring Tiger | WEB250 | Home</title>

  <!-- Accumulus Validator -->
  <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>

  <style>
    #Grid {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      width: 80%;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto;
    }

    #Grid td,
    #Grid th {
      font-size: 1em;
      border: 1px solid #61ADD7;
      padding: 3px 7px 2px 7px;
    }

    #Grid th {
      font-size: 1.1em;
      text-align: left;
      padding-top: 5px;
      padding-bottom: 4px;
      background-color: #C2D9FE;
      color: lightslategray;
    }

    #Grid .odd td {
      background-color: #F2F5A9;
    }

    #Grid .even td {
      background-color: white;
    }

    .auto-style1 {
      text-align: left;
    }
  </style>
</head>

<body>
  <header><?php include("components/header250.php"); ?></header>

  <main>
    
  <h2>Current Inventory</h2>
  <h2><a href="car_add.php?" >Add Car</a></h2>

  
  <div class="auto-style1">

    <?php
    include __DIR__ . '/car_db.php';

    // Query all cars
    $stmt = $pdo->query("SELECT * FROM cars ORDER BY make, model");
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
      echo "<td><a href='car_select.php?VIN=$vin'>$make</a></td>";
      echo "<td>$model</td>";
      echo "<td>$$price</td>";

      echo "<td>
            <a href='car_edit.php?VIN=$vin'>Edit</a> |
            <a href='car_addPic.php?VIN=$vin'>Add Image</a>
            <a href='car_delete.php?VIN=$vin' onclick=\"return confirm('Delete this car?');\">Delete</a>
          </td>";
      echo "</tr>";

      // Flip row style
      $class = ($class === "odd") ? "even" : "odd";
    }

    echo "</table>";
    ?>
  </div>

</body>

</html>