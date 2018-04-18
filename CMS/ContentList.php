<?php
require_once('../Includes/Security.php');
require_once('../Includes/Connection.php');

/* Kijk of er op knoppen zijn gedrukt */
if (isset($_POST['new'])) {
    header('Location:NewContent.php');
}
else if (isset($_POST['back'])) {
    header('Location:../Index.html');
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Portfolio</title>
    <meta name="description" content="Portfolio Menno Brands">
    <meta name="author" content="Menno Brands">
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" type="text/css" href="../CSS/Main.css">
    <script type="text/javascript" src="../Javascript/Functions.js"></script>
</head>
<nav>
    <section class="Navlogo" id="front">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrandsBlack.png" alt="logo button">
            </a>
        </section>
    </section>
    <section class="Navlogo" id="back">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrands.png" alt="logo button">
            </a>
        </section>
    </section>
</nav>
<body>
<section id="ContentList">
    <h2> Portfolio Content List </h2>

    <?php

    /* Haal een lijst met alle content op */

    $ContentInfo = $conn->prepare("SELECT ID, Title, Category FROM content ORDER BY Category ASC");
    $ContentInfo -> execute();

    $ContentInfo->bindColumn(1, $ID);
    $ContentInfo->bindColumn(2, $Title);
    $ContentInfo->bindColumn(3, $Category);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Title</th>";
    echo "<th>Category</th>";
    echo "<th>Edit</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    While ($ContentInfo->fetch()) {
        echo "<tr>";
        echo "<td>".$ID."</td>";
        echo "<td>".$Title."</td>";
        echo "<td>".$Category."</td>";
        echo "<td><a href ='EditContent.php?id=".$ID. "' type='submit' name='knop'>  <img src='../Images/edit.png'> </a></td>";
        echo "<td><a href = '#' onclick='check(".$ID.")' type='submit' name='knop'>  <img src='../Images/delete.png'> </a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    ?>
    <br/>
    <br/>
    <form action="ContentList.php" method="POST" autocomplete="off">
        <br/>
        <!-- add & back knop -->
        <input type="submit" name = "new" value="+ Add">
        <input type="submit" name = "back" value="<- Back">
    </form>
</section>
</body>
</html>
