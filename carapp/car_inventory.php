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

<div class="auto-style1">
  <?php
include __DIR__ . '/car_db.php';

//form submission for adding a new car
$addMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCar'])) {
    $vin   = trim($_POST['vin'] ?? '');
    $make  = trim($_POST['make'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year  = trim($_POST['year'] ?? '');
    $ext   = trim($_POST['ext_color'] ?? '');
    $price = trim($_POST['asking_price'] ?? '');

    if ($vin && $make && $model && $price) {
        $stmt = $pdo->prepare("
            INSERT INTO inventory (vin, make, model, year, ext_color, asking_price)
            VALUES (:vin, :make, :model, :year, :ext_color, :price)
        ");
        try {
            $stmt->execute([
                ':vin'       => $vin,
                ':make'      => $make,
                ':model'     => $model,
                ':year'      => $year,
                ':ext_color' => $ext,
                ':price'     => $price
            ]);
            $addMessage = "<p style='color:green; font-weight:bold;'>Car $make $model added successfully!</p>";
        } catch (PDOException $e) {
            $addMessage = "<p style='color:red;'>Error adding car: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        $addMessage = "<p style='color:red;'>VIN, Make, Model, and Asking Price are required.</p>";
    }
}

// Fetch all cars
$stmt = $pdo->query("SELECT vin, make, model, year, ext_color, asking_price FROM inventory ORDER BY make, model");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Daring Tiger's Cars Inventory</h2>

<!-- Show add message -->
<?= $addMessage ?>

<!-- Add New Car Form -->
<h3>Add New Car</h3>
<form method="post">
    <label>VIN: <input type="text" name="vin" required></label><br>
    <label>Make: <input type="text" name="make" required></label><br>
    <label>Model: <input type="text" name="model" required></label><br>
    <label>Year: <input type="text" name="year"></label><br>
    <label>Ext Color: <input type="text" name="ext_color"></label><br>
    <label>Asking Price: <input type="number" step="0.01" name="asking_price" required></label><br>
    <input type="submit" name="addCar" value="Add Car">
</form>

<hr>

<!-- Inventory Table -->
<table id="Grid" style="width:80%; border-collapse: collapse;">
    <tr style="background-color:#ccc;">
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Ext Color</th>
        <th>Asking Price</th>
        <th>Action</th>
    </tr>
    <?php
    $class = "odd";
    foreach ($cars as $car):
        $vin   = htmlspecialchars($car['vin'] ?? '');
        $make  = htmlspecialchars($car['make'] ?? '');
        $model = htmlspecialchars($car['model'] ?? '');
        $year  = htmlspecialchars($car['year'] ?? '');
        $ext   = htmlspecialchars($car['ext_color'] ?? '');
        $price = htmlspecialchars($car['asking_price'] ?? '');
        ?>
        <tr class="<?= $class ?>" style="background-color:<?= $class === 'odd' ? '#f9f9f9' : '#fff' ?>;">
            <td><?= $vin ?></td>
            <td><?= $make ?></td>
            <td><?= $model ?></td>
            <td><?= $year ?></td>
            <td><?= $ext ?></td>
            <td>$<?= $price ?></td>
            <td>
                <a href="car_edit.php?vin=<?= $vin ?>">Edit</a> |
                <a href="car_delete.php?vin=<?= $vin ?>" onclick="return confirm('Delete this car?');">Delete</a>
            </td>
        </tr>
        <?php
        $class = ($class === "odd") ? "even" : "odd";
    endforeach;
    ?>
</table>

  </div>

  <footer><?php include("components/footer250.php"); ?></footer>
</body>

</html>