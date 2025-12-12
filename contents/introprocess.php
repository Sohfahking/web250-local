<?php
// Collect submitted data
$first = $_POST['first'] ?? '';
$middle = $_POST['middle'] ?? '';
$last = $_POST['last'] ?? '';
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Index/Home">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Dajabre Torain">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Link to CSS file(s) -->
    <link rel="stylesheet" href="styles/default.css">

    <title> Dajabre Torain's Daring Tiger | WEB215 |Introduction</title>

    <!-- Dynamic header/footer JS -->
    <script src="scripts/components215.js" defer></script>

    <script src="https://lint.page/kit/6664c1.js" crossorigin="anonymous"></script>
</head>

<body>
    <header></header>
    <main>
        <h2>Introduction</h2>

        <?php
        // Collect submitted values
        $first = trim($_POST['first'] ?? '');
        $middle = trim($_POST['middle'] ?? '');
        $last = trim($_POST['last'] ?? '');

        // Process middle initial: take only the first character, uppercase, add a period
        if (!empty($middle)) {
            $middle = strtoupper(substr($middle, 0, 1)) . ".";
        }
        
        $fullName = trim("$first $middle $last");
        if (!empty($fullName)) :
        ?>
            <h3><?php echo htmlspecialchars($fullName); ?></h3>
        <?php endif; ?>

        <figure style="text-align:center; margin:20px auto;">
            <img src="images/gudetamame.png" alt="Profile Image" style="display:block; margin:0 auto;">
            <figcaption><em>My Mood</em></figcaption>
        </figure>


        <p><?php echo nl2br(htmlspecialchars($about)); ?></p>

        <ul>
            <?php if (!empty($personal)): ?>
                <li><strong>Personal background</strong>: <?php echo htmlspecialchars($personal); ?></li>
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
            if (!empty(array_filter($courses))) {
                echo '<li><strong>Courses I\'m In & Why</strong>:<ul>';
                foreach ($courses as $course) {
                    if (!empty(trim($course))) {
                        echo '<li><strong>' . htmlspecialchars($course) . '</strong></li>';
                    }
                }
                echo '</ul></li>';
            }
            ?>

            <?php if (!empty($funFact)): ?>
                <li><strong>Funny/Interesting Item About Yourself</strong>: <?php echo htmlspecialchars($funFact); ?></li>
            <?php endif; ?>
        </ul>
    </main>
    <footer></footer>
</body>

</html>