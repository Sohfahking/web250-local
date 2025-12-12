<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Dajabre Torain">
  <meta name="keywords" content="HTML, CSS, PHP, WEB250">
  <meta name="description" content="Dynamic Multipage PHP Site">

  <link rel="stylesheet" href="styles/styles.css">

  <?php
  //determine what page is loaded
  $page = $_GET['page'] ?? 'index';

  //page titles
  $titles = [
    "index"       => "Dajabre Torain's Daring Tiger | WEB250 | Home",
    "intro250"    => "Dajabre Torain's Daring Tiger | WEB250 | Introduction",
    "contract250" => "Dajabre Torain's Daring Tiger | WEB250 | Course Contract",
    "brand250"    => "Dajabre Torain's Daring Tiger | WEB250 | Brand",
    "template250" => "Dajabre Torain's Daring Tiger | WEB250 | Template",

    // Car app pages
    "car_inventory"  => "Dajabre Torain's Daring Tiger | Car App | Inventory",
    "car_upload" => "Dajabre Torain's Daring Tiger | Car App | Upload Image",
    "car_edit"   => "Dajabre Torain's Daring Tiger | Car App | Edit Car"
  ];

  //dynamic title (fallback if not found)
  $title = $titles[$page] ?? "Dajabre Torain's Daring Tiger";
  ?>
  <title><?= $title ?></title>

  <!-- Accumulus Validator -->
  <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <h1>Dajabre Torain's Daring Tiger | WEB250</h1>
    <nav>
      <ul>
        <li><a href="index.php?page=index" title="Index">Home</a></li>
      </ul>

      <ul class="main-menu">
        <li><a href="#" title="Contents">Contents ↓</a>
          <ul class="sub-menu">
            <li><a href="index.php?page=intro250" title="My Introduction">Introduction</a></li>
            <li><a href="index.php?page=contract250" title="My Contract">Contract</a></li>
            <li><a href="index.php?page=brand250" title="My Brand">Brand</a></li>
            <li><a href="index.php?page=template250" title="Temp">Template</a></li>

          </ul>
        </li>
      </ul>

      <ul class="main-menu">
        <li><a href="" title="My Car App">My Cars</a>
         <ul class="sub-menu">
            <li><a href="./carapp/car_inventory.php" title="Sam's Used Cars">Inventory</a></li>
          </ul>
        </li>
      </ul>

      <ul class="main-menu">
        <li><a href="#" title="Multipage Static PHP">Multipage Sites: Static & PHP ↓</a>
          <ul class="sub-menu">
            <li><a href="./multipage_sites/superduper_static/index.htm" title="Multipage Static">SuperDuper Static</a></li>
            <li><a href="./multipage_sites/superduper_php/index.php" title="Multipage PHP">SuperDuper PHP</a></li>
          </ul>
        </li>
      </ul>

      <ul class="main-menu">
        <li><a href="./joyofphp/joyphp/src/index.php" title="Joy of PHP">Joy of PHP ↓</a>
        <ul class="sub-menu">
            <li><a href="./joyofphp/joyphp/src/samsusedcars.php" title="Sam's Used Cars">Sam's Used Cars </a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

<main>
<?php
// Determine path based on page
if (str_starts_with($page, 'car_')) {
    // Map page to carapp folder
    $file = "carapp/" . substr($page, 7) . ".php"; // remove 'carapp_' prefix
} else {
    // Normal contents folder
    $file = "contents/" . $page . ".php";
}

// Load file if exists, else show 404
if (file_exists($file)) {
    include($file);
} else {
    include("contents/404.php");
}
?>

</main>


  <footer>
    <nav>
      <ul>
        <li><a href="https://github.com/Sohfahking" target="_blank" title="GitHub">GitHub</a></li>
        <li><a href="http://Sohfahking.GitHub.io" target="_blank" title="GitHub.io">GitHub.io</a></li>
        <li><a href="https://sohfahking.github.io/web115/" target="_blank" title="WEB115">WEB115.io</a></li>
        <li><a href="https://sohfahking.github.io/web215/" target="_blank" title="WEB215">WEB215.io</a></li>
        <li><a href="https://sohfahking.github.io/web250/" target="_blank" title="WEB250">WEB250.io</a></li>
        <li><a href="https://www.freecodecamp.org/DajabreTorain" target="_blank" title="freeCodeCamp">freeCodeCamp</a>
        </li>
        <li><a href="https://www.codecademy.com/profiles/DajabreTorain" target="_blank"
            title="Codecademy">Codecademy</a></li>
        <li><a href="https://jsfiddle.net/user/DajabreTorain" target="_blank" title="JSFiddle">JSFiddle</a></li>
        <li><a href="https://www.linkedin.com/in/dajabre-torain/" target="_blank" title="LinkedIn">LinkedIn</a></li>
      </ul>
    </nav>
    <p>Designed by Dajabre Torain | &copy; 2025</p>
  </footer>

</body>

</html>