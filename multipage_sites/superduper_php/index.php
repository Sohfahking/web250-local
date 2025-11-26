<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>super duper paratrooper page</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>
<body>
<header>

	<a href = "index.php"  >
		<img class = "linkedimage" src = "images/sdp_banner.png" alt = "Super Duper Paratrooper" />
	</a>
	<br />
	
	
    <!-- NO .php in the URL -->
    <a href="?p=home">home</a> |
    <a href="?p=alpha">alpha</a> |
    <a href="?p=bravo">bravo</a> |
    <a href="?p=charlie">charlie</a> |
    <a href="?p=delta">delta</a> |
    <a href="?p=echo">echo</a>

</header>
<hr />
<!-- dynamic content goes here -->

<?php

// Get p (but avoid undefined index error)
$page = isset($_GET["p"]) ? $_GET["p"] : "home";

$filename = $page . ".php";

$validPages = ["home","alpha","bravo","charlie","delta","echo"];

if (in_array($page, $validPages)) {
    include $filename;
} else {
    echo "<p>Invalid page requested.</p>";
}

?>
<hr />

<footer id = "tagline">
      		We bring it... from above!
	<br/><br/>
	<a href="http://validator.w3.org/check?uri=referer">
		<img src="images/valid_html5.gif"  alt="Valid HTML 5" 
			height="31" width="88" style="border:0px;" />

	</a>
</footer>

</body>
</html>