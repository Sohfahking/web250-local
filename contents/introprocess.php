<?php
// ===== PROCESS INPUT ONCE =====
$first = trim($_POST['first'] ?? '');
$middle = trim($_POST['middle'] ?? '');
$last = trim($_POST['last'] ?? '');

if (!empty($middle)) {
    $middle = strtoupper(substr($middle, 0, 1)) . ".";
}

$fullName = trim("$first $middle $last");

$about = $_POST['about'] ?? '';
$personal = $_POST['personal'] ?? '';
$professional = $_POST['professional'] ?? '';
$academic = $_POST['academic'] ?? '';
$background_subject = $_POST['background_subject'] ?? '';
$platform = $_POST['platform'] ?? '';

$image = $_POST['image'] ?? 'images/gudetamame.png';
$caption = $_POST['caption'] ?? '';

$courses = $_POST['courses'] ?? [];
$funFact = $_POST['funFact'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/styles.css">
<title>Dajabre Torain's Daring Tiger | WEB250 | Introduction</title>
</head>

<body>
<header><?php include("components/header250.php"); ?></header>

<main>
<h2>Introduction</h2>

<?php if (!empty($fullName)): ?>
<h3><?php echo htmlspecialchars($fullName); ?></h3>
<?php endif; ?>

<figure>
<img src="<?php echo htmlspecialchars($image); ?>" alt="Profile Image">
<?php if (!empty($caption)): ?>
<figcaption><em><?php echo htmlspecialchars($caption); ?></em></figcaption>
<?php endif; ?>
</figure>

<?php if (!empty($about)): ?>
<p><?php echo nl2br(htmlspecialchars($about)); ?></p>
<?php endif; ?>

<ul>
<?php if (!empty($personal)): ?>
<li><strong>Personal Background</strong>: <?php echo htmlspecialchars($personal); ?></li>
<?php endif; ?>

<?php if (!empty($professional)): ?>
<li><strong>Professional Background</strong>: <?php echo htmlspecialchars($professional); ?></li>
<?php endif; ?>

<?php if (!empty($academic)): ?>
<li><strong>Academic Background</strong>: <?php echo htmlspecialchars($academic); ?></li>
<?php endif; ?>

<?php if (!empty($background_subject)): ?>
<li><strong>Background in this Subject</strong>: <?php echo htmlspecialchars($background_subject); ?></li>
<?php endif; ?>

<?php if (!empty($platform)): ?>
<li><strong>Primary Computer Platform</strong>: <?php echo htmlspecialchars($platform); ?></li>
<?php endif; ?>

<?php
$filteredCourses = array_filter($courses, fn($c) => trim($c) !== '');
if (!empty($filteredCourses)):
?>
<li><strong>Courses I'm In & Why</strong>:
<ul>
<?php foreach ($filteredCourses as $course): ?>
<li><?php echo htmlspecialchars($course); ?></li>
<?php endforeach; ?>
</ul>
</li>
<?php endif; ?>

<?php if (!empty($funFact)): ?>
<li><strong>Funny/Interesting Item About Yourself</strong>: <?php echo htmlspecialchars($funFact); ?></li>
<?php endif; ?>
</ul>

</main>

<footer><?php include("components/footer250.php"); ?></footer>
</body>
</html>
