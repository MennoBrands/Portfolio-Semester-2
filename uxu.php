<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <meta name="description" content="Portfolio Menno Brands">
    <meta name="author" content="Menno Brands">
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" type="text/css" href="CSS/Main.css">
    <script src="Plugins/scrollreveal-master/dist/scrollreveal.min.js"></script>
</head>
<nav>
    <?php
    /* variabel nodig in nav.php */
    $page = "uxu";
    require_once('Includes/Nav.php');
    ?>
</nav>
<body>
<main>
    <?php
    require_once('Includes/Content.php');
    ?>
</main>

<!-- Script voor de scroll reveal Javascript plugin -->
<script src="Javascript/Scrollreveal.js"></script>
</body>
</html>